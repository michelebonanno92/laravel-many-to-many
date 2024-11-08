@extends('layouts.app')

@section('page-title', 'Tutti i progetti')

@section('main-content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center text-info">
                        Tutte le tipologie
                    </h1>
                    <a href="{{ route('admin.types.create')}}" class="btn btn-success w-100">
                      + Aggiungi tipo
                    </a>
                </div>
            </div>

            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Titolo</th>
                    <th scope="col">Slug</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($plutos as $type)
                    <tr>
                      <th scope="row">{{ $type->id}}</th>
                      <td>{{ $type->title}}</td>
                      <td>{{ $type->slug}}</td>
                      <td>
                        <a href="{{ route('admin.types.show', ['type' => $type->id]) }}" class="btn btn-primary">
                          Vedi
                         </a>
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
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
        </div>
    </div>
@endsection
