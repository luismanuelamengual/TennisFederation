<?php

namespace org\fmt\model;

use NeoPHP\mvc\Model;

class Match extends Model
{
    const MATCHTYPE_SINGLES = 1;
    const MATCHTYPE_DOUBLES = 2;
    const RESULT_NOTPLAYED = 0;
    const RESULT_TEAMAWIN = 1;
    const RESULT_TEAMBWIN = 2;
    
    private $id;
    private $description;
    private $tournament;
    private $matchType;
    private $player1;    
    private $player2;
    private $player3;    
    private $player4;
    private $date;
    private $result;
    private $resultDetail;
    
    public function getId()
    {
        return $this->id;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getTournament()
    {
        return $this->tournament;
    }

    public function getMatchType()
    {
        return $this->matchType;
    }

    public function getPlayer1()
    {
        return $this->player1;
    }

    public function getPlayer2()
    {
        return $this->player2;
    }

    public function getPlayer3()
    {
        return $this->player3;
    }

    public function getPlayer4()
    {
        return $this->player4;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function getResult()
    {
        return $this->result;
    }

    public function getResultDetail()
    {
        return $this->resultDetail;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function setTournament(Tournament $tournament)
    {
        $this->tournament = $tournament;
    }

    public function setMatchType($matchType)
    {
        $this->matchType = $matchType;
    }

    public function setPlayer1($player1)
    {
        $this->player1 = $player1;
    }

    public function setPlayer2($player2)
    {
        $this->player2 = $player2;
    }

    public function setPlayer3($player3)
    {
        $this->player3 = $player3;
    }

    public function setPlayer4($player4)
    {
        $this->player4 = $player4;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }

    public function setResult($result)
    {
        $this->result = $result;
    }

    public function setResultDetail($resultDetail)
    {
        $this->resultDetail = $resultDetail;
    }
}