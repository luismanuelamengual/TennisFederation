<?php

require_once (__DIR__."/../NeoPHP2/sources/bootstrap.php");
NeoPHP\core\ClassLoader::getInstance()->addIncludePath(__DIR__."/src");
org\fmt\WebApplication::getInstance()->handleRequest();

//trait Singleton
//{
//    private static $instance;
//
//    public static function getInstance() {
//        if (!(self::$instance instanceof self)) {
//            self::$instance = new self;
//        }
//        return self::$instance;
//    }
//}
//
//class Pepech
//{
//    use Titoch\Singleton;
//    
//    public function hola ()
//    {
//        echo "hola mundeli";
//    }
//}
//
////if (Pepech::getInstance() instanceof Singleton)
////    Pepech::getInstance()->hola();
//
//print_r(class_uses(Pepech::getInstance()));


?>
