<?php
/**
 * Template Name: Page d'accueil Artika
 * Description: Page d'accueil avec hero, collections, produits vedettes et témoignages
 */

get_header();
?>

<!-- HERO SECTION -->
<section class="hero">
    <div class="hero-image" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/accueil/hero.jpg');"></div>
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <h1 class="hero-title">ARTIKA</h1>
        <p class="hero-subtitle">Là où l'art prend vie</p>
        <a href="#collections" class="btn-primary">Découvrir nos collections</a>
    </div>
</section>

<!-- SECTION COLLECTIONS -->
<section class="collections" id="collections">
    <div class="container">
        <h2 class="section-title">Nos Collections</h2>
        
        <div class="collections-grid">
            
            <div class="collection-card">
                <div class="collection-image">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/accueil/peintures.jpg" alt="Peintures">
                    <div class="collection-overlay">
                        <?php 
                        // Lien vers la catégorie Peintures
                        $peintures_cat = get_term_by('slug', 'peintures', 'product_cat');
                        $peintures_link = $peintures_cat ? get_term_link($peintures_cat) : home_url('/categorie-produit/peintures/');
                        ?>
                        <a href="<?php echo esc_url($peintures_link); ?>" class="collection-link">Explorer</a>
                    </div>
                </div>
                <div class="collection-info">
                    <h3 class="collection-title">Peintures</h3>
                    <p class="collection-desc">Découvrez des œuvres uniques qui célèbrent la créativité et l'expression artistique.</p>
                </div>
            </div>
            
            <div class="collection-card">
                <div class="collection-image">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/accueil/blanc.jpg" alt="Accessoires">
                    <div class="collection-overlay">
                        <?php 
                        // Lien vers la catégorie Accessoires
                        $accessoires_cat = get_term_by('slug', 'accessoires', 'product_cat');
                        $accessoires_link = $accessoires_cat ? get_term_link($accessoires_cat) : home_url('/categorie-produit/accessoires/');
                        ?>
                        <a href="<?php echo esc_url($accessoires_link); ?>" class="collection-link">Explorer</a>
                    </div>
                </div>
                <div class="collection-info">
                    <h3 class="collection-title">Accessoires</h3>
                    <p class="collection-desc">Tout le matériel nécessaire pour donner vie à vos créations artistiques.</p>
                </div>
            </div>
            
            <div class="collection-card">
                <div class="collection-image">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/accueil/femme_tatoue1.jpeg" alt="Dessins de beaux arts">
                    <div class="collection-overlay">
                        <?php 
                        // Lien vers la catégorie Dessins
                        $dessins_cat = get_term_by('slug', 'dessins', 'product_cat');
                        $dessins_link = $dessins_cat ? get_term_link($dessins_cat) : home_url('/categorie-produit/dessins/');
                        ?>
                        <a href="<?php echo esc_url($dessins_link); ?>" class="collection-link">Explorer</a>
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

<!-- SECTION ŒUVRES VEDETTES -->
<section class="featured-products">
    <div class="container">
        <h2 class="section-title">Œuvres Vedettes</h2>
        
        <div class="products-grid">
            
            <?php
            // Récupérer les produits vedettes (featured products)
            $args = array(
                'post_type' => 'product',
                'posts_per_page' => 4,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'product_visibility',
                        'field' => 'name',
                        'terms' => 'featured',
                    ),
                ),
            );
            
            $featured_query = new WP_Query($args);
            
            if ($featured_query->have_posts()) :
                while ($featured_query->have_posts()) : $featured_query->the_post();
                    global $product;
            ?>
            
            <div class="product-card">
                <div class="product-image">
                    <a href="<?php the_permalink(); ?>">
                        <?php 
                        if (has_post_thumbnail()) {
                            the_post_thumbnail('woocommerce_thumbnail');
                        } else {
                            echo '<img src="' . wc_placeholder_img_src() . '" alt="' . get_the_title() . '">';
                        }
                        ?>
                    </a>
                    <?php if ($product->is_on_sale()) : ?>
                        <span class="product-badge badge-promo">-<?php echo round((($product->get_regular_price() - $product->get_sale_price()) / $product->get_regular_price()) * 100); ?>%</span>
                    <?php elseif ($product->is_featured()) : ?>
                        <span class="product-badge">Nouveau</span>
                    <?php endif; ?>
                </div>
                <div class="product-info">
                    <h4 class="product-name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                    <p class="product-artist">
                        <?php 
                        // Récupérer l'artiste (champ personnalisé)
                        $artist = get_post_meta(get_the_ID(), '_artist_name', true);
                        echo $artist ? 'Par ' . esc_html($artist) : '';
                        ?>
                    </p>
                    <p class="product-price"><?php echo $product->get_price_html(); ?></p>
                    <button class="btn-add-cart" data-product-id="<?php echo $product->get_id(); ?>">Ajouter au panier</button>
                </div>
            </div>
            
            <?php
                endwhile;
                wp_reset_postdata();
            else :
                // Produits par défaut si aucun produit vedette
                $args = array(
                    'post_type' => 'product',
                    'posts_per_page' => 4,
                );
                $default_query = new WP_Query($args);
                
                if ($default_query->have_posts()) :
                    while ($default_query->have_posts()) : $default_query->the_post();
                        global $product;
            ?>
            
            <div class="product-card">
                <div class="product-image">
                    <a href="<?php the_permalink(); ?>">
                        <?php 
                        if (has_post_thumbnail()) {
                            the_post_thumbnail('woocommerce_thumbnail');
                        }
                        ?>
                    </a>
                </div>
                <div class="product-info">
                    <h4 class="product-name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                    <p class="product-artist">
                        <?php 
                        $artist = get_post_meta(get_the_ID(), '_artist_name', true);
                        echo $artist ? 'Par ' . esc_html($artist) : '';
                        ?>
                    </p>
                    <p class="product-price"><?php echo $product->get_price_html(); ?></p>
                    <button class="btn-add-cart" data-product-id="<?php echo $product->get_id(); ?>">Ajouter au panier</button>
                </div>
            </div>
            
            <?php
                    endwhile;
                    wp_reset_postdata();
                endif;
            endif;
            ?>
            
        </div>
    </div>
</section>

<!-- SECTION TÉMOIGNAGES + FORMULAIRE -->
<section class="testimonials-section">
    <div class="container">
        
        <h2 class="section-title">Ce que disent nos clients</h2>
        
        <div class="testimonials-carousel">
            <div class="testimonial-track">
                
                <div class="testimonial-card">
                    <div class="testimonial-avatar">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/accueil/hero.jpg" alt="Client">
                    </div>
                    <p class="testimonial-text">"Une plateforme exceptionnelle ! J'ai trouvé des œuvres magnifiques pour décorer mon salon. La qualité est au rendez-vous."</p>
                    <p class="testimonial-author">— Naomi TSAGUE</p>
                    <div class="testimonial-stars">★★★★★</div>
                </div>
                
                <div class="testimonial-card">
                    <div class="testimonial-avatar">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/accueil/hero.jpg" alt="Client">
                    </div>
                    <p class="testimonial-text">"Artika m'a permis de découvrir des artistes incroyables. Le service client est impeccable et la livraison rapide."</p>
                    <p class="testimonial-author">— Felix TANZI</p>
                    <div class="testimonial-stars">★★★★★</div>
                </div>
                
                <div class="testimonial-card">
                    <div class="testimonial-avatar">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/accueil/hero.jpg" alt="Client">
                    </div>
                    <p class="testimonial-text">"Je recommande vivement ! Les œuvres sont authentiques et le site est très facile à utiliser. Bravo à l'équipe !"</p>
                    <p class="testimonial-author">— Jacky NGONGA</p>
                    <div class="testimonial-stars">★★★★☆</div>
                </div>
                
                <div class="testimonial-card">
                    <div class="testimonial-avatar">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/accueil/product1.jpg" alt="Client">
                    </div>
                    <p class="testimonial-text">"Un catalogue riche et varié. J'ai offert une peinture à ma mère et elle en était ravie. Merci Artika !"</p>
                    <p class="testimonial-author">— Bryan NGOUPAYOU</p>
                    <div class="testimonial-stars">★★★★★</div>
                </div>
                
                <!-- Dupliquer pour le scroll infini -->
                <div class="testimonial-card">
                    <div class="testimonial-avatar">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/accueil/product1.jpg" alt="Client">
                    </div>
                    <p class="testimonial-text">"Une plateforme exceptionnelle ! J'ai trouvé des œuvres magnifiques pour décorer mon salon. La qualité est au rendez-vous."</p>
                    <p class="testimonial-author">— Naomi TSAGUE</p>
                    <div class="testimonial-stars">★★★★★</div>
                </div>
                
                <div class="testimonial-card">
                    <div class="testimonial-avatar">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/accueil/hero.jpg" alt="Client">
                    </div>
                    <p class="testimonial-text">"Artika m'a permis de découvrir des artistes incroyables. Le service client est impeccable et la livraison rapide."</p>
                    <p class="testimonial-author">— Felix TANZI</p>
                    <div class="testimonial-stars">★★★★★</div>
                </div>
                
            </div>
        </div>
        
        <!-- Formulaire d'ajout de témoignage -->
        <div class="testimonial-form-section">
            <h3 class="form-title">Partagez votre expérience</h3>
            <form class="testimonial-form" id="testimonialForm">
                <div class="form-row">
                    <div class="form-group">
                        <input type="text" name="name" placeholder="Votre nom" class="form-input" required>
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" placeholder="Votre email" class="form-input" required>
                    </div>
                </div>
                <div class="form-group">
                    <textarea name="comment" placeholder="Votre commentaire..." class="form-textarea" rows="5" required></textarea>
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

<script>
// Gestion du formulaire de témoignages
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('testimonialForm');
    
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(form);
            const name = formData.get('name');
            const email = formData.get('email');
            const comment = formData.get('comment');
            const rating = formData.get('rating');
            
            // Validation
            if (!name || !email || !comment || !rating) {
                alert('Veuillez remplir tous les champs');
                return;
            }
            
            if (comment.length < 10) {
                alert('Le commentaire doit contenir au moins 10 caractères');
                return;
            }
            
            // Afficher message de confirmation
            const confirmation = document.createElement('div');
            confirmation.className = 'formulaire-confirmation show';
            confirmation.innerHTML = '<div class="confirmation-content">✓ Merci ! Votre avis a été ajouté avec succès.</div>';
            form.insertBefore(confirmation, form.firstChild);
            
            // Réinitialiser le formulaire
            form.reset();
            
            // Supprimer le message après 4 secondes
            setTimeout(() => {
                confirmation.remove();
            }, 4000);
        });
    }
});
</script>

<?php get_footer(); ?>