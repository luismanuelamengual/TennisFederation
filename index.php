<?php

require_once (__DIR__."/../NeoPHP2/bootstrap.php");
NeoPHP\core\ClassLoader::getInstance()->addIncludePath("./src");
NeoPHP\core\ClassLoader::getInstance()->addIncludePath("../NeoPHP-Bootstrap");
org\fmt\WebApplication::getInstance()->handleRequest();

?>