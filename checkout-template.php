<?php
/*
 Template Name: Checkout Template
 Template Post Type: post, page
*/
?>
<?php get_header( 'checkout-template' ); ?>

<div class="page-content">
    <?php if ( have_posts() ) : ?>
        <?php while ( have_posts() ) : the_post(); ?>
            <?php PG_Helper_v2::rememberShownPost(); ?>
            <section id="post-<?php the_ID(); ?>" <?php post_class( 'section-cart section-cart-checkout' ); ?>>
                <div>
                    <?php the_content(); ?>
                </div>
            </section>
        <?php endwhile; ?>
    <?php else : ?>
        <p><?php _e( 'Sorry, no posts matched your criteria.', 'ayayves' ); ?></p>
    <?php endif; ?>
</div>            

<?php get_footer( 'checkout-template' ); ?>