@extends ("site.main")

@section ("mainContents")
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2>Clubes</h2>
            </div>

            <div class="card-body card-padding">
                <a href="{{ $this->getUrl("/club/showClubForm") }}" class="btn btn-primary"><i class="zmdi zmdi-plus"></i> Crear</a>
            </div>        
                
            <div class="card-body table-responsive">
                <table id="crudTable" class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Descripción</th>
                            <th>Dirección</th>
                            <th>Acciones</th>
                        <tr>
                    </thead>
                    <tbody>
                        @foreach ($clubs as $club)
                        <tr>
                            <td>{{ $club->getId() }}</td>
                            <td>{{ $club->getDescription() }}</td>
                            <td>{{ $club->getAddress() }}</td>
                            <td class="text-left">
                                <ul class="actions">
                                    <li>
                                        <a href="{{ $this->getUrl("/club/showClubForm", ["id"=>$club->getId()]) }}">
                                            <i class="zmdi zmdi-edit"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ $this->getUrl("/club/deleteClub", ["id"=>$club->getId()]) }}" onclick="return confirm('Esta seguro de eliminar el club ?')">
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