@extends ("site.main")

@section ("vendorStyleFiles")
    @parent
    <link rel="stylesheet" type="text/css" href="{{ $this->getResourceUrl('assets/bootstrap-select/dist/css/bootstrap-select.css') }}">
@stop

@section ("vendorScriptFiles")
    @parent
    <script src="{{ $this->getResourceUrl('assets/bootstrap-select/dist/js/bootstrap-select.js') }}"></script>
@stop

@section ("mainContents")
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2>{{ isset($tournament)? "Edición de Torneo" : "Creación de Torneo" }}</h2>
            </div>
            <div class="card-body card-padding">
                <form method="POST" action="{{ isset($tournament)? $this->getUrl("/tournament/updateTournament") : $this->getUrl("/tournament/createTournament") }}">
                    @if (isset($tournament))
                    <input type="hidden" name="id" value="{{ $tournament->getId() }}">
                    @endif
                    
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group fg-line">
                                <label class="control-label" for="descriptionField">Descripción (*)</label>
                                <input type="text" id="descriptionField" name="description" class="form-control" value="{{ isset($this->category)?  $this->category->getDescription() : "" }}" autofocus="true" required>
                            </div>
                        </div>
                    </div> 
                    
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group fg-line">
                                <label class="control-label" for="clubField">Club (*)</label>
                                <select id="clubField" name="clubid" class="selectpicker bs-select-hidden" data-live-search="true">
                                    @foreach ($clubs as $club)
                                    <option value="{{ $club->getId() }}">{{ $club->getDescription() }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div> 
                    
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group fg-line">
                                <label class="control-label" for="inscriptionsDateField">Fecha de cierre de inscripción (*)</label>
                                <input type="date" id="inscriptionsDateField" name="inscriptionsDate" class="form-control" value="{{ isset($this->user)?  date_format(date_create($this->user->getBirthDate()), "Y-m-d") : "" }}" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group fg-line">
                                <label class="control-label" for="startDateField">Fecha de inicio (*)</label>
                                <input type="date" id="startDateField" name="startDate" class="form-control" value="{{ isset($this->user)?  date_format(date_create($this->user->getBirthDate()), "Y-m-d") : "" }}" required>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>
@stop