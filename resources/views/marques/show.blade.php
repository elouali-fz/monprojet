@extends('layouts.app') <!-- Supposant que vous utilisez un layout de base -->

@section('content')
<div class="container py-5">
    <h1 class="mb-4">Produits de la marque: {{ $marque->marque }}</h1>
    
    @if($produits->count() > 0)
        <div class="row">
            @foreach($produits as $produit)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <!-- Image du produit -->
                        <img src="{{ asset('storage/'.$produit->image) }}" class="card-img-top" alt="{{ $produit->nom }}">
                        
                        <div class="card-body">
                            <h5 class="card-title">{{ $produit->nom }}</h5>
                            <p class="card-text">{{ $produit->description }}</p>
                            <p class="text-primary fw-bold">{{ number_format($produit->prix, 2) }} €</p>
                        </div>
                        
                        <div class="card-footer bg-white">
                            <a href="{{ route('produits.show', $produit->id) }}" class="btn btn-primary">Voir détails</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info">
            Aucun produit disponible pour cette marque pour le moment.
        </div>
    @endif
</div>
@endsection