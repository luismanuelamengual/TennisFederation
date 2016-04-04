@extends ("site.base")

@section ("scripts")
    <script>
        (function($)
        {
            $passwordField = $("#passwordField");
            $passwordConfirmField = $("#passwordConfirmField");
            function validatePasswords()
            {
                $passwordField.get(0).setCustomValidity($passwordField.val() == $passwordConfirmField.val()?"":"Las contraseñas deben coincidir");
            }
            $passwordField.change(validatePasswords);
            $passwordConfirmField.change(validatePasswords);
        })(jQuery);
    </script>
@stop

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
                        <div class="col-sm-12">
                            <div class="form-group fg-line">
                                <label class="control-label" for="usernameField">Nombre de usuario (*)</label>
                                <input type="text" id="usernameField" name="username" class="form-control" value="{{ isset($this->user)?  $this->user->getUsername() : "" }}" autofocus="true" required minlength="8">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group fg-line">
                                <label class="control-label" for="passwordField">Contraseña (*)</label>
                                <input type="password" id="passwordField" name="password" class="form-control" value="{{ isset($this->user)?  $this->user->getPassword() : "" }}" required minlength="8">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group fg-line">
                                <label class="control-label" for="passwordConfirmField">Confirmar Contraseña</label>
                                <input type="password" id="passwordConfirmField" class="form-control" value="{{ isset($this->user)?  $this->user->getPassword() : "" }}">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-12">
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
                                <label class="control-label" for="firstnameField">Nombre (*)</label>
                                <input type="text" id="firstnameField" name="firstname" class="form-control" value="{{ isset($this->user)?  $this->user->getFirstname() : "" }}" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group fg-line">
                                <label class="control-label" for="lastnameField">Apellido (*)</label>
                                <input type="text" id="lastnameField" name="lastname" class="form-control" value="{{ isset($this->user)?  $this->user->getLastname() : "" }}" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group fg-line">
                                <label class="control-label" for="documentField">Nro Documento</label>
                                <input type="number" id="documentField" name="documentNumber" class="form-control" value="{{ isset($this->user)?  $this->user->getDocumentNumber() : "" }}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group fg-line">
                                <label class="control-label" for="birthDateField">Fecha de Nacimiento (*)</label>
                                <input type="date" id="birthDateField" name="birthDate" class="form-control" value="{{ isset($this->user)?  date_format(date_create($this->user->getBirthDate()), "Y-m-d") : "" }}" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group fg-line">
                                <label class="control-label" for="addressField">Dirección</label>
                                <input type="text" id="addressField" name="address" class="form-control" value="{{ isset($this->user)?  $this->user->getAddress() : "" }}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group fg-line">
                                <label class="control-label" for="emailField">Email (*)</label>
                                <input type="email" id="emailField" name="email" class="form-control" value="{{ isset($this->user)?  $this->user->getEmail() : "" }}" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group fg-line">
                                <label class="control-label" for="contactVia1Field">Teléfono 1 (*)</label>
                                <input type="text" id="contactVia1Field" name="contactVia1" class="form-control" value="{{ isset($this->user)?  $this->user->getContactVia1() : "" }}" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group fg-line">
                                <label class="control-label" for="contactVia2Field">Teléfono 2</label>
                                <input type="text" id="contactVia2Field" name="contactVia2" class="form-control" value="{{ isset($this->user)?  $this->user->getContactVia2() : "" }}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group fg-line">
                                <label class="control-label" for="contactVia3Field">Teléfono 3</label>
                                <input type="text" id="contactVia3Field" name="contactVia3" class="form-control" value="{{ isset($this->user)?  $this->user->getContactVia3() : "" }}">
                            </div>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>
@stop