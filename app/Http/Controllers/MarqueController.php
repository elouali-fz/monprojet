<?php

namespace App\Http\Controllers;
use App\Models\Marque;
use App\Http\Requests\StoreMarqueRequest;
use App\Http\Requests\UpdateMarqueRequest;


class MarqueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $marques = Marque::all();
        return view('marques.index', compact('marques'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('marques.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMarqueRequest $request)
{
    Marque::create($request->validated());
    return redirect()->route('marques.index')->with('success', 'Marque ajoutée avec succès!');
}


    /**
     * Display the specified resource.
     */

     public function show($id)
     {
         $marque = Marque::with('produits')->findOrFail($id);
         return view('marques.show', [
             'marque' => $marque,
             'produits' => $marque->produits
         ]);
     }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Marque $marque)
    {
        return view('marques.edit', compact('marque'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMarqueRequest $request, Marque $marque)
{
    $marque->update($request->validated());
    return redirect()->route('marques.index')->with('success', 'Marque mise à jour avec succès!');
}


    public function destroy(Marque $marque)
    {
        $marque->delete();
        return redirect()->route('marques.index');
    }
}


