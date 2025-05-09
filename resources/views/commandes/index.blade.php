@extends('layouts.app')
@section('content')
<div class="hero-section hero-background">
    <h1 class="page-title">Commandes</h1>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12 mt-5 mb-5" style="display: flex;flex-direction: column;">
            <div class="wrap-btn-control">
                <a class="btn back-to-shop" href="/">Back to Shop</a>
                <!-- <button class="btn btn-update" type="submit" disabled=""></button> -->
                <!-- <button class="btn btn-ajouter" type="reset">Ajouter</button> -->
                <span></span>
            </div>
            <div class="table-responsive biotable">
                <table class="table table-hover biolife-table">
                    <thead>
                        <tr class="bg-success">
                            <th class="text-white">N° Commande</th>
                            <th class="text-white">Date</th>
                            <th class="text-white">Client</th>
                            <th class="text-white">Montant</th>
                            <th class="text-white">Etat</th>
                            <th class="text-white">Mode de Règlement</th>
                            <th class="text-white">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><strong>#42</strong></td>
                        <td>15/04/2023</td>
                        <td>Jean Dupont</td>
                        <td><span class="price">125,50 €</span></td>
                        <td>
                            <span class="badge bg-success text-white px-3 py-2">
                                Livré
                            </span>
                        </td>
                        <td>Carte bancaire</td>
                        <td>
                                <form action="">
                                    <button class="co-button bg-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill co-icon" viewBox="0 0 16 16">
                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                                        <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
                                    </svg>
                                    </button>
                                </form>
                            </td>
                    </tr>
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
                            <td>
                                <form action="">
                                    <button class="bg-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                                        <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
                                    </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">Aucune commande trouvée</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
.biotable{
    margin-top:2rem;
}
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