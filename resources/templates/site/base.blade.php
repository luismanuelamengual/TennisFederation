@extends ("base")

@use ("org\fmt\model\UserType")

@section("scripts")
    <script>
        (function ($)
        {
            var $activeLinks = $(".profile-usermenu a[href=\"" + window.location + "\"]");
            $activeLinks.closest("li").addClass("active");
        })(jQuery);
    </script>
@stop

@section("contents")

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 col-sm-4">
                <div class="profile-sidebar">
                    <div class="profile-userpic">
                        <img src="{{ $this->getResourceUrl("images/users/" . $this->getSession()->userId . ".png") }}" class="img-responsive" alt="">
                    </div>
                    <div class="profile-usertitle">
                        <div class="profile-usertitle-name">
                            {{ $this->getSession()->firstname . " " . $this->getSession()->lastname }}
                        </div>
                        <div class="profile-usertitle-job">
                            {{ $this->getSession()->typeDescription }}
                        </div>
                    </div>
                    <div class="profile-userbuttons">                        
                        <a href="{{ $this->getUrl("logout") }}" class="btn btn-danger btn-sm">Salir</a>
                    </div>
                    <div class="profile-usermenu">
                        <ul class="nav">
                            
                            <li><a href="{{ $this->getUrl("/dashboard/") }}"><i class="glyphicon glyphicon-home"></i>Inicio</a></li>
                            
                            @if ($this->getSession()->type == UserType::USERTYPE_ADMINISTRATOR)
                            <li><a href="{{ $this->getUrl("/user/") }}"><i class="glyphicon glyphicon-triangle-right"></i>Adm Usuarios</a></li>
                            <li><a href="{{ $this->getUrl("/category/") }}"><i class="glyphicon glyphicon-triangle-right"></i>Adm Categorías</a></li>
                            <li><a href="{{ $this->getUrl("/club/") }}"><i class="glyphicon glyphicon-triangle-right"></i>Adm Clubes</a></li>
                            @endif
                            
                            @if ($this->getSession()->type == UserType::USERTYPE_ADMINISTRATOR or $this->getSession()->type == UserType::USERTYPE_ORGANIZER)
                            <li><a href="{{ $this->getUrl("/tournament/") }}"><i class="glyphicon glyphicon-triangle-right"></i>Adm Torneos</a></li>
                            <li><a href="{{ $this->getUrl("/ranking/") }}"><i class="glyphicon glyphicon-triangle-right"></i>Adm Rankings</a></li>
                            <li><a href="{{ $this->getUrl("/announcement/") }}"><i class="glyphicon glyphicon-triangle-right"></i>Adm Anuncios</a></li>
                            @endif
                            
                            @if ($this->getSession()->type == UserType::USERTYPE_ADMINISTRATOR or $this->getSession()->type == UserType::USERTYPE_ORGANIZER or $this->getSession()->type == UserType::USERTYPE_PLAYER)
                            <li><a href="{{ $this->getUrl("/tournament/showTournaments") }}"><i class="glyphicon glyphicon-triangle-right"></i>Ver Torneos</a></li>
                            <li><a href="{{ $this->getUrl("/ranking/showRankings") }}"><i class="glyphicon glyphicon-triangle-right"></i>Ver Rankings</a></li>
                            @endif
                            
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-9 col-sm-8">
                @yield("mainContents")
            </div>
        </div>
    </div>

@stop