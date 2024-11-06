@extends('layouts.app')

@section('page-title' , 'Modifica il tuo tipo')

@section('main-content')
<h1>
  Modifica tipo
</h1>

{{-- @if ($errors->any())
  <div class="alert alert-danger my-4">
    <ul>
      @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
      @endforeach
    </ul>
@endif --}}

<form action="{{ route('admin.types.update',['type' => $type->id])}}" method="POST">
  @csrf
  @method('PUT')
  <div class="mb-3">
    <label for="title" class="form-label">Nome</label>
    <input type="text" class="form-control" id="title"  name="title" placeholder="Inserisci il nome del progetto..." value="{{old('title')}}" required maxlength="6">
    @error('title')
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
