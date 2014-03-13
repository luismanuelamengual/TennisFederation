<?php

namespace TennisFederation\views\site;

use NeoPHP\web\html\HTMLView;

abstract class DefaultView extends HTMLView
{
    protected function build()
    {
        parent::build();
        $this->addMeta(array("http-equiv"=>"Content-Type", "content"=>"text/html; charset=UTF-8"));
        $this->addMeta(array("charset"=>"utf-8"));
        $this->addMeta(array("name"=>"viewport", "content"=>"width=device-width, initial-scale=1.0"));
        $this->addScriptFile($this->getBaseUrl() . "js/jquery.min.js");
        $this->addScriptFile($this->getBaseUrl() . "assets/bootstrap-3.1.1/js/bootstrap.min.js");
        $this->addStyleFile($this->getBaseUrl() . "assets/bootstrap-3.1.1/css/bootstrap.united.min.css");
    }
}

?>