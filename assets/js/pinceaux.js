// Déclaration d'un tableau constant (const) nommé 'accessoires'
const accessoires = [
    {
        id: 1,
        nom: "Pointe Ronde N°4",
        description: "Fibre synthétique, idéal pour les détails fins et l'aquarelle.",
        prix: 2500,
        image: "assets/images/09effbaa086a00978ab4a93b745d67b8.jpg"
    },
    {
        id: 2,
        nom: "Plat Carré N°10",
        description: "Soies synthétiques rigides, parfait pour les aplats et l'acrylique.",
        prix: 3200,
        image: "assets/images/0917b9ffee0f07d58f2a63ee77a7b26c.jpg"
    },
    {
        id: 3,
        nom: "Langue de Chat N°8",
        description: "Idéal pour les bords doux, les dégradés et le travail en épaisseur (huile/acrylique).",
        prix: 4500,
        image: "assets/images/1cf933e6ad16b2356851a6843e26f0a9.jpg"
    },
    {
        id: 4,
        nom: "Set Calligraphie Chine (5pcs)",
        description: "Pinceaux en poils de chèvre/loup pour encre et Sumi-e, pointe très fine.",
        prix: 12000,
        image: "assets/images/219acf043cadd3b510ecf34982cc469d.jpg"
    },
    {
        id: 5,
        nom: "Éventail N°6",
        description: "Permet des effets de texture, d'herbe, ou d'adoucir des contours sur huile et acrylique.",
        prix: 2900,
        image: "assets/images/36000cccedf589f2791101b6b27da0f7.jpg"
    },
    {
        id: 6,
        nom: "Spalter Synthétique (50mm)",
        description: "Grande brosse plate pour lavis larges, fonds et gesso sur toile.",
        prix: 5800,
        image: "assets/images/36ad309418f4dfe259fad34df15f5c97.jpg"
    },
    {
        id: 7,
        nom: "Traceur/Liner N°0",
        description: "Poils extra longs pour des lignes très fines, fluides et de la calligraphie.",
        prix: 2100,
        image: "assets/images/380cda2546b07825eec13bc58347f3f5.jpg"
    },
    {
        id: 8,
        nom: "Lavis Petit-Gris N°6",
        description: "Poils très absorbants, idéal pour les grands lavis et mouiller le papier aquarelle.",
        prix: 6500,
        image: "assets/images/3daa56639249c1649bc88f0b5c26a08e.jpg"
    },
    {
        id: 9,
        nom: "Biseauté N°12",
        description: "Permet de tracer des lignes nettes et de couvrir de petites surfaces.",
        prix: 3500,
        image: "assets/images/40b6461c0d9357316754d8778cc2e8f6.jpg"
    },
    {
        id: 10,
        nom: "Biseauté Précision N°2",
        description: "Pointe précise pour les petits détails et les lignes dures en acrylique/huile.",
        prix: 2400,
        image: "assets/images/42e200b4d2e62f6089661a96c47f1652.jpg"
    },
    {
        id: 11,
        nom: "Ronde Martre Kolinsky N°6",
        description: "Haut de gamme, élasticité et rétention d'eau maximales pour aquarelle et détails.",
        prix: 15000,
        image: "assets/images/4d18920f3e5c5932c641047b35d5791b.jpg"
    },
    {
        id: 12,
        nom: "Usé Bombé N°14",
        description: "Pour estomper les bords, fondre les couleurs et créer des effets de feuilles (huile/acrylique).",
        prix: 4100,
        image: "assets/images/73ab2677e804c696ed8b854f98edd14c.jpg"
    },
    {
        id: 13,
        nom: "Ronde Aquarelle N°16",
        description: "Pointe fine sur brosse large, excellent pour les lavis et les détails en aquarelle.",
        prix: 7500,
        image: "assets/images/74f66bdbea5d8eb2d4aab978e3ef6d17.jpg"
    },
    {
        id: 14,
        nom: "Éventail N°4",
        description: "Pour la création de textures légères, le lissage et les effets spéciaux.",
        prix: 2700,
        image: "assets/images/9bf2fab0bf79734b85b74541e7b4740c.jpg"
    },
    {
        id: 15,
        nom: "Plat Carré N°6",
        description: "Pour les surfaces moyennes, les lignes épaisses et le travail à l'acrylique.",
        prix: 2500,
        image: "assets/images/9d6c285a79664b26998f795f9f58e56a.jpg"
    },
    {
        id: 16,
        nom: "Retouche N°00",
        description: "Pinceau à poils très courts pour les points, les retouches et le micro-détail.",
        prix: 1900,
        image: "assets/images/9e996efeabf5124c21d5c206ba441308.jpg"
    },
    {
        id: 17,
        nom: "Brosse Plate N°20",
        description: "Pour les grands aplats de couleur à l'huile ou à l'acrylique.",
        prix: 5100,
        image: "assets/images/ab2f6aa16509ecd059bea2d6d873b1a7.jpg"
    },
    {
        id: 18,
        nom: "Trousse de l'Artiste",
        description: "Inspiration : le pinceau dans l'action de la création.",
        prix: 0, // Prix à zéro pour gérer "Sur Demande" dans le JS
        prixDisplay: "Sur Demande", // Ajout d'une propriété pour l'affichage spécial
        image: "assets/images/abby-tait-mwLRxFKPNPg-unsplash.jpg"
    },
    {
        id: 19,
        nom: "Atelier Créatif",
        description: "Set de gouache et pinceaux variés pour débutants et artistes.",
        prix: 18000,
        image: "assets/images/alireza-valizadeh-o6WViBEzOWU-unsplash.jpg"
    },
    {
        id: 20,
        nom: "Pinceau pour Encre de Chine",
        description: "Brosse en poils naturels pour la calligraphie et le dessin à l'encre.",
        prix: 4800,
        image: "assets/images/amoon-ra-e3LTikv7Uug-unsplash.jpg"
    },
    {
        id: 21,
        nom: "Papier Aquarelle Épais",
        description: "Support de haute qualité 300g/m² pour des effets mouillés parfaits.",
        prix: 4000,
        prixDisplay: "4 000 FCFA (Feuille A3)",
        image: "assets/images/andrew-d-dyBQ8b3JJ_g-unsplash.jpg"
    },
    {
        id: 22,
        nom: "Palette d'Aquarelle Semi-Sèche",
        description: "12 couleurs vives et un pinceau à réservoir pour la peinture nomade.",
        prix: 9500,
        image: "assets/images/anna-daudelin-GwrW3qCrpZY-unsplash.jpg"
    },
    {
        id: 23,
        nom: "Set de Démarrage Aquarelle",
        description: "Comprend pinceaux, godets de peinture et papier pour débuter.",
        prix: 15000,
        image: "assets/images/anna-evans-W69XtU15eRM-unsplash.jpg"
    },
    {
        id: 24,
        nom: "Set Huile / Acrylique PRO",
        description: "Assortiment de pinceaux rigides et souples pour textures et mélanges.",
        prix: 25000,
        image: "assets/images/anna-ozola-BDNLe0vj1Xo-unsplash.jpg"
    },
    {
        id: 25,
        nom: "Kit Peinture Plein Air",
        description: "Inspiration : Pinceaux, toile et pigments pour les paysages en extérieur.",
        prix: 0,
        prixDisplay: "Non Disponible à la Vente",
        image: "assets/images/annie-spratt-b_pSSMpQgLI-unsplash.jpg"
    },
    {
        id: 26,
        nom: "Ronde Synthétique PRO",
        description: "Fibre de haute qualité pour toutes les techniques, excellente résilience.",
        prix: 4900,
        image: "assets/images/cb101683710fe685891175f1242fdb60.jpg"
    },
    {
        id: 27,
        nom: "Spalter pour Lavis (Large)",
        description: "Brosse large et plate pour l'application uniforme des fonds et des vernis.",
        prix: 7200,
        image: "assets/images/colin-redwood-85QWDfLhJAE-unsplash.jpg"
    },
    {
        id: 28,
        nom: "Brosse Plate N°16",
        description: "Manche court, poils rigides pour les empâtements à l'huile ou à l'acrylique.",
        prix: 3900,
        image: "assets/images/crystal-de-passille-chabot-TTwwVG4Isjw-unsplash.jpg"
    },
    {
        id: 29,
        nom: "Ronde Précision N°0",
        description: "Pinceau très fin pour les micro-détails, les signatures et les cils.",
        prix: 2300,
        image: "assets/images/d739aa0b2407be55316d2bf722e40d9f.jpg"
    },
    {
        id: 30,
        nom: "Kit Pinceaux Polyvalents (10pcs)",
        description: "Assortiment de formes et tailles pour huile, acrylique et aquarelle.",
        prix: 19900,
        image: "assets/images/dcc66868b5b836b1325f89b98ed27281.jpg"
    },
    {
        id: 31,
        nom: "Pinceau de Calligraphie Fine",
        description: "Pointe souple pour le lettrage au pinceau et les déliés élégants.",
        prix: 3800,
        image: "assets/images/debby-hudson-GkZoz3gVG8c-unsplash.jpg"
    },
    {
        id: 32,
        nom: "Brosse Plate N°24 (Manche Long)",
        description: "Idéal pour les fonds de toile, les grands aplats et l'application du gesso.",
        prix: 6100,
        image: "assets/images/e5eafd0998133b4afb7eaf7927e097cb.jpg"
    },
    {
        id: 33,
        nom: "Médium Acrylique Liquide",
        description: "Fluidifie la peinture et prolonge le temps de travail pour les dégradés.",
        prix: 6500,
        prixDisplay: "6 500 FCFA (250ml)",
        image: "assets/images/edz-norton-weS5yN6P3vE-unsplash.jpg"
    },
    {
        id: 34,
        nom: "Palette à Pouce en Bois",
        description: "Légère et ergonomique, pour le mélange des couleurs huile et acrylique.",
        prix: 4200,
        image: "assets/images/emma-theron-KkkpIt_-7OM-unsplash.jpg"
    },
    {
        id: 35,
        nom: "Set de Pinceaux Ronds (3pcs)",
        description: "Tailles N°2, N°6, N°12, essentiels pour le détail et le remplissage.",
        prix: 6900,
        image: "assets/images/erfan-amiri-2YDsH_hRGWg-unsplash.jpg"
    },
    {
        id: 36,
        nom: "Plat Usé N°10",
        description: "Poils rigides pour les effets de texture et la pose d'empâtements.",
        prix: 3400,
        image: "assets/images/f615dff5e1e454196b8a3d04b11e774b.jpg"
    },
    {
        id: 37,
        nom: "Pinceau Maître (Martre)",
        description: "Pinceau premium pour l'aquarelle et l'huile, excellent contrôle du médium.",
        prix: 11500,
        image: "assets/images/hairapetyann-G8lgGfRh0Uc-unsplash.jpg"
    },
    {
        id: 38,
        nom: "Pinceau Réservoir d'Eau",
        description: "Parfait pour l'aquarelle et le croquis à l'encre en déplacement.",
        prix: 4500,
        image: "assets/images/jennie-razumnaya-euZfWU_nbO8-unsplash.jpg"
    },
    {
        id: 39,
        nom: "Bloc d'Encre de Chine Solide",
        description: "Encre noire traditionnelle pour la calligraphie et le lavis.",
        prix: 5000,
        image: "assets/images/jingyu-liu-RhPM8AE51f8-unsplash.jpg"
    },
    {
        id: 40,
        nom: "Kit Collage et Mixte",
        description: "Outils essentiels pour le collage, l'assemblage et les techniques mixtes.",
        prix: 10500,
        image: "assets/images/jon-tyson-rhaM4-nzhp4-unsplash.jpg"
    },
    {
        id: 41,
        nom: "Pinceau Naturel N°8 (Sable)",
        description: "Fibre douce, excellente rétention pour les pigments en poudre et les glacis.",
        prix: 6800,
        image: "assets/images/karen-bullaro-i4ciDEuzE8M-unsplash.jpg"
    }
];


document.addEventListener('DOMContentLoaded', () => {
    // La variable 'accessoires' est disponible ici (grâce à pinceaux.js).
    
    const galleryContainer = document.querySelector('.gallery'); 
    const filterNameInput = document.getElementById('filterName');
    const maxPriceInput = document.getElementById('maxPrice');
    const applyFilterButton = document.getElementById('applyFilter');
    const resetFilterButton = document.getElementById('resetFilter');

    // ... (Fonction formaterPrix, creerCarteHTML, non répétées ici) ...
    const formaterPrix = (prix) => {
        return prix.toLocaleString('fr-FR', {
            style: 'currency',
            currency: 'XOF', // Franc CFA
            minimumFractionDigits: 0
        }).replace('XOF', 'FCFA'); 
    };

    const creerCarteHTML = (produit) => {
        const prixAffichage = produit.prixDisplay 
            ? produit.prixDisplay 
            : formaterPrix(produit.prix);
        const dataPrice = produit.prix > 0 ? produit.prix : 999999999; 

        return `
            <div class="artwork-card" data-id="${produit.id}" data-price="${dataPrice}" data-category="pinceau">
                <div class="artwork-image">
                    <img src="${produit.image}" alt="${produit.nom}">
                </div>
                <div class="artwork-info">
                    <div class="artist-name">${produit.nom}</div>
                    <div class="artwork-title">${produit.description}</div>
                    <div class="price">${prixAffichage}</div>
                </div>
            </div>
        `;
    };

    /** Affiche les produits en générant le HTML. */
    const afficherGalerie = (data) => {
        const galleryHTML = data.map(creerCarteHTML).join(''); 
        galleryContainer.innerHTML = galleryHTML;
    };
    
    // --- 1. AFFICHAGE INITIAL ---
    afficherGalerie(accessoires);


    // --- 2. LOGIQUE DE FILTRAGE ---
    const appliquerFiltres = () => {
        const nomFiltre = filterNameInput.value.toLowerCase().trim();
        const prixMax = parseFloat(maxPriceInput.value); 

        const produitsFiltres = accessoires.filter(produit => {
            const nomProduit = produit.nom.toLowerCase();
            const prixProduit = produit.prix;
            
            let correspond = true;

            if (nomFiltre && !nomProduit.includes(nomFiltre)) {
                correspond = false;
            }

            if (!isNaN(prixMax) && prixProduit > prixMax && prixProduit > 0) {
                correspond = false;
            }

            return correspond;
        });

        // Ré-afficher la galerie avec les produits filtrés
        afficherGalerie(produitsFiltres);
    };

    const reinitialiserFiltres = () => {
        filterNameInput.value = '';
        maxPriceInput.value = '';
        afficherGalerie(accessoires); // Afficher le tableau complet
    };

    // Attacher les écouteurs d'événements
    applyFilterButton.addEventListener('click', appliquerFiltres);
    resetFilterButton.addEventListener('click', reinitialiserFiltres);
    filterNameInput.addEventListener('input', appliquerFiltres); // Filtre en temps réel
});