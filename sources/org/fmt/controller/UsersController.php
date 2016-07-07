<?php

namespace org\fmt\controller;

use NeoPHP\web\http\RedirectResponse;
use org\fmt\model\User;

class UsersController extends SiteController
{
    public function indexAction()
    {
        return $this->showUsersListAction();
    }
    
    public function showUsersListAction()
    {
        return $this->createTemplateView("site.users", ["users"=>$this->retrieveModels(User::class, [], ["id"])]);
    }
    
    public function showUserFormAction($id = null)
    {
        return $this->createTemplateView("site.userForm", ["user"=>$id != null? $this->retrieveModel (User::class, $id) : null]);
    }
    
    public function createUserAction ()
    {
        $user = new User();
        $user->setFrom($this->getRequest()->getParameters()->get());
        $this->createModel($user);
        return new RedirectResponse($this->getUrl("user/showUsersList"));
    }
    
    public function updateUserAction ()
    {
        $user = new User();
        $user->setFrom($this->getRequest()->getParameters()->get());
        $this->updateModel($user);
        return new RedirectResponse($this->getUrl("user/showUsersList"));
    }
    
    public function deleteUserAction ($id)
    {
        $user = new User();
        $user->setId($id);
        $this->deleteModel($user);
        return new RedirectResponse($this->getUrl("user/showUsersList"));
    }
}