<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Domain\Entities\Customer;
use Response;

class APIControllerTest extends TestCase
{

    public function testGetCustomerList()
    {
        $this->json('GET', 'api/customers', ['Accept' => 'application/json'])
            ->assertStatus(200);
    }

    public function testGetCustomerById()
    {
        $this->json('GET', 'api/customers/1', ['Accept' => 'application/json'])
            ->assertStatus(200);
    }

    public function testErrorHandlingIfCustomerNotFound()
    {
        $this->json('GET', 'api/customers/500', ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJson([
                'code' => 400,
                'status' => 'Bad request.',
                'result' => array()
            ]);
    }

    public function testGetCustomersByIdAcceptsIntegerOnly()
    {
        $response = $this->get('api/customers/abc');
        $this->assertEquals(500, $response->getStatusCode());
        
    }

    public function testGetCustomersReturnsRequiredColumns()
    {
        $response = $this->get('api/customers');
        $json_content = json_decode($response->content(), true);
        $this->assertNotEmpty($json_content, true);        
    }

    /**
     * @depends testGetCustomersReturnsRequiredColumns
     */
    public function testGetCustomersReturnsFullname()
    {
        $response = $this->get('api/customers');
        $json_content = json_decode($response->content(), true);
        $this->assertArrayHasKey('fullname', $json_content['result'][0]);        
    }

    /**
     * @depends testGetCustomersReturnsFullname
     */
    public function testGetCustomersReturnsEmail()
    {
        $response = $this->get('api/customers');
        $json_content = json_decode($response->content(), true);
        $this->assertArrayHasKey('email', $json_content['result'][0]);        
    }

    /**
     * @depends testGetCustomersReturnsEmail
     */
    public function testGetCustomersReturnsCountry()
    {
        $response = $this->get('api/customers');
        $json_content = json_decode($response->content(), true);
        $this->assertArrayHasKey('country', $json_content['result'][0]);        
    }

    public function testGetCustomersByIdReturnsRequiredColumns()
    {
        $response = $this->get('api/customers/1');
        $json_content = json_decode($response->content(), true);
        $this->assertNotEmpty($json_content, true);        
    }    

    /**
     * @depends testGetCustomersByIdReturnsRequiredColumns
     */
    public function testGetCustomersByIdReturnsFullname()
    {
        $response = $this->get('api/customers/1');
        $json_content = json_decode($response->content(), true);
        $this->assertArrayHasKey('fullname', $json_content['result']);         
    }

    /**
     * @depends testGetCustomersByIdReturnsFullname
     */
    public function testGetCustomersByIdReturnsEmail()
    {
        $response = $this->get('api/customers/1');
        $json_content = json_decode($response->content(), true);
        $this->assertArrayHasKey('email', $json_content['result']);         
    }

    /**
     * @depends testGetCustomersByIdReturnsEmail
     */
    public function testGetCustomersByIdReturnsUsername()
    {
        $response = $this->get('api/customers/1');
        $json_content = json_decode($response->content(), true);
        $this->assertArrayHasKey('username', $json_content['result']);         
    }

    /**
     * @depends testGetCustomersByIdReturnsUsername
     */
    public function testGetCustomersByIdReturnsGender()
    {
        $response = $this->get('api/customers/1');
        $json_content = json_decode($response->content(), true);
        $this->assertArrayHasKey('gender', $json_content['result']);         
    }

    /**
     * @depends testGetCustomersByIdReturnsGender
     */
    public function testGetCustomersByIdReturnsCountry()
    {
        $response = $this->get('api/customers/1');
        $json_content = json_decode($response->content(), true);
        $this->assertArrayHasKey('country', $json_content['result']);         
    }

    /**
     * @depends testGetCustomersByIdReturnsCountry
     */
    public function testGetCustomersByIdReturnsCity()
    {
        $response = $this->get('api/customers/1');
        $json_content = json_decode($response->content(), true);
        $this->assertArrayHasKey('city', $json_content['result']);         
    }

    /**
     * @depends testGetCustomersByIdReturnsCity
     */
    public function testGetCustomersByIdReturnsPhone()
    {
        $response = $this->get('api/customers/1');
        $json_content = json_decode($response->content(), true);
        $this->assertArrayHasKey('phone', $json_content['result']);         
    }
}
