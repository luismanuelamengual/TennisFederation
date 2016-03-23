<?php

namespace org\fmt\controller;

use Exception;
use NeoPHP\web\http\Response;
use NeoPHP\web\WebRestController;
use org\fmt\manager\UsersManager;
use stdClass;

class SessionController extends WebRestController
{
    public function getResource ($username, $password)
    {
        return $this->createResource($username, $password); 
    }
    
    public function updateResource ($username, $password)       
    {   
        return $this->createResource($username, $password); 
    }
    
    public function createResource ($username, $password)
    {
        $response = new Response();
        $responseObject = new stdClass();
        
        try
        {
            $this->getSession()->destroy();
            $sessionId = false;
            $user = UsersManager::getInstance()->getUserForUsernameAndPassword($username,$password);
            
            if ($user != null)
            {
                $this->getSession()->start();
                $this->getSession()->sessionId = session_id();
                $this->getSession()->sessionName = session_name();
                $this->getSession()->userId = $user->getId();
                $this->getSession()->firstname = $user->getFirstname();
                $this->getSession()->lastname = $user->getLastname();
                $this->getSession()->email = $user->getEmail();
                $this->getSession()->type = $user->getType()->getId();
                $this->getSession()->typeDescription = $user->getType()->getDescription();
                $responseObject->success = true;
                $responseObject->sessionId = $this->getSession()->getId();
                $response->setContent($this->getSession()->getId());
            }
            else
            {
                $response->setStatusCode(401);
                $response->setContent("Nombre de usuario o contraseña incorrecta");
            }
        }
        catch (Exception $ex)
        {
            $response->setStatusCode(500);
            $response->setContent($ex->getMessage());
        }
        
        return $response;
    }
}