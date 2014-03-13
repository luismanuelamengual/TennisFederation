<?php

namespace TennisFederation\controllers;

use NeoPHP\web\WebController;

class SessionController extends WebController
{
    public function startSessionAction ($username, $password)
    {
        $this->getSession()->destroy();
        $sessionId = false;
        $user = $this->getUserForUsernameAndPassword($username, $password);
        if ($user != null)
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
    
    private function getUserForUsernameAndPassword ($username, $password)
    {
        $user = null;
        return $user;
    }
}

?>