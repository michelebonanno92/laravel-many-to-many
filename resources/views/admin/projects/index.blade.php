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
                    <th scope="col">Type</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($projects as $project )

                  {{-- le funzioni del model le possiamo richiare come funzioni e la usiamo per iniziare una query che poi va finalizzata--}}
                    {{--  con first prendi il primo --}}
                      {{-- @if ($project->type_id != null)
                      {{-- con first ti prende il primo --}}
                        {{-- @dd($project->type()->first()) --}}
                        {{-- con get ti fa una collezione e all'interno di un array trovi il singolo elemento --}}
                        {{-- @dd($project->type()->get()) --}}
                      {{-- @endif  --}}

                      {{-- oppure la funzione del model la possiamo richiamare e usare come proprietà  mi restituisce direttamente le instanze o l'istanza associata e ti esegue direttamente la query --}}
                      {{-- @if ($project->type_id != null)
                    
                        @dd($project->type)
                
                      @endif --}}

                    <tr>
                      <th scope="row">{{ $project->id}}</th>
                      <td>{{ $project->name}}</td>
                      <td>{{ $project->slug}}</td>
                      <td class="text-center fs-5">
                        @if ($project->type != null)
                        {{-- con questo andiamo a prendere nel ciclo dei project la funzione type che prende il title dalla tabella type attraverso la relazione con il belongsTo che pesca direttamente tramite Model dal db  --}}
                          {{ $project->type->title}}
                        @else
                          -
                        @endif
                      </td>
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
