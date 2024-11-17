<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

// Helpers
use Illuminate\Support\Facades\Storage;
// per spostare i file da $data allo storage 

// Models
use App\Models\{
    Project,
    Type,
    Technology
};

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();

        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // così mi importo i types nella view create
        $types = Type::all();
        $technologies = Technology::get();


        return view('admin.projects.create', compact('types','technologies'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $data = $request->validate([
            'name' => 'required|min:3|max:6',
            // nullable, deve esistere come id nella tabella types 
            'type_id' => 'nullable|exists:types,id',
            'file' => 'nullable|image|max:1024',
            'technologies' => 'nullable|array|exists:technologies,id'

        ],[
            'name.min' => 'il campo titolo deve avere minimo 3 caratteri',
            'type_id.exists' => 'tipologia non valida',
            'file.max' => 'immagine troppo grande'

        ]);

        // con questo laravel crea una cartella di nome uploads nello storage/app/public aggiornando con put il file con un nuovo nome che gli viene assegnato cambianfo il percorso una volta salvato nel db con uploads/e nuovo nome del file ...

        if (isset($data['file'])) {
            $filePath = Storage::put('uploads', $data['file']);
            // nel caso volessimo utilizzare un disk diverso da quello di FILESYSTEM_DISK=public nel file env basta aggiungere la funzione disk()
            // $filePath = Storage::disk('local')->put('uploads', $data['file']);
             $data['file'] = $filePath;
        }
       

        $data['slug'] = str()->slug($data['name']);

        $project = Project::create($data);
      
        $project->technologies()->sync($data['technologies'] ?? []); 


        // prendiamo tutti gli id che si troveranno nell'array technologies e li sincronizzerà con i projects se invece non passiamo niente diventa null( ?? [])


          return redirect()->route('admin.projects.index', ['project' => $project->id]);
        // $request->validate([
        //     'name' => 'required|min:3|max:6',
        // ],[
        //     'name.min' => 'il campo name deve avere minimo 3 caratteri'
            
        // ]);

        // $data = $request->all();

        // $project = new Project();
        // $project->name = $request->name;
        // $project->slug = Str::slug($request->name, '-');

        // $project->save();
        // // \Log::debug($project);
        // return redirect()->route('admin.projects.index', ['project' => $project->id]);
       
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        
        // if (!$project){
        //     abort(404);
        //     } 
        return view('admin.projects.show', compact('project'));
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {   
        // aggiungiamo ache qui i types per usarli nella view aggiungendoli anche nel compact
        $types = Type::all();
        $technologies = Technology::get();


        return view('admin.projects.edit', compact('project', 'types','technologies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {

        // casi possibile sul file img:
        // 1) se c'è già un immagine , la posso sostituire
        // 2) se non c'è l'immagine , la posso aggiungere
        // 3) se c'è un immagine , la posso rimuovere

        $data = $request->validate([
            'name' => 'required|min:3|max:6',
            'type_id' => 'nullable|exists:types,id',
            'file' => 'nullable|image|max:1024',
            'technologies' => 'nullable|array|exists:technologies,id',
            'remove_img' => 'nullable'
        ],[
            'name.min' => 'il campo titolo deve avere minimo 3 caratteri',
            'type_id.exists' => 'tipologia non valida',
            'file.max' => 'immagine troppo grande'
        ]);

        $data['slug'] = str()->slug($data['name']);

        if (isset($data['file'])) {
            // se è diverso da null entra nella condizione e fai l'eliminazione del vecchio con l'aggiunta del nuovo 
            if ($project->file) {
                // elimina file(immagine) precedente
                Storage::delete($project->file);
                $project->file = null;
            }
            // altrimenti se è null aggiornalo e salvalo
            $filePath = Storage::put('uploads', $data['file']);
            $data['file'] = $filePath;
        }
        elseif (isset($data['remove_img']) && $project->file) {
            // elimina file(immagine) precedente
            Storage::delete($project->file);
            $project->file = null;
        }
        $project->update($data);
        
        $project->technologies()->sync($data['technologies'] ?? []); 


        return redirect()->route('admin.projects.index', ['project' => $project->id]);

       
        // $project->name = $request->name;
        // $project->slug = Str::slug($request->name, '-');

        // $project->update();
        // // \Log::debug($project);

        // return redirect()->route('admin.projects.index', ['project' => $project->id]);


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();

        // prima di cancellare direttamente il project se è presente il project->file allora lo eliminiamo 
        if ($project->file) {
            Storage::delete($project->file);
        }
        // aggiunto condizione nel destroy per eliminare il file img insieme al project altrimenti verrebbe cancellato il project ma non il file img

        return redirect()->route('admin.projects.index');
    }
}
