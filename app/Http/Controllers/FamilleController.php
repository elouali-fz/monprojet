<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreFamilleRequest;
use App\Models\Famille;
use Illuminate\Support\Facades\Storage;


class FamilleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $familles = Famille::paginate(10);
        return view('familles.index', compact('familles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('familles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }
        Famille::create([
            'libelle' => $request->libelle,
            'image' => $imagePath,
        ]);
        return redirect()->route('familles.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(famille $famille)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(famille $famille)
    {
        return view('familles.edit', compact('famille'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, famille $famille)
    {
        if ($request->hasFile('image')) {
            if ($famille->image) {
                Storage::disk('public')->delete($famille->image);
            }
    
            $imagePath = $request->file('image')->store('images', 'public');
            $famille->image = $imagePath;
        }
    
        $famille->update($request->except('image'));
    
        return redirect()->route('familles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(famille $famille)
    {
        if ($famille->image) {
            Storage::disk('public')->delete($famille->image);
        }
        $famille->delete();
        return redirect()->route('familles.index');
    }
}
