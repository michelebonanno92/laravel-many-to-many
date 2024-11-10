<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// MOdels
use App\Models\Technology;



class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $technologies = Technology::all();

        return view('admin.technologies.index', compact('technologies'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.technologies.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|min:3|max:6',
        ],[
            'name.min' => 'il campo titolo deve avere minimo 3 caratteri',
        ]);

        $data['slug'] = str()->slug($data['name']);
        $technology = Technology::create($data);
          return redirect()->route('admin.technologies.index', ['technology' => $technology->id]);
       
    }

    /**
     * Display the specified resource.
     */
    public function show(Technology $technology)
    {
        return view('admin.technologies.show', compact('technology'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Technology $technology)
    {
        return view('admin.technologies.edit', compact('technology'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Technology $technology)
    {
        $data = $request->validate([
            'name' => 'required|min:3|max:6',
        ],[
            'name.min' => 'il campo titolo deve avere minimo 3 caratteri',
        ]);

        $data['slug'] = str()->slug($data['name']);
        $technology->update($data);
          return redirect()->route('admin.technologies.index', ['technology' => $technology->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Technology $technology)
    {
        $technology->delete();

        return redirect()->route('admin.technologies.index');

    }
}
