<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product, $post;

$current_product = $product;
$heading = apply_filters( 'woocommerce_product_related_products_heading', __( 'Related products', 'woocommerce' ) );

if ( $related_products ) : ?>
<div role="list" class="slider-rail swiper-wrapper">
    <?php foreach ( $related_products as $product ) : ?>
        <div role="listitem" class="slider-w swiper-slide">
            <?php $post_object = get_post( $product->get_id() ); ?>
            <?php setup_postdata( $GLOBALS['post'] =& $post_object ); ?>
            <div class="merch-card">
                <div class="info-w">
                    <div class="desc-w">
                        <a class="title-link" href="<?php echo esc_url( apply_filters( 'woocommerce_loop_product_link', get_the_permalink(), $product ) ); ?>"><?php wc_get_template( 'loop/title.php' ) ?></a>
                        <div class="divider">
                            <div class="divider_fill"></div>
                            <div class="divider_bg"></div>
                        </div>
                        <div class="meta-w">
                            <?php $terms = get_the_terms( get_the_ID(), 'product_cat' ) ?>
                            <?php if( !empty( $terms ) ) : ?>
                                <?php foreach( $terms as $term_i => $term ) : ?>
                                    <?php if( $term_i == 0 ) : ?>
                                        <div class="heading-300" href="http://127.0.0.1:8000/product-category/the-serotonin-collection/" rel="tag" data="category">
                                            <?php echo $term->name; ?>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            <?php wc_get_template( 'loop/short-description.php' ) ?>
                        </div>
                    </div>
                    <a href="<?php echo esc_url( apply_filters( 'woocommerce_loop_product_link', get_the_permalink(), $product ) ); ?>" class="button--display secondary"> <div class="star-w" hidden>
                            <svg width="100%" height="100%" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5.76283 0.711511C5.8388 0.483587 6.1612 0.483588 6.23717 0.711513L7.46047 4.38141C7.48536 4.45607 7.54393 4.51465 7.61859 4.53953L11.2885 5.76283C11.5164 5.8388 11.5164 6.1612 11.2885 6.23717L7.61859 7.46047C7.54393 7.48536 7.48536 7.54393 7.46047 7.61859L6.23717 11.2885C6.1612 11.5164 5.8388 11.5164 5.76283 11.2885L4.53953 7.61859C4.51464 7.54393 4.45607 7.48536 4.38141 7.46047L0.711511 6.23717C0.483587 6.1612 0.483588 5.8388 0.711513 5.76283L4.38141 4.53953C4.45607 4.51464 4.51465 4.45607 4.53953 4.38141L5.76283 0.711511Z" fill="currentColor"></path>
                            </svg>
                        </div> <div label>
                            <?php _e( 'Explore', 'ayayves' ); ?>
                        </div> <div class="star-w">
                            <svg width="0.75rem" height="100%" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5.76283 0.711511C5.8388 0.483587 6.1612 0.483588 6.23717 0.711513L7.46047 4.38141C7.48536 4.45607 7.54393 4.51465 7.61859 4.53953L11.2885 5.76283C11.5164 5.8388 11.5164 6.1612 11.2885 6.23717L7.61859 7.46047C7.54393 7.48536 7.48536 7.54393 7.46047 7.61859L6.23717 11.2885C6.1612 11.5164 5.8388 11.5164 5.76283 11.2885L4.53953 7.61859C4.51464 7.54393 4.45607 7.48536 4.38141 7.46047L0.711511 6.23717C0.483587 6.1612 0.483588 5.8388 0.711513 5.76283L4.38141 4.53953C4.45607 4.51464 4.51465 4.45607 4.53953 4.38141L5.76283 0.711511Z" fill="currentColor"></path>
                            </svg>
                        </div> </a>
                </div>
                <a href="<?php echo esc_url( apply_filters( 'woocommerce_loop_product_link', get_the_permalink(), $product ) ); ?>" class="img-w"><img class="img" decoding="async" sizes="360px" src="http://127.0.0.1:8000/wp-content/uploads/Serotonin-Vinyl-Image-1.webphttp://127.0.0.1:8000/wp-content/uploads/Serotonin-Vinyl-Image-1.webp<?php $image_id = get_post_thumbnail_id( $product->get_id() );

echo pull_image($image_id); ?>" srcset="http://127.0.0.1:8000/wp-content/uploads/Serotonin-Vinyl-Image-1.webp 1500w, http://127.0.0.1:8000/wp-content/uploads/Serotonin-Vinyl-Image-1-360x480.webp 360w, http://127.0.0.1:8000/wp-content/uploads/Serotonin-Vinyl-Image-1-450x600.webp 450w, http://127.0.0.1:8000/wp-content/uploads/Serotonin-Vinyl-Image-1-540x720.webp 540w, http://127.0.0.1:8000/wp-content/uploads/Serotonin-Vinyl-Image-1-600x800.webp 600w, http://127.0.0.1:8000/wp-content/uploads/Serotonin-Vinyl-Image-1-720x960.webp 720w, http://127.0.0.1:8000/wp-content/uploads/Serotonin-Vinyl-Image-1-810x1080.webp 810w, http://127.0.0.1:8000/wp-content/uploads/Serotonin-Vinyl-Image-1-960x1280.webp 960w, http://127.0.0.1:8000/wp-content/uploads/Serotonin-Vinyl-Image-1-1080x1440.webp 1080w, http://127.0.0.1:8000/wp-content/uploads/Serotonin-Vinyl-Image-1-1200x1600.webp 1200w, http://127.0.0.1:8000/wp-content/uploads/Serotonin-Vinyl-Image-1-1350x1800.webp 1350w, http://127.0.0.1:8000/wp-content/uploads/Serotonin-Vinyl-Image-1-640x853.webp 640w" loading="lazy"></a>
                <!--[Pinegrow components saved data - this data is no longer used in the component. We're saving it just in case. Clear this with Components -> Clear saved unused edits]<div label data-pgc-field="button.label">Shop</div><div label data-pgc-field="button.label">Shop</div><div label data-pgc-field="button.label">Shop</div><div label data-pgc-field="button.label">Shop</div>-->
            </div>
        </div>
    <?php endforeach; ?>
</div>        
<?php endif; 
wp_reset_postdata();
$product = $current_product;
?>