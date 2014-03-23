<?php

namespace TennisFederation\controllers\site;

use Exception;
use TennisFederation\controllers\SiteController;
use TennisFederation\models\Player;
use TennisFederation\models\PlayerType;

class PlayerController extends SiteController
{
    public function onBeforeActionExecution ($action)
    {
        $executeAction = parent::onBeforeActionExecution($action);
        if ($executeAction && $this->getSession()->type != PlayerType::PLAYERTYPE_ADMINISTRATOR)
            throw new Exception ("No tiene permisos para acceder a este controlador");
        return $executeAction;
    }
    
    public function indexAction()
    {
        $this->showPlayerListAction();
    }
    
    public function showPlayerListAction ()
    {
        $this->renderPlayersView();
    }
    
    public function showPlayerFormAction($playerid=null)
    {
        $playerView = $this->createView("site/playerForm");
        $playerView->setCountries ($this->getApplication()->getController("site/country")->getCountries());
        $playerView->setProvinces ($this->getApplication()->getController("site/province")->getProvinces());
        $playerView->setPlayerTypes ($this->getPlayerTypes());
        if ($playerid != null)
            $playerView->setPlayer($this->getPlayer($playerid));
        $playerView->render();
    }
    
    public function createPlayerAction()
    {
        $player = new Player();
        $player->completeFromFieldsArray($this->getRequest()->getParameters()->getVars());
        $this->createPlayer($player);
        $this->renderPlayersView();
    }
    
    public function updatePlayerAction()
    {
        $player = new Player();
        $player->completeFromFieldsArray($this->getRequest()->getParameters()->getVars());
        $this->updatePlayer($player);
        $this->renderPlayersView();
    }
    
    public function deletePlayerAction($playerid)
    {
        $this->deletePlayer($playerid);
        $this->renderPlayersView();
    }
    
    private function renderPlayersView ()
    {
        $players = $this->getPlayers();
        $playerView = $this->createView("site/players");
        $playerView->setPlayers ($players);
        $playerView->render();
    }
    
    public function getPlayers ()
    {
        $players = array();
        $database = $this->getApplication()->getDefaultDatabase ();
        $doPlayer = $database->getDataObject ("player");
        $doPlayer->addOrderByField ("playerid");
        $doPlayer->find();
        while ($doPlayer->fetch())
        {
            $player = new Player();
            $player->completeFromFieldsArray($doPlayer->getFields());
            $players[] = $player;
        }
        return $players;
    }
    
    public function getPlayerTypes ()
    {
        $playertypes = array();
        $database = $this->getApplication()->getDefaultDatabase ();
        $doPlayerType = $database->getDataObject ("playertype");
        $doPlayerType->addOrderByField ("playertypeid");
        $doPlayerType->find();
        while ($doPlayerType->fetch())
        {
            $playertype = new PlayerType();
            $playertype->completeFromFieldsArray($doPlayerType->getFields());
            $playertypes[] = $playertype;
        }
        return $playertypes;
    }
    
    public function getPlayer ($playerid)
    {
        $player = null;
        $database = $this->getApplication()->getDefaultDatabase ();
        $doPlayer = $database->getDataObject ("player");
        $doPlayer->addWhereCondition("playerid = " . $playerid);
        if ($doPlayer->find(true))
        {
            $player = new Player();
            $player->completeFromFieldsArray($doPlayer->getFields());
        }
        return $player;
    }
    
    public function createPlayer (Player $player)
    {
        $database = $this->getApplication()->getDefaultDatabase ();
        $doPlayer = $database->getDataObject ("player");
        $doPlayer->playertypeid = $player->getType()->getId();
        $doPlayer->address = $player->getAddress();
        $doPlayer->birthdate = $player->getBirthDate();
        $doPlayer->contactvia1 = $player->getContactVia1();
        $doPlayer->contactvia2 = $player->getContactVia2();
        $doPlayer->contactvia3 = $player->getContactVia3();
        $doPlayer->countryid = $player->getCountry()->getId();
        $doPlayer->documentnumber = $player->getDocumentNumber();
        $doPlayer->email = $player->getEmail();
        $doPlayer->firstname = $player->getFirstname();
        $doPlayer->lastname = $player->getLastname();
        $doPlayer->username = $player->getUsername();
        $doPlayer->password = $player->getPassword();
        $doPlayer->provinceid = $player->getProvince()->getId();
        $doPlayer->active = true;
        $doPlayer->insert();
    }
    
    public function updatePlayer (Player $player)
    {
        $database = $this->getApplication()->getDefaultDatabase ();
        $doPlayer = $database->getDataObject ("player");
        $doPlayer->playertypeid = $player->getType()->getId();
        $doPlayer->address = $player->getAddress();
        $doPlayer->birthdate = $player->getBirthDate();
        $doPlayer->contactvia1 = $player->getContactVia1();
        $doPlayer->contactvia2 = $player->getContactVia2();
        $doPlayer->contactvia3 = $player->getContactVia3();
        $doPlayer->countryid = $player->getCountry()->getId();
        $doPlayer->documentnumber = $player->getDocumentNumber();
        $doPlayer->email = $player->getEmail();
        $doPlayer->firstname = $player->getFirstname();
        $doPlayer->lastname = $player->getLastname();
        $doPlayer->username = $player->getUsername();
        $doPlayer->password = $player->getPassword();
        $doPlayer->provinceid = $player->getProvince()->getId();
        $doPlayer->addWhereCondition("playerid = " . $player->getId());
        $doPlayer->update();
    }
    
    public function deletePlayer ($playerid)
    {
        $database = $this->getApplication()->getDefaultDatabase ();
        $doPlayer = $database->getDataObject ("player");
        $doPlayer->addWhereCondition("playerid = " . $playerid);
        $doPlayer->delete();
    }
}

?>