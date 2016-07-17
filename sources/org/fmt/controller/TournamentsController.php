<?php

namespace org\fmt\controller;

use NeoPHP\web\http\RedirectResponse;
use org\fmt\model\Club;
use org\fmt\model\Tournament;
use org\fmt\model\User;

class TournamentsController extends SiteController 
{   
    public function indexAction ()
    {
        return $this->showTournamentsListAction();
    }
    
    public function showTournamentsListAction ()
    {
        return $this->createTemplateView("site.tournaments.list", ["tournaments"=>$this->findModels(Tournament::class, [], ["id"])]);
    }
    
    public function showTournamentFormAction ($id = null)
    {
        $parameters = [];
        $parameters["tournament"] = !empty($id)? $this->findModel(Tournament::class, $id) : null;
        $parameters["clubs"] = $this->findModels(Club::class);
        return $this->createTemplateView("site.tournaments.form", $parameters);
    }
    
    public function createTournamentAction ()
    {
        $properties = $this->getRequest()->getParameters()->get();
        $tournament = $this->createModel(Tournament::class, $properties);
        $tournament->setClub(new Club($properties["clubid"]));
        $tournament->setState(Tournament::STATE_INSCRIPTION);
        $tournament->setOrganizer(new User($this->getSession()->userId));
        $this->insertModel($tournament);
        return new RedirectResponse($this->getUrl("tournament/showTournamentsList"));
    }
    
    public function updateTournamentAction ()
    {
        $this->updateModel($this->createModel(Tournament::class, $this->getRequest()->getParameters()->get()));
        return new RedirectResponse($this->getUrl("tournament/showTournamentsList"));
    }
    
    public function deleteTournamentAction ($id)
    {
        $this->removeModel(new Tournament($id));
        return new RedirectResponse($this->getUrl("tournament/showTournamentsList"));
    }
}