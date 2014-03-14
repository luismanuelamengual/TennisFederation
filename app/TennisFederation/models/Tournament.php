<?php

namespace TennisFederation\models;

use NeoPHP\mvc\Model;

/**
 * @Table (tableName="tournament")
 */
class Tournament extends Model
{
    /**
     * @Column (columnName="tournamentid", id=true)
     */
    private $id;
    
    /**
     * @Column (columnName="description")
     */
    private $description;
    
    /**
     * @Column (columnName="countryid", relatedTableName="country")
     */
    private $country;
    
    /**
     * @Column (columnName="provinceid", relatedTableName="province")
     */
    private $province;
    
    /**
     * @Column (columnName="clubid", relatedTableName="club")
     */
    private $club;
    
    /**
     * @Column (columnName="startdate")
     */
    private $startDate;
    
    /**
     * @Column (columnName="inscriptiondate")
     */
    private $inscriptionDate;
    
    /**
     * @Column (columnName="tournamentstateid")
     */
    private $state;
    
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

    public function setCountry($country)
    {
        $this->country = $country;
    }

    public function getProvince()
    {
        return $this->province;
    }

    public function setProvince($province)
    {
        $this->province = $province;
    }

    public function getClub()
    {
        return $this->club;
    }

    public function setClub($club)
    {
        $this->club = $club;
    }

    public function getStartDate()
    {
        return $this->startDate;
    }

    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;
    }

    public function getInscriptionDate()
    {
        return $this->inscriptionDate;
    }

    public function setInscriptionDate($inscriptionDate)
    {
        $this->inscriptionDate = $inscriptionDate;
    }

    public function getState()
    {
        return $this->state;
    }

    public function setState(TournamentState $state)
    {
        $this->state = $state;
    }
}

?>