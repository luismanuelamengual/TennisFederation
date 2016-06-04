<?php

namespace org\fmt\manager;

use MongoClient;
use NeoPHP\core\Collection;
use NeoPHP\mvc\ModelManager;
use org\fmt\model\User;

class UsersManager extends ModelManager {
    
    public function getUserForUsernameAndPassword ($username, $password)
    {
        return $this->createModelFromAttributes(User::class, $this->getConnection()->createQuery("\"user\"")->addWhere("username", "=", $username)->addWhere("password", "=", $password)->getFirst());
    }
    
    /**
     * Obtiene todos los usuarios
     * @return Collection Colección de usuarios
     */
    public function getUsers ()
    {
        return $this->getAllModels(User::class);
    }
    
    /**
     * Obtiene un usuario a traves del id
     * @param $id id del usuario
     * @return User Usuario obtenido
     */
    public function getUser ($id)
    {
        return $this->getModel(User::class, $id);
    }
    
    /**
     * Persiste un usuario
     * @param User $user
     */
    public function persistUser (User $user)
    {
        return $this->persistModel($user);
    }
    
    /**
     * Borra un usuario
     * @param User $user
     * @return type
     */
    public function deleteUser (User $user)
    {
        return $this->deleteModel($user);
    }
}