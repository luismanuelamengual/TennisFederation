<?php

namespace org\fmt\controller;

use NeoPHP\web\http\RedirectResponse;
use org\fmt\manager\UsersManager;
use org\fmt\model\User;

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
    
    public function showUserFormAction($id = null)
    {
        $userFormView = $this->createTemplateView("site.userForm");
        if (!empty($id))
            $userFormView->user = $this->getUsersManager()->getUser($id);
        return $userFormView;
    }
    
    public function saveUserAction ()
    {
        $user = new User();
        $user->setFrom($this->getRequest()->getParameters()->get());
        $this->getUsersManager()->persistUser($user);
        return new RedirectResponse($this->getUrl("user/showUsersList"));
    }
    
    public function deleteUserAction ($id)
    {
        $user = new User();
        $user->setId($id);
        $this->getUsersManager()->deleteUser($user);
        return new RedirectResponse($this->getUrl("user/showUsersList"));
    }
}