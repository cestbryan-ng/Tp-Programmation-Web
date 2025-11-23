@extends('layouts.app')

@section('title', $produit->nom)

@section('styles')
    @endsection

@section('content')
    <div class="product-wrapper">
        <div class="product-container">

            <div class="product-gallery">
                <div class="main-image-container">
                    <div class="main-image">
                        <img id="product-image" src="{{ asset($produit->image) }}" alt="{{ $produit->nom }}">
                    </div>
                </div>
                </div>

            <div class="product-info">
                <a href="#" id="product-artist" class="artist-link">{{ $produit->artiste }}</a>
                <h1 id="product-title" class="product-title">{{ $produit->nom }}</h1>
                <p id="product-subtitle" class="product-subtitle">{{ $produit->technique }}</p>

                <div class="product-price">
                    <span id="product-price">{{ number_format($produit->prix, 0, ',', ' ') }} FCFA</span>
                    <div class="price-info">TVA incluse • Livraison gratuite</div>
                </div>

                <div class="specs-grid">
                    <div class="spec-item">
                        <span class="spec-label">Dimensions</span>
                        <span id="product-dimensions" class="spec-value">{{ $produit->dimensions }}</span>
                    </div>
                    </div>

                <form action="{{ route('panier.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="produit_id" value="{{ $produit->id }}">
                    <div class="action-buttons">
                        <button type="submit" class="btn-primary">Ajouter au panier</button>
                    </div>
                </form>

                <div class="description-section">
                    <h3>Description de l'œuvre</h3>
                    <p id="product-description">{{ $produit->description }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @endsection
