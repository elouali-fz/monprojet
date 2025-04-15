<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SousFamille;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreSous_familleRequest;


class SousFamilleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sous_familles = SousFamille::paginate(10);
        return view('admin.sous_famille.index', compact('sous_familles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.sous_famille.create');
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
        SousFamille::create([
            'libelle' => $request->libelle,
            'famille_id' => $request->famille_id,
            'image' => $imagePath,
        ]);
        return redirect()->route('sous_famille.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(sousFamille $sous_famille)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(sousFamille $sous_famille)
    {
        return view('admin.sous_famille.edit', compact('sous_famille'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, sousFamille $sous_famille)
    {
        if ($request->hasFile('image')) {
            if ($sous_famille->image) {
                Storage::disk('public')->delete($sous_famille->image);
            }
    
            $imagePath = $request->file('image')->store('images', 'public');
            $sous_famille->image = $imagePath;
        }
    
        // Update the other fields
        $sous_famille->update($request->except('image'));
    
        return redirect()->route('sous_famille.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(sousFamille $sous_famille)
    {
        if ($sous_famille->image) {
            if ($famille->image) {
                Storage::disk('public')->delete($famille->image);
            }
        }
        $famille->delete();
        return redirect()->route('sous_famille.index');
    }
}
