<?php

namespace TennisFederation\models;

use NeoPHP\mvc\Model;

/**
 * @Table (tableName="tournamentzone")
 */
class TournamentZone extends Model
{
    /**
     * @Column (columnName="tournamentzoneid", id=true)
     */
    private $id;
    
    /**
     * @Column (columnName="description")
     */
    private $description; 
    
    /**
     * @Column (columnName="tournamentphaseid", relatedClassName="tournamentphase")
     */
    private $phase;
    
    private $playerTeams = array();
    
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

    public function getPhase()
    {
        return $this->phase;
    }

    public function setPhase(TournamentPhase $phase)
    {
        $this->phase = $phase;
    }
    
    public function getPlayerTeams()
    {
        return $this->playerTeams;
    }
    
    public function addPlayerTeam (PlayerTeam $team)
    {
        $this->playerTeams[] = $team;
    }
}

?>
