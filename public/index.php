<?php

require_once ("../../NeoPHP2/autoload.php");
NeoPHP\core\ClassLoader::getInstance()->addIncludePath("../sources");
$app = new org\fmt\WebApplication(realpath(".."));
$app->handleRequest();

?>