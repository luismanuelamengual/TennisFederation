<?php

namespace TennisFederation\models;

use NeoPHP\mvc\Model;

/**
 * @Table (tableName="match")
 */
class Match extends Model
{
    const MATCHTYPE_SINGLES = 1;
    const MATCHTYPE_DOUBLES = 2;
    
    /**
     * @Column (columnName="matchid", id=true)
     */
    private $id;
    
    /**
     * @Column (columnName="matchtype")
     */
    private $matchType;
    private $teamA;
    private $teamB;
    
    /**
     * @Column (columnName="tournamentid", relatedTableName="tournament")
     */
    private $tournament;
    
    /**
     * @Column (columnName="tournamentphaseid", relatedTableName="tournamentphase")
     */
    private $phase;
    
    /**
     * @Column (columnName="tournamentzoneid", relatedTableName="tournamentzone")
     */
    private $zone;
    
    /**
     * @Column (columnName="date")
     */
    private $date;
    
    /**
     * @Column (columnName="result")
     */
    private $result;
    
    public function getId()
    {
        return $this->id;
    }
    
    public function setId($id)
    {
        $this->id = $id;
    }
    
    public function getMatchType()
    {
        return $this->matchType;
    }
    
    public function setMatchType($matchType)
    {
        $this->matchType = $matchType;
    }
    
    public function getTeamA()
    {
        return $this->teamA;
    }
    
    public function setTeamA(PlayerTeam $teamA)
    {
        $this->teamA = $teamA;
    }
    
    public function getTeamB()
    {
        return $this->teamB;
    }
    
    public function setTeamB(PlayerTeam $teamB)
    {
        $this->teamB = $teamB;
    }
    
    public function getTournament ()
    {
        return $this->tournament;
    }
    
    public function setTournament (Tournament $tournament)
    {
        $this->tournament = $tournament;
    }
    
    public function getPhase ()
    {
        return $this->phase;
    }
    
    public function setPhase (TournamentPhase $phase)
    {
        $this->phase = $phase;
    }
    
    public function getZone ()
    {
        return $this->zone;
    }
    
    public function setZone (TournamentZone $zone)
    {
        $this->zone = $zone;
    }
    
    public function getDate ()
    {
        return $this->date;
    }
    
    public function setDate ($date)
    {
        $this->date = $date;
    }
    
    public function getResult ()
    {
        return $this->result;
    }
    
    public function setResult ($result)
    {
        $this->result = $result;
    }
}

?>
