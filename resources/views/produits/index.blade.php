<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Produits</title>
</head>
<body>
    <h1>Liste des Produits</h1>
    <ul>
        @foreach ($produits as $produit)
            <li>
                <a href="{{ route('produit.show', $produit->id) }}">{{ $produit->nom }}</a>
            </li>
        @endforeach
    </ul>
</body>
</html>
