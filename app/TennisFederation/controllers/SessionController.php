<?php

namespace TennisFederation\controllers;

use Exception;
use NeoPHP\web\WebRestController;
use stdClass;
use TennisFederation\models\Player;

class SessionController extends WebRestController
{
    public function onAfterActionExecution ($action, $response)
    {
        if ($this->getRequest()->getParameters()->returnFormat == "json")
        {
            $jsonObject = new stdClass();
            $jsonObject->success = true;
            echo json_encode($jsonObject);
        }
    }
    
    public function onActionError ($action, $error)
    {
        if ($this->getRequest()->getParameters()->returnFormat == "json")
        {
            $jsonObject = new stdClass();
            $jsonObject->success = false;
            $jsonObject->message = $error->getMessage();
            echo json_encode($jsonObject);
        }
    }
    
    public function getResourceAction ($username, $password)
    {
        $this->createResourceAction($username, $password);
    }
    
    public function createResourceAction ($username, $password)
    {
        $this->getSession()->destroy();
        $sessionId = false;
        $player = $this->getPlayerForUsernameAndPassword($username, $password);
        if ($player != null)
        {
            $this->getSession()->start();
            $this->getSession()->sessionId = session_id();
            $this->getSession()->sessionName = session_name();
            $this->getSession()->firstname = $player->getFirstname();
            $this->getSession()->lastname = $player->getLastname();
            $this->getSession()->type = $player->getPlayerType()->getId();
            $sessionId = session_id();
        }
        else
        {
            throw new Exception ("Nombre de usuario o contraseña incorrecta");
        }
        return $sessionId;
    }
    
    public function deleteResourceAction ()
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