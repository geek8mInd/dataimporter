<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Domain\Entities\Customer;

class CustomersTest extends TestCase
{

    private $customerObj;

    protected function setUp()
    {
        $this->customerObj = new Customer();
    }

    /** @test **/
    public function testFirstnameProp()
    {
        $firstname = $this->customerObj->setFirstname('Rhea');
        $this->assertNotEquals('Maria', $this->customerObj->getFirstname());
    }

    /** @test **/
    public function testLastnameProp()
    {
        $lastname = $this->customerObj->setLastname('Dela Cruz');
        $this->assertEquals($lastname, $this->customerObj->getLastname());
    }

    /** @test **/
    public function testGetFullname()
    {
        $this->customerObj->setFirstName('Juan');
        $this->customerObj->setLastName('Dela Cruz');

        $fullname = $this->customerObj->getFirstname() . ' ' . $this->customerObj->getLastname();
        $this->assertEquals($fullname, $this->customerObj->getFullname());

    }

    /** @test **/
    public function testEmailProp()
    {
        $email = $this->customerObj->setEmail('jdelacruz@email.ph');
        $this->assertEquals($email, $this->customerObj->getEmail());
    }

    /** @test **/
    public function testUsernameProp()
    {
        $username = $this->customerObj->setUsername('jdelacruz');
        $this->assertEquals($username, $this->customerObj->getUsername());
    }

    /** @test **/
    public function testGenderProp()
    {
        $gender = $this->customerObj->setGender('male');
        $this->assertEquals($gender, $this->customerObj->getGender());
    }

    /** @test **/
    public function testCountryProp()
    {
        $country = $this->customerObj->setCountry('Australia');
        $this->assertEquals($country, $this->customerObj->getCountry());
    }

    /** @test **/
    public function testCityProp()
    {
        $city = $this->customerObj->setCity('Sydney');
        $this->assertEquals($city, $this->customerObj->getCity());
    }

    /** @test **/
    public function testPhoneProp()
    {
        $phone = $this->customerObj->setPhone('0912-345-67-1');
        $this->assertEquals($phone, $this->customerObj->getPhone());
    }
}
