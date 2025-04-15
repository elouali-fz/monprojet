@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="page-title">Liste des Produits</h1>

    <a href="{{ route('produits.create') }}" class="btn btn-primary mb-4">Ajouter un Nouveau Produit</a>

    <div class="row">
        @foreach($produits as $product)
            <div class="col-md-4 mb-4">
                <div class="card">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                    @else
                        <img src="{{ asset('images/no-image.png') }}" class="card-img-top" alt="Image non disponible">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">Famille : {{ $product->family->name }}</p>
                        <p class="card-text">Marque : {{ $product->brand->name }}</p>
                        <p class="card-text">Unité : {{ $product->unit->name }}</p>
                        <a href="{{ route('produits.show', $product->id) }}" class="btn btn-info">Voir</a>
                        <a href="{{ route('produits.edit', $product->id) }}" class="btn btn-warning">Modifier</a>
                        <form action="{{ route('produits.destroy', $product->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
