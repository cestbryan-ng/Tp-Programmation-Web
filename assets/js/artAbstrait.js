const artworksDatabase = [
  {
    id: 1,
    artist: "Sophie Dubois",
    title: "Rêves Abstraits",
    details: "Estampe numérique • 60 × 80 cm",
    price: 285000,
    size: "60x80",
    color: "bleu",
    orientation: "portrait",
    style: "abstrait",
    image: "assets/images/IMG_3433.JPG",
    badge: "Best-seller"
  },
  {
    id: 2,
    artist: "Jean-Marc Laurent",
    title: "Horizon Urbain",
    details: "Sérigraphie • 50 × 70 cm",
    price: 195000,
    size: "50x70",
    color: "gris",
    orientation: "portrait",
    style: "urbain",
    image: "assets/images/IMG_3434.JPG",
    badge: null
  },
  {
    id: 3,
    artist: "Amina Kamara",
    title: "Océan Intérieur",
    details: "Lithographie • 70 × 90 cm",
    price: 425000,
    size: "70x90",
    color: "bleu",
    orientation: "portrait",
    style: "abstrait",
    image: "assets/images/IMG_3435.JPG",
    badge: "Nouveau"
  },
  {
    id: 4,
    artist: "Pierre Nkomo",
    title: "Lumière du Soir",
    details: "Estampe • 40 × 60 cm",
    price: 155000,
    size: "40x60",
    color: "orange",
    orientation: "portrait",
    style: "paysage",
    image: "assets/images/IMG_3436.JPG",
    badge: null
  },
  {
    id: 5,
    artist: "Claire Mbarga",
    title: "Nuit Étoilée",
    details: "Gravure • 55 × 75 cm",
    price: 320000,
    size: "55x75",
    color: "noir",
    orientation: "portrait",
    style: "abstrait",
    image: "assets/images/IMG_3437.JPG",
    badge: "Best-seller"
  },
  {
    id: 6,
    artist: "David Essono",
    title: "Douceur Matinale",
    details: "Estampe numérique • 45 × 65 cm",
    price: 175000,
    size: "45x65",
    color: "rose",
    orientation: "portrait",
    style: "paysage",
    image: "assets/images/IMG_3438.JPG",
    badge: null
  },
  {
    id: 7,
    artist: "Isabelle Fotso",
    title: "Printemps Éternel",
    details: "Sérigraphie • 60 × 80 cm",
    price: 265000,
    size: "60x80",
    color: "vert",
    orientation: "portrait",
    style: "nature",
    image: "assets/images/IMG_3439.JPG",
    badge: null
  },
  {
    id: 8,
    artist: "Thomas Onana",
    title: "Chaleur d'Automne",
    details: "Lithographie • 50 × 70 cm",
    price: 235000,
    size: "50x70",
    color: "orange",
    orientation: "portrait",
    style: "abstrait",
    image: "assets/images/IMG_3440.JPG",
    badge: "Best-seller"
  },
  {
    id: 9,
    artist: "Marie Ngono",
    title: "Ciel Serein",
    details: "Estampe • 70 × 90 cm",
    price: 385000,
    size: "70x90",
    color: "bleu",
    orientation: "portrait",
    style: "paysage",
    image: "assets/images/IMG_3441.JPG",
    badge: null
  },
  {
    id: 10,
    artist: "Léa Tchoumba",
    title: "Jardin Secret",
    details: "Estampe • 55 × 75 cm",
    price: 295000,
    size: "55x75",
    color: "vert",
    orientation: "portrait",
    style: "nature",
    image: "assets/images/IMG_3442.JPG",
    badge: null
  },
  {
    id: 11,
    artist: "Marc Atangana",
    title: "Expression Moderne",
    details: "Sérigraphie • 65 × 85 cm",
    price: 340000,
    size: "65x85",
    color: "magenta",
    orientation: "portrait",
    style: "moderne",
    image: "assets/images/IMG_3443.JPG",
    badge: "Nouveau"
  },
  {
    id: 12,
    artist: "Nadège Manga",
    title: "Fraîcheur Tropicale",
    details: "Lithographie • 50 × 70 cm",
    price: 215000,
    size: "50x70",
    color: "vert",
    orientation: "portrait",
    style: "nature",
    image: "assets/images/IMG_3444.JPG",
    badge: null
  },
  {
    id: 13,
    artist: "Paul Bekolo",
    title: "Harmonie Colorée",
    details: "Estampe • 60 × 80 cm",
    price: 275000,
    size: "60x80",
    color: "multicolore",
    orientation: "portrait",
    style: "abstrait",
    image: "assets/images/IMG_3445.JPG",
    badge: null
  }
];

// Sélection DOM
const artworksContainer = document.getElementById("artworks-container");
const filterStyle = document.getElementById("filter-style");
const filterColor = document.getElementById("filter-color");
const filterSize = document.getElementById("filter-size");
const filterPrice = document.getElementById("filter-price");
const priceValue = document.getElementById("price-value");
const resetButton = document.getElementById("reset-filters");

// Fonction d'affichage
function displayArtworks(artworks) {
  artworksContainer.innerHTML = "";

  if (artworks.length === 0) {
    artworksContainer.innerHTML = "<p class='no-results'>Aucune œuvre trouvée.</p>";
    return;
  }

  artworks.forEach((art) => {
    const card = document.createElement("div");
    card.classList.add("art-card");

    card.innerHTML = `
      <img src="${art.image}" alt="${art.title}" class="art-image">
      ${art.badge ? `<span class="badge">${art.badge}</span>` : ""}
      <div class="art-info">
        <h3>${art.title}</h3>
        <p class="artist">${art.artist}</p>
        <p class="details">${art.details}</p>
        <p class="price">${art.price.toLocaleString("fr-FR")} FCFA</p>
      </div>
    `;

    // Ajout d'un événement click pour chaque carte (optionnel)
    card.addEventListener('click', () => {
      console.log('Œuvre sélectionnée:', art.title);
      // Vous pouvez ajouter ici une navigation vers une page détail
    });

    artworksContainer.appendChild(card);
  });
}

// Fonction de filtrage
function filterArtworks() {
  const selectedStyle = filterStyle.value;
  const selectedColor = filterColor.value;
  const selectedSize = filterSize.value;
  const maxPrice = parseInt(filterPrice.value);

  const filtered = artworksDatabase.filter((art) => {
    const styleMatch = selectedStyle === "all" || art.style === selectedStyle;
    const colorMatch = selectedColor === "all" || art.color === selectedColor;
    const sizeMatch = selectedSize === "all" || art.size === selectedSize;
    const priceMatch = art.price <= maxPrice;
    
    return styleMatch && colorMatch && sizeMatch && priceMatch;
  });

  displayArtworks(filtered);
}

// Mise à jour de l'affichage du prix
function updatePriceDisplay() {
  const price = parseInt(filterPrice.value);
  priceValue.textContent = `${(price / 1000).toLocaleString("fr-FR")} 000 FCFA`;
}

// Fonction de réinitialisation des filtres
function resetFilters() {
  filterStyle.value = "all";
  filterColor.value = "all";
  filterSize.value = "all";
  filterPrice.value = "500000";
  updatePriceDisplay();
  displayArtworks(artworksDatabase);
}

// Événements
filterStyle.addEventListener("change", filterArtworks);
filterColor.addEventListener("change", filterArtworks);
filterSize.addEventListener("change", filterArtworks);
filterPrice.addEventListener("input", () => {
  updatePriceDisplay();
  filterArtworks();
});
resetButton.addEventListener("click", resetFilters);

// Affichage initial
updatePriceDisplay();
displayArtworks(artworksDatabase);