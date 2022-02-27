<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebserviceController extends Controller
{
    /**
     * Returns a sample raw response from webservice
     * @return [object] [Response in JSON format with the necessary attributes]
     */
    public function getRaw()
    {
        return array();
        /*return json_encode(
            array(
                'results' => array(
                        "gender" => "female",
                        "name" => array(
                            "title" => "Mrs",
                            "first" => "Jasmine",
                            "last" => "Bercero",
                        ),
                        "location" => array(

                        )
                    ),


            )
        );*/
    }
}
