<?php

namespace org\fmt\model;

class Player extends Model
{
    private $user1;
    private $user2;
    
    public function __construct($user1, $user2 = null)
    {
        $this->user1 = $user1;
        $this->user2 = $user2;
    }

    public function getUser1()
    {
        return $this->user1;
    }

    public function getUser2()
    {
        return $this->user2;
    }

    public function setUser1($user1)
    {
        $this->user1 = $user1;
    }

    public function setUser2($user2)
    {
        $this->user2 = $user2;
    }
}