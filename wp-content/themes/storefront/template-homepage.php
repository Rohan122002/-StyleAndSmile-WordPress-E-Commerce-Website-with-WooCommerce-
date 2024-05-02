<?php
/**
 * The template for displaying the homepage.
 *
 * This page template will display any functions hooked into the `homepage` action.
 * By default this includes a variety of product displays and the page content itself. To change the order or toggle these components
 * use the Homepage Control plugin.
 * https://wordpress.org/plugins/homepage-control/
 *
 * Template name: Homepage
 *
 * @package storefront
 */

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

        <!-- Hero Section -->
        <section class="hero-section">
            <!-- Add your hero content here -->
            <div class="hero-content">
                <h1>Welcome to Our Store</h1>
                <p>Discover amazing deals on a wide range of products</p>
                <a href="<?php echo esc_url( home_url( '/shop/' ) ); ?>" class="btn btn-primary">Shop Now</a>
            </div>
        </section>

        <!-- Featured Categories -->
        <section class="featured-categories">
            <h2>Shop by Category</h2>
            <!-- Add your featured categories or product categories here -->
            <?php
            // Output product categories
            if ( function_exists( 'woocommerce_output_product_categories' ) ) {
                woocommerce_output_product_categories( array(
                    'number' => 4, // Number of categories to display
                    'columns' => 4, // Number of columns
                ) );
            }
            ?>
        </section>

        <!-- Featured Products -->
        <section class="featured-products">
            <h2>Featured Products</h2>
            <!-- Add your featured products here -->
            <?php
            // Output featured products
            if ( function_exists( 'storefront_featured_products' ) ) {
                echo '<div class="featured-products-carousel">';
                storefront_featured_products();
                echo '</div>';
            }
            ?>
        </section>

        <!-- Popular Products -->
        <section class="popular-products">
            <h2>Popular Products</h2>
            <!-- Add your popular products here -->
            <?php
            // Output popular products
            if ( function_exists( 'storefront_popular_products' ) ) {
                echo '<div class="popular-products-carousel">';
                storefront_popular_products();
                echo '</div>';
            }
            ?>
        </section>

    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
