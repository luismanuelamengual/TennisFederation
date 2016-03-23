<?php

namespace org\fmt\manager;

use NeoPHP\mvc\ModelManager;
use org\fmt\model\User;

class UsersManager extends ModelManager {
    
    public function getUserForUsernameAndPassword ($username, $password)
    {
        $query = $this->getConnection()->createQuery("\"user\"");
        $query->addField("*");
        $query->addFields(["id", "description"], "type_%s", "usertype");
        $query->addJoin("usertype", "\"user\".usertypeid", "usertype.id");
        $query->addWhere("username", "=", $username);
        $query->addWhere("password", "=", $password);
        return new User($query->getFirst());
    }
}