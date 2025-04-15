@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="page-title">Modifier le Produit</h1>

    <form action="{{ route('produits.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="product-form">
        @csrf
        @method('PUT')

        <!-- Champ pour le nom du produit -->
        <div class="form-group">
            <label for="name">Nom du produit</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $product->name }}" required>
        </div>

        <!-- Sélection de la famille -->
        <div class="form-group">
            <label for="family">Famille</label>
            <select name="family_id" id="family" class="form-control" required>
                @foreach($families as $family)
                    <option value="{{ $family->id }}" {{ $product->family_id == $family->id ? 'selected' : '' }}>
                        {{ $family->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Sélection de la marque -->
        <div class="form-group">
            <label for="brand">Marque</label>
            <select name="brand_id" id="brand" class="form-control" required>
                @foreach($brands as $brand)
                    <option value="{{ $brand->id }}" {{ $product->brand_id == $brand->id ? 'selected' : '' }}>
                        {{ $brand->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Sélection de l'unité -->
        <div class="form-group">
            <label for="unit">Unité</label>
            <select name="unit_id" id="unit" class="form-control" required>
                @foreach($units as $unit)
                    <option value="{{ $unit->id }}" {{ $product->unit_id == $unit->id ? 'selected' : '' }}>
                        {{ $unit->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Champ pour l'image -->
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" name="image" id="image" class="form-control" accept="image/*">
            @if ($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid mt-2">
            @endif
        </div>

        <!-- Bouton de soumission -->
        <button type="submit" class="btn btn-warning">Mettre à jour le produit</button>
    </form>
</div>
@endsection
