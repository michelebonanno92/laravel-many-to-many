@extends('layouts.app')

@section('page-title' , 'Crea il tuo tipo')

@section('main-content')
<h1>
  Crea tipo
</h1>

<form action="{{ route('admin.types.store')}}" method="POST">
  @csrf
  <div class="mb-3">
    <label for="title" class="form-label">Titolo</label>
    <input type="text" class="form-control" id="title"  name="title" placeholder="Inserisci il nome del tipo..." value="{{old('title')}}" required maxlength="6">
    @error('title')
      <div class="alert alert-danger mt-2">
        Errore Nome: {{ $message }}
      </div>
    @enderror
  </div>
  
  <button type="submit" class="btn btn-primary w-100">
    + Aggiungi
   </button>
</form>
@endsection
