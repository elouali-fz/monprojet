@extends('layouts.app')
@section('content')
<div class="hero-section hero-background">
    <h1 class="page-title">Commandes</h1>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12 mt-5 mb-5">
            <div class="table-responsive">
                <table class="table table-hover biolife-table">
                    <thead>
                        <tr class="bg-success">
                            <th class="text-white">N° Commande</th>
                            <th class="text-white">Date</th>
                            <th class="text-white">Client</th>
                            <th class="text-white">Montant</th>
                            <th class="text-white">Etat</th>
                            <th class="text-white">Mode de Règlement</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($commandes as $commande)
                        <tr>
                            <td><strong>#{{ $commande->id }}</strong></td>
                            <td>{{ \Carbon\Carbon::parse($commande->date_commande)->format('d/m/Y') }}</td>
                            <td>{{ $commande->user->name ?? 'Non défini' }}</td>
                            <td><span class="price">{{ number_format($commande->montant_total, 2) }} €</span></td>
                            <td>
                                <span class="badge @if($commande->etat->libelle == 'Livré') bg-success @elseif($commande->etat->libelle == 'En attente') bg-warning @elseif($commande->etat->libelle == 'Annulé') bg-danger @else bg-info @endif text-white px-3 py-2">
                                    {{ $commande->etat->libelle ?? 'Non défini' }}
                                </span>
                            </td>
                            <td>{{ $commande->modeReglement->libelle ?? 'Non défini' }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Aucune commande trouvée</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
.biolife-table {
    box-shadow: 0 5px 20px rgba(0,0,0,0.05);
    border-radius: 8px;
    overflow: hidden;
}

.biolife-table thead th {
    font-weight: 600;
    text-transform: uppercase;
    padding: 15px;
    font-size: 0.9em;
}

.biolife-table tbody td {
    padding: 15px;
    border-bottom: 1px solid #f0f0f0;
}

.biolife-table tbody tr:hover {
    background-color: #f9f9f9;
    transition: background-color 0.3s ease;
}

.price {
    color: #e73918;
    font-weight: 600;
}

.badge {
    border-radius: 30px;
    font-weight: 500;
    letter-spacing: 0.5px;
}
</style>
@endsection 