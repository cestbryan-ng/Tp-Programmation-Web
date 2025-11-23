<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panier</title>
</head>
<body>
    <h1>Votre Panier</h1>
    @if ($panier && $panier->details->count() > 0)
        <ul>
            @foreach ($panier->details as $detail)
                <li>{{ $detail->produit->nom }} - Quantité : {{ $detail->quantite }}</li>
            @endforeach
        </ul>
    @else
        <p>Votre panier est vide.</p>
    @endif
</body>
</html>
