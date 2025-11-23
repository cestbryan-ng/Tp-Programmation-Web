<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produit</title>
</head>
<body>
    <h1>Détails du produit</h1>
    <p>Nom : {{ $produit->nom }}</p>
    <p>Description : {{ $produit->description }}</p>
    <p>Prix : {{ $produit->prix }} €</p>
</body>
</html>
