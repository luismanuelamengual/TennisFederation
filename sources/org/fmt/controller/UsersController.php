<?php

namespace org\fmt\controller;

use org\fmt\manager\UsersManager;

class UsersController extends SiteController
{
    /**
     * Obtiene el manejador de categorias
     * @return UsersManager Manejador de categorias
     */
    private function getUsersManager ()
    {
        return $this->getManager(UsersManager::class);
    }
    
    public function indexAction()
    {
        return $this->showUsersListAction();
    }
    
    public function showUsersListAction()
    {        
        $usersView = $this->createTemplateView("site.users");
        $usersView->users = $this->getUsersManager()->getUsers();
        return $usersView;
    }
}