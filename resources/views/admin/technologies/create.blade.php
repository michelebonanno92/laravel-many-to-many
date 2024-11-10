@extends('layouts.app')

@section('page-title' , 'Crea il tuo progetto')

@section('main-content')
<h1>
  Crea Progetto
</h1>

<form action="{{ route('admin.projects.store')}}" method="POST">
  @csrf
  <div class="mb-3">
    <label for="name" class="form-label">Nome</label>
    <input type="text" class="form-control" id="name"  name="name" placeholder="Inserisci il nome del progetto..." value="{{old('name')}}" required maxlength="6">
    @error('name')
      <div class="alert alert-danger mt-2">
        Errore Nome: {{ $message }}
      </div>
    @enderror
  </div>
  <div class="mb-3">
    <label for="type_id" class="form-label">Tipologia di progetto</label>
    <select id="type_id" name="type_id"  class="form-select" aria-label="Default select example">
        <option
        {{-- con questo lo selezioniamo solo se non era stato selezionato --}}
        @if (old('type_id') == null)
            selected
        @endif
           value="">Seleziona una tipologia</option>
        @foreach ($types as $type)
          <option 
          {{-- con questo se l'old è uguale ad un id allora facciamo la selezione con il selected --}}
              @if (old('type_id') == $type->id)
                 selected   
              @endif
              value="{{ $type->id }}">{{ $type->title }}</option>
        @endforeach
    </select>
    @error('type_id')
      <div class="alert alert-danger mt-2">
        Errore Tipologia: {{ $message }}
      </div>
    @enderror
  </div>

  
  <button type="submit" class="btn btn-primary w-100">
    + Aggiungi
   </button>
</form>
@endsection
