<?php get_header(); ?>

                <?php
                    $hero_release_query_args = array(
                        'post_type' => 'release',
                        'posts_per_page' => 1,
                        'order' => 'DESC',
                        'orderby' => 'meta_value',
                        'meta_key' => 'release_date'
                    )
                ?>
                <?php $hero_release_query = new WP_Query( $hero_release_query_args ); ?>
                <?php if ( $hero_release_query->have_posts() ) : ?>
                    <?php while ( $hero_release_query->have_posts() ) : $hero_release_query->the_post(); ?>
                        <?php PG_Helper_v2::rememberShownPost(); ?>
                        <?php $releaseDate = get_field('release_date');

if ($releaseDate) {
    $dateObject = DateTime::createFromFormat('M j, Y', $releaseDate);
    if ($dateObject) {
        $currentDateTime = new DateTime();
        if ($dateObject < $currentDateTime) {
            $released = true; 
        }
    }
} ?>
                        <section class="home section-hero" theme="overlay">
                            <div class="background-w">
                                <div class="bg-tint"></div>
                                <?php if ( !get_field('raw_music_video_link') && !get_field('key_art') ) : ?>
                                    <img class="bg-content" src="<?php $image_id = get_field('cover_art');
echo pull_image($image_id); ?>"/>
                                <?php endif; ?>
                                <?php if ( !get_field('raw_music_video_link') && get_field('key_art') ) : ?>
                                    <img class="bg-content" src="<?php $image_id = get_field('key_art');
echo pull_image($image_id); ?>"/>
                                <?php endif; ?>
                                <?php if ( get_field( 'raw_music_video_link' ) ) : ?>
                                    <div class="bg-content video-w">
                                        <img loading="lazy" src="<?php $image_id = get_field('cover_art');
echo pull_image($image_id); ?>">
                                        <video playsinline="" loop="true" muted="true" autoplay="" height="100%" preload="auto" object-fit="cover" data-src="<?php echo get_field( 'raw_music_video_link' ); ?>">
</video>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div role="listitem" class="subsection-feature">
                                <div class="feature_grid" release-status>
                                    <h2 class="heading-900" data="title"><?php the_title(); ?></h2>
                                    <div class="meta-w">
                                        <?php if ( get_field( 'release_type' ) ) : ?>
                                            <div data="release-type" class="heading-300">
                                                <?php echo get_field( 'release_type' ); ?>
                                            </div>
                                        <?php endif; ?>
                                        <?php if ( get_field( 'hero_subtitle' ) ) : ?>
                                            <div class="p1" data="subtitle">
                                                <?php echo get_field( 'hero_subtitle' ); ?>
                                            </div>
                                        <?php endif; ?>
                                        <div class="p1" data="release-date">
                                            <?php if ( !$released ) : ?>
                                                <span data="release-status"><?php _e( 'Releasing', 'ayayves' ); ?> </span>
                                            <?php endif; ?>
                                            <?php if ( $released ) : ?>
                                                <span data="release-status"><?php _e( 'Released', 'ayayves' ); ?> </span>
                                            <?php endif; ?>
                                            <span><?php echo get_field( 'release_date' ); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="divider">
                                    <div class="divider_fill"></div>
                                    <div class="divider_bg"></div>
                                </div>
                                <div class="feature_grid">
                                    <a class="button--display" data="streamlink" id="post-<?php the_ID(); ?>"> <div class="star-w" hidden>
                                            <svg width="100%" height="100%" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M5.76283 0.711511C5.8388 0.483587 6.1612 0.483588 6.23717 0.711513L7.46047 4.38141C7.48536 4.45607 7.54393 4.51465 7.61859 4.53953L11.2885 5.76283C11.5164 5.8388 11.5164 6.1612 11.2885 6.23717L7.61859 7.46047C7.54393 7.48536 7.48536 7.54393 7.46047 7.61859L6.23717 11.2885C6.1612 11.5164 5.8388 11.5164 5.76283 11.2885L4.53953 7.61859C4.51464 7.54393 4.45607 7.48536 4.38141 7.46047L0.711511 6.23717C0.483587 6.1612 0.483588 5.8388 0.711513 5.76283L4.38141 4.53953C4.45607 4.51464 4.51465 4.45607 4.53953 4.38141L5.76283 0.711511Z" fill="currentColor"></path>
                                            </svg>
                                        </div><div label>
                                            <?php if ( $released ) : ?>
                                                <span><?php _e( 'Listen', 'ayayves' ); ?></span>
                                            <?php endif; ?>
                                            <?php if ( ! $released ) : ?>
                                                <span><?php _e( 'Pre-Save', 'ayayves' ); ?></span>
                                            <?php endif; ?>
                                        </div><div class="star-w">
                                            <svg width="100%" height="100%" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M5.76283 0.711511C5.8388 0.483587 6.1612 0.483588 6.23717 0.711513L7.46047 4.38141C7.48536 4.45607 7.54393 4.51465 7.61859 4.53953L11.2885 5.76283C11.5164 5.8388 11.5164 6.1612 11.2885 6.23717L7.61859 7.46047C7.54393 7.48536 7.48536 7.54393 7.46047 7.61859L6.23717 11.2885C6.1612 11.5164 5.8388 11.5164 5.76283 11.2885L4.53953 7.61859C4.51464 7.54393 4.45607 7.48536 4.38141 7.46047L0.711511 6.23717C0.483587 6.1612 0.483588 5.8388 0.711513 5.76283L4.38141 4.53953C4.45607 4.51464 4.51465 4.45607 4.53953 4.38141L5.76283 0.711511Z" fill="currentColor"></path>
                                            </svg>
                                        </div> </a>
                                    <div class="p1" data="subtitle" style="align-self: center;">
                                        <?php _e( 'Scroll to explore', 'ayayves' ); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="subsection-slider">
                                <div class="merch-slider" href>
                                    <div class="slider-header">
                                        <div class="heading-w">
                                            <h2 class="heading-800"><?php _e( 'Support the Art', 'ayayves' ); ?></h2>
                                            <div class="heading-600" hide-mobile="true">
                                                <?php _e( '(Merch)', 'ayayves' ); ?>
                                            </div>
                                        </div>
                                        <div class="swiper-arrow-w" mobile="false"><a class="button--arrow swiper-prev"> <div class="arrow-w">
                                                    <svg width="2.25rem" height="100%" viewBox="0 0 36 14" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio transform:="rotate(0deg)" class="arrow">
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M4.46458 7.94931L9.01045 12.4804C9.10846 12.5781 9.10846 12.7368 9.01045 12.8345L8.01767 13.8241C7.92011 13.9213 7.76226 13.9213 7.66469 13.8241L0.996001 7.17706C0.897986 7.07937 0.897986 6.92063 0.996001 6.82294L7.66469 0.175915C7.76226 0.0786674 7.92011 0.0786675 8.01767 0.175915L9.01045 1.16546C9.10846 1.26316 9.10846 1.4219 9.01045 1.51959L4.46458 6.05069H34.932C35.0701 6.05069 35.182 6.16262 35.182 6.30069V7.69931C35.182 7.83738 35.0701 7.94931 34.932 7.94931H4.46458Z" fill="currentColor"/>
                                                    </svg>
                                                    <svg width="2.25rem" height="100%" viewBox="0 0 36 14" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio transform:="rotate(0deg)" class="arrow is--outer-prev">
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M4.46458 7.94931L9.01045 12.4804C9.10846 12.5781 9.10846 12.7368 9.01045 12.8345L8.01767 13.8241C7.92011 13.9213 7.76226 13.9213 7.66469 13.8241L0.996001 7.17706C0.897986 7.07937 0.897986 6.92063 0.996001 6.82294L7.66469 0.175915C7.76226 0.0786674 7.92011 0.0786675 8.01767 0.175915L9.01045 1.16546C9.10846 1.26316 9.10846 1.4219 9.01045 1.51959L4.46458 6.05069H34.932C35.0701 6.05069 35.182 6.16262 35.182 6.30069V7.69931C35.182 7.83738 35.0701 7.94931 34.932 7.94931H4.46458Z" fill="currentColor"/>
                                                    </svg>
                                                </div> </a>
                                            <a class="button--arrow swiper-next"> <div class="arrow-w">
                                                    <svg width="2.25rem" height="100%" viewBox="0 0 36 14" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio transform:="rotate(0deg)" class="arrow is--flipped">
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M4.46458 7.94931L9.01045 12.4804C9.10846 12.5781 9.10846 12.7368 9.01045 12.8345L8.01767 13.8241C7.92011 13.9213 7.76226 13.9213 7.66469 13.8241L0.996001 7.17706C0.897986 7.07937 0.897986 6.92063 0.996001 6.82294L7.66469 0.175915C7.76226 0.0786674 7.92011 0.0786675 8.01767 0.175915L9.01045 1.16546C9.10846 1.26316 9.10846 1.4219 9.01045 1.51959L4.46458 6.05069H34.932C35.0701 6.05069 35.182 6.16262 35.182 6.30069V7.69931C35.182 7.83738 35.0701 7.94931 34.932 7.94931H4.46458Z" fill="currentColor"/>
                                                    </svg>
                                                    <svg width="2.25rem" height="100%" viewBox="0 0 36 14" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio transform:="rotate(0deg)" class="arrow is--flipped is--outer-next">
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M4.46458 7.94931L9.01045 12.4804C9.10846 12.5781 9.10846 12.7368 9.01045 12.8345L8.01767 13.8241C7.92011 13.9213 7.76226 13.9213 7.66469 13.8241L0.996001 7.17706C0.897986 7.07937 0.897986 6.92063 0.996001 6.82294L7.66469 0.175915C7.76226 0.0786674 7.92011 0.0786675 8.01767 0.175915L9.01045 1.16546C9.10846 1.26316 9.10846 1.4219 9.01045 1.51959L4.46458 6.05069H34.932C35.0701 6.05069 35.182 6.16262 35.182 6.30069V7.69931C35.182 7.83738 35.0701 7.94931 34.932 7.94931H4.46458Z" fill="currentColor"/>
                                                    </svg>
                                                </div> </a>
                                        </div>
                                    </div>
                                    <div class="slider swiper">
                                        <?php
                                            $hero_merch_query_args = array(
                                                'post_type' => 'product',
                                                'nopaging' => true,
                                                'order' => 'ASC',
                                                'orderby' => 'date'
                                            )
                                        ?>
                                        <?php
                                            $hero_merch_query_args['meta_query'] = WC()->query->get_meta_query(); 
                                            if( isset( $hero_merch_query_args[ 'orderby' ] ) ) {
                                                switch( $hero_merch_query_args[ 'orderby' ] ) {
                                                    case 'price':
                                                        $hero_merch_query_args[ 'orderby' ] = 'meta_value_num';
                                                        $hero_merch_query_args[ 'meta_key' ] = '_price';
                                                        break;
                                                    case 'rating':
                                                        $hero_merch_query_args[ 'orderby' ] = 'meta_value_num';
                                                        $hero_merch_query_args[ 'meta_key' ] = '_wc_average_rating';
                                                        break;
                                                    case 'total_sales':
                                                        $hero_merch_query_args[ 'orderby' ] = 'meta_value_num';
                                                        $hero_merch_query_args[ 'meta_key' ] = 'total_sales';
                                                        break;
                                                    case 'review_count':
                                                        $hero_merch_query_args[ 'orderby' ] = 'meta_value_num';
                                                        $hero_merch_query_args[ 'meta_key' ] = '_wc_review_count';
                                                        break;
                                                }
                                        }?>
                                        <?php $hero_merch_query = new WP_Query( $hero_merch_query_args ); ?>
                                        <?php if ( $hero_merch_query->have_posts() ) : ?>
                                            <div role="list" class="slider-rail swiper-wrapper">
                                                <?php while ( $hero_merch_query->have_posts() ) : $hero_merch_query->the_post(); ?>
                                                    <?php global $product, $post; ?>
                                                    <?php PG_Helper_v2::rememberShownPost(); ?>
                                                    <div role="listitem" <?php wc_product_class( 'slider-w swiper-slide' , $product ); ?> id="post-<?php the_ID(); ?>">
                                                        <div class="merch-card">
                                                            <div class="info-w">
                                                                <div class="desc-w"><a class="title-link" href="<?php echo esc_url( apply_filters( 'woocommerce_loop_product_link', get_the_permalink(), $product ) ); ?>"><?php wc_get_template( 'loop/title.php' ) ?></a>
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
                                                            </div><a href="<?php echo esc_url( apply_filters( 'woocommerce_loop_product_link', get_the_permalink(), $product ) ); ?>" class="img-w"><img loading="lazy" class="img" src="http://127.0.0.1:8000/wp-content/uploads/Serotonin-Pendant-Image-scaled.webphttp://127.0.0.1:8000/wp-content/uploads/Serotonin-Pendant-Image-scaled.webp<?php $image_id = get_post_thumbnail_id( $product->get_id() );

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
                                    <div class="swiper-arrow-w" mobile="true"><a class="button--arrow swiper-prev"> <div class="arrow-w">
                                                <svg width="2.25rem" height="100%" viewBox="0 0 36 14" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio transform:="rotate(0deg)" class="arrow">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M4.46458 7.94931L9.01045 12.4804C9.10846 12.5781 9.10846 12.7368 9.01045 12.8345L8.01767 13.8241C7.92011 13.9213 7.76226 13.9213 7.66469 13.8241L0.996001 7.17706C0.897986 7.07937 0.897986 6.92063 0.996001 6.82294L7.66469 0.175915C7.76226 0.0786674 7.92011 0.0786675 8.01767 0.175915L9.01045 1.16546C9.10846 1.26316 9.10846 1.4219 9.01045 1.51959L4.46458 6.05069H34.932C35.0701 6.05069 35.182 6.16262 35.182 6.30069V7.69931C35.182 7.83738 35.0701 7.94931 34.932 7.94931H4.46458Z" fill="currentColor"/>
                                                </svg>
                                                <svg width="2.25rem" height="100%" viewBox="0 0 36 14" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio transform:="rotate(0deg)" class="arrow is--outer-prev">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M4.46458 7.94931L9.01045 12.4804C9.10846 12.5781 9.10846 12.7368 9.01045 12.8345L8.01767 13.8241C7.92011 13.9213 7.76226 13.9213 7.66469 13.8241L0.996001 7.17706C0.897986 7.07937 0.897986 6.92063 0.996001 6.82294L7.66469 0.175915C7.76226 0.0786674 7.92011 0.0786675 8.01767 0.175915L9.01045 1.16546C9.10846 1.26316 9.10846 1.4219 9.01045 1.51959L4.46458 6.05069H34.932C35.0701 6.05069 35.182 6.16262 35.182 6.30069V7.69931C35.182 7.83738 35.0701 7.94931 34.932 7.94931H4.46458Z" fill="currentColor"/>
                                                </svg>
                                            </div> </a>
                                        <a class="button--arrow swiper-next"> <div class="arrow-w">
                                                <svg width="2.25rem" height="100%" viewBox="0 0 36 14" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio transform:="rotate(0deg)" class="arrow is--flipped">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M4.46458 7.94931L9.01045 12.4804C9.10846 12.5781 9.10846 12.7368 9.01045 12.8345L8.01767 13.8241C7.92011 13.9213 7.76226 13.9213 7.66469 13.8241L0.996001 7.17706C0.897986 7.07937 0.897986 6.92063 0.996001 6.82294L7.66469 0.175915C7.76226 0.0786674 7.92011 0.0786675 8.01767 0.175915L9.01045 1.16546C9.10846 1.26316 9.10846 1.4219 9.01045 1.51959L4.46458 6.05069H34.932C35.0701 6.05069 35.182 6.16262 35.182 6.30069V7.69931C35.182 7.83738 35.0701 7.94931 34.932 7.94931H4.46458Z" fill="currentColor"/>
                                                </svg>
                                                <svg width="2.25rem" height="100%" viewBox="0 0 36 14" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio transform:="rotate(0deg)" class="arrow is--flipped is--outer-next">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M4.46458 7.94931L9.01045 12.4804C9.10846 12.5781 9.10846 12.7368 9.01045 12.8345L8.01767 13.8241C7.92011 13.9213 7.76226 13.9213 7.66469 13.8241L0.996001 7.17706C0.897986 7.07937 0.897986 6.92063 0.996001 6.82294L7.66469 0.175915C7.76226 0.0786674 7.92011 0.0786675 8.01767 0.175915L9.01045 1.16546C9.10846 1.26316 9.10846 1.4219 9.01045 1.51959L4.46458 6.05069H34.932C35.0701 6.05069 35.182 6.16262 35.182 6.30069V7.69931C35.182 7.83738 35.0701 7.94931 34.932 7.94931H4.46458Z" fill="currentColor"/>
                                                </svg>
                                            </div> </a>
                                    </div>
                                </div>
                            </div>
                        </section>
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                <?php endif; ?>
                <section class="section-scrollgrid">
                    <div class="ribbon-c">
                        <div class="ribbon-w">
                            <div class="ribbon">
                                <div class="ribbon_img-w">
                                    <img sizes="(min-width: 920px) 35vw, (min-width: 520px) 75vw, 60vw" src="http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-4.webp<?php echo pull_image('image.bottom.left'); ?>" srcset="http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-4.webp 2000w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-4-360x240.webp 360w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-4-640x427.webp 640w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-4-480x320.webp 480w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-4-600x401.webp 600w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-4-720x481.webp 720w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-4-800x534.webp 800w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-4-960x641.webp 960w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-4-1080x721.webp 1080w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-4-1280x854.webp 1280w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-4-1440x961.webp 1440w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-4-1600x1068.webp 1600w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-4-1800x1202.webp 1800w">
                                </div>
                                <div class="ribbon_img-w">
                                    <img sizes="(min-width: 920px) 35vw, (min-width: 520px) 75vw, 60vw" src="http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-121.webp<?php echo pull_image('image.top.left'); ?>" srcset="http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-121.webp 1331w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-121-360x541.webp 360w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-121-640x962.webp 640w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-121-319x480.webp 319w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-121-399x600.webp 399w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-121-479x720.webp 479w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-121-532x800.webp 532w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-121-639x960.webp 639w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-121-719x1080.webp 719w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-121-852x1280.webp 852w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-121-958x1440.webp 958w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-121-1065x1600.webp 1065w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-121-1198x1800.webp 1198w">
                                </div>
                                <div class="ribbon_img-w">
                                    <img sizes="(min-width: 920px) 35vw, (min-width: 520px) 75vw, 60vw" src="http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-4.webp<?php echo pull_image('image.bottom.left'); ?>" srcset="http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-4.webp 2000w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-4-360x240.webp 360w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-4-640x427.webp 640w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-4-480x320.webp 480w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-4-600x401.webp 600w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-4-720x481.webp 720w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-4-800x534.webp 800w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-4-960x641.webp 960w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-4-1080x721.webp 1080w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-4-1280x854.webp 1280w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-4-1440x961.webp 1440w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-4-1600x1068.webp 1600w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-4-1800x1202.webp 1800w">
                                </div>
                                <div class="ribbon_img-w">
                                    <img sizes="(min-width: 920px) 35vw, (min-width: 520px) 75vw, 60vw" src="http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-121.webp<?php echo pull_image('image.top.left'); ?>" srcset="http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-121.webp 1331w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-121-360x541.webp 360w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-121-640x962.webp 640w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-121-319x480.webp 319w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-121-399x600.webp 399w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-121-479x720.webp 479w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-121-532x800.webp 532w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-121-639x960.webp 639w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-121-719x1080.webp 719w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-121-852x1280.webp 852w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-121-958x1440.webp 958w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-121-1065x1600.webp 1065w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-121-1198x1800.webp 1198w">
                                </div>
                            </div>
                            <div class="ribbon">
                                <div class="ribbon_img-w">
                                    <img src="http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-142.webp<?php echo pull_image('image.bottom.center'); ?>" srcset="http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-142.webp 2000w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-142-360x240.webp 360w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-142-640x426.webp 640w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-142-480x319.webp 480w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-142-600x399.webp 600w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-142-720x479.webp 720w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-142-800x532.webp 800w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-142-960x639.webp 960w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-142-1080x719.webp 1080w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-142-1280x852.webp 1280w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-142-1440x958.webp 1440w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-142-1600x1065.webp 1600w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-142-1800x1198.webp 1800w">
                                </div>
                                <div class="ribbon_img-w">
                                    <img sizes="(min-width: 920px) 35vw, (min-width: 520px) 75vw, 60vw" src="http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-55.webp<?php echo pull_image('image.top.center'); ?>" srcset="http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-55.webp 1331w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-55-360x541.webp 360w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-55-640x962.webp 640w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-55-319x480.webp 319w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-55-399x600.webp 399w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-55-479x720.webp 479w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-55-532x800.webp 532w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-55-639x960.webp 639w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-55-719x1080.webp 719w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-55-852x1280.webp 852w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-55-958x1440.webp 958w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-55-1065x1600.webp 1065w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-55-1198x1800.webp 1198w">
                                </div>
                                <div class="ribbon_img-w">
                                    <img sizes="(min-width: 920px) 35vw, (min-width: 520px) 75vw, 60vw" src="http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-142.webp<?php echo pull_image('image.bottom.center'); ?>" srcset="http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-142.webp 2000w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-142-360x240.webp 360w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-142-640x426.webp 640w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-142-480x319.webp 480w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-142-600x399.webp 600w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-142-720x479.webp 720w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-142-800x532.webp 800w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-142-960x639.webp 960w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-142-1080x719.webp 1080w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-142-1280x852.webp 1280w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-142-1440x958.webp 1440w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-142-1600x1065.webp 1600w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-142-1800x1198.webp 1800w">
                                </div>
                                <div class="ribbon_img-w">
                                    <img sizes="(min-width: 920px) 35vw, (min-width: 520px) 75vw, 60vw" src="http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-55.webp<?php echo pull_image('image.top.center'); ?>" srcset="http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-55.webp 1331w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-55-360x541.webp 360w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-55-640x962.webp 640w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-55-319x480.webp 319w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-55-399x600.webp 399w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-55-479x720.webp 479w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-55-532x800.webp 532w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-55-639x960.webp 639w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-55-719x1080.webp 719w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-55-852x1280.webp 852w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-55-958x1440.webp 958w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-55-1065x1600.webp 1065w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-55-1198x1800.webp 1198w">
                                </div>
                            </div>
                            <div class="ribbon">
                                <div class="ribbon_img-w">
                                    <img sizes="(min-width: 920px) 35vw, (min-width: 520px) 75vw, 60vw" src="http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-77.webp<?php echo pull_image('image.bottom.right'); ?>" srcset="http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-77.webp 1331w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-77-360x541.webp 360w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-77-640x962.webp 640w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-77-319x480.webp 319w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-77-399x600.webp 399w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-77-479x720.webp 479w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-77-532x800.webp 532w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-77-639x960.webp 639w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-77-719x1080.webp 719w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-77-852x1280.webp 852w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-77-958x1440.webp 958w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-77-1065x1600.webp 1065w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-77-1198x1800.webp 1198w">
                                </div>
                                <div class="ribbon_img-w">
                                    <img sizes="(min-width: 920px) 35vw, (min-width: 520px) 75vw, 60vw" src="http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-125.webp<?php echo pull_image('image.top.right'); ?>" srcset="http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-125.webp 1331w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-125-360x541.webp 360w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-125-640x962.webp 640w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-125-319x480.webp 319w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-125-399x600.webp 399w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-125-479x720.webp 479w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-125-532x800.webp 532w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-125-639x960.webp 639w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-125-719x1080.webp 719w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-125-852x1280.webp 852w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-125-958x1440.webp 958w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-125-1065x1600.webp 1065w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-125-1198x1800.webp 1198w">
                                </div>
                                <div class="ribbon_img-w">
                                    <img sizes="(min-width: 920px) 35vw, (min-width: 520px) 75vw, 60vw" src="http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-77.webp<?php echo pull_image('image.bottom.right'); ?>" srcset="http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-77.webp 1331w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-77-360x541.webp 360w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-77-640x962.webp 640w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-77-319x480.webp 319w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-77-399x600.webp 399w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-77-479x720.webp 479w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-77-532x800.webp 532w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-77-639x960.webp 639w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-77-719x1080.webp 719w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-77-852x1280.webp 852w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-77-958x1440.webp 958w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-77-1065x1600.webp 1065w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-77-1198x1800.webp 1198w">
                                </div>
                                <div class="ribbon_img-w">
                                    <img sizes="(min-width: 920px) 35vw, (min-width: 520px) 75vw, 60vw" src="http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-125.webp<?php echo pull_image('image.top.right'); ?>" srcset="http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-125.webp 1331w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-125-360x541.webp 360w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-125-640x962.webp 640w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-125-319x480.webp 319w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-125-399x600.webp 399w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-125-479x720.webp 479w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-125-532x800.webp 532w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-125-639x960.webp 639w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-125-719x1080.webp 719w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-125-852x1280.webp 852w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-125-958x1440.webp 958w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-125-1065x1600.webp 1065w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-125-1198x1800.webp 1198w">
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="section-shows" theme="secondary" page="home">
                    <div class="img-w">
                        <img src="http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-135.webphttp://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-135.webp<?php echo pull_image('shows.image'); ?>" loading="lazy" srcset="http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-135.webp 1331w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-135-1022x1536.webp 1022w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-135-319x480.webp 319w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-135-426x640.webp 426w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-135-639x960.webp 639w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-135-852x1280.webp 852w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-135-1065x1600.webp 1065w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-135-600x902.webp 600w" sizes="95vw">
                    </div>
                    <div class="header-marquee">
                        <div class="marquee-split">
                            <div class="marquee-block section_header-w">
                                <h2 class="heading-grand"><?php _e( 'See Me', 'ayayves' ); ?> <span><?php _e( 'Live', 'ayayves' ); ?></span></h2>
                            </div>
                        </div>
                    </div>
                    <div class="shows-w">
                        <div class="shows_info-w">
                            <?php
                                $event_query_args = array(
                                    'post_type' => 'event',
                                    'posts_per_page' => 6,
                                    'order' => 'DESC',
                                    'orderby' => 'meta_value',
                                    'meta_key' => 'date_and_time'
                                )
                            ?>
                            <?php $event_query = new WP_Query( $event_query_args ); ?>
                            <?php if ( $event_query->have_posts() ) : ?>
                                <?php while ( $event_query->have_posts() ) : $event_query->the_post(); ?>
                                    <?php PG_Helper_v2::rememberShownPost(); ?>
                                    <?php $dateField = get_field('date_and_time');
$showExpired = false; // Flag to determine whether to show the 'Sold Out' message

if ($dateField) {
    $dateObject = DateTime::createFromFormat('Y-m-d H:i:s', $dateField);
    if ($dateObject) {
        $dateObject->modify('+3 hours');
        $currentDateTime = new DateTime();
        if ($dateObject < $currentDateTime) {
            $showExpired = true; // Set the flag to true if the condition is met
        }
    }
} ?>
                                    <div id="post-<?php the_ID(); ?>" <?php post_class( 'show-item' ); ?>> 
                                        <div class="show-item-inner">
                                            <div class="heading-400">
                                                <?php     $dateField = get_field('date_and_time');
                                                    if ($dateField) {
                                                        $dateObject = DateTime::createFromFormat('Y-m-d H:i:s', $dateField);
                                                        if ($dateObject) {
                                                            echo $dateObject->format('D j M');
                                                        }
                                                } ?>
                                            </div>
                                            <div class="heading-500">
                                                <span><?php echo get_field( 'city_geo' ); ?></span>, <span><?php echo get_field( 'city_indigenous' ); ?></span>
                                            </div>
                                            <?php if ( ! $showExpired ) : ?>
                                                <a href="<?php echo get_field( 'ticket_link' ); ?>" class="button--display tertiary"> <div class="star-w" hidden>
                                                        <svg width="100%" height="100%" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M5.76283 0.711511C5.8388 0.483587 6.1612 0.483588 6.23717 0.711513L7.46047 4.38141C7.48536 4.45607 7.54393 4.51465 7.61859 4.53953L11.2885 5.76283C11.5164 5.8388 11.5164 6.1612 11.2885 6.23717L7.61859 7.46047C7.54393 7.48536 7.48536 7.54393 7.46047 7.61859L6.23717 11.2885C6.1612 11.5164 5.8388 11.5164 5.76283 11.2885L4.53953 7.61859C4.51464 7.54393 4.45607 7.48536 4.38141 7.46047L0.711511 6.23717C0.483587 6.1612 0.483588 5.8388 0.711513 5.76283L4.38141 4.53953C4.45607 4.51464 4.51465 4.45607 4.53953 4.38141L5.76283 0.711511Z" fill="currentColor"></path>
                                                        </svg>
                                                    </div> <div label>
                                                        <?php _e( 'Tickets', 'ayayves' ); ?>
                                                    </div> <div class="star-w">
                                                        <svg width="100%" height="100%" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M5.76283 0.711511C5.8388 0.483587 6.1612 0.483588 6.23717 0.711513L7.46047 4.38141C7.48536 4.45607 7.54393 4.51465 7.61859 4.53953L11.2885 5.76283C11.5164 5.8388 11.5164 6.1612 11.2885 6.23717L7.61859 7.46047C7.54393 7.48536 7.48536 7.54393 7.46047 7.61859L6.23717 11.2885C6.1612 11.5164 5.8388 11.5164 5.76283 11.2885L4.53953 7.61859C4.51464 7.54393 4.45607 7.48536 4.38141 7.46047L0.711511 6.23717C0.483587 6.1612 0.483588 5.8388 0.711513 5.76283L4.38141 4.53953C4.45607 4.51464 4.51465 4.45607 4.53953 4.38141L5.76283 0.711511Z" fill="currentColor"></path>
                                                        </svg>
                                                    </div> </a>
                                            <?php endif; ?>
                                            <?php if ( $showExpired ) : ?>
                                                <div class="button--display disabled tertiary"> 
                                                    <div label>
                                                        <?php _e( 'Sold Out', 'ayayves' ); ?>
                                                    </div>                                                     
                                                </div>
                                            <?php endif; ?>
                                        </div>                                         
                                        <div class="divider">
                                            <div class="divider_fill"></div>
                                            <div class="divider_bg"></div>
                                        </div>
                                    </div>
                                <?php endwhile; ?>
                                <?php wp_reset_postdata(); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </section>
                <section class="section-doublecard">
                    <div class="card-w">
                        <div class="card">
                            <img src="http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-164.webphttp://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-164.webp<?php echo pull_image('doublecard.image.first'); ?>" loading="lazy" srcset="http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-164.webp 1331w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-164-1022x1536.webp 1022w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-164-319x480.webp 319w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-164-426x640.webp 426w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-164-639x960.webp 639w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-164-852x1280.webp 852w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-164-1065x1600.webp 1065w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-164-600x902.webp 600w" sizes="60vw">
                        </div>
                        <div class="card">
                            <img loading="lazy" sizes="50vw" src="<?php echo pull_image('doublecard.image.second'); ?>">
                        </div>
                    </div>
                </section>
                <section class="section-discography">
                    <div class="sticky-w">
                        <div class="image-w">
                            <div class="background-img">
                                <div class="bg-tint"></div>
                                <img src="http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-165-1.webphttp://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-165-1.webp<?php echo pull_image('release.background.image'); ?>" loading="lazy" srcset="http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-165-1.webp 1872w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-165-1-1438x1536.webp 1438w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-165-1-449x480.webp 449w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-165-1-599x640.webp 599w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-165-1-899x960.webp 899w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-165-1-1198x1280.webp 1198w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-165-1-1498x1600.webp 1498w, http://127.0.0.1:8000/wp-content/uploads/GxbrielleMxry-165-1-600x641.webp 600w" sizes="100vw">
                            </div>
                        </div>
                    </div>
                    <?php
                        $discography_home_query_args = array(
                            'post_type' => 'release',
                            'order' => 'DESC',
                            'orderby' => 'meta_value',
                            'meta_key' => 'release_date'
                        )
                    ?>
                    <?php $discography_home_query = new WP_Query( $discography_home_query_args ); ?>
                    <?php if ( $discography_home_query->have_posts() ) : ?>
                        <div class="discography-w">
                            <?php while ( $discography_home_query->have_posts() ) : $discography_home_query->the_post(); ?>
                                <?php PG_Helper_v2::rememberShownPost(); ?>
                                <div class="release-w" href> <a href="<?php echo esc_url( get_permalink() ); ?>" id="post-<?php the_ID(); ?>" <?php post_class( 'release-card' ); ?>> <div class="bg-tint"></div><div class="bg-gradient"></div> <img src="http://127.0.0.1:8000/wp-content/uploads/Serotonin_Cover_Clean.webphttp://127.0.0.1:8000/wp-content/uploads/Serotonin_Cover_Clean.webphttp://127.0.0.1:8000/wp-content/uploads/Serotonin_Cover_Clean.webphttp://127.0.0.1:8000/wp-content/uploads/Serotonin_Cover_Clean.webp<?php $image_id = get_field('cover_art');
echo pull_image($image_id); ?>" srcset="http://127.0.0.1:8000/wp-content/uploads/Serotonin_Cover_Clean.webp 2000w, http://127.0.0.1:8000/wp-content/uploads/Serotonin_Cover_Clean-480x480.webp 480w, http://127.0.0.1:8000/wp-content/uploads/Serotonin_Cover_Clean-600x600.webp 600w, http://127.0.0.1:8000/wp-content/uploads/Serotonin_Cover_Clean-720x720.webp 720w, http://127.0.0.1:8000/wp-content/uploads/Serotonin_Cover_Clean-800x800.webp 800w, http://127.0.0.1:8000/wp-content/uploads/Serotonin_Cover_Clean-960x960.webp 960w, http://127.0.0.1:8000/wp-content/uploads/Serotonin_Cover_Clean-1080x1080.webp 1080w, http://127.0.0.1:8000/wp-content/uploads/Serotonin_Cover_Clean-1280x1280.webp 1280w, http://127.0.0.1:8000/wp-content/uploads/Serotonin_Cover_Clean-1440x1440.webp 1440w, http://127.0.0.1:8000/wp-content/uploads/Serotonin_Cover_Clean-1600x1600.webp 1600w, http://127.0.0.1:8000/wp-content/uploads/Serotonin_Cover_Clean-1800x1800.webp 1800w, http://127.0.0.1:8000/wp-content/uploads/Serotonin_Cover_Clean-360x360.webp 360w, http://127.0.0.1:8000/wp-content/uploads/Serotonin_Cover_Clean-640x640.webp 640w, http://127.0.0.1:8000/wp-content/uploads/Serotonin_Cover_Clean-100x100.webp 100w" alt="Aya Yves is suspended, clothes and all, inside of a clear prism of blue water somewhere in the forest." loading="lazy"> <div class="desc-w">
                                            <div class="heading-300">
                                                <?php the_title(); ?>
                                            </div>
                                            <?php if ( get_field( 'short_description' ) ) : ?>
                                                <div class="p2">
                                                    <?php echo get_field( 'short_description' ); ?>
                                                </div>
                                            <?php endif; ?>
                                            <div class="listen-button-w">
                                                <div class="button--listen" style="opacity: 1;">
                                                    <div class="label" style="translate: none; rotate: none; scale: none; transform: translate(0px, 0px);">
                                                        <?php _e( 'Stream', 'ayayves' ); ?>
                                                    </div>
                                                    <svg width="10" height="10" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg" style="translate: none; rotate: none; scale: none; transform: translate(0px, 0px);">
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M8.005 1.75443H0.375954V0H11V10.6241H9.24557V2.995L1.24057 11L0 9.75943L8.005 1.75443Z" fill="currentColor"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                        </div> </a>
                                </div>
                            <?php endwhile; ?>
                            <?php wp_reset_postdata(); ?>
                        </div>
                    <?php else : ?>
                        <p><?php _e( 'Sorry, no posts matched your criteria.', 'ayayves' ); ?></p>
                    <?php endif; ?>
                </section>                

<?php get_footer(); ?>