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
                                        <?php PG_Helper_v2::rememberShownPost(); ?>
                                        <div role="listitem" id="post-<?php the_ID(); ?>" <?php post_class( 'slider-w swiper-slide' ); ?>><a href="<?php echo esc_url( get_permalink() ); ?>" id="post-<?php the_ID(); ?>" <?php post_class( 'release-card' ); ?>> <div class="bg-tint"></div><div class="bg-gradient"></div> <img src="<?php $image_id = get_field('cover_art'); echo pull_image($image_id); ?>" loading="lazy"> <div class="desc-w">
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