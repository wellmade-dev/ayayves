<?php
    defined( 'ABSPATH' ) || exit;
    
if ( $max_value && $min_value === $max_value ) { ?>
<div class="quantity hidden">
    <input type="hidden" id="<?php echo esc_attr( $input_id ); ?>" class="qty" name="<?php echo esc_attr( $input_name ); ?>" value="<?php echo esc_attr( $min_value ); ?>" />
</div>
<?php
} else {
$label = ! empty( $args['product_name'] ) ? sprintf( esc_html__( '%s quantity', 'woocommerce' ), wp_strip_all_tags( $args['product_name'] ) ) : esc_html__( 'Quantity', 'woocommerce' );
?>
<div class="quantity quantity-w">
    <?php do_action( 'woocommerce_before_quantity_input_field' ); ?>
    <input type="number" id="<?php echo esc_attr( $input_id ); ?>" class="<?php echo esc_attr( join( ' ', (array) $classes ) ); ?> input-text qty text" name="<?php echo esc_attr( $input_name ); ?>" value="<?php echo esc_attr( $input_value ); ?>" aria-label="Product quantity" size="4" min="<?php echo esc_attr( $min_value ); ?>" max="<?php echo esc_attr( 0 < $max_value ? $max_value : '' ); ?>" step="<?php echo esc_attr( $step ); ?>" placeholder="<?php echo esc_attr( $placeholder ); ?>" inputmode="<?php echo esc_attr( $inputmode ); ?>" autocomplete="off" title="<?php echo esc_attr_x( 'Qty', 'Product quantity input tooltip', 'woocommerce' ); ?>"/>
    <?php do_action( 'woocommerce_after_quantity_input_field' ); ?>
</div>
<?php } ?>    
