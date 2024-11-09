@extends('layouts.app')

@section('page-title', $type->name )

@section('main-content')

  <div class="card w-100 mb-3 text-center">
    <div class="card-body">
      <h5 class="card-title">{{ $type->name}}</h5>
      <p class="card-text">{{ $type->id}}</p>
      <p class="card-text">{{ $type->slug}}</p>
      <p>
        Progetti collegati : 
        @if ($type->projects()->count() > 0)
            @foreach ($type->projects as $project )
                <a href="{{ route('admin.projects.show', ['project' => $project->id])}}" class="me-3">
                  {{$project->name}}
                </a>
            @endforeach
        @else
          Nessun progetto collegato
        @endif
      </p>
      <a href="{{ route('admin.types.edit', ['type' => $type->id]) }}" class="btn btn-warning">
            Modifica
      </a>
      <form 
      {{-- aggiunto conferma di cancellazione --}}
         onsubmit="return confirm('sei sicuro di volerlo cancellare ?')"
         action="{{ route('admin.types.destroy', ['type' => $type->id]) }}" 
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
