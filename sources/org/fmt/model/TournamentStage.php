<?php

namespace org\fmt\model;

class TournamentStage extends Model
{
    const TYPE_ROUND_ROBIN = 1;
    const TYPE_ELIMINATION = 2;
    
    private $tournament;
    private $type;
    private $matches = [];
    
    public function getTournament()
    {
        return $this->tournament;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setTournament(Tournament $tournament)
    {
        $this->tournament = $tournament;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

        public function getMatches()
    {
        return $this->matches;
    }
    
    public function addMatch(Match $match)
    {
        $this->matches[] = $match;
    }
}