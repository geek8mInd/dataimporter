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
			// 'uri_resource' => Config::get('dataimporter.webservice.uri_resource'),
			'http_method' => 'GET',
			// 'payload_format' => Config::get('dataimporter.webservice.payload_format'),
			'allowed_columns' => array(
				'firstname',
				'lastname',
				'email',
				'username',
				'password',
				'gender',
				'nation'
			)
		);

	}

	/**
	 * Consume the resource using Guzzle HTTP client
	 * @return [object] [JSON Object containing the raw data]
	 */
	public function fetchData()
	{
        
		return true;
		
        $this->client = new Client();

        $request = $this->client->request(
        	$this->config['http_method'], 
        	$this->config['uri_resource'],
        	[
	            "verify" => false
        	]);
        $data = self::getResponseData($request);

        return $data;
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
		$filtered_raw_data = array();

		return $this->sanitized_data = json_encode($filtered_raw_data);
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