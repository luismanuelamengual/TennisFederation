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
        $usersView = $this->createTemplateView("site.users");
        $usersView->users = $this->retrieveModels(User::class, [], ["id"]);
        return $usersView;
    }
    
    public function showUserFormAction($id = null)
    {
        $userFormView = $this->createTemplateView("site.userForm");
        if (!empty($id))
            $userFormView->user = $this->retrieveModel (User::class, $id);
        return $userFormView;
    }
    
    public function saveUserAction ()
    {
        $user = new User();
        $user->setFrom($this->getRequest()->getParameters()->get());
        $this->persistModel($user);
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