@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="page-title">Ajouter un Nouveau Produit</h1>

    <form action="{{ route('produits.store') }}" method="POST" enctype="multipart/form-data" class="product-form">
        @csrf

        <!-- Champ pour le nom du produit -->
        <div class="form-group">
            <label for="name">Nom du produit</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Nom du produit" required>
        </div>

        <!-- Sélection de la famille -->
        <div class="form-group">
            <label for="family">Famille</label>
            <select name="family_id" id="family" class="form-control" required>
                @foreach(\App\Models\Famille::all() as $family)
                    <option value="{{ $family->id }}">{{ $family->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Sélection de la marque -->
        <div class="form-group">
            <label for="brand">Marque</label>
            <select name="brand_id" id="brand" class="form-control" required>
                @foreach($brands as $brand)
                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Sélection de l'unité -->
        <div class="form-group">
            <label for="unit">Unité</label>
            <select name="unit_id" id="unit" class="form-control" required>
                @foreach($units as $unit)
                    <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Champ pour l'image -->
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" name="image" id="image" class="form-control" accept="image/*">
        </div>

        <!-- Bouton de soumission -->
        <button type="submit" class="btn btn-primary">Ajouter le produit</button>
    </form>
</div>
@endsection
