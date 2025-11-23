@extends('layouts.app')

@section('title', 'Artika - Accueil')


@section('content')
    <section class="hero">
        <div class="hero-image" style="background-image: url('{{ asset('ressources\images\accueil\hero.jpg') }}');"></div>
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h1 class="hero-title">ARTIKA</h1>
            <p class="hero-subtitle">Là où l'art prend vie</p>
            <a href="#collections" class="btn-primary">Découvrir nos collections</a>
        </div>
    </section>

    <section class="collections" id="collections">
        <div class="container">
            <h2 class="section-title">Nos Collections</h2>

            <div class="collections-grid">

                <div class="collection-card">
                    <div class="collection-image">
                        <img src="{{ asset('resources\images\accueil\peintures.jpg') }}" alt="Peintures">
                        <div class="collection-overlay">
                            <a href="#" class="collection-link">Explorer</a>
                        </div>
                    </div>
                    <div class="collection-info">
                        <h3 class="collection-title">Peintures</h3>
                        <p class="collection-desc">Découvrez des œuvres uniques qui célèbrent la créativité et l'expression artistique.</p>
                    </div>
                </div>

                <div class="collection-card">
                    <div class="collection-image">
                        <img src="{{ asset('resources\images\accueil\materiel.jpg') }}" alt="Accessoires">
                        <div class="collection-overlay">
                            <a href="#" class="collection-link">Explorer</a>
                        </div>
                    </div>
                    <div class="collection-info">
                        <h3 class="collection-title">Accessoires</h3>
                        <p class="collection-desc">Tout le matériel nécessaire pour donner vie à vos créations artistiques.</p>
                    </div>
                </div>

                <div class="collection-card">
                    <div class="collection-image">
                        <img src="{{ asset('resources/images/accueil/sculptures.jpg') }}" alt="Dessins de beaux arts">
                        <div class="collection-overlay">
                            <a href="#" class="collection-link">Explorer</a>
                        </div>
                    </div>
                    <div class="collection-info">
                        <h3 class="collection-title">Dessins de beaux arts</h3>
                        <p class="collection-desc">L'art du dessin dans toute sa splendeur, du portrait à l'aquarelle.</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="featured-products">
        <div class="container">
            <h2 class="section-title">Œuvres Vedettes</h2>

            <div class="products-grid">

                <div class="product-card">
                    <div class="product-image">
                        <img src="{{ asset('resources\images\accueil\hero.jpg') }}" alt="Harmonie">
                        <span class="product-badge">Nouveau</span>
                    </div>
                    <div class="product-info">
                        <h4 class="product-name">Harmonie</h4>
                        <p class="product-artist">Par Marie Dubois</p>
                        <p class="product-price">45 000 FCFA</p>
                        <button class="btn-add-cart">Ajouter au panier</button>
                    </div>
                </div>

                <div class="product-card">
                    <div class="product-image">
                        <img src="{{ asset('resources\images\accueil\sculptures.jpg') }}" alt="Rythmes">
                    </div>
                    <div class="product-info">
                        <h4 class="product-name">Rythmes</h4>
                        <p class="product-artist">Par Jean Kouassi</p>
                        <p class="product-price">62 000 FCFA</p>
                        <button class="btn-add-cart">Ajouter au panier</button>
                    </div>
                </div>

                <div class="product-card">
                    <div class="product-image">
                        <img src="{{ asset('resources\images\accueil\product1.jpg') }}" alt="Essence">
                        <span class="product-badge badge-promo">-20%</span>
                    </div>
                    <div class="product-info">
                        <h4 class="product-name">Essence</h4>
                        <p class="product-artist">Par Sophie Martin</p>
                        <p class="product-price">38 000 FCFA</p>
                        <button class="btn-add-cart">Ajouter au panier</button>
                    </div>
                </div>

                <div class="product-card">
                    <div class="product-image">
                        <img src="{{ asset('resources\images\accueil\peintures.jpg') }}" alt="Lumière">
                    </div>
                    <div class="product-info">
                        <h4 class="product-name">Lumière</h4>
                        <p class="product-artist">Par Paul Ngoma</p>
                        <p class="product-price">55 000 FCFA</p>
                        <button class="btn-add-cart">Ajouter au panier</button>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="testimonials-section">
        <div class="container">

            <h2 class="section-title">Ce que disent nos clients</h2>

            <div class="testimonials-carousel">
                <div class="testimonial-track">

                    <div class="testimonial-card">
                        <div class="testimonial-avatar">
                            <img src="{{ asset('resources\images\accueil\hero.jpg') }}" alt="Client">
                        </div>
                        <p class="testimonial-text">"Une plateforme exceptionnelle ! J'ai trouvé des œuvres magnifiques pour décorer mon salon. La qualité est au rendez-vous."</p>
                        <p class="testimonial-author">— Naomi TSAGUE</p>
                        <div class="testimonial-stars">★★★★★</div>
                    </div>

                    <div class="testimonial-card">
                        <div class="testimonial-avatar">
                            <img src="{{ asset('resources\images\accueil\hero.jpg') }}" alt="Client">
                        </div>
                        <p class="testimonial-text">"Artika m'a permis de découvrir des artistes incroyables. Le service client est impeccable et la livraison rapide."</p>
                        <p class="testimonial-author">— Felix TANZI</p>
                        <div class="testimonial-stars">★★★★★</div>
                    </div>

                </div>
            </div>

            <div class="testimonial-form-section">
                <h3 class="form-title">Partagez votre expérience</h3>
                <form class="testimonial-form">
                    <div class="form-row">
                        <div class="form-group">
                            <input type="text" placeholder="Votre nom" class="form-input" required>
                        </div>
                        <div class="form-group">
                            <input type="email" placeholder="Votre email" class="form-input" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <textarea placeholder="Votre commentaire..." class="form-textarea" rows="5" required></textarea>
                    </div>
                    <div class="form-group">
                        <label class="rating-label">Votre note :</label>
                        <div class="star-rating">
                            <input type="radio" name="rating" value="5" id="star5"><label for="star5">★</label>
                            <input type="radio" name="rating" value="4" id="star4"><label for="star4">★</label>
                            <input type="radio" name="rating" value="3" id="star3"><label for="star3">★</label>
                            <input type="radio" name="rating" value="2" id="star2"><label for="star2">★</label>
                            <input type="radio" name="rating" value="1" id="star1"><label for="star1">★</label>
                        </div>
                    </div>
                    <button type="submit" class="btn-submit">Envoyer mon avis</button>
                </form>
            </div>

        </div>
    </section>
@endsection
