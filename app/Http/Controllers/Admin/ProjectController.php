<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

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
        $data = $request->validate([
            'name' => 'required|min:3|max:6',
            // nullable, deve esistere come id nella tabella types 
            'type_id' => 'nullable|exists:types,id',
            'technologies' => 'nullable|array|exists:technologies,id'

        ],[
            'name.min' => 'il campo titolo deve avere minimo 3 caratteri',
            'type_id.exists' => 'tipologia non valida',
        ]);

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
        $data = $request->validate([
            'name' => 'required|min:3|max:6',
            'type_id' => 'nullable|exists:types,id',
            'technologies' => 'nullable|array|exists:technologies,id'
        ],[
            'name.min' => 'il campo titolo deve avere minimo 3 caratteri',
            'type_id.exists' => 'tipologia non valida'
        ]);

        $data['slug'] = str()->slug($data['name']);

        $project->update($data);
        
        $project->technologies()->sync($data['technologies'] ?? []); 


        return redirect()->route('admin.projects.index', ['project' => $project->id]);

       
        // $project->name = $request->name;
        // $project->slug = Str::slug($request->name, '-');

        // $project->update();
        // // \Log::debug($project);

        return redirect()->route('admin.projects.index', ['project' => $project->id]);


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('admin.projects.index');
    }
}
