@extends('layouts.app')

@section('page-title', 'Tutte le tecnologie')

@section('main-content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center text-info">
                      Tutte le tecnologie
                    </h1>
                    <a href="{{ route('admin.technologies.create')}}" class="btn btn-success w-100">
                      + Aggiungi 
                    </a>
                </div>
            </div>

            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Slug</th>
                    <th scope="col">Numero di progetti collegati</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                  {{-- le funzioni del model le possiamo richiare come funzioni e la usiamo per iniziare una query che poi va finalizzata--}}
                    {{--  con first prendi il primo --}}
                      {{-- @if ($technology->type_id != null)
                      {{-- con first ti prende il primo --}}
                        {{-- @dd($technology->type()->first()) --}}
                        {{-- con get ti fa una collezione e all'interno di un array trovi il singolo elemento --}}
                        {{-- @dd($technology->type()->get()) --}}
                      {{-- @endif  --}}

                      {{-- oppure la funzione del model la possiamo richiamare e usare come proprietà  mi restituisce direttamente le instanze o l'istanza associata e ti esegue direttamente la query --}}
                      {{-- @if ($technology->type_id != null)
                    
                        @dd($technology->type)
      
                      @endif --}}
                      @foreach ($technologies as $technology )
                        <tr>
                          <th scope="row">{{ $technology->id}}</th>
                          <td>{{ $technology->name}}</td>
                          <td>{{ $technology->slug}}</td>
                          <td>
                            @foreach ($technology->projects as $project)
                              <a href="{{ route('admin.projects.show',['project' => $project->id]) }}" class="badge rounded-pill text-bg-warning">
                                  {{ $project->name }}
                              </a>
                                
                            @endforeach
                          </td>
                          <td>
                            {{ $technology->projects()->count() }}
                          </td>
                          <td>
                            <a href="{{ route('admin.technologies.show', ['technology' => $technology->id]) }}" class="btn btn-primary">
                              Vedi
                            </a>
                            <a href="{{ route('admin.technologies.edit', ['technology' => $technology->id]) }}" class="btn btn-warning">
                              Modifica
                            </a>
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
                          </td>
                      
                        </tr>
                 
                      @endforeach
                </tbody>
               
               
              </table>
        </div>
    </div>
@endsection
