<?php

namespace org\fmt\model;

use NeoPHP\mvc\Model;

/**
 * @entity (name='\"user\"')
 */
class User extends Model
{   
    const PERMISSION_ORGANIZER = 1;
    const PERMISSION_ADMINISTRATOR = 2;
    
    /**
     * @id
     * @attribute
     */
    private $id;
    
    /**
     * @attribute
     */
    private $username;
    
    /**
     * @attribute
     */
    private $password;
    
    /**
     * @attribute
     */
    private $permissions;
    
    /**
     * @attribute
     */
    private $firstname;
    
    /**
     * @attribute
     */
    private $lastname;
    
    /**
     * @attribute
     */
    private $birthDate;
    
    /**
     * @attribute
     */
    private $address;
    
    /**
     * @attribute
     */
    private $contactVia1;
    
    /**
     * @attribute
     */
    private $contactVia2;
    
    /**
     * @attribute
     */
    private $contactVia3;
    
    /**
     * @attribute
     */
    private $email;
    
    /**
     * @attribute
     */
    private $documentNumber;
    
    /**
     * @attribute
     */
    private $active = true;
        
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getPermissions()
    {
        return $this->permissions;
    }

    public function setPermissions($permissions)
    {
        $this->permissions = $permissions;
    }

    public function getFirstname()
    {
        return $this->firstname;
    }

    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    public function getBirthDate()
    {
        return $this->birthDate;
    }

    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }

    public function getContactVia1()
    {
        return $this->contactVia1;
    }

    public function setContactVia1($contactVia1)
    {
        $this->contactVia1 = $contactVia1;
    }

    public function getContactVia2()
    {
        return $this->contactVia2;
    }

    public function setContactVia2($contactVia2)
    {
        $this->contactVia2 = $contactVia2;
    }

    public function getContactVia3()
    {
        return $this->contactVia3;
    }

    public function setContactVia3($contactVia3)
    {
        $this->contactVia3 = $contactVia3;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getDocumentNumber()
    {
        return $this->documentNumber;
    }

    public function setDocumentNumber($documentNumber)
    {
        $this->documentNumber = $documentNumber;
    }
    
    public function getActive() 
    {
        return $this->active;
    }

    public function setActive($active) 
    {
        $this->active = $active;
    }
}