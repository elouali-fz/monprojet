@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Modes de règlement</h2>
    <a href="{{ route('mode_reglements.create') }}" class="btn btn-primary mb-3">Ajouter un mode</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Mode</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($mode_reglements as $mode)
                <tr>
                    <td>{{ $mode->id }}</td>
                    <td>{{ $mode->mode }}</td>
                    <td>
                        <a href="{{ route('mode_reglements.edit', $mode->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                        <form action="{{ route('mode_reglements.destroy', $mode->id) }}" method="POST" style="display:inline-block">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Supprimer ce mode ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
