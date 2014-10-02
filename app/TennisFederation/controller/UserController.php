<?php

namespace TennisFederation\controllers;

use Exception;
use TennisFederation\controllers\SiteController;
use TennisFederation\models\User;
use TennisFederation\models\UserType;

class UserController extends SiteController
{
    public function onBeforeActionExecution ($action)
    {
        $executeAction = parent::onBeforeActionExecution($action);
        if ($executeAction && ($this->getSession()->type != UserType::USERTYPE_ADMINISTRATOR && $action != "myAccount" && $action != "myAccountSave" ))
            throw new Exception ("No tiene permisos para acceder a este controlador");
        return $executeAction;
    }
    
    public function indexAction()
    {
        $this->showUserListAction();
    }
    
    public function checkUsernameAction ($username)
    {
        echo $this->getUserForUsername($username) != null? "true" : "false";
    }
    
    public function showUserListAction ()
    {
        $this->renderUsersView();
    }
    
    public function showUserFormAction($userid=null)
    {
        $userView = $this->createView("site/userForm");
        $userView->setCountries ($this->getApplication()->getController("site/country")->getCountries());
        $userView->setProvinces ($this->getApplication()->getController("site/province")->getProvinces());
        $userView->setClubs ($this->getApplication()->getController("site/club")->getClubs());
        $userView->setUserTypes ($this->getUserTypes());
        if ($userid != null)
            $userView->setUser($this->getUser($userid));
        $userView->render();
    }
    
    public function myAccountAction()
    {
        $userView = $this->createView("site/userForm");
        $userView->setMyAccountMode(true);
        $userView->setCountries ($this->getApplication()->getController("site/country")->getCountries());
        $userView->setProvinces ($this->getApplication()->getController("site/province")->getProvinces());
        $userView->setClubs ($this->getApplication()->getController("site/club")->getClubs());
        $userView->setUserTypes ($this->getUserTypes());
        $userView->setUser($this->getUser($this->getSession()->userId));
        $userView->render();
    }
    
    public function myAccountSaveAction()
    {
        $user = new User();
        $user->completeFromFieldsArray($this->getRequest()->getParameters()->getVars());
        $this->saveUser($user);
        $this->executeAction("site/dashboard/");
    }
    
    public function createUserAction()
    {
        $user = new User();
        $user->completeFromFieldsArray($this->getRequest()->getParameters()->getVars());
        $this->saveUser($user);
        $this->renderUsersView();
    }
    
    public function updateUserAction($userid)
    {
        $user = new User();
        $user->completeFromFieldsArray($this->getRequest()->getParameters()->getVars());
        $this->saveUser($user);
        $this->renderUsersView();
    }
    
    public function deleteUserAction($userid)
    {
        $this->deleteUser($userid);
        $this->renderUsersView();
    }
    
    private function renderUsersView ()
    {
        $users = $this->getUsers();
        $userView = $this->createView("site/users");
        $userView->setUsers ($users);
        $userView->render();
    }
    
    public function getUsers ()
    {
        $users = array();
        $database = $this->getApplication()->getDefaultDatabase ();
        $doUser = $database->getDataObject ("user");
        $doUser->addOrderByField ("userid");
        $doUser->find();
        while ($doUser->fetch())
        {
            $user = new User();
            $user->completeFromFieldsArray($doUser->getFields());
            $users[] = $user;
        }
        return $users;
    }
    
    public function getUserTypes ()
    {
        $usertypes = array();
        $database = $this->getApplication()->getDefaultDatabase ();
        $doUserType = $database->getDataObject ("usertype");
        $doUserType->addOrderByField ("usertypeid");
        $doUserType->find();
        while ($doUserType->fetch())
        {
            $usertype = new UserType();
            $usertype->completeFromFieldsArray($doUserType->getFields());
            $usertypes[] = $usertype;
        }
        return $usertypes;
    }
    
    public function getUser ($userid)
    {
        $user = null;
        $database = $this->getApplication()->getDefaultDatabase ();
        $doUser = $database->getDataObject ("user");
        $doUser->addWhereCondition("userid = " . $userid);
        if ($doUser->find(true))
        {
            $user = new User();
            $user->completeFromFieldsArray($doUser->getFields());
        }
        return $user;
    }
    
    public function getUserForUsername ($username)
    {
        $user = null;
        $database = $this->getApplication()->getDefaultDatabase ();
        $doUser = $database->getDataObject ("user");
        $doUser->addWhereCondition("username = '" . $username . "'");
        if ($doUser->find(true))
        {
            $user = new User();
            $user->completeFromFieldsArray($doUser->getFields());
        }
        return $user;
    }
    
    public function saveUser (User $user)
    {
        $database = $this->getApplication()->getDefaultDatabase ();
        $doUser = $database->getDataObject ("user");
        if ($user->getType() != null)
            $doUser->usertypeid = $user->getType()->getId();
        if (!empty($user->getBirthDate()))
            $doUser->birthdate = $user->getBirthDate();
        $doUser->address = $user->getAddress();
        $doUser->contactvia1 = $user->getContactVia1();
        $doUser->contactvia2 = $user->getContactVia2();
        $doUser->contactvia3 = $user->getContactVia3();
        $doUser->documentnumber = $user->getDocumentNumber();
        $doUser->email = $user->getEmail();
        $doUser->firstname = $user->getFirstname();
        $doUser->lastname = $user->getLastname();
        if (!empty($user->getUsername()))
            $doUser->username = $user->getUsername();
        $doUser->password = $user->getPassword();
        if ($user->getCountry() != null)
            $doUser->countryid = $user->getCountry()->getId();
        if ($user->getProvince() != null)
            $doUser->provinceid = $user->getProvince()->getId();
        if ($user->getClub() != null)
            $doUser->clubid = $user->getClub()->getId();
        if ($user->getId() != null)
        {
            $doUser->addWhereCondition("userid = " . $user->getId());
            $doUser->update();
        }
        else
        {
            $doUser->active = true;
            $doUser->insert();
        }
    }
    
    public function updateUserImage ($userid)
    {
        if (!empty($userid) && !empty($_FILES) && !empty($_FILES["image"]) && $_FILES["image"]["type"] == "image/jpeg")
        {
            $uploaddir = realpath("") . "/images/users/";
            if (!file_exists($uploaddir))
                mkdir($uploaddir);
            $uploadfile = $uploaddir . $userid . ".jpg";
            move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile);
        }
    }
    
    public function deleteUser ($userid)
    {
        $database = $this->getApplication()->getDefaultDatabase ();
        $doUser = $database->getDataObject ("user");
        $doUser->addWhereCondition("userid = " . $userid);
        $doUser->delete();
    }
}

?>