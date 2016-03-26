<?php

namespace org\fmt\manager;

use NeoPHP\core\Collection;
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
        $userData = $query->getFirst();
        return $userData != null? new User($userData) : null;
    }
    
    public function getUsers ()
    {
        $users = new Collection();
        $query = $this->getConnection()->createQuery("\"user\"");
        $results = $query->get();
        foreach ($results as $result)
        {
            $user = new User();
            $user->setFrom($result);
            $users->add($user);
        }
        return $users;
    }
}