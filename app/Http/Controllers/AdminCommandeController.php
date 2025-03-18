<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\ModeReglement;
use App\Models\Etat;
use App\Models\DetailsCommande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminCommandeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Commande::with(['user', 'etat', 'mode_reglement'])
                        ->orderBy('created_at', 'desc');
        
        // Filter by status if applied
        if ($request->has('status')) {
            $query->where('etat_id', $request->status);
        }

        // Paginate results (15 per page)
        $commandes = $query->paginate(15);

        // Get all available statuses for filtering
        $statuses = Etat::all();

        return view('admin.commandes.index', compact('commandes', 'statuses'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Commande $commande)
    {
        // Load all necessary relationships
        $commande = Commande::with(['user', 'etat', 'mode_reglement', 'details.produit'])
                            ->findOrFail($commande->id);

        // Calculate the total of the order
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

        // Get client information
        $client = $commande->user;

        return view('admin.commandes.show', [
            'commande' => $commande,
            'details' => $details,
            'totalCommande' => $totalCommande,
            'client' => $client,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Commande $commande)
    {
        // Get the available statuses and payment methods
        $statuses = Etat::all();
        $paymentMethods = ModeReglement::all();

        // Display the edit form with current values
        return view('admin.commandes.edit', [
            'commande' => $commande,
            'statuses' => $statuses,
            'paymentMethods' => $paymentMethods,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Commande $commande)
    {
        // Validate incoming data
        $request->validate([
            'status' => 'required|exists:etats,id',
            'mode_reglement_id' => 'required|exists:mode_reglements,id',
            'regle' => 'required|boolean',
        ]);

        try {
            // Start transaction
            DB::beginTransaction();

            // Update the order with new values
            $commande->update([
                'etat_id' => $request->status,
                'mode_reglement_id' => $request->mode_reglement_id,
                'regle' => $request->regle,
            ]);

            // Commit transaction
            DB::commit();

            return redirect()->route('admin.commandes.index')->with('success', 'Order updated successfully!');
        } catch (\Exception $e) {
            // Rollback in case of an error
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to update the order. Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Commande $commande)
    {
        try {
            // Start transaction
            DB::beginTransaction();

            // Delete all the details of the order
            foreach ($commande->details as $detail) {
                $detail->delete();
            }

            // Now delete the main order
            $commande->delete();

            // Commit transaction
            DB::commit();

            return redirect()->route('admin.commandes.index')->with('success', 'Order deleted successfully!');
        } catch (\Exception $e) {
            // Rollback in case of an error
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to delete the order. Please try again.');
        }
    }
}
