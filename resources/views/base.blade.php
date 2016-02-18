<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>{{ $this->getApplication()->getName() }}</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="@resource('css/site.css')" />
        @yield("stylesheets")
    </head>
    <body>
        <div class="modal fade" id="mainmodal" tabindex="-1" role="dialog" aria-labelledby="mainmodal_label" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <h4 class="modal-title" id="mainmodal_label">Inicio de sesión</h4>
                    </div>
                    <div class="modal-body">
                        <form id="bs2">
                            <div class="form-group">
                                <label class="control-label" for="bs3">Usuario</label>
                                <input id="bs3" name="loginUsername" type="text" class="form-control" placeholder="Nombre de Usuario"></input>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="bs4">Contraseña</label>
                                <input id="bs4" name="loginPassword" type="password" class="form-control" placeholder="Contraseña"></input>
                            </div>
                            <button class="btn btn-primary" id="loginButton" type="submit">Iniciar sesión</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <nav id="mainheader" class="navbar navbar-default navbar-fixed-top bg-faded">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand">Federación Mendocina de Tenis</a>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#mainnavbar_collasiblecontent" aria-expanded="false"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
                </div>
                <div class="collapse navbar-collapse" id="mainnavbar_collasiblecontent">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="nav-item">
                            <a id="bs7" href="@url('user/showRegistrationForm')" class="nav-link">Registrate</a>
                        </li>
                        <li class="nav-item">
                            <a data-toggle="modal" data-target="#mainmodal" id="bs8" href="#" class="nav-link">Ingresa</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div id="maincontent">
            @yield("contents")
        </div>
    </body>
    <script type="text/javascript" src="http://code.jquery.com/jquery-2.2.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <script type="text/javascript">
        (function ()
        {
            function disableLoginControls ()
            {
                $("#mainmodal input").attr("disabled", "true");
                $("#mainmodal button").attr("disabled", "disabled");
            }

            function enableLoginControls ()
            {
                $("#mainmodal input").removeAttr("disabled");
                $("#mainmodal button").removeAttr("disabled");
            }

            function clearLoginError ()
            {
                $("#mainmodal .help-block").remove();
                $("#mainmodal .alert").remove();
                $("#mainmodal .has-error").removeClass("has-error");
            }

            function showLoginError (message)
            {
                clearLoginError();
                $("#mainmodal .form-group").addClass("has-error");
                $("#mainmodal .modal-body").prepend($("<div>").addClass("alert").addClass("alert-danger").html(message));
            }

            $("#loginButton").click(function() 
            {
                clearLoginError();
                disableLoginControls();
                $("body").css("cursor", "wait");
                var $form = $(this).closest("form");
                var username = $form.find("input[name=loginUsername]")[0].value;
                var password = $form.find("input[name=loginPassword]")[0].value;
                $.ajax("{{ $this->getUrl("session/"); }}",
                {
                    method: "POST",
                    data:
                    {
                        username: username,
                        password: password
                    },
                    success: function (contents)
                    {
                        window.open("http://localhost/fmt/site/?PHPSESSID=" + contents, "_self");
                    },
                    error: function (qXHR, textStatus, errorThrown)
                    {
                        showLoginError(qXHR.responseText);
                    },
                    timeout: function ()
                    {
                        showLoginError("Se ha agotado el tiempo de conexión. Intente más tarde");
                    },
                    complete: function ()
                    {
                        enableLoginControls();
                        $("input[name=username]").focus();
                        $("body").css("cursor", "default");
                    }
                });
            });

            $("#mainmodal").on("shown.bs.modal", function (e) 
            {
                $("input[name=username]").focus();
            })

            $("#mainmodal").on("show.bs.modal", function (e) 
            {
                clearLoginError();
                $("input[name=loginUsername]").val("");
                $("input[name=loginPassword]").val("");
            })
        })();
    </script>
    @yield("scripts")
</html>