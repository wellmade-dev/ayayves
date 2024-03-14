<?php get_header(); ?>

                <section class="section-release-archive">
                    <div class="archive-marquee">
                        <div class="marquee-split">
                            <div class="flexed marquee-block">
                                <h2 class="heading-grand"><?php _e( 'Catalogue', 'ayayves' ); ?></h2>
                                <div class="heading-grand serif">
                                    <?php _e( 'Discography', 'ayayves' ); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="archive release-slider">
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
                        <div class="arrow-counter-w">
                            <?php get_template_part( '/partials/components/slider-arrows', null, array( 'is_bottom' => true ) ); ?>
                            <div hide-mobile="true" class="counter">
                                <?php _e( '(1 of 14)', 'ayayves' ); ?>
                            </div>
                        </div>
                    </div>
                </section>                

<?php get_footer(); ?>