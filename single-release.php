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
                                <img loading="lazy" src="https://pinegrow.com/placeholders/img19.jpg<?php $image_id = get_field('cover_art');
echo pull_image($image_id); ?>">
                                <video playsinline="" loop="true" muted="true" autoplay="" height="100%" preload="auto" object-fit="cover" data-src="<?php echo get_field( 'raw_music_video_link' ); ?>">
</video>
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
} ?>
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
                        <div class="divider">
                            <div class="divider_fill"></div>
                            <div class="divider_bg"></div>
                        </div>
                        <div class="feature_grid"><a class="button--display" data="streamlink" id="post-<?php the_ID(); ?>"> <div class="star-w" hidden>
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
                        <div class="release-slider" href>
                            <div class="slider-header">
                                <div class="heading-w">
                                    <h2 class="heading-800"><?php _e( 'Catalogue', 'ayayves' ); ?></h2>
                                    <div class="heading-600" hide-mobile="true">
                                        <?php _e( '(Releases)', 'ayayves' ); ?>
                                    </div>
                                </div>
                                <div class="swiper-arrow-w" mobile="false">
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
                                            <?php PG_Helper_v2::rememberShownPost(); ?>
                                            <div role="listitem" id="post-<?php the_ID(); ?>" <?php post_class( 'slider-w swiper-slide' ); ?>>
                                                <a href="<?php echo esc_url( get_permalink() ); ?>" id="post-<?php the_ID(); ?>" <?php post_class( 'release-card' ); ?>> <div class="bg-tint"></div><div class="bg-gradient"></div> <img src="http://127.0.0.1:8000/wp-content/uploads/Serotonin_Cover_Clean.webphttp://127.0.0.1:8000/wp-content/uploads/Serotonin_Cover_Clean.webphttp://127.0.0.1:8000/wp-content/uploads/Brave_Cover_Clean.webp<?php $image_id = get_field('cover_art');
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
                            </div>
                            <div class="swiper-arrow-w" mobile="true">
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
                        </div>
                    </div>
                </section>                

<?php get_footer(); ?>