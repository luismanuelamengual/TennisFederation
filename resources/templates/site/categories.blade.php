@extends ("site.base")

@section ("mainContents")

    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2>Administración de categorías</h2>
            </div>

            <div class="card-body card-padding">
                <button class="btn btn-primary btn-icon waves-effect waves-circle waves-float"><i class="zmdi zmdi-plus"></i></button>
            </div>        
                
            <div class="card-body table-responsive">
                <table id="crudTable" class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Descripción</th>
                            <th>Tipo de Partido</th>
                            <th>Acciones</th>
                        <tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                        <tr data-categoryid="{{ $category->getId() }}">
                            <td>{{ $category->getId() }}</td>
                            <td>{{ $category->getDescription() }}</td>
                            <td>{{ $category->getMatchType() == 1? "Singles":"Dobles" }}</td>
                            <td>
                                <ul class="actions">
                                    <li class="dropdown">
                                        <a href="" data-toggle="dropdown" aria-expanded="false">
                                            <i class="zmdi zmdi-more-vert"></i>
                                        </a>

                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="">Editar</a>
                                            </li>
                                            <li>
                                                <a href="">Eliminar</a>
                                            </li>
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