@extends ("base")

@section("mainbarContents")
    <form class="navbar-form navbar-right">
        <div class="form-group">
            <input type="text" id="usernameField" placeholder="Usuario" class="form-control" autofocus>
        </div>
        <div class="form-group">
            <input type="password" id="passwordField" placeholder="Contraseña" class="form-control">
        </div>
        <button id="loginButton" type="button" class="btn btn-default">Ingresar</button>
    </form>
@stop

@section("scripts")
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
                        window.open("{{ $this->getUrl('/dashboard/') }}", "_self");                     
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
@stop
