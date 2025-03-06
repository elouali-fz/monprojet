<?php

namespace App\Http\Controllers;


use App\Models\Unite;
use App\Http\Requests\StoreUniteRequest;
use App\Http\Requests\UpdateUniteRequest;


class UniteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $unites = Unite::all();
        return view('unites.index', compact('unites'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('unites.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUniteRequest $request)
{
    Unite::create($request->validated());
    return redirect()->route('unites.index')->with('success', 'Unité ajoutée avec succès!');
}


    /**
     * Display the specified resource.
     */
    public function show(Unite $unite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Unite $unite)
    {
        return view('unites.edit', compact('unite'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUniteRequest $request, Unite $unite)
{
    $unite->update($request->validated());
    return redirect()->route('unites.index')->with('success', 'Unité mise à jour avec succès!');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Unite $unite)
    {
        $unite->delete();
        return redirect()->route('unites.index');
    }
}



