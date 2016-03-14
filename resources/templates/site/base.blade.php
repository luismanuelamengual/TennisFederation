@extends ("base")

@use ("org\fmt\model\UserType")

@section("contents")

    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="profile-sidebar">
                    <div class="profile-userpic">
                        <img src="{{ $this->getResourceUrl("images/users/" . $this->getSession()->userId . ".png") }}" class="img-responsive img-rounded" alt="">
                    </div>
                    <div class="profile-usertitle">
                        <div class="profile-usertitle-name">
                            {{ $this->getSession()->firstname . " " . $this->getSession()->lastname }}
                        </div>
                        <div class="profile-usertitle-job">
                            Developer
                        </div>
                    </div>
                    <div class="profile-userbuttons">                        
                        <a href="{{ $this->getUrl("logout") }}" class="btn btn-danger btn-sm">Salir</a>
                    </div>
                    <div class="profile-usermenu">
                        <ul class="nav">
                            
                            <li class="active"><a href="#"><i class="glyphicon glyphicon-home"></i>Home </a></li>
                            
                            @if ($this->getSession()->type == org\fmt\model\UserType::USERTYPE_ADMINISTRATOR)
                            <li><a href="#"><i class="glyphicon glyphicon-triangle-right"></i>Adm Usuarios</a></li>
                            <li><a href="#"><i class="glyphicon glyphicon-triangle-right"></i>Adm Categorías</a></li>
                            <li><a href="#"><i class="glyphicon glyphicon-triangle-right"></i>Adm Clubes</a></li>
                            <li><a href="#"><i class="glyphicon glyphicon-triangle-right"></i>Adm Paises</a></li>
                            <li><a href="#"><i class="glyphicon glyphicon-triangle-right"></i>Adm Provincias</a></li>
                            @endif
                            
                            @if ($this->getSession()->type == org\fmt\model\UserType::USERTYPE_ADMINISTRATOR or $this->getSession()->type == org\fmt\model\UserType::USERTYPE_ORGANIZER)
                            <li><a href="#"><i class="glyphicon glyphicon-triangle-right"></i>Adm Torneos</a></li>
                            <li><a href="#"><i class="glyphicon glyphicon-triangle-right"></i>Adm Rankings</a></li>
                            <li><a href="#"><i class="glyphicon glyphicon-triangle-right"></i>Adm Anuncios</a></li>
                            @endif
                            
                            @if ($this->getSession()->type == org\fmt\model\UserType::USERTYPE_ADMINISTRATOR or $this->getSession()->type == org\fmt\model\UserType::USERTYPE_ORGANIZER or $this->getSession()->type == org\fmt\model\UserType::USERTYPE_PLAYER)
                            <li><a href="#"><i class="glyphicon glyphicon-triangle-right"></i>Ver Torneos</a></li>
                            <li><a href="#"><i class="glyphicon glyphicon-triangle-right"></i>Ver Rankings</a></li>
                            @endif
                            
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="profile-content">
                    Some user related content goes here...
                </div>
            </div>
        </div>
    </div>

@stop