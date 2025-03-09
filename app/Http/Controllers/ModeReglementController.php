<?php

namespace App\Http\Controllers;

use App\Models\ModeReglement;
use Illuminate\Http\Request;

class ModeReglementController extends Controller
{
    public function index()
    {
        return view('mode_reglements.index', ['modes' => ModeReglement::all()]);
    }

    public function create()
    {
        return view('mode_reglements.create');
    }

    public function store(Request $request)
    {
        $request->validate(['mode_reglement' => 'required|string|unique:mode_reglements']);
        ModeReglement::create($request->all());
        return redirect()->route('mode_reglements.index');
    }

    public function edit(ModeReglement $modeReglement)
    {
        return view('mode_reglements.edit', compact('modeReglement'));
    }

    public function update(Request $request, ModeReglement $modeReglement)
    {
        $request->validate(['mode_reglement' => 'required|string|unique:mode_reglements,mode_reglement,' . $modeReglement->id]);
        $modeReglement->update($request->all());
        return redirect()->route('mode_reglements.index');
    }

    public function destroy(ModeReglement $modeReglement)
    {
        $modeReglement->delete();
        return redirect()->route('mode_reglements.index');
    }
}
