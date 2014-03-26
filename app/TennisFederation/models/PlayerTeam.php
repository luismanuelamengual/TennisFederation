<?php

namespace TennisFederation\models;

use NeoPHP\mvc\Model;

class PlayerTeam extends Model
{
    private $playerA;
    private $playerB;
    
    public function __construct(User $playerA = null, User $playerB = null)
    {
        $this->playerA = $playerA;
        $this->playerB = $playerB;
    }
    
    public function setPlayerA (User $player)
    {
        $this->playerA = $player;
    }
    
    public function getPlayerA ()
    {
        return $this->playerA;
    }
    
    public function setPlayerB (User $player)
    {
        $this->playerB = $player;
    }
    
    public function getPlayerB ()
    {
        return $this->playerB;
    }
}

?>
