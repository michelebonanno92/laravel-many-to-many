@extends('layouts.guest')

@section('main-content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center text-primary">
                        Welcome!
                    </h1>
                    <br>
                    La welcome page è una pagina pubblica (NON protetta)
                </div>
            </div>
        </div>
        <div>
            <div class="mb-4">
               <a href="{{route('admin.projects.index') }}" class="btn btn-primary w-100">
                  Tutti i progetti
               </a>
            </div>
       </div> 
@endsection
