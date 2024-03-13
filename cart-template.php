<?php
/*
 Template Name: Cart Template
 Template Post Type: post, page
*/
?>
<?php get_header( 'cart-template' ); ?>

<div class="page-content">
    <?php if ( have_posts() ) : ?>
        <?php while ( have_posts() ) : the_post(); ?>
            <?php PG_Helper_v2::rememberShownPost(); ?>
            <section id="post-<?php the_ID(); ?>" <?php post_class( 'section-cart section-cart-checkout' ); ?>>
                <h1><?php the_title(); ?></h1>
                <div class="cart-content">
                    <?php the_content(); ?>
                </div>
            </section>
        <?php endwhile; ?>
    <?php else : ?>
        <p><?php _e( 'Sorry, no posts matched your criteria.', 'ayayves' ); ?></p>
    <?php endif; ?>
</div>            

<?php get_footer( 'cart-template' ); ?>