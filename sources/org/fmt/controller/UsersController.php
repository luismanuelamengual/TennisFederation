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
        return $this->createTemplateView("site.users.list", ["users"=>$this->findModels(User::class, ["sorters"=>["id"]])]);
    }
    
    public function showUserFormAction($id = null)
    {
        return $this->createTemplateView("site.users.form", ["user"=>$id != null? $this->findModel (User::class, $id) : null]);
    }
    
    public function createUserAction ()
    {
        $this->insertModel($this->createModel(User::class, $this->getRequest()->getParameters()->get()));
        return new RedirectResponse($this->getUrl("user/showUsersList"));
    }
    
    public function updateUserAction ()
    {
        $this->updateModel($this->createModel(User::class, $this->getRequest()->getParameters()->get()));
        return new RedirectResponse($this->getUrl("user/showUsersList"));
    }
    
    public function deleteUserAction ($id)
    {
        $this->removeModel(new User($id));
        return new RedirectResponse($this->getUrl("user/showUsersList"));
    }
}