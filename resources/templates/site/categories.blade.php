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
            <table id="crudTable" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Descripción</th>
                        <th>Tipo de Partido</th>
                    <tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                    <tr data-categoryid="{{ $category->getId() }}">
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

@section ("scripts")
    @parent
    <script>
        $("#crudTable tr").on(
        {
            click: function (e) 
            {
                $("#crudTable tr.selected").removeClass("selected");
                $(this).addClass("selected");
                $("#updateButton").prop("disabled",false); 
                $("#deleteButton").prop("disabled",false); 
            },
            dblclick: function (e)
            {
                window.open("showCategoryForm?categoryid=" + $(this).data("categoryid"), "_self");
            }
        });
    </script>
@stop