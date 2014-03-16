<?php

namespace TennisFederation\models;

use NeoPHP\mvc\Model;

/**
 * @Table (tableName="tournamentphase")
 */
class TournamentPhase extends Model
{
    /**
     * @Column (columnName="tournamentphaseid", id=true)
     */
    private $id;
    
    /**
     * @Column (columnName="description")
     */
    private $description;
    
    /**
     * @Column (columnName="tournamentid", relatedTableName="tournament")
     */
    private $tournament;
    
    private $zones = array();
    private $matches = array();
    
    /**
     * @Column (columnName="order")
     */
    private $order;
    
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

    public function getTournament()
    {
        return $this->tournament;
    }

    public function setTournament(Tournament $tournament)
    {
        $this->tournament = $tournament;
    }

    public function getOrder()
    {
        return $this->order;
    }

    public function setOrder($order)
    {
        $this->order = $order;
    } 
    
    public function getZones()
    {
        return $this->zones;
    }
    
    public function addZone (TournamentZone $zone)
    {
        $this->zones[] = $zone;
    }
    
    public function getMatches()
    {
        return $this->matches;
    }
    
    public function addMatch (Match $match)
    {
        $this->matches[] = $match;
    }
}

?>
