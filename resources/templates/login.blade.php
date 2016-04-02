@extends ("base")

@section ("vendorStyleFiles")
    <link rel="stylesheet" type="text/css" href="{{ $this->getResourceUrl('assets/animate.css/animate.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ $this->getResourceUrl('assets/bootstrap-sweetalert/lib/sweet-alert.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ $this->getResourceUrl('assets/material-design-iconic-font/dist/css/material-design-iconic-font.min.css') }}">    
@stop

@section ("vendorScriptFiles")
    <script src="{{ $this->getResourceUrl('assets/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ $this->getResourceUrl('assets/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ $this->getResourceUrl('assets/Waves/dist/waves.min.js') }}"></script>
    <script src="{{ $this->getResourceUrl('assets/bootstrap-sweetalert/lib/sweet-alert.min.js') }}"></script>
@stop

@section("contentType", "login-content")
@section("contents")
    <div class="lc-block toggled" id="l-login">
        <form>
            <div class="input-group m-b-20">
                <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
                <div class="fg-line">
                    <input type="text" name="username" id="loginUsername" class="form-control" placeholder="Nombre de usuario" autofocus="true">
                </div>
            </div>

            <div class="input-group m-b-20">
                <span class="input-group-addon"><i class="zmdi zmdi-male"></i></span>
                <div class="fg-line">
                    <input type="password" name="password" id="loginPassword" class="form-control" placeholder="Contraseña">
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="checkbox">
                <label>
                    <input type="checkbox" value=""><i class="input-helper"></i> Mantenerme logueado
                </label>
            </div>

            <button id="loginButton" type="submit" class="btn btn-login btn-danger btn-float"><i class="zmdi zmdi-arrow-forward"></i></button>
        </form>
    </div>
@stop

@section("scripts")
    <script type="text/javascript">
        (function ()
        {
            function showErrorMessage (errorMessage)
            {
                var $loginWidget = $("#l-login");
                var $errorMessage = $loginWidget.find(".errorMessage");
                if ($errorMessage.length == 0)
                    $errorMessage = $("<div>").addClass("alert").addClass("alert-danger").addClass("errorMessage").attr("role","alert").prependTo($loginWidget);
                $errorMessage.html(errorMessage);
            }
            
            $("#loginButton").click(function() 
            {
                var $usernameField = $("#loginUsername");
                var $passwordField = $("#loginPassword");
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
                        window.open("{{ $this->getUrl('/dashboard/') }}", "_self");                     
                    },
                    error: function (qXHR, textStatus, errorThrown)
                    {
                        showErrorMessage(qXHR.responseText);
                    },
                    timeout: function ()
                    {
                        showErrorMessage("Se ha agotado el tiempo de conexión. Intente más tarde");
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
@stop