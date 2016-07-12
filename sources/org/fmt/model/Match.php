<?php

namespace org\fmt\model;

use NeoPHP\mvc\Model;

class Match extends Model
{
    const MATCHTYPE_SINGLES = 1;
    const MATCHTYPE_DOUBLES = 2;
    const RESULT_NOT_PLAYED = 0;
    const RESULT_PLAYER_A_WIN = 1;
    const RESULT_PLAYER_B_WIN = 2;
    
    private $id;
    private $description;
    private $tournamentStage;
    private $matchType;
    private $playerA;
    private $playerB;
    private $date;
    private $result;
    private $resultDetail;
    private $playerAMatch;
    private $playerBMatch;
    
    public function getId()
    {
        return $this->id;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getTournamentStage()
    {
        return $this->tournamentStage;
    }

    public function getMatchType()
    {
        return $this->matchType;
    }
    
    public function getPlayerA()
    {
        return $this->playerA;
    }

    public function getPlayerB()
    {
        return $this->playerB;
    }

    public function setPlayerA(Player $playerA)
    {
        $this->playerA = $playerA;
    }

    public function setPlayerB(Player $playerB)
    {
        $this->playerB = $playerB;
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

    public function setTournamentStage(TournamentStage $tournamentStage)
    {
        $this->tournamentStage = $tournamentStage;
    }

    public function setMatchType($matchType)
    {
        $this->matchType = $matchType;
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
    
    public function getPlayerAMatch()
    {
        return $this->playerAMatch;
    }

    public function getPlayerBMatch()
    {
        return $this->playerBMatch;
    }

    public function setPlayerAMatch(Match $playerAMatch)
    {
        $this->playerAMatch = $playerAMatch;
    }

    public function setPlayerBMatch(Match $playerBMatch)
    {
        $this->playerBMatch = $playerBMatch;
    }
}