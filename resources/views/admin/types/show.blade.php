@extends('layouts.app')

@section('page-title', $type->name )

@section('main-content')

  <div class="card w-100 mb-3 text-center">
    <div class="card-body">
      <h5 class="card-title">{{ $type->name}}</h5>
      <p class="card-text">{{ $type->id}}</p>
      <p class="card-text">{{ $type->slug}}</p>
      <a href="#" class="btn btn-warning">Modifica</a>
      <a href="#" class="btn btn-danger">Elimina</a>
    </div>
  </div>
@endsection
