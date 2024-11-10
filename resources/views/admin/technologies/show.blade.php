@extends('layouts.app')

@section('page-title', $technology->name )

@section('main-content')

  <div class="card w-100 mb-3 text-center">
    <div class="card-body">
      <h5 class="card-title">{{ $technology->name}}</h5>
      <p class="card-text">{{ $technology->id}}</p>
      <p class="card-text">{{ $technology->slug}}</p>
      {{-- <p> 
        Tipologia collegata :
        @if ($technology->type != null)
        <a href="{{ route('admin.technologies.show', ['type' => $technology->type_id]) }}">
          {{ $technology->type->title}}
        </a>
       @else
      -
       @endif</p>
      </p> --}}
      <a href="{{ route('admin.technologies.edit', ['technology' => $technology->id]) }}" class="btn btn-warning">Modifica</a>
      <form 
        {{-- aggiunto conferma di cancellazione --}}
          onsubmit="return confirm('sei sicuro di volerlo cancellare ?')"
          action="{{ route('admin.technologies.destroy', ['technology' => $technology->id]) }}" 
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
