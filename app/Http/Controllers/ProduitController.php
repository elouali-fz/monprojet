<?php
namespace App\Http\Controllers;

use App\Http\Requests\StoreProduitRequest;
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produits = Produit::paginate(10);
        return view('produits.index', compact('produits'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('produits.create');
    }

    /**
     * Store a newly created resource in storage.
        */
    public function store(StoreProduitRequest $request)
    {
        $request->validate([
            'codebarre' => 'required|numeric',
            'designation' => 'required|string',
            'prix_ht' => 'required|numeric',
            'tva' => 'required|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'sous_famille_id' => 'required|exists:sous_familles,id',
            'marque_id' => 'required|exists:marques,id',
            'unite_id' => 'required|exists:unites,id',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('produits', 'public');
        } else {
            $imagePath = null;
        }

        Produit::create([
            'codebarre' => $request->codebarre,
            'designation' => $request->designation,
            'prix_ht' => $request->prix_ht,
            'tva' => $request->tva,
            'description' => $request->description,
            'image' => $imagePath,
            'sous_famille_id' => $request->sous_famille_id,
            'marque_id' => $request->marque_id,
            'unite_id' => $request->unite_id,
        ]);

        return redirect()->route('produits.index')->with('success', 'Produit ajouté avec succès');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('produits.show', compact('produit'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produit $produit)
    {
        return view('produits.edit', compact('produit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreProduitRequest $request, Produit $produit)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'prix' => 'required|numeric',
            'quantite' => 'required|integer',
            'famille_id' => 'required|integer',
            'sous_famille_id' => 'nullable|integer',
            'marque_id' => 'nullable|integer',
            'unite_id' => 'required|integer',
        ]);
        if ($request->hasFile('image')) {
            if ($produit->image) {
                Storage::disk('public')->delete($produit->image);
            }
            $produit->image = $request->file('image')->store('images', 'public');
        }

        $produit->update($request->except('image'));
        
        return redirect()->route('produit.index');
    }


    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produit $produit)
    {
        if ($produit->image) {
            if ($produit->image) {
                Storage::disk('public')->delete($produit->image);
            }
        }
        $produit->delete();
        return redirect()->route('produits.index');
    }
}