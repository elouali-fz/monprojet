@extends('layouts.app')

@section('content')
    <h2>Ajouter une Famille</h2>
    <form action="{{ route('familles.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
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