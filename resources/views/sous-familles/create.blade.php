@extends('layouts.app')

@section('content')
    <h2>Ajouter une Sous-Famille</h2>
    <form action="{{ route('sous-familles.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="famille_id">Famille</label>
            <select name="famille_id" class="form-control" required>
                <option value="">-- Choisir une famille --</option>
                @foreach (\App\Models\Famille::all() as $famille)
                    <option value="{{ $famille->id }}">{{ $famille->libelle }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Libellé</label>
            <input type="text" name="libelle" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Image</label>
            <input type="file" name="image" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Enregistrer</button>
    </form>
@endsection