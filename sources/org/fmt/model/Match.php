<?php

namespace org\fmt\model;

use NeoPHP\mvc\Model;

/**
 * @table (name="match")
 */
class Match extends Model
{
    const MATCHTYPE_SINGLES = 1;
    const MATCHTYPE_DOUBLES = 2;
    const RESULT_NOTPLAYED = 0;
    const RESULT_TEAMAWIN = 1;
    const RESULT_TEAMBWIN = 2;
    
    /**
     * @column (name="matchid", id=true)
     */
    private $id;
    
    /**
     * @column (name="matchtype")
     */
    private $matchType;
    
    /**
     * @column (name="userid")
     */
    private $user1;
    
    /**
     * @column (name="opponentuserid")
     */
    private $user2;
    
    /**
     * @column (name="phase")
     */
    private $phase;
    
    /**
     * @column (name="date")
     */
    private $date;
    
    /**
     * @column (name="result")
     */
    private $result;
    
    /**
     * @column (name="resultdetail")
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
    
    public function setPhase ($phase)
    {
        $this->phase = $phase;
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