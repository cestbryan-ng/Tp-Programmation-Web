@extends('layouts.app') @section('title', $produit->nom)

@section('content')
    <div class="product-wrapper">
        <div class="product-info">
            <h1 class="product-title">{{ $produit->nom }}</h1>

            <div class="product-price">
                {{ $produit->prix }} FCFA
            </div>

            <form action="{{ route('panier.add') }}" method="POST">
                @csrf
                <input type="hidden" name="produit_id" value="{{ $produit->id }}">
                <button type="submit" class="btn-primary">Ajouter au panier</button>
            </form>
        </div>
    </div>
@endsection
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/product.css') }}">
@endsection
