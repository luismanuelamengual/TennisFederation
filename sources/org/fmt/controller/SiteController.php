<?php

namespace org\fmt\controller;

use NeoPHP\web\http\RedirectResponse;
use NeoPHP\web\WebController;

class SiteController extends WebController
{
    protected function onBeforeAction($action, $parameters) 
    {   
        $this->getSession()->start();
        if (!isset($this->getSession()->sessionId))
        {
            $response = new RedirectResponse("/");
            $response->send();
            return false;
        }
        return parent::onBeforeAction($action, $parameters);
    }
}