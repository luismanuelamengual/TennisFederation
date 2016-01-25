<?php

namespace org\fmt\model;

use NeoPHP\mvc\Model;

/**
 * @Entity
 * @Table (name="province")
 */
class Province extends Model 
{
    /**
     * @Id
     * @GeneratedValue
     * @Column (name="provinceid", type="integer")
     */
    private $id;
    
    /**
     * @Column (type="string")
     */
    private $description;
    
    /**
     * @OneToOne (targetEntity="Country")
     * @JoinColumn (name="countryid", referencedColumnName="countryid")
     */
    private $country;
    
    public function getId() 
    {
        return $this->id;
    }

    public function setId($id) 
    {
        $this->id = $id;
    }

    public function getDescription() 
    {
        return $this->description;
    }

    public function setDescription($description) 
    {
        $this->description = $description;
    }
    
    public function getCountry()
    {
        return $this->country;
    }

    public function setCountry(Country $country)
    {
        $this->country = $country;
    }
}

?>