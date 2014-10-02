<?php

namespace TennisFederation\controller;

use Exception;
use NeoPHP\web\WebRestController;
use stdClass;
use TennisFederation\models\User;

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
        $user = $this->getUserForUsernameAndPassword($username, $password);
        if ($user != null)
        {
            $this->getSession()->start();
            $this->getSession()->sessionId = session_id();
            $this->getSession()->sessionName = session_name();
            $this->getSession()->userId = $user->getId();
            $this->getSession()->firstname = $user->getFirstname();
            $this->getSession()->lastname = $user->getLastname();
            $this->getSession()->type = $user->getType()->getId();
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
    
    private function getUserForUsernameAndPassword ($username, $password)
    {
        $user = null;
        $database = $this->getApplication()->getDefaultDatabase ();
        $doUser = $database->getDataObject ("user");
        $doUser->addWhereCondition("username = '" . $username . "'");
        $doUser->addWhereCondition("password = '" . $password . "'");
        if ($doUser->find(true))
        {
            $user = new User();
            $user->completeFromFieldsArray($doUser->getFields());
        }
        return $user;
    }
}

?>