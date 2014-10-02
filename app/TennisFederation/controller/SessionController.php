<?php

namespace TennisFederation\controller;

use Exception;
use NeoPHP\web\WebController;
use stdClass;
use TennisFederation\model\User;

class SessionController extends WebController
{
    public function processAction ($action, array $parameters = array())
    {
        $response = null;
        if ($action == "index")
        {
            $method = $this->getRequest()->getMethod ();
            switch ($method)
            {
                case "GET":
                    $response = $this->processAction("getResource");
                    break;
                case "PUT":
                    $response = $this->processAction("createResource");
                    break;
                case "POST":
                    $response = $this->processAction("updateResource"); 
                    break;
                case "DELETE":
                    $response = $this->processAction("deleteResource");
                    break;
            }
        }
        else
        {
            $response = parent::processAction($action, $parameters);
        }
        return $response;
    }
    
    public function onAfterActionExecution ($action, $params, $response)
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
        $user = User::getUserForUsernameAndPassword($username, $password);
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
}

?>