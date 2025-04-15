@extends('layouts.app')

@section('content')
    <h2>Modifier la Famille</h2>
    <form action="{{ route('familles.update', $famille->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Libellé</label>
            <input type="text" name="libelle" class="form-control" value="{{ $famille->libelle }}" required>
        </div>
        <div class="mb-3">
            <label>Image Actuelle</label><br>
            <img src="{{ asset('storage/' . $famille->image) }}" width="100"><br><br>
            <input type="file" name="image" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Modifier</button>
    </form>
@endsection