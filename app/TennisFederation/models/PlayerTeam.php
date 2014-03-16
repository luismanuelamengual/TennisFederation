<?php

namespace TennisFederation\models;

use NeoPHP\mvc\Model;

class PlayerTeam extends Model
{
    private $playerA;
    private $playerB;
    
    public function setPlayerA (Player $player)
    {
        $this->playerA = $player;
    }
    
    public function getPlayerA ()
    {
        return $this->playerA;
    }
    
    public function setPlayerB (Player $player)
    {
        $this->playerB = $player;
    }
    
    public function getPlayerB ()
    {
        return $this->playerB;
    }
}

?>
