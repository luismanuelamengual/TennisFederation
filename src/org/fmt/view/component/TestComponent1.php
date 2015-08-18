<?php

namespace org\fmt\view\component;

use NeoPHP\web\html\HTMLTag;
use NeoPHP\web\WebView;

class TestComponent1 extends WebView
{
    public function onRender() 
    {
        $body = new HTMLTag("div", ["class"=>"pepech"]);
        echo $body->toHtml();
    }
}

?>