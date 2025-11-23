@extends('layouts.app')
@section('title', 'Mes Commandes')

@section('content')
    <h1>Mes Commandes</h1>

    @foreach($commandes as $commande)
        <div class="commande-card">
            <h2>Commande #{{ $commande->id }}</h2>
            <p>Passée le: {{ $commande->created_at->format('d/m/Y') }}</p>
            <p>Total: {{ $commande->total }} FCFA</p>

            <h4>Détails :</h4>
            @foreach($commande->details as $detail)
                <p>
                    {{ $detail->produit->nom }}
                    (x {{ $detail->quantite }})
                </p>
            @endforeach
        </div>
    @endforeach
@endsection
