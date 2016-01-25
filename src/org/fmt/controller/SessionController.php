<?php

namespace org\fmt\controller;

use Exception;
use NeoPHP\web\http\Response;
use NeoPHP\web\WebRestController;
use org\fmt\connection\ProductionConnection;
use org\fmt\model\User;
use stdClass;

class SessionController extends WebRestController
{
    public function getResource ($username, $password)
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
            $connection = ProductionConnection::getInstance();
            $userTable = $connection->getTable("\"user\"");
            $userTable->addWhere("username", "=", $username);
            $userTable->addWhere("password", "=", $password);
            $user = $userTable->getFirst(User::getClass());
            
            if ($user != null)
            {
                $this->getSession()->start();
                $this->getSession()->sessionId = session_id();
                $this->getSession()->sessionName = session_name();
                $this->getSession()->userId = $user->getId();
                $this->getSession()->firstname = $user->getFirstname();
                $this->getSession()->lastname = $user->getLastname();
                $this->getSession()->type = $user->getType()->getId();
                $responseObject->success = true;
                $responseObject->sessionId = $this->getSession()->getId();
                $response->setContent(json_encode($responseObject));
            }
            else
            {
                $responseObject->success = false;
                $responseObject->errorMessage = "Nombre de usuario o contraseña incorrecta";
                $response->setStatusCode(401);
                $response->setContent(json_encode($responseObject));
            }
        }
        catch (Exception $ex)
        {
            $responseObject->success = false;
            $responseObject->errorMessage = $ex->getMessage();
            $response->setStatusCode(500);
            $response->setContent(json_encode($responseObject));
        }
        
        return $response;
    }
}

?>