@extends ("site.base")
@section ("mainContents")
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2>{{ isset($this->club)? "Edición de Club" : "Creación de Club" }}</h2>
            </div>
            <div class="card-body card-padding">
                <form method="POST" action="{{ $this->getUrl("/club/saveClub") }}">
                    @if (isset($this->club))
                    <input type="hidden" name="id" value="{{ $this->club->getId() }}">
                    @endif
                    <div class="form-group fg-line">
                        <label class="control-label" for="descriptionField">Descripción</label>
                        <input type="text" id="descriptionField" name="description" class="form-control" value="{{ isset($this->club)?  $this->club->getDescription() : "" }}" autofocus="true">
                    </div>
                    <div class="form-group fg-line">
                        <label class="control-label" for="addressField">Dirección</label>
                        <input type="text" id="addressField" name="address" class="form-control" value="{{ isset($this->club)?  $this->club->getAddress() : "" }}">
                    </div>
                    <div class="form-group fg-line">
                        <label class="control-label" for="contactVia1Field">Contacto 1</label>
                        <input type="text" id="contactVia1Field" name="contactvia1" class="form-control" value="{{ isset($this->club)?  $this->club->getContactVia1() : "" }}">
                    </div>
                    <div class="form-group fg-line">
                        <label class="control-label" for="contactVia2Field">Contacto 2</label>
                        <input type="text" id="contactVia2Field" name="contactvia2" class="form-control" value="{{ isset($this->club)?  $this->club->getContactVia2() : "" }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>
@stop