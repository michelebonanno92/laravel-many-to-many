@extends('layouts.app')

@section('page-title' , 'Crea la tua tecnologia')

@section('main-content')
<h1>
  Crea la tecnologia
</h1>

<form action="{{ route('admin.technologies.store')}}" method="POST">
  @csrf
  <div class="mb-3">
    <label for="name" class="form-label">Nome</label>
    <input type="text" class="form-control" id="name"  name="name" placeholder="Inserisci il nome della tecnologia" value="{{old('name')}}" required maxlength="6">
    @error('name')
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
