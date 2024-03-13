<?php get_header(); ?>

                <section class="section-product-archive">
                    <div class="archive-marquee">
                        <div class="marquee-split">
                            <div class="flexed marquee-block">
                                <h2 class="heading-grand"><?php _e( 'The Merch Shop', 'ayayves' ); ?></h2>
                                <div class="heading-grand serif">
                                    <?php _e( 'Support The Art', 'ayayves' ); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="archive merch-slider">
                        <div class="slider swiper">
                            <?php
                                $archive_merch_query_args = array(
                                    'post_type' => 'product',
                                    'nopaging' => true,
                                    'order' => 'ASC',
                                    'orderby' => 'date'
                                )
                            ?>
                            <?php
                                $archive_merch_query_args['meta_query'] = WC()->query->get_meta_query(); 
                                if( isset( $archive_merch_query_args[ 'orderby' ] ) ) {
                                    switch( $archive_merch_query_args[ 'orderby' ] ) {
                                        case 'price':
                                            $archive_merch_query_args[ 'orderby' ] = 'meta_value_num';
                                            $archive_merch_query_args[ 'meta_key' ] = '_price';
                                            break;
                                        case 'rating':
                                            $archive_merch_query_args[ 'orderby' ] = 'meta_value_num';
                                            $archive_merch_query_args[ 'meta_key' ] = '_wc_average_rating';
                                            break;
                                        case 'total_sales':
                                            $archive_merch_query_args[ 'orderby' ] = 'meta_value_num';
                                            $archive_merch_query_args[ 'meta_key' ] = 'total_sales';
                                            break;
                                        case 'review_count':
                                            $archive_merch_query_args[ 'orderby' ] = 'meta_value_num';
                                            $archive_merch_query_args[ 'meta_key' ] = '_wc_review_count';
                                            break;
                                    }
                            }?>
                            <?php $archive_merch_query = new WP_Query( $archive_merch_query_args ); ?>
                            <?php if ( $archive_merch_query->have_posts() ) : ?>
                                <div role="list" class="slider-rail swiper-wrapper">
                                    <?php while ( $archive_merch_query->have_posts() ) : $archive_merch_query->the_post(); ?>
                                        <?php global $product, $post; ?>
                                        <?php PG_Helper_v2::rememberShownPost(); ?>
                                        <div role="listitem" <?php wc_product_class( 'slider-w swiper-slide' , $product ); ?> id="post-<?php the_ID(); ?>">
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
                                                    </div><a href="<?php echo esc_url( apply_filters( 'woocommerce_loop_product_link', get_the_permalink(), $product ) ); ?>" class="button--display secondary"> <div class="star-w" hidden>
                                                            <svg width="100%" height="100%" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M5.76283 0.711511C5.8388 0.483587 6.1612 0.483588 6.23717 0.711513L7.46047 4.38141C7.48536 4.45607 7.54393 4.51465 7.61859 4.53953L11.2885 5.76283C11.5164 5.8388 11.5164 6.1612 11.2885 6.23717L7.61859 7.46047C7.54393 7.48536 7.48536 7.54393 7.46047 7.61859L6.23717 11.2885C6.1612 11.5164 5.8388 11.5164 5.76283 11.2885L4.53953 7.61859C4.51464 7.54393 4.45607 7.48536 4.38141 7.46047L0.711511 6.23717C0.483587 6.1612 0.483588 5.8388 0.711513 5.76283L4.38141 4.53953C4.45607 4.51464 4.51465 4.45607 4.53953 4.38141L5.76283 0.711511Z" fill="currentColor"></path>
                                                            </svg>
                                                        </div> <div label>
                                                            <?php _e( 'Shop', 'ayayves' ); ?>
                                                        </div> <div class="star-w">
                                                            <svg width="0.75rem" height="100%" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M5.76283 0.711511C5.8388 0.483587 6.1612 0.483588 6.23717 0.711513L7.46047 4.38141C7.48536 4.45607 7.54393 4.51465 7.61859 4.53953L11.2885 5.76283C11.5164 5.8388 11.5164 6.1612 11.2885 6.23717L7.61859 7.46047C7.54393 7.48536 7.48536 7.54393 7.46047 7.61859L6.23717 11.2885C6.1612 11.5164 5.8388 11.5164 5.76283 11.2885L4.53953 7.61859C4.51464 7.54393 4.45607 7.48536 4.38141 7.46047L0.711511 6.23717C0.483587 6.1612 0.483588 5.8388 0.711513 5.76283L4.38141 4.53953C4.45607 4.51464 4.51465 4.45607 4.53953 4.38141L5.76283 0.711511Z" fill="currentColor"></path>
                                                            </svg>
                                                        </div> </a>
                                                </div>
                                                <a href="<?php echo esc_url( apply_filters( 'woocommerce_loop_product_link', get_the_permalink(), $product ) ); ?>" class="img-w"><img loading="lazy" alt="" class="img" src="http://127.0.0.1:8000/wp-content/uploads/Serotonin-Pendant-Image-scaled.webp<?php $image_id = get_post_thumbnail_id( $product->get_id() );

echo pull_image($image_id); ?>" decoding="async" sizes='360px' srcset="http://127.0.0.1:8000/wp-content/uploads/Serotonin-Pendant-Image-scaled.webp 1852w, http://127.0.0.1:8000/wp-content/uploads/Serotonin-Pendant-Image-scaled-347x480.webp 347w, http://127.0.0.1:8000/wp-content/uploads/Serotonin-Pendant-Image-scaled-434x600.webp 434w, http://127.0.0.1:8000/wp-content/uploads/Serotonin-Pendant-Image-scaled-521x720.webp 521w, http://127.0.0.1:8000/wp-content/uploads/Serotonin-Pendant-Image-scaled-579x800.webp 579w, http://127.0.0.1:8000/wp-content/uploads/Serotonin-Pendant-Image-scaled-695x960.webp 695w, http://127.0.0.1:8000/wp-content/uploads/Serotonin-Pendant-Image-scaled-781x1080.webp 781w, http://127.0.0.1:8000/wp-content/uploads/Serotonin-Pendant-Image-scaled-926x1280.webp 926w, http://127.0.0.1:8000/wp-content/uploads/Serotonin-Pendant-Image-scaled-1042x1440.webp 1042w, http://127.0.0.1:8000/wp-content/uploads/Serotonin-Pendant-Image-scaled-1158x1600.webp 1158w, http://127.0.0.1:8000/wp-content/uploads/Serotonin-Pendant-Image-scaled-1302x1800.webp 1302w, http://127.0.0.1:8000/wp-content/uploads/Serotonin-Pendant-Image-scaled-360x498.webp 360w, http://127.0.0.1:8000/wp-content/uploads/Serotonin-Pendant-Image-scaled-640x885.webp 640w"></a>
                                                <!--[Pinegrow components saved data - this data is no longer used in the component. We're saving it just in case. Clear this with Components -> Clear saved unused edits]<div label data-pgc-field="button.label">Shop</div><div label data-pgc-field="button.label">Shop</div><div label data-pgc-field="button.label">Shop</div><div label data-pgc-field="button.label">Shop</div>-->
                                            </div>
                                        </div>
                                    <?php endwhile; ?>
                                    <?php wp_reset_postdata(); ?>
                                </div>
                            <?php else : ?>
                                <p><?php _e( 'Sorry, no posts matched your criteria.', 'ayayves' ); ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="arrow-counter-w">
                            <div class="bottom-mounted swiper-arrow-w">
                                <a class="button--arrow swiper-prev"> <div class="arrow-w">
                                        <svg width="2.25rem" height="100%" viewBox="0 0 36 14" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio transform:="rotate(0deg)" class="arrow">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M4.46458 7.94931L9.01045 12.4804C9.10846 12.5781 9.10846 12.7368 9.01045 12.8345L8.01767 13.8241C7.92011 13.9213 7.76226 13.9213 7.66469 13.8241L0.996001 7.17706C0.897986 7.07937 0.897986 6.92063 0.996001 6.82294L7.66469 0.175915C7.76226 0.0786674 7.92011 0.0786675 8.01767 0.175915L9.01045 1.16546C9.10846 1.26316 9.10846 1.4219 9.01045 1.51959L4.46458 6.05069H34.932C35.0701 6.05069 35.182 6.16262 35.182 6.30069V7.69931C35.182 7.83738 35.0701 7.94931 34.932 7.94931H4.46458Z" fill="currentColor"/>
                                        </svg>
                                        <svg width="2.25rem" height="100%" viewBox="0 0 36 14" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio transform:="rotate(0deg)" class="arrow is--outer-prev">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M4.46458 7.94931L9.01045 12.4804C9.10846 12.5781 9.10846 12.7368 9.01045 12.8345L8.01767 13.8241C7.92011 13.9213 7.76226 13.9213 7.66469 13.8241L0.996001 7.17706C0.897986 7.07937 0.897986 6.92063 0.996001 6.82294L7.66469 0.175915C7.76226 0.0786674 7.92011 0.0786675 8.01767 0.175915L9.01045 1.16546C9.10846 1.26316 9.10846 1.4219 9.01045 1.51959L4.46458 6.05069H34.932C35.0701 6.05069 35.182 6.16262 35.182 6.30069V7.69931C35.182 7.83738 35.0701 7.94931 34.932 7.94931H4.46458Z" fill="currentColor"/>
                                        </svg>
                                    </div> </a><a class="button--arrow swiper-next"> <div class="arrow-w">
                                        <svg width="2.25rem" height="100%" viewBox="0 0 36 14" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio transform:="rotate(0deg)" class="arrow is--flipped">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M4.46458 7.94931L9.01045 12.4804C9.10846 12.5781 9.10846 12.7368 9.01045 12.8345L8.01767 13.8241C7.92011 13.9213 7.76226 13.9213 7.66469 13.8241L0.996001 7.17706C0.897986 7.07937 0.897986 6.92063 0.996001 6.82294L7.66469 0.175915C7.76226 0.0786674 7.92011 0.0786675 8.01767 0.175915L9.01045 1.16546C9.10846 1.26316 9.10846 1.4219 9.01045 1.51959L4.46458 6.05069H34.932C35.0701 6.05069 35.182 6.16262 35.182 6.30069V7.69931C35.182 7.83738 35.0701 7.94931 34.932 7.94931H4.46458Z" fill="currentColor"/>
                                        </svg>
                                        <svg width="2.25rem" height="100%" viewBox="0 0 36 14" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio transform:="rotate(0deg)" class="arrow is--flipped is--outer-next">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M4.46458 7.94931L9.01045 12.4804C9.10846 12.5781 9.10846 12.7368 9.01045 12.8345L8.01767 13.8241C7.92011 13.9213 7.76226 13.9213 7.66469 13.8241L0.996001 7.17706C0.897986 7.07937 0.897986 6.92063 0.996001 6.82294L7.66469 0.175915C7.76226 0.0786674 7.92011 0.0786675 8.01767 0.175915L9.01045 1.16546C9.10846 1.26316 9.10846 1.4219 9.01045 1.51959L4.46458 6.05069H34.932C35.0701 6.05069 35.182 6.16262 35.182 6.30069V7.69931C35.182 7.83738 35.0701 7.94931 34.932 7.94931H4.46458Z" fill="currentColor"/>
                                        </svg>
                                    </div> </a>
                            </div>
                            <div hide-mobile="true" class="counter">
                                <?php _e( '(1 of 14)', 'ayayves' ); ?>
                            </div>
                        </div>
                    </div>
                </section>                

<?php get_footer(); ?>