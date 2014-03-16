<?php

namespace TennisFederation\models;

use NeoPHP\mvc\Model;

/**
 * @Table (tableName="tournamentinscription")
 */
class TournamentInscription extends Model
{
    /**
     * @Column (columnName="tournamentid", relatedTableName="tournament")
     */
    private $tournament;
    private $team;
    
    /**
     * @Column (columnName="categoryid", relatedTableName="category")
     */
    private $category;
    
    public function getTournament ()
    {
        return $this->tournament;
    }
    
    public function setTournament (Tournament $tournament)
    {
        $this->tournament = $tournament;
    }
    
    public function getTeam ()
    {
        return $this->team;
    }
    
    public function setTeam (PlayerTeam $team)
    {
        $this->team = $team;
    }
    
    public function getCategory ()
    {
        return $this->category;
    }
    
    public function setCategory (Category $category)
    {
        $this->category = $category;
    }
}

?>
