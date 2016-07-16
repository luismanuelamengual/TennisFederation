@extends ("site.main")
@use ("org\fmt\model\Tournament")

@section ("mainContents")
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2>Torneos</h2>
            </div>

            <div class="card-body card-padding">
                <a href="{{ $this->getUrl("/tournament/showTournamentForm") }}" class="btn btn-primary"><i class="zmdi zmdi-plus"></i> Agregar</a>
            </div>        
                
            <div class="card-body table-responsive">
                <table id="crudTable" class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Descripción</th>
                            <th>Estado</th>
                            <th>Fecha cierre inscripción</th>
                            <th>Fecha inicio</th>
                            <th>Acciones</th>
                        <tr>
                    </thead>
                    <tbody>
                        @foreach ($tournaments as $tournament)
                        <tr>
                            <td>{{ $tournament->getId() }}</td>
                            <td>{{ $tournament->getDescription() }}</td>
                            <td>
                                @if ($tournament->getState() == Tournament::STATE_INSCRIPTION)
                                Inscripción abierta
                                @elseif ($tournament->getState() == Tournament::STATE_PLAYING)
                                Iniciado
                                @elseif ($tournament->getState() == Tournament::STATE_FINALIZED)
                                Finalizado
                                @endif
                            </td>
                            <td>{{ $tournament->getInscriptionsDate() }}</td>
                            <td>{{ $tournament->getStartDate() }}</td>
                            <td class="text-left">
                                <ul class="actions">
                                    <li>
                                        <a href="{{ $this->getUrl("/tournament/showTournamentForm", ["id"=>$tournament->getId()]) }}">
                                            <i class="zmdi zmdi-edit"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ $this->getUrl("/tournament/deleteTournament", ["id"=>$tournament->getId()]) }}" onclick="return confirm('Esta seguro de eliminar el torneo ?')">
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