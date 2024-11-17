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
      <p>
        numero di tecnologie collegate : 
        {{ $project->technologies()->count() }}
      </p>
      <p> 
        Tecnologie collegate : 
          @foreach ($project->technologies as $technology )
            <a href="{{ route('admin.technologies.show', ['technology' => $technology->id]) }}"  class="badge rounded-pill text-bg-warning">
              {{ $technology->name}}
            </a>
          @endforeach
      </p>
      <div>
        @if ($project->file)
            {{-- <img src="{{ '/storage/'.$project->file }}" alt="{{ $project->name }}" class="card-img-bottom mb-4" > --}}
            <img src="{{ asset('/storage/'.$project->file) }}" alt="{{ $project->name }}" style="height: 100px">
        @endif
      </div>
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
