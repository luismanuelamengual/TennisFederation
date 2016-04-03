<?php

namespace org\fmt\manager;

use NeoPHP\core\Collection;
use NeoPHP\mvc\ModelManager;
use org\fmt\model\User;

class UsersManager extends ModelManager {
    
    public function getUserForUsernameAndPassword ($username, $password)
    {
        $query = $this->getConnection()->createQuery("\"user\"");
        $query->addWhere("username", "=", $username);
        $query->addWhere("password", "=", $password);
        return $this->createModel(User::class, $query->getFirst());
    }
    
    /**
     * Obtiene todos los usuarios
     * @return Collection Colección de usuarios
     */
    public function getUsers ()
    {
        return $this->createModelCollection(User::class, $this->getConnection()->createQuery("\"user\"")->addOrderBy("id")->get());
    }
    
    /**
     * Obtiene un usuario a traves del id
     * @param $id id del usuario
     * @return User Usuario obtenido
     */
    public function getUser ($id)
    {
        return $this->createModel(User::class, $this->getConnection()->createQuery("\"user\"")->addWhere("id", "=", $id)->getFirst());
    }
}