<?php

namespace org\fmt\controller;

use Exception;
use NeoPHP\web\http\Response;
use NeoPHP\web\WebController;
use org\fmt\model\User;
use stdClass;

/**
 * @route (path="session")
 */
class SessionController extends WebController
{
    /**
     * @routeAction (method="PUT")
     */
    public function createSession ($username, $password)
    {
        $response = new Response();
        $responseObject = new stdClass();
        
        try
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
                $responseObject->success = true;
                $responseObject->sessionId = $this->getSession()->getId();
                $response->setJsonContent($responseObject);
            }
            else
            {
                $responseObject->success = false;
                $responseObject->message = "Nombre de usuario o contraseña incorrecta";
                $response->setStatusCode(401);
                $response->setJsonContent($responseObject);
            }
        }
        catch (Exception $ex)
        {
            $responseObject->success = false;
            $responseObject->message = $ex->getMessage();
            $response->setStatusCode(500);
            $response->setJsonContent($responseObject);
        }
        
        return $response;
    }
}

?>