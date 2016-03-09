@extends ("base")

@section("mainbarContents")
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

    <ul class="nav navbar-nav navbar-right">
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
    </ul>
@stop