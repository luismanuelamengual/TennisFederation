<?php

namespace org\fmt\controller;

use NeoPHP\web\WebController;

class ClubsController extends WebController 
{
    public function indexAction ()
    {
        $mongo = new \MongoClient();
        
//        $db = $mongo->mydb;
//        echo "<br>Database mydb selected";
//        $collection = $db->mycol;
//        echo "<br>Collection selected succsessfully";
//
//        $document = array( 
//           "title" => "MongoDB", 
//           "description" => "database", 
//           "likes" => 100,
//           "url" => "http://www.tutorialspoint.com/mongodb/",
//           "by", "tutorials point"
//        );
//
//        $collection->insert($document);
//        echo "<br>Document inserted successfully";
        
        
//        $db = $mongo->mydb;
//        $collection = $db->mycol;
//        
//        $results = $collection->find();
//        
//        foreach ($results as $document) {
//            echo "<pre>";
//            print_r($document);
//            echo "</pre>";
//        }
        
        
        $mongo->mydb->mycol->remove();
        
        
//        $a = new \stdClass();
//        $a->name = "Luis";
//        $a->profession = "engeineer";
        
        $a = new \org\fmt\model\Club();
        $a->setContactvia1("ramach");
        $a->setDescription("es un club copado");
        
        
        $mongo->mydb->mycol->insert($a->toArray());
//        $mongo->mydb->mycol->insert (["name"=>"Luis","lastName"=>"Amengual", "age"=>34]);
//        $mongo->mydb->mycol->insert (["name"=>"Pepe","lastName"=>"Paredita", "age"=>29]);
        
        foreach ($mongo->mydb->mycol->find() as $document) 
        {
            echo "<pre>";
            print_r($document);
            echo "</pre>";
        }
    }
}