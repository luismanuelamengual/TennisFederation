<?php

namespace org\fmt\controller;

use DateTime;
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
        $user = $this->createModel(User::class, $this->getRequest()->getParameters()->get());
        $user->setBirthDate(DateTime::createFromFormat("Y-m-d", $this->getRequest()->getParameters()->birthDate));
        $this->insertModel($user);
        return new RedirectResponse($this->getUrl("user/showUsersList"));
    }
    
    public function updateUserAction ()
    {
        $user = $this->createModel(User::class, $this->getRequest()->getParameters()->get());
        $user->setBirthDate(DateTime::createFromFormat("Y-m-d", $this->getRequest()->getParameters()->birthDate));
        $this->updateModel($user);
        return new RedirectResponse($this->getUrl("user/showUsersList"));
    }
    
    public function deleteUserAction ($id)
    {
        $this->removeModel(new User($id));
        return new RedirectResponse($this->getUrl("user/showUsersList"));
    }
}