<?php

namespace org\fmt\model;

use NeoPHP\mvc\DatabaseModel;
use org\fmt\connection\ProductionConnection;

abstract class Entity extends DatabaseModel
{
    protected static function getConnection()
    {
        return ProductionConnection::getInstance();
    }
}

?>