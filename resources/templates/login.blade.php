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

    <!-- Login -->
    <div class="lc-block toggled" id="l-login">
        <div class="input-group m-b-20">
            <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
            <div class="fg-line">
                <input type="text" id="loginUsername" class="form-control" placeholder="Nombre de usuario">
            </div>
        </div>

        <div class="input-group m-b-20">
            <span class="input-group-addon"><i class="zmdi zmdi-male"></i></span>
            <div class="fg-line">
                <input type="password" id="loginPassword" class="form-control" placeholder="Contraseña">
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="checkbox">
            <label>
                <input type="checkbox" value="">
                <i class="input-helper"></i>
                Mantenerme logueado
            </label>
        </div>

        <button id="loginButton" class="btn btn-login btn-danger btn-float"><i class="zmdi zmdi-arrow-forward"></i></button>

        <ul class="login-navigation">
            <li data-block="#l-register" class="bgm-red">Register</li>
            <li data-block="#l-forget-password" class="bgm-orange">Forgot Password?</li>
        </ul>
    </div>

    <!-- Register -->
    <div class="lc-block" id="l-register">
        <div class="input-group m-b-20">
            <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
            <div class="fg-line">
                <input type="text" class="form-control" placeholder="Username">
            </div>
        </div>

        <div class="input-group m-b-20">
            <span class="input-group-addon"><i class="zmdi zmdi-email"></i></span>
            <div class="fg-line">
                <input type="text" class="form-control" placeholder="Email Address">
            </div>
        </div>

        <div class="input-group m-b-20">
            <span class="input-group-addon"><i class="zmdi zmdi-male"></i></span>
            <div class="fg-line">
                <input type="password" class="form-control" placeholder="Password">
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="checkbox">
            <label>
                <input type="checkbox" value="">
                <i class="input-helper"></i>
                Accept the license agreement
            </label>
        </div>

        <a href="" class="btn btn-login btn-danger btn-float"><i class="zmdi zmdi-arrow-forward"></i></a>

        <ul class="login-navigation">
            <li data-block="#l-login" class="bgm-green">Login</li>
            <li data-block="#l-forget-password" class="bgm-orange">Forgot Password?</li>
        </ul>
    </div>

    <!-- Forgot Password -->
    <div class="lc-block" id="l-forget-password">
        <p class="text-left">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla eu risus. Curabitur commodo lorem fringilla enim feugiat commodo sed ac lacus.</p>

        <div class="input-group m-b-20">
            <span class="input-group-addon"><i class="zmdi zmdi-email"></i></span>
            <div class="fg-line">
                <input type="text" class="form-control" placeholder="Email Address">
            </div>
        </div>

        <a href="" class="btn btn-login btn-danger btn-float"><i class="zmdi zmdi-arrow-forward"></i></a>

        <ul class="login-navigation">
            <li data-block="#l-login" class="bgm-green">Login</li>
            <li data-block="#l-register" class="bgm-red">Register</li>
        </ul>
    </div>
        
@stop

@section("scripts")
    <script type="text/javascript">
        (function ()
        {
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
                        sweetAlert("Oops", qXHR.responseText, "error");
                    },
                    timeout: function ()
                    {
                        sweetAlert("Oops", "Se ha agotado el tiempo de conexión. Intente más tarde", "error");
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