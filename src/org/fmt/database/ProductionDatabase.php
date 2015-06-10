<?php

namespace org\fmt\database;

use NeoPHP\sql\PostgreSQLDatabase;

class ProductionDatabase extends PostgreSQLDatabase
{
    public function getDatabaseName()
    {
        return "tennisfederation";
    }

    public function getHost()
    {
        return "localhost";
    }
    
    public function getUsername ()
    {
        return "postgres";
    }
    
    public function getPassword ()
    {
        return "tuvieja.com";
    }
}

?>