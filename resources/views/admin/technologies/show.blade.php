@extends('layouts.app')

@section('page-title', $project->name )

@section('main-content')

  <div class="card w-100 mb-3 text-center">
    <div class="card-body">
      <h5 class="card-title">{{ $project->name}}</h5>
      <p class="card-text">{{ $project->id}}</p>
      <p class="card-text">{{ $project->slug}}</p>
      <p> 
        Tipologia collegata :
        @if ($project->type != null)
        <a href="{{ route('admin.types.show', ['type' => $project->type_id]) }}">
          {{ $project->type->title}}
        </a>
       @else
      -
       @endif</p>
      </p>
      <a href="{{ route('admin.projects.edit', ['project' => $project->id]) }}" class="btn btn-warning">Modifica</a>
      <form 
        {{-- aggiunto conferma di cancellazione --}}
          onsubmit="return confirm('sei sicuro di volerlo cancellare ?')"
          action="{{ route('admin.projects.destroy', ['project' => $project->id]) }}" 
          method="POST" 
          class="d-inline-block">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger">
              Elimina
          </button>
      </form>
    </div>
  </div>
@endsection
