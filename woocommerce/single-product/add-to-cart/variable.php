<?php
defined('ABSPATH') || exit;

global $product;

// This should already be part of your WooCommerce template or function file.
if (!$product->is_purchasable()) {
    return;
}

// Assuming PG_WC_Helper::getQuantityFieldSettings($product) is defined elsewhere and required for your form.
$cart_quantity_settings = PG_WC_Helper::getQuantityFieldSettings($product);

$out_of_stock = empty( $available_variations ) && false !== $available_variations;                

$attribute_keys  = array_keys( $attributes );
$variations_json = wp_json_encode( $available_variations );
$variations_attr = function_exists( 'wc_esc_json' ) ? wc_esc_json( $variations_json ) : _wp_specialchars( $variations_json, ENT_QUOTES, 'UTF-8', true );

// Make sure this function is placed where it's appropriately loaded before being called.
function unavailable_variants($product) {
    if (!($product && $product->is_type('variable'))) {
        return [];
    }

    $out_of_stock = [];
    $available_variations = $product->get_available_variations();

    foreach ($available_variations as $variation) {
        if (!$variation['is_in_stock']) {
            $variant_id = $variation['variation_id'];
            $variant = wc_get_product($variant_id);
            if ($variant) {
                $full_name = $variant->get_name();
                $variant_name = substr($full_name, strrpos($full_name, ' - ') + 3);
                $out_of_stock[] = $variant_name;
            }
        }
    }

    return $out_of_stock;
}

$out_of_stock = unavailable_variants($product);

if (!empty($out_of_stock)) {
    echo "<script>console.log('Inline Pass: Found out-of-stock variant names: ', " . json_encode($out_of_stock) . ");</script>";
    echo "<script type='text/javascript'>var outOfStockVariantNames = " . json_encode($out_of_stock) . ";</script>";
} else {
    // This else block ensures that the script knows it's okay to proceed without out-of-stock variants.
    echo "<script>console.log('Inline Fail: No out-of-stock variants found or not a variable product');</script>";
}
?>


<?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>

<form class="cart-form variations_form" method="post" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" enctype="multipart/form-data" data-product-id="<?php echo absint( $product->get_id() ); ?>" data-product_variations="<?php echo esc_attr( $variations_attr ); ?>">
    <?php foreach ( $attributes as $attribute_name => $options ) : ?>
        <div class="variant-option variations">
            <div class="wc-variant-selector">
                <label for="<?php echo esc_attr( sanitize_title( $attribute_name ) ); ?>">
                    <?php echo wc_attribute_label( $attribute_name ); ?>
                </label>
                <?php 
                    ob_start();
                    wc_dropdown_variation_attribute_options(
                        array(
                            'options'   => $options,
                            'attribute' => $attribute_name,
                            'product'   => $product,
                        )
                    );
                    $dropdown_html = ob_get_clean();
                    // Convert attribute name to a proper format for the name and data-attribute_name attributes
                    $sanitized_attribute_name = sanitize_title( $attribute_name );
                    $attribute_name_for_form = 'attribute_' . $sanitized_attribute_name;

                    // Using a simple str_replace to adjust the dropdown's name and data-attribute_name
                    $dropdown_html = str_replace( 'name="'.$sanitized_attribute_name.'"', 'name="'.$attribute_name_for_form.'"', $dropdown_html );
                    $dropdown_html = str_replace( 'data-attribute_name="'.$sanitized_attribute_name.'"', 'data-attribute_name="'.$attribute_name_for_form.'"', $dropdown_html );

                    echo $dropdown_html; 
                ?>
            </div>
        </div>
    <?php endforeach; ?>
    <?php do_action( 'woocommerce_after_variations_table' ); ?>
    <?php if( end( $attribute_keys ) === $attribute_name ) : ?>
        <a class="reset_variations" href="#"><?php _e( 'Clear', 'yourtextdomain' ); ?></a>
    <?php endif; ?>
    <div class="single_variation_wrap woocommerce-variation-add-to-cart">
        <div class="accordion-group-w">
            <div class="divider">
                <div class="divider_fill"></div>
                <div class="divider_bg"></div>
            </div>
            <div class="accordion" aria-expanded="false">
                <div class="accordion-button" role="button" aria-expanded="false">
                    <div class="heading-300">
                        <?php _e( 'Description', 'ayayves' ); ?>
                    </div>
                    <div class="disclosure-icon">
                        <div class="line"></div>
                        <div class="line" style="perspective: 0px;"></div>
                    </div>
                </div>
                <div class="content">
                    <?php the_content(); ?>
                </div>
                <div class="divider">
                    <div class="divider_fill"></div>
                    <div class="divider_bg"></div>
                </div>
            </div>
        </div>
        <?php
            do_action( 'woocommerce_before_single_variation' );
            do_action( 'woocommerce_single_variation' );
            do_action( 'woocommerce_after_single_variation' );
         ?>
    </div>
    <?php do_action( 'woocommerce_after_variations_form' ); ?>
</form>

<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>