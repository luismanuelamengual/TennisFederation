@extends ("site.base")

@section ("mainContents")
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2>Administración de Categorías</h2>
            </div>

            <div class="card-body card-padding">
                <a href="{{ $this->getUrl("/category/showCategoryForm") }}" class="btn btn-primary btn-icon waves-effect waves-circle waves-float"><i class="zmdi zmdi-plus"></i></a>
            </div>        
                
            <div class="card-body">
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
                                                <a href="{{ $this->getUrl("/category/showCategoryForm", ["id"=>$category->getId()]) }}">Editar</a>
                                            </li>
                                            <li>
                                                <a href="{{ $this->getUrl("/category/deleteCategory", ["id"=>$category->getId()]) }}">Eliminar</a>
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