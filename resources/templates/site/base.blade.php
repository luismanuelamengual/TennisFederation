@extends ("base")

@use ("org\fmt\model\UserType")

@section ("vendorStyleFiles")
    <link rel="stylesheet" type="text/css" href="{{ $this->getResourceUrl('assets/animate.css/animate.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ $this->getResourceUrl('assets/bootstrap-sweetalert/lib/sweet-alert.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ $this->getResourceUrl('assets/material-design-iconic-font/dist/css/material-design-iconic-font.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ $this->getResourceUrl('assets/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css') }}">    
@stop

@section ("vendorScriptFiles")
    <script src="{{ $this->getResourceUrl('assets/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ $this->getResourceUrl('assets/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ $this->getResourceUrl('assets/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <script src="{{ $this->getResourceUrl('assets/Waves/dist/waves.min.js') }}"></script>
    <script src="{{ $this->getResourceUrl('assets/bootstrap-growl/jquery.bootstrap-growl.min.js') }}"></script>
    <script src="{{ $this->getResourceUrl('assets/bootstrap-sweetalert/lib/sweet-alert.min.js') }}"></script>
@stop

@section("scripts")
    <script>
        (function ($)
        {
            var $activeLinks = $(".main-menu a[href=\"" + window.location + "\"]");
            $activeLinks.closest("li").addClass("active");
        })(jQuery);
    </script>
@stop

@section("contents")

    <header id="header" class="clearfix" data-current-skin="blue">
        <ul class="header-inner">
            <li id="menu-trigger" data-trigger="#sidebar">
                <div class="line-wrap">
                    <div class="line top"></div>
                    <div class="line center"></div>
                    <div class="line bottom"></div>
                </div>
            </li>

            <li class="logo hidden-xs">
                <a href="#">Federación mendocina de tenis</a>
            </li>

            <li class="pull-right">
                <ul class="top-menu">
                    <li id="toggle-width">
                        <div class="toggle-switch">
                            <input id="tw-switch" type="checkbox" hidden="hidden">
                            <label for="tw-switch" class="ts-helper"></label>
                        </div>
                    </li>

                    <li class="dropdown">
                        <a data-toggle="dropdown" href="widget-templates.html"><i class="tm-icon zmdi zmdi-more-vert"></i></a>
                        <ul class="dropdown-menu dm-icon pull-right">
                            <li class="skin-switch hidden-xs">
                                <span class="ss-skin bgm-lightblue" data-skin="lightblue"></span>
                                <span class="ss-skin bgm-bluegray" data-skin="bluegray"></span>
                                <span class="ss-skin bgm-cyan" data-skin="cyan"></span>
                                <span class="ss-skin bgm-teal" data-skin="teal"></span>
                                <span class="ss-skin bgm-orange" data-skin="orange"></span>
                                <span class="ss-skin bgm-blue" data-skin="blue"></span>
                            </li>
                            <li class="divider hidden-xs"></li>
                            <li class="hidden-xs">
                                <a data-action="fullscreen" href="#"><i class="zmdi zmdi-fullscreen"></i> Toggle Fullscreen</a>
                            </li>
                            <li>
                                <a data-action="clear-localstorage" href="#"><i class="zmdi zmdi-delete"></i> Clear Local Storage</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
        </ul>
    </header>
        
    <section id="main">
        <aside id="sidebar" class="sidebar c-overflow">
            <div class="profile-menu">
                <a href="widget-templates.html">
                    <div class="profile-pic">
                        <img src="{{ "http://www.gravatar.com/avatar/" . md5(strtolower(trim($this->getSession()->email))) . "/?s=200" }}" class="img-responsive" alt="">
                    </div>

                    <div class="profile-info">{{ $this->getSession()->firstname . " " . $this->getSession()->lastname }}<i class="zmdi zmdi-caret-down"></i></div>
                </a>

                <ul class="main-menu">
                    <li><a href="profile-about.html"><i class="zmdi zmdi-account"></i> Mi Cuenta</a></li>
                    <li><a href="{{ $this->getUrl("logout") }}"><i class="zmdi zmdi-power"></i> Salir</a></li>
                </ul>
            </div>

            <ul class="main-menu">
                <li><a href="{{ $this->getUrl("/dashboard/") }}"><i class="zmdi zmdi-home"></i>Inicio</a></li>            
                @if ($this->getSession()->type == UserType::USERTYPE_ADMINISTRATOR)
                <li><a href="{{ $this->getUrl("/user/") }}"><i class="zmdi zmdi-accounts-alt"></i>Usuarios</a></li>
                <li><a href="{{ $this->getUrl("/category/") }}"><i class="zmdi zmdi-accounts-list"></i>Categorías</a></li>
                <li><a href="{{ $this->getUrl("/club/") }}"><i class="zmdi zmdi-pin"></i>Clubes</a></li>
                @endif

                @if ($this->getSession()->type == UserType::USERTYPE_ADMINISTRATOR or $this->getSession()->type == UserType::USERTYPE_ORGANIZER)
                <li><a href="{{ $this->getUrl("/announcement/") }}"><i class="zmdi zmdi-receipt"></i></i>Anuncios</a></li>
                @endif

                @if ($this->getSession()->type == UserType::USERTYPE_ADMINISTRATOR or $this->getSession()->type == UserType::USERTYPE_ORGANIZER or $this->getSession()->type == UserType::USERTYPE_PLAYER)
                <li><a href="{{ $this->getUrl("/tournament/") }}"><i class="zmdi zmdi-star"></i>Torneos</a></li>
                <li><a href="{{ $this->getUrl("/ranking/") }}"><i class="zmdi zmdi-trending-up"></i>Rankings</a></li>
                @endif
            </ul>
        </aside>

        <section id="content">
            @yield ("mainContents")
        </section>
    </section>


    <footer id="footer">
        Copyright &copy; 2016 Federación Mendocina de Tenis
    </footer>

    <!-- Page Loader -->
    <div class="page-loader">
        <div class="preloader pls-blue">
            <svg class="pl-circular" viewBox="25 25 50 50"><circle class="plc-path" cx="50" cy="50" r="20" /></svg>
            <p>Por favor espere ...</p>
        </div>
    </div>

@stop