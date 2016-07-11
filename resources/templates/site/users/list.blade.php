@extends ("site.main")

@section ("mainContents")
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2>Administración de Usuarios</h2>
            </div>

            <div class="card-body card-padding">
                <a href="{{ $this->getUrl("/user/showUserForm") }}" class="btn btn-primary"><i class="zmdi zmdi-plus"></i> Agregar</a>
            </div>        
                
            <div class="card-body table-responsive">
                <table id="crudTable" class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Documento</th>
                            <th>Email</th>
                            <th>Celular</th>
                            <th>Acciones</th>
                        <tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->getId() }}</td>
                            <td>{{ $user->getFirstname() . " " . $user->getLastname() }}</td>
                            <td>{{ $user->getDocumentNumber() }}</td>
                            <td>{{ $user->getEmail() }}</td>
                            <td>{{ $user->getContactVia1() }}</td>
                            <td>
                                <ul class="actions">
                                    <li>
                                        <a href="{{ $this->getUrl("/user/showUserForm", ["id"=>$user->getId()]) }}">
                                            <i class="zmdi zmdi-edit"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ $this->getUrl("/user/deleteUser", ["id"=>$user->getId()]) }}">
                                            <i class="zmdi zmdi-delete"></i>
                                        </a>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop 