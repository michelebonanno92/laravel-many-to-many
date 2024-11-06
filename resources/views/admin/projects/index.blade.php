@extends('layouts.app')

@section('page-title', 'Tutti i progetti')

@section('main-content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center text-info">
                        Tutti i progetti 
                    </h1>
                    <a href="{{ route('admin.projects.create')}}" class="btn btn-success w-100">
                      + Aggiungi Progetto
                    </a>
                </div>
            </div>

            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Slug</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($projects as $project )
                    <tr>
                      <th scope="row">{{ $project->id}}</th>
                      <td>{{ $project->name}}</td>
                      <td>{{ $project->slug}}</td>
                      <td>
                        <a href="{{ route('admin.projects.show', ['project' => $project->id]) }}" class="btn btn-primary">
                          Vedi
                         </a>
                         <a href="{{ route('admin.projects.edit', ['project' => $project->id]) }}" class="btn btn-warning">
                           Modifica
                         </a>
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
                      </td>
                   
                    </tr>
                 
                  @endforeach
                </tbody>
               
               
              </table>
        </div>
    </div>
@endsection
