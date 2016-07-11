@extends ("site.main")
@section ("mainContents")
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2>{{ isset($category)? "Edición de Categoría" : "Creación de Categoría" }}</h2>
            </div>
            <div class="card-body card-padding">
                <form method="POST" action="{{ isset($category)? $this->getUrl("/category/updateCategory") : $this->getUrl("/category/createCategory") }}">
                    @if (isset($this->category))
                    <input type="hidden" name="id" value="{{ $category->getId() }}">
                    @endif
                    <div class="form-group fg-line">
                        <label class="control-label" for="descriptionField">Descripción</label>
                        <input type="text" id="descriptionField" name="description" class="form-control" value="{{ isset($this->category)?  $this->category->getDescription() : "" }}" autofocus="true">
                    </div>
                    <div class="form-group fg-line">
                        <label class="control-label" for="typeField">Tipo</label>
                        <select id="typeField" name="matchType" class="form-control" placeholder="Tipo">
                            <option value="1">Singles</option>
                            <option value="2"{{ (isset($category) && $category->getMatchType() == 2)? " selected=\"selected\"" : "" }}>Dobles</option>
                        </select>    
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>
@stop