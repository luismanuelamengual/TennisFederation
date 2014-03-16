<?php

namespace TennisFederation\controllers;

use NeoPHP\web\WebController;
use TennisFederation\models\Player;

class SessionController extends WebController
{
    public function onAfterActionExecution ($action, $response)
    {
        if ($this->getRequest()->getParameters()->returnFormat == "string")
            echo $response;
    }
    
    public function startSessionAction ($username, $password)
    {
        $this->getSession()->destroy();
        $sessionId = false;
        $player = $this->getPlayerForUsernameAndPassword($username, $password);
        if ($player != null)
        {
            $this->getSession()->start();
            $this->getSession()->sessionId = session_id();
            $this->getSession()->sessionName = session_name();
            $sessionId = session_id();
        }
        return $sessionId;
    }
    
    public function destroySessionAction ()
    {
        $this->getSession()->destroy();
    }
    
    private function getPlayerForUsernameAndPassword ($username, $password)
    {
        $player = null;
        $database = $this->getApplication()->getDefaultDatabase ();
        $doPlayer = $database->getDataObject ("player");
        $doPlayer->addWhereCondition("username = '" . $username . "'");
        $doPlayer->addWhereCondition("password = '" . $password . "'");
        if ($doPlayer->find(true))
        {
            $player = new Player();
            $player->completeFromFieldsArray($doPlayer->getFields());
        }
        return $player;
    }
}

?>