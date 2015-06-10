<?php

namespace org\fmt\model;

use NeoPHP\mvc\DatabaseModel;
use org\fmt\database\ProductionDatabase;

abstract class Entity extends DatabaseModel
{
    protected static function getDatabase()
    {
        return ProductionDatabase::getInstance();
    }
}

?>