@extends ("site.base")

@section ("mainContents")

    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2>Administración de categorías</h2>
            </div>

            <div class="card-body table-responsive">
                <table id="crudTable" class="table table-hover">
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