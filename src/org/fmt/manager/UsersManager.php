<?php

namespace org\fmt\manager;

use NeoPHP\mvc\Manager;
use org\fmt\connection\ProductionConnection;
use PDO;

class UsersManager extends Manager
{
    public function getUserByUsernameAndPassword ($username, $password)
    {
        $statement = ProductionConnection::getInstance()->query("SELECT * FROM \"user\" WHERE username = ? AND password = ?", array($username, $password));
        $record = $statement->fetch(PDO::FETCH_OBJ);
        if ($record != false)
        {
            echo "<pre>";
            print_r ($record);
            echo "</pre>";
        }
        echo "func llamado OK";
    }
}

?>