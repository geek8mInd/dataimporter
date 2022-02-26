<?php
namespace App\Domain\Entities;

use Doctrine\ORM\Mapping as ORM;
use LaravelDoctrine\Extensions\Timestamps\Timestamps;

/**
 * @ORM\Entity()
 * @ORM\Table(name="customers",uniqueConstraints={@ORM\UniqueConstraint(name="email_uniq", columns={"email"})})
 */
class Customer
{
    use Timestamps;
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @var string
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=100)
     * @var string
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=100)
     * @var string
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=100)
     * @var string
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=100)
     * @var string
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=10)
     * @var string
     */
    private $gender;

    /**
     * @ORM\Column(type="string", length=50)
     * @var string
     */
    private $country;
    
    /**
     * @ORM\Column(type="string", length=100)
     * @var string
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=50)
     * @var string
     */
    private $phone;


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param string $name
     */
    public function setLastname($lastname)
    {
        return $this->lastname = $lastname;
    }

    /**
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param string $name
     */
    public function setFirstname($firstname)
    {
        return $this->firstname = $firstname;
    }

    public function getFullname()
    {
        return $this->getFirstname() . ' ' . $this->getLastname();
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $name
     */
    public function setEmail($email)
    {
        return $this->email = $email;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $name
     */
    public function setUsername($username)
    {
        return $this->username = $username;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $name
     */
    public function setPassword($password)
    {
        return $this->password = $password;
    }

    /**
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param string $name
     */
    public function setGender($gender)
    {
        return $this->gender = $gender;
    }


    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param string $name
     */
    public function setCountry($country)
    {
        return $this->country = $country;
    }    

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $name
     */
    public function setCity($city)
    {
        return $this->city = $city;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param string $name
     */
    public function setPhone($phone)
    {
        return $this->phone = $phone;
    } 
}