@extends('layouts.app')
@section('content')
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-warning text-white">
            <h4 class="mb-0">✏️ Modifier l’achat #{{ $achat->id }}</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('achats.update', $achat->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="date" class="form-label">📅 Date</label>
                    <input type="date" name="date" class="form-control" value="{{ old('date', $achat->date) }}" required>
                </div>

                <div class="mb-3">
                    <label for="observations" class="form-label">📝 Observations</label>
                    <textarea name="observations" class="form-control" rows="3">{{ old('observations', $achat->observations) }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="fournisseur" class="form-label">📝 fournisseur</label>

                    <select name="fournisseur" id="" class="form-select">
                        @foreach($fournisseurs as $fournisseur)
                            <option value="{{ $fournisseur->id }}">{{ $fournisseur->nom ? "selected" : "" }}</option>
                        @endforeach
                    </select>

                </div>

                <hr>
                <h5 class="mb-3">🧾 Détails de l’achat (consultation uniquement)</h5>

                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>Produit</th>
                            <th>Quantité</th>
                            <th>Prix HT</th>
                            <th>TVA (%)</th>
                            <th>Prix TTC</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($achat->details_achat as $detail)
                            <tr>
                                <td>{{ $detail->produit->designation }}</td>
                                <td>{{ $detail->quantite }}</td>
                                <td>{{ number_format($detail->prix_ht, 2) }} MAD</td>
                                <td>{{ $detail->tva }}</td>
                                <td>{{ number_format($detail->prix_ht * (1 + $detail->tva / 100), 2) }} MAD</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">💾 Enregistrer</button>
                    <a href="{{ route('achats.index') }}" class="btn btn-secondary">↩️ Annuler</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
