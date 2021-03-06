<?php

namespace org\fmt\model;

use DateTime;
use NeoPHP\mvc\Model;

/**
 * @entity
 */
class Tournament extends Model
{
    const STATE_INSCRIPTION = 1;
    const STATE_PLAYING = 2;
    const STATE_FINALIZED = 3;
    
    /**
     * @id
     * @attribute
     */
    private $id;
    
    /**
     * @attribute
     */
    private $description;
    
    /**
     * @attribute (name="clubid")
     */
    private $club;
    
    /**
     * @attribute (name="startdate")
     */
    private $startDate;
    
    /**
     * @attribute (name="inscriptionsdate")
     */
    private $inscriptionsDate;
    
    /**
     * @attribute
     */
    private $state;
    
    /**
     * @attribute (name="organizeruserid")
     */
    private $organizer;
    
    private $categories = [];
    private $inscriptions = [];
    private $stages = [];
    
    public function getId()
    {
        return $this->id;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getClub()
    {
        return $this->club;
    }

    public function getStartDate()
    {
        return $this->startDate;
    }

    public function getInscriptionsDate()
    {
        return $this->inscriptionsDate;
    }

    public function getState()
    {
        return $this->state;
    }

    public function getOrganizer()
    {
        return $this->organizer;
    }

    public function getCategories()
    {
        return $this->categories;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function setClub(Club $club)
    {
        $this->club = $club;
    }

    public function setStartDate(DateTime $startDate)
    {
        $this->startDate = $startDate;
    }

    public function setInscriptionsDate(DateTime $inscriptionsDate)
    {
        $this->inscriptionsDate = $inscriptionsDate;
    }

    public function setState($state)
    {
        $this->state = $state;
    }

    public function setOrganizer(User $organizer)
    {
        $this->organizer = $organizer;
    }

    public function addCategory(Category $category)
    {
        $this->categories[] = $category;
    }

    public function addInscription(Category $category, Player $player)
    {
        $this->inscriptions[$category->getId()][] = $player;
    }
    
    public function getInscriptions(Category $category)
    {
        return $this->inscriptions[$category->getId()];
    }
    
    public function addStage (TournamentStage $stage)
    {
        $this->stages[] = $stage;
    }
    
    public function getStages ()
    {
        return $this->stages;
    }
}