@extends ("site.base")
@section ("mainContents")
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2>{{ isset($this->user)? "Edición de Usuario" : "Creación de Usuario" }}</h2>
            </div>
            <div class="card-body card-padding">
                <form method="POST" action="{{ $this->getUrl("/user/saveUser") }}">
                    @if (isset($this->user))
                    <input type="hidden" name="id" value="{{ $this->user->getId() }}">
                    @endif
                    
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group fg-line">
                                <label class="control-label" for="usernameField">Nombre de usuario</label>
                                <input type="text" id="usernameField" name="username" class="form-control" value="{{ isset($this->user)?  $this->user->getUsername() : "" }}" autofocus="true">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group fg-line">
                                <label class="control-label" for="typeField">Tipo</label>
                                <select id="typeField" name="type" class="form-control">
                                    <option value="1">Administrador</option>
                                    <option value="2"{{ (isset($this->user) && $this->user->getType() == 2)? " selected=\"selected\"" : "" }}>Organizador</option>
                                    <option value="2"{{ (isset($this->user) && $this->user->getType() == 3)? " selected=\"selected\"" : "" }}>Jugador</option>
                                </select> 
                            </div>
                        </div>
                        
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group fg-line">
                                <label class="control-label" for="passwordField">Contraseña</label>
                                <input type="text" id="passwordField" name="password" class="form-control" value="{{ isset($this->user)?  $this->user->getPassword() : "" }}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group fg-line">
                                <label class="control-label" for="passwordRepeatField">Repetir Contraseña</label>
                                <input type="text" id="passwordRepeatField" name="password" class="form-control" value="{{ isset($this->user)?  $this->user->getPassword() : "" }}">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group fg-line">
                                <label class="control-label" for="firstnameField">Nombre</label>
                                <input type="text" id="firstnameField" name="firstname" class="form-control" value="{{ isset($this->user)?  $this->user->getFirstname() : "" }}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group fg-line">
                                <label class="control-label" for="lastnameField">Apellido</label>
                                <input type="text" id="lastnameField" name="lastname" class="form-control" value="{{ isset($this->user)?  $this->user->getLastname() : "" }}">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>
@stop