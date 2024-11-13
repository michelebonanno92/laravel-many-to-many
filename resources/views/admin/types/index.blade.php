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
                </div>z
            </div>

            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Titolo</th>
                    <th scope="col">Slug</th>
                    <th scope="col">Progetti collegati</th>
                    <th scope="col">Numero dei Progetti collegati</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($types as $type)
                    <tr>
                      <th scope="row">{{ $type->id}}</th>
                      <td>{{ $type->title}}</td>
                      <td>{{ $type->slug}}</td>
                      <td>
                          {{-- @if ($type->projects()->count() > 0) --}}
                          @if (count($type->projects) > 0)
                              @foreach ($type->projects as $project )
                                  <a href="{{ route('admin.projects.show', ['project' => $project->id])}}" class="me-3">
                                    {{$project->name}}
                                  </a>
                              @endforeach
                          @else
                            Nessun progetto collegato
                          @endif
                      </td>
                      {{-- metodo query --}}
                      {{-- <td> {{ $type->projects()->count()}}</td> --}}
                      {{-- oppure scrivendo {{ $type->projects}} mi stampa una collezione  --}}
                      {{-- oppure scrivendo il count() prima --}}
                      <td> {{ count($type->projects)}}</td>
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
