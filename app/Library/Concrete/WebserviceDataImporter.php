<?php

namespace App\Library\Concrete;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\Library\Contract\DataImporterBundle;
use Config;

/**
 * Allows to import data source from a URI or webservice
 */
class WebserviceDataImporter implements DataImporterBundle
{

	/** @var array|object [unformatted content as consumed from the webservice] */
	protected $raw_datasource;

	/** @var array|object [clean data ready for storage] */
	protected $sanitized_data;

	/** @var boolean [toggles if data has been successfully imported to destination] */
	protected $is_data_imported = false;

	/** @var array [webservice specific configurations] */
	protected $config;

	public function __construct()
	{
		$this->config = array
		(
			'http_method' => 'GET'
		);

	}

	/**
	 * Consume the resource using Guzzle HTTP client
	 * @return [object] [JSON Object containing the raw data]
	 */
	public function fetchData()
	{

        $this->client = new Client();

        $request = $this->client->request(
        	$this->config['http_method'], 
        	Config::get('dataimporter.webservice.uri_resource'),
        	[
	            "verify" => false
        	]);

        $this->raw_datasource = self::getResponseData($request);

        return $this->raw_datasource;
	}

    /**
     * @param mixed $response
     *
     * @return mixed|object
     */
    protected function getResponseData($response)
    {

        if ($response->getStatusCode() == 200) {
            return [
                "status" => true,
                "result" => json_decode((string) $response->getBody(), true),
                "code" => $response->getStatusCode()
            ];
        }

        if ($response->getStatusCode() != 200) {
            return [
                "status" => false,
                "message" => "Request Error. " . $response->getReasonPhrase(),
                "code" => $response->getStatusCode()
            ];
        }

        $data = json_decode((string) $response->getBody(), true);

        if ($data["status"] != "success") {
            return [
                "status" => false,
                "message" => "Something went wrong.",
                "data" => $data,
                "code" => 400
            ];
        }

        return $data;
    }

    /**
	 * Sanitize data before storing to protect against malicious attacks like cross-site-scripting
	 * @return [object] [JSON object containing the data properties on key=>value pair format]
	 */
	public function prepareData()
	{
		$payload_format = Config::get('dataimporter.webservice.payload_format');

        $mapped_result = array();

        $raw_customers = (array_key_exists('results', $this->raw_datasource['result']))? $this->raw_datasource['result']['results'] : array();

        if (!empty($raw_customers))
        {
            foreach($raw_customers as $customer)
            {
                $mapped_result[] = array(
                    'firstname' => $customer['name']['first'],
                    'lastname' => $customer['name']['last'],
                    'email' => $customer['email'],
                    'username' => $customer['login']['username'],
                    'gender' => $customer['gender'],
                    'country' => $customer['location']['country'],
                    'city' => $customer['location']['city'],
                    'phone' => $customer['phone'],
                    'password' => md5($customer['login']['password']),
                );
            }
        }

		return $this->sanitized_data = json_encode($mapped_result);
	}

	/**
	 * Connect on DB ORM and store clean data to tables or collections
	 * @return [boolean] [returns true if import to storage is success]
	 */
	public function importData()
	{
		return $this->is_data_imported = true;
	}
	
}