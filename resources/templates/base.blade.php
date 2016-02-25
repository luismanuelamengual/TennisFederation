<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>{{ $this->getApplication()->getName() }}</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="{{ $this->getResourceUrl('css/site.css') }}" />
        @yield("stylesheets")
    </head>
    <body>
        
        <nav id="mainheader" class="navbar navbar-default navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand">{{ $this->getApplication()->getName() }}</a>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#mainnavbar_collasiblecontent" aria-expanded="false"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
                </div>
                <div id="mainnavbar_collasiblecontent" class="collapse navbar-collapse">
                    
                    @if (isset($this->getSession()->sessionId))
                    
                    <ul class="nav navbar-nav navbar-left">
                        
                        @if ($this->getSession()->type == org\fmt\model\UserType::USERTYPE_ADMINISTRATOR)
                        
                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">&nbsp;Administración<b class="caret"></b>
                            <ul class="dropdown-menu">
                                <li><a href="#">Adm Usuarios</a></li>
                                <li><a href="#">Adm Categorías</a></li>
                                <li><a href="#">Adm Clubes</a></li>
                                <li><a href="#">Adm Paises</a></li>
                                <li><a href="#">Adm Provincias</a></li>
                            </ul>
                            </a>
                        </li>
                        
                        @endif
                        
                        @if ($this->getSession()->type == org\fmt\model\UserType::USERTYPE_ADMINISTRATOR or $this->getSession()->type == org\fmt\model\UserType::USERTYPE_ORGANIZER)
                        
                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">&nbsp;Organizador<b class="caret"></b>
                            <ul class="dropdown-menu">
                                <li><a href="#">Adm Torneos</a></li>
                                <li><a href="#">Adm Rankings</a></li>
                                <li><a href="#">Adm Anuncios</a></li>
                            </ul>
                            </a>
                        </li>
                        
                        @endif
                        
                        @if ($this->getSession()->type == org\fmt\model\UserType::USERTYPE_ADMINISTRATOR or $this->getSession()->type == org\fmt\model\UserType::USERTYPE_ORGANIZER or $this->getSession()->type == org\fmt\model\UserType::USERTYPE_PLAYER)
                        
                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">&nbsp;Jugadores<b class="caret"></b>
                            <ul class="dropdown-menu">
                                <li><a href="#">Ver Torneos</a></li>
                                <li><a href="#">Ver Rankings</a></li>
                            </ul>
                            </a>
                        </li>
                        
                        @endif
                         
                    </ul>
                    
                    @endif
                    
                    <ul class="nav navbar-nav navbar-right">
                    
                        @if (!isset($this->getSession()->sessionId))
                        
                        <form class="navbar-form">
                            <div class="form-group">
                                <input type="text" id="usernameField" placeholder="Usuario" class="form-control" autofocus>
                            </div>
                            <div class="form-group">
                                <input type="password" id="passwordField" placeholder="Contraseña" class="form-control">
                            </div>
                            <button id="loginButton" type="submit" class="btn btn-primary">Ingresar</button>
                        </form>
                        
                        @else
                    
                        <li class="nav-item dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ $this->getSession()->firstname . " " . $this->getSession()->lastname }} <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="{{ $this->getUrl("user/showMyAccount") }}" class="dropdown-item"><span class="glyphicon glyphicon-user"></span> Mi cuenta</a>
                                </li>
                                <li>
                                    <a href="{{ $this->getUrl("logout") }}" class="dropdown-item"><span class="glyphicon glyphicon-off"></span> Salir</a>
                                </li>
                            </ul>
                        </li>
                        
                        @endif  
                        
                    </ul>
                </div>
            </div>
        </nav>
        <div id="maincontainer">
            <div id="maincontent">
                @yield("contents")
            </div>
        </div>
    </body>
    <script type="text/javascript" src="http://code.jquery.com/jquery-2.2.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    @yield("scriptFiles")
    @if (!isset($this->getSession()->sessionId))
    <script type="text/javascript">
        (function ()
        {
            $("#loginButton").click(function() 
            {
                var $usernameField = $("#usernameField");
                var $passwordField = $("#passwordField");
                var $button = $(this);
                
                $usernameField.attr("disabled", "true");
                $passwordField.attr("disabled", "true");
                $button.attr("disabled", "disabled");
                
                $("body").css("cursor", "wait");
                
                $.ajax("{{ $this->getUrl('session/') }}", 
                {
                    method: "POST",
                    data:
                    {
                        username: $usernameField.val(),
                        password: $passwordField.val()
                    },
                    success: function (contents)
                    {
                        window.open("{{ $this->getUrl('/') }}", "_self");                     
                    },
                    error: function (qXHR, textStatus, errorThrown)
                    {
                        alert(qXHR.responseText);
                    },
                    timeout: function ()
                    {
                        alert("Se ha agotado el tiempo de conexión. Intente más tarde");
                    },
                    complete: function ()
                    {
                        $usernameField.removeAttr("disabled", "true");
                        $passwordField.removeAttr("disabled", "true");
                        $button.removeAttr("disabled", "disabled");
                        $usernameField.focus();
                        $("body").css("cursor", "default");
                    }
                });
            });
        })();
    </script>
    @yield("scripts")
    @endif
</html>