<?php

namespace org\fmt;

class WebApplication extends \NeoPHP\web\WebApplication
{
    public function __construct ($basePath)
    {
        parent::__construct($basePath);
        $this->setName ("Federación Mendocina de Tenis");
        $this->setRestfull (true);
    }
}

?>