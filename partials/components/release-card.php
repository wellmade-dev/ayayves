<a href="<?php echo esc_url( get_permalink() ); ?>" id="post-<?php the_ID(); ?>" <?php post_class( 'release-card' ); ?>>
    <div class="bg-tint"></div>
    <div class="bg-gradient"></div>
    <img src="<?php $image_id = get_field('cover_art'); echo pull_image($image_id); ?>" loading="lazy">
    <div class="desc-w">
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
                <?php get_template_part( '/partials/svg/arrow-diagonal', null, array( 'width' => '10' ) ); ?>
            </div>
        </div>
    </div>
</a>