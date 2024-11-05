@extends('layouts.app')

@section('page-title', $project->name )

@section('main-content')

  <div class="card w-100 mb-3 text-center">
    <div class="card-body">
      <h5 class="card-title">{{ $project->name}}</h5>
      <p class="card-text">{{ $project->id}}</p>
      <p class="card-text">{{ $project->slug}}</p>
      <a href="#" class="btn btn-warning">Modifica</a>
      <a href="#" class="btn btn-danger">Elimina</a>
    </div>
  </div>
@endsection
