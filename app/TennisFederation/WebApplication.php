<?php

namespace TennisFederation;

class WebApplication extends \NeoPHP\web\WebApplication
{
    protected function initialize ()
    {
        parent::initialize();
        $this->setName ("Federación Mendocina de Tenis");
        $this->setDefaultControllerName("portal");
        $this->setRestfull (true);
    }
}

?>
