<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Config;
use App\Domain\Entities\Customer;
use Doctrine\ORM\EntityManagerInterface;

class WebserviceController extends Controller
{

    public function importData()
    {
        $raw_result = $this->getRaw();
        $mapped_result = $this->mapData($raw_result);
        $customer_data = $this->storeData($mapped_result);

        return $customer_data;
    }

    /**
     * Returns a sample raw response from webservice
     * @return [object] [Response in JSON format with the necessary attributes]
     */
    public function getRaw()
    {
        $raw_result = json_encode(
            array(
                    'results' => array(
                        array(
                            "gender" => "male",
                            "name" => array(
                                "title" => "Mr",
                                "first" => "Ray",
                                "last" => "Richardson"
                            ),
                            "location" => array(
                                "street" => array(
                                    "number" => 7362,
                                    "name" => "Valley View Ln"
                                ),
                                "city" => "Geelong",
                                "state" => "South Australia",
                                "country" => "Australia",
                                "postcode" => 2873,
                                "coordinates" => array(
                                    "latitude" => "88.1288",
                                    "longitude" => "-38.1597"
                                ),
                                "timezone" => array(
                                    "offset" => "-11=>00",
                                    "description" => "Midway Island, Samoa"
                                )
                            ),
                            "email" => "ray.richardson@example.com",
                            "login" => array(
                                "uuid" => "cc0bd693-5903-44e4-8e6f-f21cffd4b321",
                                "username" => "happyzebra991",
                                "password" => "trader",
                                "salt" => "wJant3ss",
                                "md5" => "2e1cc86e8e0dec34178372b83e1405a0",
                                "sha1" => "de2a3c49a10606893386725833bf106955a240ea",
                                "sha256" => "020adce7fa829f5f9d3cb75d93fb2c9cbd4c966588e0b726941364da8c3f31b2"
                            ),
                            "dob" => array(
                                "date" => "1952-01-09T09=>14=>14.366Z",
                                "age" => 70
                            ),
                            "registered" => array(
                                "date" => "2003-08-01T00=>56=>12.277Z",
                                "age" => 19
                            ),
                            "phone" => "09-9827-1100",
                            "cell" => "0404-536-973",
                            "id" => array(
                                "name" => "TFN",
                                "value" => "562085422"
                            ),
                            "picture" => array(
                                "large" => "https=>//randomuser.me/api/portraits/men/77.jpg",
                                "medium" => "https=>//randomuser.me/api/portraits/med/men/77.jpg",
                                "thumbnail" => "https=>//randomuser.me/api/portraits/thumb/men/77.jpg"
                            ),
                            "nat" => "AU"
                        ),
                        array(
                            "gender"=> "female",
                            "name"=> array(
                              "title"=> "Ms",
                              "first"=> "Bertha",
                              "last"=> "Hansen"
                            ),
                            "location"=> array(
                                "street"=> array(
                                    "number"=> 2893,
                                    "name"=> "Homestead Rd"
                                ),
                                "city"=> "Nowra",
                                "state"=> "Northern Territory",
                                "country"=> "Australia",
                                "postcode"=> 8172,
                                "coordinates"=> array(
                                "latitude"=> "-83.0606",
                                "longitude"=> "126.3433"
                                ),
                                "timezone"=> array(
                                    "offset"=> "+8=>00",
                                    "description"=> "Beijing, Perth, Singapore, Hong Kong"
                                )
                            ),
                            "email"=> "bertha.hansen@example.com",
                            "login"=> array(
                                "uuid"=> "bb6814f0-0c2f-400b-961c-15cd46a56443",
                                "username"=> "purplewolf296",
                                "password"=> "frontier",
                                "salt"=> "pqmS7RZA",
                                "md5"=> "f330093ffc53c9814015c3acb1c04964",
                                "sha1"=> "764fd6dacb3c0c73ee27c03b73ff0d929259dc15",
                                "sha256"=> "fc2941ef3c481249880485b9149e514c2548871e9d07107e9ae6bf972e86edf1"
                            ),
                            "dob"=> array(
                              "date"=> "1997-04-07T22=>22=>21.673Z",
                              "age"=> 25
                            ),
                            "registered"=> array(
                              "date"=> "2009-03-16T02=>44=>07.437Z",
                              "age"=> 13
                            ),
                            "phone"=> "03-2048-6613",
                            "cell"=> "0459-934-719",
                            "id"=> array(
                                "name"=> "TFN",
                                "value"=> "456966910"
                            ),
                            "picture"=> array(
                                "large"=> "https://randomuser.me/api/portraits/women/44.jpg",
                                "medium"=> "https://randomuser.me/api/portraits/med/women/44.jpg",
                                "thumbnail"=> "https://randomuser.me/api/portraits/thumb/women/44.jpg"
                            ),
                            "nat" => "AU"
                        )
                    ),
                'info' => array(
                    "seed" => "90e3c6c2c02a6996",
                    "results" => 1,
                    "page" => 1,
                    "version" => "1.3"
                )
            )
        );
    
        $decoded_raw_result = json_decode($raw_result, true);

        return $decoded_raw_result;

    }

    /**
     * Raw data mappings against the required columns
     * @param  [array] $result [Raw result]
     * @return [array] $mapped_result [Formatted result based on the required columns to store on db]
     */
    public function mapData($result){

        $mapped_result = array();

        $raw_customers = (array_key_exists('results', $result))? $result['results'] : array();

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

        return $mapped_result;
    }

    /**
     * Store the data result set as defined with the required columns on database
     * @param  [array] $data_resultset [Mapped and clean data ready for database storage]
     * @return [array]                 [Return results against total insert + updated]
     */
    public function storeData($data_resultset)
    {

        $ctr_insert = 0;
        $ctr_update = 0;

        foreach($data_resultset as $row)
        {
            $customer = new Customer();
            $customer->setLastname($row['lastname']);
            $customer->setFirstname($row['firstname']);
            $customer->setEmail($row['email']);
            $customer->setUsername($row['username']);
            $customer->setGender($row['gender']);
            $customer->setCountry($row['country']);
            $customer->setCity($row['city']);
            $customer->setPhone($row['phone']);

            $email_exists = \EntityManager::getRepository(Customer::class)
                ->findOneBy(array('email' => $row['email']));         
        
            if (is_null($email_exists))
            {
                \EntityManager::persist($customer);
                \EntityManager::flush();

                $ctr_insert++;

            } else {
                \EntityManager::flush();
                $ctr_update++;
            }

        }
        
        return array(
            'total_raw' => count($data_resultset),
            'total_insert' => $ctr_insert,
            'total_update' => $ctr_update

        );

    }
}
