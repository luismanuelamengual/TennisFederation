<?php

namespace org\fmt\controller;

use Exception;
use NeoPHP\web\http\Response;
use NeoPHP\web\WebRestController;
use org\fmt\model\User;
use stdClass;

class SessionController extends WebRestController
{
    const ADMINISTRATOR_USERNAME = "admin";
    const ADMINISTRATOR_PASSWORD = "istrator";
    
    public function getResourceAction ($username, $password)
    {
        return $this->createResourceAction($username, $password); 
    }
    
    public function updateResourceAction ($username, $password)       
    {   
        return $this->createResourceAction($username, $password); 
    }
    
    public function createResourceAction ($username, $password)
    {
        $response = new Response();
        $responseObject = new stdClass();
        
        try
        {
            $this->getSession()->destroy();
            $sessionId = false;
            
            $user = null;
            if ($username == self::ADMINISTRATOR_USERNAME && $password == self::ADMINISTRATOR_PASSWORD)
            {
                $user = new User(-1);
                $user->setFirstname("Administrator");
                $user->setLastname("FMT");
                $user->setPermissions(User::PERMISSION_ALL);
            }
            else
            {
                $users = $this->findModels(User::class, ["filters"=>["username"=>$username, "password"=>$password]]);
                if (!$users->isEmpty()) $user = $users->getFirst();
            }
            
            if ($user != null)
            {
                $this->getSession()->start();
                $this->getSession()->sessionId = session_id();
                $this->getSession()->sessionName = session_name();
                $this->getSession()->userId = $user->getId();
                $this->getSession()->firstname = $user->getFirstname();
                $this->getSession()->lastname = $user->getLastname();
                $this->getSession()->email = $user->getEmail();
                $this->getSession()->permissions = $user->getPermissions();
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