@extends ("site.base")

@section ("mainContents")
    <div class="panel panel-default">
        <div class="panel-heading">Categorias</div>
        <div class="panel-body">
            <ul class="nav nav-pills">
                <li><button id="createButton" class="btn btn-default"><span class="glyphicon glyphicon-file"></span> Crear</button></li>
                <li><button id="updateButton" class="btn btn-default" disabled="disabled"><span class="glyphicon glyphicon-pencil"></span> Modifiar</button></li>
                <li><button id="deleteButton" class="btn btn-danger" disabled="disabled"><span class="glyphicon glyphicon-trash"></span> Eliminar</button></li>
            </ul>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Descripción</th>
                        <th>Tipo de Partido</th>
                    <tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->getId() }}</td>
                        <td>{{ $category->getDescription() }}</td>
                        <td>{{ $category->getMatchType() == 1? "Singles":"Dobles" }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop 