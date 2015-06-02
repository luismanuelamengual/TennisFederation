<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $this->getApplication()->getName(); ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" type="text/css" href="<?php echo $this->getBaseUrl(); ?>assets/bootstrap-3.3.4/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo $this->getBaseUrl(); ?>css/login.css" />
    </head>
    <body id="loginBody">
        <form role="form">
            <div class="modal show">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title"><?php echo $this->getApplication()->getName(); ?></h4>
                        </div>
                        <div class="modal-body">
                            <fieldset>
                                <div class="form-group">
                                    <div id="errorMessage"></div>
                                    <input class="form-control" placeholder="Nombre de usuario" name="username" type="text" autofocus="autofocus">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Contraseña" name="password" type="password" value="">
                                </div>
                                <div class="checkbox">
                                    <label><input name="remember" type="checkbox" value="Remember Me"> Recordarme</label>
                                </div>
                            </fieldset>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" name="loginbutton" class="btn btn-primary" value="Iniciar sesión"></input>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </body>
    <script type="text/javascript" src="<?php echo $this->getBaseUrl(); ?>assets/jquery-1.11.2/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo $this->getBaseUrl(); ?>assets/bootstrap-3.3.4/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        function checkPageLocation ()
        {
            var src = window.location.href;
            if(window.top != window.self) {
                window.open(src,"_top");
            }
        }

        function showErrorMessage (message)
        {
            $(".form-group").addClass ("has-error");
            $("#errorMessage").html("<label class=\"control-label\" >" + message + "</label>");
        }

        function clearErrorMessage ()
        {
            $(".form-group").removeClass ("has-error");
            $("#errorMessage").html("");
        }

        function disableLoginControls ()
        {
            $("input[name=username]").prop("disabled", true);
            $("input[name=password]").prop("disabled", true);
            $("input[name=loginbutton]").prop("disabled", true);
            $("body").css("cursor", "progress");
        }

        function enableLoginControls ()
        {
            $("input[name=username]").prop("disabled", false);
            $("input[name=password]").prop("disabled", false);
            $("input[name=loginbutton]").prop("disabled", false);
            $("body").css("cursor", "default");
            $("input[name=username]").focus();
        }

        $("input[name=loginbutton]").click(function(event)
        {
            clearErrorMessage ();
            disableLoginControls();
            var username = $("input[name=username]")[0].value;
            var password = $("input[name=password]")[0].value;
            $.ajax("<?php echo $this->getUrl("session/"); ?>?username=" + username + "&password=" + password,
            {
                method: "PUT",
                success: function (data)
                {
                    if (data.success)
                    {
                        window.open("<?php echo $this->getUrl("site/main/"); ?>", "_self");
                    }
                    else
                    {
                        showErrorMessage(data.errorMessage);
                        enableLoginControls();
                    }
                },
                error: function (qXHR, textStatus, errorThrown)
                {
                    if (qXHR.responseText)
                    {
                        var responseObject = jQuery.parseJSON(qXHR.responseText);
                        showErrorMessage(responseObject.errorMessage);
                    }
                    else
                    {
                        showErrorMessage(textStatus + " - " + errorThrown);
                    }
                    enableLoginControls();
                },
                timeout: function ()
                {
                    showErrorMessage("Se ha agotado el tiempo de conexión. Intente más tarde");
                    enableLoginControls();
                }
            });
            return false;
        });
    </script>
</html>