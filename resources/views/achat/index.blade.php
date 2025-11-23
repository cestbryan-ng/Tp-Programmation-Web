@extends('layouts.app')
@section('title', 'Validation')

@section('content')
    <h1>Valider votre commande</h1>

    <div class="cart-items">
        @foreach($itemsPanier as $item)
            <div class="cart-item">
                <img src="{{ asset($item->produit->image) }}" alt="">
                <h3>{{ $item->produit->nom }}</h3>
                <p>Quantité: {{ $item->quantite }}</p>
                <p>Prix: {{ $item->produit->prix * $item->quantite }} FCFA</p>
            </div>
        @endforeach
    </div>

    <div class="cart-summary">
        <h3>Adresse de livraison</h3>
        <p>{{ $adresse }}</p>

        <h3>Total : {{ $total }} FCFA</h3>

        <form action="{{ route('checkout.store') }}" method="POST">
            @csrf
            <button type="submit" class="checkout-btn">Payer la commande</button>
        </form>
    </div>
@endsection
