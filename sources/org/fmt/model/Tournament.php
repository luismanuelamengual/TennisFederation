<?php

namespace org\fmt\model;

use NeoPHP\mvc\Model;
use stdClass;

class Tournament extends Model
{
    const STATE_INSCRIPTION = 1;
    const STATE_PLAYING = 2;
    const STATE_FINALIZED = 3;
    
    private $id;
    private $description;
    private $club;
    private $startDate;
    private $inscriptionsDate;
    private $state;
    private $organizer;
    private $categories = [];
    private $inscriptions = [];
    private $matches = [];
    
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

    public function getInscriptions()
    {
        return $this->inscriptions;
    }

    public function getMatches()
    {
        return $this->matches;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function setClub($club)
    {
        $this->club = $club;
    }

    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;
    }

    public function setInscriptionsDate($inscriptionsDate)
    {
        $this->inscriptionsDate = $inscriptionsDate;
    }

    public function setState($state)
    {
        $this->state = $state;
    }

    public function setOrganizer($organizer)
    {
        $this->organizer = $organizer;
    }

    public function addCategory(Category $category)
    {
        $this->categories[] = $category;
    }

    public function addMatch(Match $match)
    {
        $this->matches[] = $match;
    }
    
    public function addInscription(Category $category, User $player1, User $player2=null)
    {
        $inscription = new stdClass();
        $inscription->category = $category;
        $inscription->player1 = $player1;
        $inscription->player2 = $player2;
        $this->inscriptions[] = $inscription;
    }
}