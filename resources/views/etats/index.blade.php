@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Liste des états</h2>
    <a href="{{ route('etats.create') }}" class="btn btn-primary mb-3">Ajouter un état</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>État</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($etats as $etat)
                <tr>
                    <td>{{ $etat->id }}</td>
                    <td>{{ $etat->etat }}</td>
                    <td>
                        <a href="{{ route('etats.edit', $etat->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                        <form action="{{ route('etats.destroy', $etat->id) }}" method="POST" style="display:inline-block">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Supprimer cet état ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection


