@extends('layouts.app')

@section('page-title', $type->name )

@section('main-content')

  <div class="card w-100 mb-3 text-center">
    <div class="card-body">
      <h5 class="card-title">{{ $type->name}}</h5>
      <p class="card-text">{{ $type->id}}</p>
      <p class="card-text">{{ $type->slug}}</p>
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
