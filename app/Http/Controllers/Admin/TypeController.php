<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// aggiunto per lo slug
// use Illuminate\Support\Str;
// use Illuminate\Support\Facades\Log;


// Models
use App\Models\Type;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = Type::get();
        return view('admin.types.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|min:3|max:6',
        ],[
            'title.min' => 'il campo titolo deve avere minimo 3 caratteri'
        ]);

        $data['slug'] = str()->slug($data['title']);

        $type = Type::create($data);
          return redirect()->route('admin.types.index', ['type' => $type->id]);
        // $request->validate([
        //     'title' => 'required|min:3|max:6',
        // ],[
        //     'title.min' => 'il campo titolo deve avere minimo 3 caratteri'
            
        // ]);

        // $data = $request->all();

        // $type = new Type();
        // $type->title = $request->title;
        // $type->slug = Str::slug($request->title, '-');

        // $type->save();
        // Log::debug($type);
        // return redirect()->route('admin.types.index', ['type' => $type->id]);
       
       
    }

    /**
     * Display the specified resource.
     */
    public function show(Type $type)
    {
        return view('admin.types.show' , compact('type'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Type $type)
    {
        return view('admin.types.edit', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Type $type)
    {
        $data = $request->validate([
            'title' => 'required|min:3|max:6',
        ],[
            'title.min' => 'il campo titolo deve avere minimo 3 caratteri'
        ]);

        $data['slug'] = str()->slug($data['title']);

        $type->update($data);

          return redirect()->route('admin.types.index', ['type' => $type->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $type)
    {
       $type->delete();

       return redirect()->route('admin.types.index');

    }
}
