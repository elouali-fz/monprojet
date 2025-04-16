@extends('layouts.app')

@section('content')
    <h2>Liste des Sous-Familles</h2>
    <a href="{{ route('sous-familles.create') }}" class="btn btn-primary">Ajouter une Sous-Famille</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>Famille</th>
                <th>Libellé</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sous_familles as $sf)
                <tr>
                    <td>{{ $sf->famille->libelle }}</td>
                    <td>{{ $sf->libelle }}</td>
                    <td><img src="{{ asset('storage/' . $sf->image) }}" width="50"></td>
                    <td>
                        <a href="{{ route('sous-familles.edit', $sf->id) }}" class="btn btn-warning">Modifier</a>
                        <form action="{{ route('sous-familles.destroy', $sf->id) }}" method="POST" style="display:inline-block">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" onclick="return confirm('Supprimer cette sous-famille ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection