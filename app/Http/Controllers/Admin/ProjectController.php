<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

// Models
use App\Models\Project;

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
        return view('admin.projects.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|min:3|max:6',
        ],[
            'name.min' => 'il campo titolo deve avere minimo 3 caratteri'
        ]);

        $data['slug'] = str()->slug($data['name']);

        $project = Project::create($data);
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
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $data = $request->validate([
            'name' => 'required|min:3|max:6',
        ],[
            'name.min' => 'il campo titolo deve avere minimo 3 caratteri'
        ]);

        $data['slug'] = str()->slug($data['name']);

        $project->update($data);
          return redirect()->route('admin.projects.index', ['project' => $project->id]);

        // $data = $request->all();

        // $project = new Project();
        // $project->name = $request->name;
        // $project->slug = Str::slug($request->name, '-');

        // $project->update();
        // \Log::debug($project);

        // return redirect()->route('admin.projects.index', ['project' => $project->id]);


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $type->delete();

        return redirect()->route('admin.projects.index');
    }
}
