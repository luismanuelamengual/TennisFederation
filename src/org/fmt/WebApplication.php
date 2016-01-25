<?php

namespace org\fmt;

class WebApplication extends \NeoPHP\web\WebApplication
{
    public function __construct ()
    {
        parent::__construct();
        $this->setName ("Federación Mendocina de Tenis");
        $this->setRestfull (true);
    }
}

?>