<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Library\Concrete\WebserviceDataImporter;

class WebserviceDataImporterTest extends TestCase
{

    protected $webserviceImporterObj;

    protected function setUp()
    {
        parent::setUp();
        $this->webserviceImporterObj = new WebserviceDataImporter();
    }

    /** @test */
    public function testFetchDataMethodReturnsJsonResponse()
    {
        $response = $this->webserviceImporterObj->fetchData();
        $this->assertEquals(json_decode($response), true);
    }


    public function tearDown()
    {
        parent::tearDown();
        $this->webserviceImporterObj = null;
    }

}
