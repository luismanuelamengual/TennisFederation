@extends ("site.base")

@section ("mainContents")
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2>Administración de Categorías</h2>
            </div>

            <div class="card-body card-padding">
                <a href="{{ $this->getUrl("/category/showCategoryForm") }}" class="btn btn-primary"><i class="zmdi zmdi-plus"></i> Agregar</a>
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
                        <tr>
                            <td>{{ $category->getId() }}</td>
                            <td>{{ $category->getDescription() }}</td>
                            <td>{{ $category->getMatchType() == 1? "Singles":"Dobles" }}</td>
                            <td class="text-left">
                                <ul class="actions">
                                    <li>
                                        <a href="{{ $this->getUrl("/category/showCategoryForm", ["id"=>$category->getId()]) }}">
                                            <i class="zmdi zmdi-edit"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ $this->getUrl("/category/deleteCategory", ["id"=>$category->getId()]) }}">
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