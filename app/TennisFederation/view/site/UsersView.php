<?php

namespace TennisFederation\views\site;

use NeoPHP\web\html\Tag;
use TennisFederation\components\Button;
use TennisFederation\components\EntityTable;
use TennisFederation\views\site\SiteView;

class UsersView extends SiteView
{
    private $users = array();
    
    public function setUsers ($users)
    {
        $this->users = $users;
    }
    
    protected function createMainContent() 
    {
        $container = parent::createMainContent();
        $container->add (new Tag("h1", array("class"=>"page-header"), "Administración de Usuarios"));
        $container->add ($this->createButtonToolbar());
        $container->add ($this->createUsersTable());
        return $container;
    }
    
    protected function createButtonToolbar()
    {
        $toolbar = new Tag("ul", array("class"=>"nav nav-pills"));
        $toolbar->add (new Tag("li", new Button('<span class="glyphicon glyphicon-file"></span>&nbsp;Crear', array("class"=>"btn btn-primary", "onclick"=>"createUser();"))));
        $toolbar->add (new Tag("li", new Button('<span class="glyphicon glyphicon-pencil"></span>&nbsp;Modifiar', array("id"=>"updateButton", "class"=>"btn btn-primary", "onclick"=>"updateUser();", "disabled"=>"true"))));
        $toolbar->add (new Tag("li", new Button('<span class="glyphicon glyphicon-trash"></span>&nbsp;Eliminar', array("id"=>"deleteButton", "class"=>"btn btn-primary", "onclick"=>"deleteUser();", "disabled"=>"true"))));
        return $toolbar;
    }
    
    protected function createUsersTable()
    {
        $table = new EntityTable(array("id"=>"usersTable"));
        $table->addColumn ("#", "id");
        $table->addColumn ("Nombre", "firstname");
        $table->addColumn ("Apellido", "lastname");
        $table->addColumn ("E-mail", "email");
        $table->addColumn ("Teléfono 1", "contactVia1");
        $table->addColumn ("Teléfono 2", "contactVia2");
        $table->setEntities($this->users);
        $table->addEntityProperty("userId", "id");
        return $table;
    }
    
    protected function addScripts ()
    {
        parent::addScripts();
        $this->addScript ('
            function getSelectedUserId ()
            {
                var selectedRows = $("#usersTable > tbody > tr.danger"); 
                return (selectedRows.length > 0)? selectedRows.first().attr("userId") : false;
            }
            
            function selectUser (userId)
            {
                $("tr[userId=" + userId + "]").addClass("danger").siblings().removeClass("danger");
                $("#updateButton").prop("disabled",false); 
                $("#deleteButton").prop("disabled",false);
            }

            function createUser ()
            {
                window.open("' . $this->getUrl("site/user/showUserForm") . '", "_self");
            }
            
            function updateUser ()
            {
                var selectedUserId = getSelectedUserId();
                if (selectedUserId != false)
                    window.open("' . $this->getUrl("site/user/showUserForm") . '?userid=" + selectedUserId, "_self");
            }
            
            function deleteUser ()
            {
                var selectedUserId = getSelectedUserId();
                if (selectedUserId != false)
                    if (window.confirm("Esta seguro de eliminar la categoría " + selectedUserId + " ?"))
                        window.open("' . $this->getUrl("site/user/deleteUser") . '?userid=" + selectedUserId, "_self");
            }
        ');
        
        $this->addOnDocumentReadyScript('
            var tableRows = $("#usersTable > tbody > tr");
            tableRows.on("click", function(event) { selectUser($(this).attr("userId")); });
            tableRows.on("dblclick", function(event) { updateUser(); });
        ');
    }
}

?>