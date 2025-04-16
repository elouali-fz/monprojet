<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails Achat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">🧾 Détails de l’Achat #{{ $achat->id }}</h4>
        </div>
        <div class="card-body">
            <p><strong>📅 Date :</strong> {{ $achat->date }}</p>
            <p><strong>📝 Observations :</strong> {{ $achat->observations ?? 'Aucune' }}</p>
            <p><strong>🚀 Fournisseur :</strong> {{ $achat->fournisseur->nom }} </p>

            <hr>

            <h5 class="mb-3">📦 Produits achetés</h5>
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Produit</th>
                        <th>Quantité</th>
                        <th>Prix HT (MAD)</th>
                        <th>TVA (%)</th>
                        <th>Prix TTC (MAD)</th>
                        <th>Total TTC (MAD)</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0; @endphp
                    @foreach ($achat->details_achat as $detail)
                        @php
                            $prix_ttc = $detail->prix_ht * (1 + $detail->tva / 100);
                            $total_ligne = $detail->quantite * $prix_ttc;
                            $total += $total_ligne;
                        @endphp
                        <tr>
                            <td>{{ $detail->produit->designation }}</td>
                            <td>{{ $detail->quantite }}</td>
                            <td>{{ number_format($detail->prix_ht, 2) }}</td>
                            <td>{{ $detail->tva }}</td>
                            <td>{{ number_format($prix_ttc, 2) }}</td>
                            <td>{{ number_format($total_ligne, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot class="table-light">
                    <tr>
                        <th colspan="5" class="text-end">💰 Total TTC :</th>
                        <th>{{ number_format($total, 2) }} MAD</th>
                    </tr>
                </tfoot>
            </table>

            <a href="{{ route('achats.index') }}" class="btn btn-secondary mt-3">⬅️ Retour à la liste</a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
