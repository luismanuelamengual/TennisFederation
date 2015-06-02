<?php

namespace org\fmt\view;

use NeoPHP\web\html\HTMLView;
use NeoPHP\web\html\Tag;

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
    
    protected function addOnDocumentReadyScript($script, $hash=null)
    {
        if ($hash == null)
            $hash = md5($script);
        if (!isset($this->onDocumentReadyScriptHashes[$hash]))
        {
            if (!isset($this->documentReadyTag))
            {
                $this->documentReadyTag = new Tag("script", array("type"=>"text/javascript"), "$(document).ready(function(){});");
                $this->htmlTag->add($this->documentReadyTag);
            }
            
            $content = $this->documentReadyTag->getContent();
            $newContent = substr_replace($content, $script, -3, 0);
            $this->documentReadyTag->setContent($newContent);
            $this->onDocumentReadyScriptHashes[$hash] = true;
        }
    }
}

?>