<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
global $product;
?>
<div class="<?php echo esc_attr( apply_filters( 'woocommerce_product_price_class', 'price' ) ); ?> heading-300 price" data="price">
    <?php if( !$product->is_on_sale() ) : ?>
        <div class="amount">
            <?php echo PG_WC_Helper::getPrice( $product, 'regular' ); ?>
        </div>
    <?php endif; ?>
    <?php if( $product->is_on_sale() ) : ?>
        <div class="amount">
            <?php echo PG_WC_Helper::getPrice( $product, 'sale' ); ?>
        </div>
    <?php endif; ?>
    <?php if( $product->is_on_sale() ) : ?>
        <div class="strikeout">
            <?php echo PG_WC_Helper::getPrice( $product, 'regular' ); ?>
        </div>
    <?php endif; ?>
</div>