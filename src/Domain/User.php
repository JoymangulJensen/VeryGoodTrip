<?php

namespace VeryGoodTrip\Domain;

use Symfony\Component\Security\Core\User\UserInterface;

class User implements UserInterface
{
    /**
     * User id
     * @var integer
     */
    private $id;

    /**
     * User email
     * @var string
     */
    private $email;
    /**
     * User last name
     * @var string
     */
    private $lastname;
    /**
     * User first name
     * @var string
     */
    private $firstname;
    /**
     * User password
     * @var string
     */
    private $password;
    /**
     * Salt used to encode password
     * @var string
     */
    private $salt;
    /**
     * User address
     * @var string
     */
    private $address;
    /**
     * User town
     * @var string
     */
    private $town;
    /**
     * User zipCode
     * @var integer
     */
    private $zipcode;
    /**
     * User role
     * Values : ROLE_USER or ROLE_ADMIN.
     * @var string
     */
    private $role;



    /*************************************************************
     *************       Getters and setters         *************
     *************************************************************/

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    public function getFirstname()
    {
        return $this->firstname;
    }

    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getSalt()
    {
        return $this->salt;
    }

    public function setSalt($salt)
    {
        $this->salt = $salt;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }

    public function getTown()
    {
        return $this->town;
    }

    public function setTown($town)
    {
        $this->town = $town;
    }

    public function getZipcode()
    {
        return $this->zipcode;
    }

    public function setZipcode($zipcode)
    {
        $this->zipcode = $zipcode;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function setRole($role)
    {
        $this->role = $role;
    }

    /**
     * @inheritDoc
     */
    public function getUsername()
    {
        return $this->getEmail();
    }

    /**
     * @inheritDoc
     */
    public function getPassword()
    {
        return $this->password;
    }

    /*************************************************************
     **************       Implement Methods         **************
     *************************************************************/

    /**
     * @inheritDoc
     */
    public function getRoles()
    {
        return array($this->getRole());
    }


    /**
     * @inheritDoc
     */
    public function eraseCredentials()
    {
        // $this->get('security.context')->setToken(null);
        // $this->get('request')->getSession()->invalidate();
    }


}