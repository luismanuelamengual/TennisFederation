@extends ("site.base")

@section ("mainContents")
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2>Administración de Usuarios</h2>
            </div>

            <div class="card-body card-padding">
                <a href="{{ $this->getUrl("/user/showUserForm") }}" class="btn btn-primary"><i class="zmdi zmdi-plus"></i> Agregar</a>
            </div>        
                
            <div class="card-body">
                <table id="crudTable" class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Acciones</th>
                        <tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->getId() }}</td>
                            <td>{{ $user->getFirstname() . " " . $user->getLastname() }}</td>
                            <td>
                                <ul class="actions">
                                    <li class="dropdown">
                                        <a href="" data-toggle="dropdown" aria-expanded="false"><i class="zmdi zmdi-more-vert"></i></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="{{ $this->getUrl("/user/showUserForm", ["id"=>$user->getId()]) }}">Editar</a></li>
                                            <li><a href="{{ $this->getUrl("/user/deleteUser", ["id"=>$user->getId()]) }}">Eliminar</a></li>
                                        </ul>
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