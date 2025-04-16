@extends('layouts.app')

@section('content')
    <h2>Liste des Familles</h2>
    <a href="{{ route('familles.create') }}" class="btn btn-primary">Ajouter une Famille</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>Libellé</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($familles as $famille)
                <tr>
                    <td>{{ $famille->libelle }}</td>
                    <td><img src="{{ asset('storage/' . $famille->image) }}" width="50"></td>
                    <td>
                        <a href="{{ route('familles.edit', $famille->id) }}" class="btn btn-warning">Modifier</a>
                        <form action="{{ route('familles.destroy', $famille->id) }}" method="POST" style="display:inline-block">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" onclick="return confirm('Supprimer cette famille ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
