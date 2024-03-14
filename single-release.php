<?php get_header(); ?>

                <section class="section-hero" theme="overlay">
                    <div class="background-w">
                        <div class="bg-tint"></div>
                        <?php if ( !get_field('raw_music_video_link') && !get_field('key_art') ) : ?>
                            <img class="bg-content" src="<?php echo PG_Image::getUrl( get_field( 'cover_art' ), 'large' ) ?>"/>
                        <?php endif; ?>
                        <?php if ( !get_field('raw_music_video_link') && get_field('key_art') ) : ?>
                            <img class="bg-content" src="<?php echo PG_Image::getUrl( get_field( 'key_art' ), 'large' ) ?>"/>
                        <?php endif; ?>
                        <?php if ( get_field( 'raw_music_video_link' ) ) : ?>
                            <div class="bg-content video-w">
                                <img loading="lazy" <?php $image_id = get_field('cover_art');echo pull_image($image_id); ?>">
                                <video playsinline="" loop="true" muted="true" autoplay="" height="100%" preload="auto" object-fit="cover" data-src="<?php echo get_field( 'raw_music_video_link' ); ?>"></video>
                            </div>
                        <?php endif; ?>
                    </div>
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
                    <div role="listitem" class="subsection-feature">
                        <div class="feature_grid" release-status>
                            <h2 class="heading-900" data="title"><?php the_title(); ?></h2>
                            <div class="meta-w">
                                <?php if ( get_field( 'release_type' ) ) : ?>
                                    <div data="release-type" class="heading-300">
                                        <?php echo get_field( 'release_type' ); ?>
                                    </div>
                                <?php endif; ?>
                                <?php if ( get_field( 'short_description' ) ) : ?>
                                    <div class="p1" data="subtitle">
                                        <?php echo get_field( 'short_description' ); ?>
                                    </div>
                                <?php endif; ?>
                                <div class="p1" data="release-date">
                                    <?php if ( !$released ) : ?>
                                        <span data="release-status"><?php _e( 'Releasing', 'ayayves' ); ?> </span>
                                    <?php endif; ?>
                                    <?php if ( $released ) : ?>
                                        <span data="release-status"><?php _e( 'Released', 'ayayves' ); ?> </span>
                                    <?php endif; ?><span><?php echo get_field( 'release_date' ); ?></span>
                                </div>
                            </div>
                        </div>
                        <?php get_template_part ('/partials/components/divider'); ?>
                        <div class="feature_grid"><a class="button--display" data="streamlink" id="post-<?php the_ID(); ?>"> <div class="star-w" hidden>
                                    <?php get_template_part( '/partials/svg/star' ); ?>
                                </div><div label>
                                    <?php if ( $released ) : ?>
                                        <span><?php _e( 'Listen', 'ayayves' ); ?></span>
                                    <?php endif; ?>
                                    <?php if ( ! $released ) : ?>
                                        <span><?php _e( 'Pre-Save', 'ayayves' ); ?></span>
                                    <?php endif; ?>
                                </div><div class="star-w">
                                    <?php get_template_part( '/partials/svg/star' ); ?>
                                </div> </a>
                            <div class="p1" data="subtitle" style="align-self: center;">
                                <?php _e( 'Scroll to explore', 'ayayves' ); ?>
                            </div>
                        </div>
                    </div>
                    <div class="subsection-slider">
                        <div class="release-slider" href>
                            <div class="slider-header">
                                <div class="heading-w">
                                    <h2 class="heading-800"><?php _e( 'Catalogue', 'ayayves' ); ?></h2>
                                    <div class="heading-600" hide-mobile="true">
                                        <?php _e( '(Releases)', 'ayayves' ); ?>
                                    </div>
                                </div>
                                <?php get_template_part( '/partials/components/slider-arrows', null, array('is_mobile' => false)) ?>
                            </div>
                            <div class="slider swiper">
                                <?php
                                    $archive_release_query_args = array(
                                        'post_type' => 'release',
                                        'nopaging' => true,
                                        'order' => 'ASC',
                                        'orderby' => 'date'
                                    )
                                ?>
                                <?php $archive_release_query = new WP_Query( $archive_release_query_args ); ?>
                                <?php if ( $archive_release_query->have_posts() ) : ?>
                                    <div role="list" class="slider-rail swiper-wrapper">
                                        <?php while ( $archive_release_query->have_posts() ) : $archive_release_query->the_post(); ?>
                                            <div role="listitem" id="post-<?php the_ID(); ?>" <?php post_class( 'slider-w swiper-slide' ); ?>>
                                                <?php get_template_part( '/partials/components/release-card' ); ?>
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

<?php get_footer(); ?>