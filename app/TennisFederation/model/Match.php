<?php

namespace TennisFederation\model;

use NeoPHP\mvc\DatabaseModel;

/**
 * @Table (tableName="match")
 */
class Match extends DatabaseModel
{
    const MATCHTYPE_SINGLES = 1;
    const MATCHTYPE_DOUBLES = 2;
    const RESULT_NOTPLAYED = 0;
    const RESULT_TEAMAWIN = 1;
    const RESULT_TEAMBWIN = 2;
    
    /**
     * @Column (columnName="matchid", id=true)
     */
    private $id;
    
    /**
     * @Column (columnName="matchtype")
     */
    private $matchType;
    
    /**
     * @Column (columnName="userid")
     */
    private $user1;
    
    /**
     * @Column (columnName="opponentuserid")
     */
    private $user2;
    
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
    
    /**
     * @Column (columnName="resultdetail")
     */
    private $resultDetail;
    
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
    
    public function getUser1()
    {
        return $this->user1;
    }
    
    public function setUser1(User $user)
    {
        $this->user1 = $user;
    }
    
    public function getUser2()
    {
        return $this->user2;
    }
    
    public function setUser2(User $user)
    {
        $this->user2 = $user;
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
    
    public function getResultDetail ()
    {
        return $this->resultDetail;
    }
    
    public function setResultDetail ($resultDetail)
    {
        $this->resultDetail = $resultDetail;
    }
}

?>