@extends('layouts.app')
@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="mb-0">📋 Liste des Achats</h2>
            <a href="{{ route('achats.create') }}" class="btn btn-success">
                ➕ Nouveau Achat
            </a>
        </div>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <table class="table table-hover table-bordered shadow-sm">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Date</th>
                    <th>Observations</th>
                    <th>Fournisseur</th>
                    <th colspan="3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($achats as $achat)
                    <tr>
                        <td>{{ $achat->id }}</td>
                        <td>{{ $achat->date }}</td>
                        <td>{{ $achat->observations }}</td>
                        <td>{{ $achat->fournisseur->nom  }}</td>
                        <td class="d-flex gap-2">
                            <a href="{{ route('achats.show', $achat->id) }}" class="btn btn-info btn-sm">details</a>
                        </td>
                        <td>
                            <a href="{{ route('achats.edit', $achat->id) }}" class="btn btn-warning btn-sm">edit</a>
                        </td>
                        <td>
                            <form action="{{ route('achats.destroy', $achat->id) }}" method="POST" onsubmit="return confirm('Confirmer la suppression ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">delete</button>
                            </form>
                        </td>

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted">Aucun achat trouvé.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection

{{--
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>
</html> --}}
