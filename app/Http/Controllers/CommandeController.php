<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommandeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();  
        $commandes = $user->commandes()->orderBy('created_at','desc')->paginate(10);
        return view('',compact('commandes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'mode_reglement_id' => 'required|exists:mode_reglements,id',
        ]);

        try {
            DB::beginTransaction();

            $commande = Commande::create([
                'date' => now()->toDateString(),
                'heure' => now()->toTimeString(),
                'regle' => false,
                'mode_reglement_id' => $request->mode_reglement_id,
                'etat_id' => 1,
                'user_id' => Auth::id(),
            ]);

            $cart = session('cart', []);
            if (empty($cart)) {
                throw new Exception('Cart is empty.');
            }

            foreach ($cart as $produitId => $item) {
                DetailsCommande::create([
                    'commande_id' => $commande->id,
                    'produit_id' => $produitId,
                    'quantite' => $item['quantity'],
                    'prix_ht' => $item['prix_ht'],
                    'tva' => $item['tva'],
                ]);
            }

            session()->forget('cart');

            DB::commit();

            return redirect()->route('commandes.confirmation', $commande->id)
                             ->with('success', 'Order placed successfully!');

        } catch (Exception $e) {
            DB::rollBack();

            \Log::error('Order creation failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to place the order. Please try again.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Commande $commande)  {
        $commande = Commande::with('details.produit')->findOrFail($commande->id);
        $details = $commande->details->map(function ($detail) {
            $prix_ht_total = $detail->prix_ht * $detail->quantite;  
            $tva_amount = $prix_ht_total * ($detail->tva / 100);    
            $prix_ttc = $prix_ht_total + $tva_amount;             

            return [
                'produit' => $detail->produit->name ?? 'Unknown Product', 
                'quantite' => $detail->quantite,
                'prix_ht_unitaire' => $detail->prix_ht,
                'prix_ht_total' => $prix_ht_total,
                'tva' => $detail->tva,
                'tva_amount' => $tva_amount,
                'prix_ttc' => $prix_ttc,
            ];
        });

        $totalCommande = $details->sum('prix_ttc');
        return view('commandes.show', [
            'commande' => $commande,
            'details' => $details,
            'totalCommande' => $totalCommande,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Commande $commande)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Commande $commande)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Commande $commande)
    {
        //
    }
}
