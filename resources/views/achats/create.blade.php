@extends('layouts.app')
@section('content')
<div class="container py-4">
    <h2 class="mb-4">🛒 Nouveau Achat</h2>

    <form action="{{ route('achats.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="date" class="form-label">📅 Date de l'achat</label>
            <input type="date" class="form-control" name="date" required>
        </div>

        <div class="mb-3">
            <label for="observations" class="form-label">📝 Observations</label>
            <textarea name="observations" rows="3" class="form-control" placeholder="Ex: Commande fournisseur, retour stock..."></textarea>
        </div>

        <hr>
        <h5>📦 Détails des Produits</h5>

        <table class="table table-bordered" id="detailsTable">
            <thead class="table-light">
                <tr>
                    <th>Produit</th>
                    <th>Quantité</th>
                    <th>Prix HT</th>
                    <th>TVA (%)</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <select name="produits" class="form-select" required>
                            @foreach($produits as $produit)
                                <option value="{{ $produit->id }}">{{ $produit->designation }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td><input type="number" name="quantites[]" class="form-control" min="1" required></td>
                    <td><input type="number" name="prix_hts[]" class="form-control" step="0.01" required></td>
                    <td><input type="number" name="tvas[]" class="form-control" step="0.01" value="20"></td>
                    <td><button type="button" class="btn btn-danger btn-sm removeRow">🗑️</button></td>
                </tr>
            </tbody>
        </table>

        <button type="button" class="btn btn-secondary mb-3" id="addRow">➕ Ajouter un produit</button>

        <div class="text-end">
            <button type="submit" class="btn btn-primary">✅ Enregistrer l'achat</button>
        </div>
    </form>
</div>

<script>
    document.getElementById('addRow').addEventListener('click', function () {
        const tableBody = document.querySelector('#detailsTable tbody');
        const firstRow = tableBody.querySelector('tr');
        const newRow = firstRow.cloneNode(true);

        // Reset les champs
        newRow.querySelectorAll('input').forEach(input => input.value = '');
        tableBody.appendChild(newRow);
    });

    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('removeRow')) {
            const row = e.target.closest('tr');
            const rowCount = document.querySelectorAll('#detailsTable tbody tr').length;
            if (rowCount > 1) {
                row.remove();
            }
        }
    });
</script>
@endsection


{{-- Script d'ajout/suppression dynamique de lignes --}}


    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>
</html> --}}
