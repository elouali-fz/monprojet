<?php

namespace App\Http\Controllers;

use App\Models\Etat;
use Illuminate\Http\Request;

class EtatController extends Controller
{
    public function index()
    {
        return view('etats.index', ['etats' => Etat::all()]);
    }

    public function create()
    {
        return view('etats.create');
    }

    public function store(Request $request)
    {
        $request->validate(['etat' => 'required|string|unique:etats']);
        Etat::create($request->all());
        return redirect()->route('etats.index');
    }

    public function edit(Etat $etat)
    {
        return view('etats.edit', compact('etat'));
    }

    public function update(Request $request, Etat $etat)
    {
        $request->validate(['etat' => 'required|string|unique:etats,etat,' . $etat->id]);
        $etat->update($request->all());
        return redirect()->route('etats.index');
    }

    public function destroy(Etat $etat)
    {
        $etat->delete();
        return redirect()->route('etats.index');
    }
}
