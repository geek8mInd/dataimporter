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

    protected $response;

    protected $mapped_data_result;

    protected $imported_data_result;

    protected function setUp()
    {
        parent::setUp();
        $this->webserviceImporterObj = new WebserviceDataImporter();
        $this->response = $this->webserviceImporterObj->fetchData();
        $this->mapped_data_result = $this->webserviceImporterObj->prepareData();
        $this->imported_data_result = $this->webserviceImporterObj->importData();

    }

    /** @test */
    public function testFetchDataMethodConvertsResponseToArray()
    {
        $this->assertEquals(is_array($this->response), true);
    }

    /** @test */
    public function testPrepareDataMethodConvertsResponsetoJSON()
    {
        
        $result = json_decode($this->mapped_data_result, true);
        $this->assertEquals(json_last_error(), 0);
    }

    /** @test */
    public function testMappedDataIsNotEmpty()
    {
        $result = json_decode($this->mapped_data_result, true);
        $this->assertNotEmpty($result);
    }

    /**
     * @depends testMappedDataIsNotEmpty
     */
    public function testFirstnamePropExistsOnMappedData()
    {
        $result = json_decode($this->mapped_data_result, true);
        $this->assertArrayHasKey('firstname', end($result));
    }

    /**
     * @depends testFirstnamePropExistsOnMappedData
     */
    public function testLastnamePropExistsOnMappedData()
    {
        $result = json_decode($this->mapped_data_result, true);
        $this->assertArrayHasKey('lastname', end($result));
    }

    /**
     * @depends testLastnamePropExistsOnMappedData
     */
    public function testEmailPropExistsOnMappedData()
    {
        $result = json_decode($this->mapped_data_result, true);
        $this->assertArrayHasKey('email', end($result));
    }

    /**
     * @depends testEmailPropExistsOnMappedData
     */
    public function testUsernamePropExistsOnMappedData()
    {
        $result = json_decode($this->mapped_data_result, true);
        $this->assertArrayHasKey('username', end($result));
    }

    /**
     * @depends testUsernamePropExistsOnMappedData
     */
    public function testGenderPropExistsOnMappedData()
    {
        $result = json_decode($this->mapped_data_result, true);
        $this->assertArrayHasKey('gender', end($result));
    }

    /**
     * @depends testGenderPropExistsOnMappedData
     */
    public function testCountryPropExistsOnMappedData()
    {
        $result = json_decode($this->mapped_data_result, true);
        $this->assertArrayHasKey('country', end($result));
    }

    /**
     * @depends testCountryPropExistsOnMappedData
     */
    public function testCityPropExistsOnMappedData()
    {
        $result = json_decode($this->mapped_data_result, true);
        $this->assertArrayHasKey('city', end($result));
    }

    /**
     * @depends testCityPropExistsOnMappedData
     */
    public function testPhonePropExistsOnMappedData()
    {
        $result = json_decode($this->mapped_data_result, true);
        $this->assertArrayHasKey('phone', end($result));
    }

    public function testImportDataMethodReturnsTotalInsertAndUpdate()
    {
        $count = $this->imported_data_result['total_insert'] + $this->imported_data_result['total_update'];
        $this->assertEquals($count, $this->imported_data_result['total_raw']);

    }

    public function tearDown()
    {
        parent::tearDown();
        $this->webserviceImporterObj = null;
        $this->response = array();
        $this->mapped_data_result = array();
    }

}
