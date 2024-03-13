<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
global $post;

$short_description = apply_filters( 'woocommerce_short_description', $post->post_excerpt );

if ( ! $short_description ) {
	return;
}

?>
<div class="p1" data="description">
    <?php echo $short_description; ?>
</div>