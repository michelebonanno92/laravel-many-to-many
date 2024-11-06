@extends('layouts.app')

@section('page-title' , 'Modifica il tuo progetto')

@section('main-content')
<h1>
  Modifica Progetto
</h1>

{{-- @if ($errors->any())
  <div class="alert alert-danger my-4">
    <ul>
      @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
      @endforeach
    </ul>
@endif --}}

<form action="{{ route('admin.projects.update',['project' => $project->id])}}" method="POST">
  @csrf
  @method('PUT')
  <div class="mb-3">
    <label for="name" class="form-label">Nome</label>
    <input type="text" class="form-control" id="name"  name="name" placeholder="Inserisci il nome del progetto..." value="{{old('name')}}" required maxlength="6">
    @error('name')
      <div class="alert alert-danger mt-2">
        Errore Nome: {{ $message }}
      </div>
    @enderror
  </div>
  
  <button type="submit" class="btn btn-primary w-100">
    + Modifica
   </button>
</form>
@endsection
