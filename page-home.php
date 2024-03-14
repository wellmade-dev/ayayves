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
                        <?php $releaseDate = get_field('release_date');
                            if ($releaseDate) {
                                $dateObject = DateTime::createFromFormat('M j, Y', $releaseDate);
                                if ($dateObject) {
                                    $currentDateTime = new DateTime();
                                    if ($dateObject < $currentDateTime) {
                                        $released = true; 
                                    }
                                }
                            }
                        ?>
                        <section class="home section-hero" theme="overlay">
                            <div class="background-w">
                                <div class="bg-tint"></div>
                                <?php if ( !get_field('raw_music_video_link') && !get_field('key_art') ) : ?>
                                    <img class="bg-content" src="<?php $image_id = get_field('cover_art'); echo pull_image($image_id); ?>"/>
                                <?php endif; ?>
                                <?php if ( !get_field('raw_music_video_link') && get_field('key_art') ) : ?>
                                    <img class="bg-content" src="<?php $image_id = get_field('key_art'); echo pull_image($image_id); ?>"/>
                                <?php endif; ?>
                                <?php if ( get_field( 'raw_music_video_link' ) ) : ?>
                                    <div class="bg-content video-w">
                                        <img loading="lazy" src="<?php $image_id = get_field('cover_art'); echo pull_image($image_id); ?>">
                                        <video playsinline="" loop="true" muted="true" autoplay="" height="100%" preload="auto" object-fit="cover" data-src="<?php echo get_field( 'raw_music_video_link' ); ?>"> </video>
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
                                <?php get_template_part ('/partials/components/divider'); ?>
                                <div class="feature_grid">
                                    <a class="button--display" data="streamlink" id="post-<?php the_ID(); ?>"> <div class="star-w" hidden>
                                            <?php get_template_part( '/partials/svg/star' ); ?>
                                        </div>
                                        <div label>
                                            <?php if ( $released ) : ?>
                                                <span><?php _e( 'Listen', 'ayayves' ); ?></span>
                                            <?php endif; ?>
                                            <?php if ( ! $released ) : ?>
                                                <span><?php _e( 'Pre-Save', 'ayayves' ); ?></span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="star-w">
                                            <?php get_template_part( '/partials/svg/star' ); ?>
                                        </div> 
                                    </a>
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
                                        <?php get_template_part( '/partials/components/slider-arrows', null, array('is_mobile' => false)) ?>
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
                                                    <div role="listitem" <?php wc_product_class( 'slider-w swiper-slide' , $product ); ?> id="post-<?php the_ID(); ?>">
                                                        <div class="merch-card">
                                                            <div class="info-w">
                                                                <div class="desc-w"><a class="title-link" href="<?php echo esc_url( apply_filters( 'woocommerce_loop_product_link', get_the_permalink(), $product ) ); ?>"><?php wc_get_template( 'loop/title.php' ) ?></a>
                                                                    <?php get_template_part ('/partials/components/divider'); ?>
                                                                    <div class="meta-w">
                                                                        <?php $terms = get_the_terms( get_the_ID(), 'product_cat' ) ?>
                                                                        <?php if( !empty( $terms ) ) : ?>
                                                                            <?php foreach( $terms as $term_i => $term ) : ?>
                                                                                <?php if( $term_i == 0 ) : ?>
                                                                                    <div class="heading-300" rel="tag" data="category">
                                                                                        <?php echo $term->name; ?>
                                                                                    </div>
                                                                                <?php endif; ?>
                                                                            <?php endforeach; ?>
                                                                        <?php endif; ?>
                                                                        <?php wc_get_template( 'loop/short-description.php' ) ?>
                                                                    </div>
                                                                </div>
                                                                <a href="<?php echo esc_url( apply_filters( 'woocommerce_loop_product_link', get_the_permalink(), $product ) ); ?>" class="button--display secondary">
                                                                    <div class="star-w" hidden>
                                                                        <?php get_template_part( '/partials/svg/star' ); ?>
                                                                    </div> <div label>
                                                                        <?php _e( 'Shop', 'ayayves' ); ?>
                                                                    </div> 
                                                                    <div class="star-w">
                                                                        <?php get_template_part( '/partials/svg/star' ); ?>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                            <a href="<?php echo esc_url( apply_filters( 'woocommerce_loop_product_link', get_the_permalink(), $product ) ); ?>" class="img-w"><img loading="lazy" class="img" src="<?php $image_id = get_post_thumbnail_id( $product->get_id() ); echo pull_image($image_id); ?>" decoding="async" sizes='360px'></a>
                                                        </div>
                                                    </div>
                                                <?php endwhile; ?>
                                                <?php wp_reset_postdata(); ?>
                                            </div>
                                        <?php else : ?>
                                            <p><?php _e( 'Sorry, no posts matched your criteria.', 'ayayves' ); ?></p>
                                        <?php endif; ?>
                                    </div>
                                    <?php get_template_part( '/partials/components/slider-arrows', null, array('is_mobile' => true)) ?>
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
                                    <img src="<?php echo pull_image('image.bottom.left'); ?>" sizes="(min-width: 920px) 35vw, (min-width: 520px) 75vw, 60vw">
                                </div>
                                <div class="ribbon_img-w">
                                    <img src="<?php echo pull_image('image.top.left'); ?>" sizes="(min-width: 920px) 35vw, (min-width: 520px) 75vw, 60vw">
                                </div>
                                <div class="ribbon_img-w">
                                    <img src="<?php echo pull_image('image.bottom.left'); ?>" sizes="(min-width: 920px) 35vw, (min-width: 520px) 75vw, 60vw">
                                </div>
                                <div class="ribbon_img-w">
                                    <img src="<?php echo pull_image('image.top.left'); ?>" sizes="(min-width: 920px) 35vw, (min-width: 520px) 75vw, 60vw">
                                </div>
                            </div>
                            <div class="ribbon">
                                <div class="ribbon_img-w">
                                    <img src="<?php echo pull_image('image.bottom.center'); ?>" sizes="(min-width: 920px) 35vw, (min-width: 520px) 75vw, 60vw">
                                </div>
                                <div class="ribbon_img-w">
                                    <img src="<?php echo pull_image('image.top.center'); ?>" sizes="(min-width: 920px) 35vw, (min-width: 520px) 75vw, 60vw">
                                </div>
                                <div class="ribbon_img-w">
                                    <img src="<?php echo pull_image('image.bottom.center'); ?>" sizes="(min-width: 920px) 35vw, (min-width: 520px) 75vw, 60vw">
                                </div>
                                <div class="ribbon_img-w">
                                    <img src="<?php echo pull_image('image.top.center'); ?>" sizes="(min-width: 920px) 35vw, (min-width: 520px) 75vw, 60vw">
                                </div>
                            </div>
                            <div class="ribbon">
                                <div class="ribbon_img-w">
                                    <img src="<?php echo pull_image('image.bottom.right'); ?>" sizes="(min-width: 920px) 35vw, (min-width: 520px) 75vw, 60vw">
                                </div>
                                <div class="ribbon_img-w">
                                    <img src="<?php echo pull_image('image.top.right'); ?>" sizes="(min-width: 920px) 35vw, (min-width: 520px) 75vw, 60vw">
                                </div>
                                <div class="ribbon_img-w">
                                    <img src="<?php echo pull_image('image.bottom.right'); ?>" sizes="(min-width: 920px) 35vw, (min-width: 520px) 75vw, 60vw">
                                </div>
                                <div class="ribbon_img-w">
                                    <img src="<?php echo pull_image('image.top.right'); ?>" sizes="(min-width: 920px) 35vw, (min-width: 520px) 75vw, 60vw">
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="section-shows" theme="secondary" page="home">
                    <div class="img-w">
                        <img src="<?php echo pull_image('shows.image'); ?>" loading="lazy" sizes="95vw">
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
                                        } 
                                    ?>
                                    <div id="post-<?php the_ID(); ?>" <?php post_class( 'show-item' ); ?>> 
                                        <div class="show-item-inner">
                                            <div class="heading-400">
                                                <?php     $dateField = get_field('date_and_time');
                                                    if ($dateField) { 
                                                        $dateObject = DateTime::createFromFormat('Y-m-d H:i:s', $dateField);
                                                        if ($dateObject) {
                                                            echo $dateObject->format('D j M');
                                                        }
                                                    } 
                                                ?>
                                            </div>
                                            <div class="heading-500">
                                                <span><?php echo get_field( 'city_geo' ); ?></span>, <span><?php echo get_field( 'city_indigenous' ); ?></span>
                                            </div>
                                            <?php if ( ! $showExpired ) : ?>
                                                <a href="<?php echo get_field( 'ticket_link' ); ?>" class="button--display tertiary">
                                                    <div class="star-w" hidden>
                                                        <?php get_template_part( '/partials/svg/star' ); ?>
                                                    </div> 
                                                    <div label>
                                                        <?php _e( 'Tickets', 'ayayves' ); ?>
                                                    </div> <div class="star-w">
                                                        <?php get_template_part( '/partials/svg/star' ); ?>
                                                    </div> 
                                                </a>
                                            <?php endif; ?>
                                            <?php if ( $showExpired ) : ?>
                                                <div class="button--display disabled tertiary"> 
                                                    <div label>
                                                        <?php _e( 'Sold Out', 'ayayves' ); ?>
                                                    </div>                                                     
                                                </div>
                                            <?php endif; ?>
                                        </div>                                         
                                        <?php get_template_part ('/partials/components/divider'); ?>
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
                            <img src="<?php echo pull_image('doublecard.image.first'); ?>" loading="lazy" sizes="60vw">
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
                                <img src="<?php echo pull_image('release.background.image'); ?>" loading="lazy" sizes="100vw">
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
                                <div class="release-w"> 
                                    <?php get_template_part( '/partials/components/release-card' ); ?>
                                </div>
                            <?php endwhile; ?>
                            <?php wp_reset_postdata(); ?>
                        </div>
                    <?php else : ?>
                        <p><?php _e( 'Sorry, no posts matched your criteria.', 'ayayves' ); ?></p>
                    <?php endif; ?>
                </section>                

<?php get_footer(); ?>