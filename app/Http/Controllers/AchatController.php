<?php

namespace App\Http\Controllers;

use App\Models\Achat;
use App\Models\Details_achat;
use App\Models\Fournisseur;
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AchatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $achats = Achat::paginate(10);
        return view('achats.index', compact('achats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $produits = Produit::all();
          return view('achats.create', compact('produits'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'produits' => 'required|array',
            'quantites' => 'required|array',
            'prix_ht' => 'required|array',
            'tva' => 'required|array',
        ]);

        try {
            DB::beginTransaction();

            // Enregistrement de l'achat
            $achat = Achat::create([
                'date' => $request->date,
                'observations' => $request->observations,
            ]);

            // Boucle sur chaque produit
            foreach ($request->produits as $index => $produitId) {
                $quantite = $request->quantites[$index];
                $prix_ht = $request->prix_hts[$index];
                $tva = $request->tvas[$index];

                $prix_ttc = $prix_ht + ($prix_ht * $tva / 100);
                $montant_total = $prix_ttc * $quantite;

                // Enregistrement du détail d'achat
                Details_achat::create([
                    'achat_id' => $achat->id,
                    'produit_id' => $produitId,
                    'quantite' => $quantite,
                    'prix_ht' => $prix_ht,
                    'tva' => $tva,
                    'prix_ttc' => $prix_ttc,
                    'montant_total' => $montant_total,
                ]);

                // Mise à jour automatique du stock
                $produit = Produit::find($produitId);
                $produit->stock += $quantite;
                $produit->save();
            }

            DB::commit();

            return redirect()->route('achats.index')->with('success', 'Achat enregistré avec succès !');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Erreur lors de l\'enregistrement de l\'achat : ' . $e->getMessage());
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Achat $achat)
    {
        $achat->load('details_achat.produit');

        return view('achats.show', compact('achat'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Achat $achat)
    {
        $fournisseurs = Fournisseur::all();

        // Passer les données nécessaires à la vue
        return view('achats.edit', compact('achat', 'fournisseurs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Achat $achat)
    {
        $request->validate([
            'date' => 'required|date',
            'fournisseur_id' => 'required|exists:fournisseurs,id',
            'produits' => 'required|array',
            'produits.*.produit_id' => 'required|exists:produits,id',
            'produits.*.quantite' => 'required|numeric|min:1',
            'produits.*.prix_ht' => 'required|numeric|min:0',
            'produits.*.tva' => 'required|numeric|min:0',
        ]);

        DB::transaction(function () use ($request, $achat) {
            $achat->update($request->only('date', 'observations', 'fournisseur_id'));

            // Supprimer les anciens détails d'achat
            $achat->details_commande()->delete();

            foreach ($request->produits as $item) {
                $achat->details_cchat()->create($item);

                // Mise à jour automatique du stock
                $produit = Produit::find($item['produit_id']);
                $produit->ajouterStock($item['quantite']);
            }
        });

        return redirect()->route('achats.index')->with('success', 'Achat mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Achat $achat)
    {
        DB::transaction(function () use ($achat) {
            // Supprimer les détails d'achat
            foreach ($achat->details_achat as $detail) {
                $produit = Produit::find($detail->produit_id);
                $produit->retirerStock($detail->quantite);
            }

            // Supprimer l'achat
            $achat->delete();
        });

        return redirect()->route('achats.index')->with('success', 'Achat supprimé avec succès.');
    }

}
