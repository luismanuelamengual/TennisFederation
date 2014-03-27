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
    
    /**
     * @Column (columnName="organizerid", relatedTableName="user")
     */
    private $organizer;
    
    private $phases = array();
    private $categories = array();
    private $inscriptions = array();
    
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
    
    public function getPhases()
    {
        return $this->phases;
    }
    
    public function addPhase (TournamentPhase $phase)
    {
        $this->phases[] = $phase;
    }
    
    public function getCategories ()
    {
        return $this->categories;
    }
    
    public function addCategory (Category $category)
    {
        $this->categories[] = $category;
    }
    
    public function getInscriptions (Category $category = null)
    {
        $inscriptions = array();
        if ($category == null)
        { 
            $inscriptions = array_values($this->inscriptions);
        }
        else if (isset($this->inscriptions[$category]))
        {
            $inscriptions = $this->inscriptions[$category];
        }
        return $inscriptions;
    }
    
    public function addInscription(Category $category, PlayerTeam $team)
    {
        if (!isset($this->inscriptions[$category]))
            $this->inscriptions[$category] = array();
        $this->inscriptions[$category][] = $team;
    }
    
    public function getOrganizer()
    {
        return $this->organizer;
    }

    public function setOrganizer(User $organizer)
    {
        $this->organizer = $organizer;
    }
}

?>