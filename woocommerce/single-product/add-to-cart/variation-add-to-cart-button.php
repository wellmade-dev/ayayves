<?php
defined( 'ABSPATH' ) || exit;

global $product;
?>
<div class="quantity woocommerce-variation-add-to-cart">
    <?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>
    <?php do_action( 'woocommerce_before_add_to_cart_quantity' );
        
        	woocommerce_quantity_input(
        		array(
        			'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
        			'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
        			'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) ) : $product->get_min_purchase_quantity(),
        		)
        	);
        
    	do_action( 'woocommerce_after_add_to_cart_quantity' ); ?>
    <div class="atc-w">
        <div class="atc-foil">
            <div class="button--marquee
                <?php
                // Assuming $product is a WC_Product_Variable object
                $all_variants_out_of_stock = true;
                $available_variants = $product->get_available_variations();

                foreach ($available_variants as $variant) {
                    $variant_obj = wc_get_product($variant['variation_id']);
                    if ($variant_obj && $variant_obj->is_in_stock()) {
                        $all_variants_out_of_stock = false;
                        break;
                    }
                }

                echo $all_variants_out_of_stock ? ' disabled' : '';
                ?>">
                <div class="marquee-split">
                    <div class="marquee-block">
                        <?php
                        // Assuming $product is a WC_Product_Variable object
                        $variation_id = isset($_POST['variation_id']) ? $_POST['variation_id'] : 0;
                        $variation = $variation_id ? wc_get_product($variation_id) : false;

                        // Define an array with all the necessary information
                        $items = [
                            [
                                'check' => $variation ? $variation->is_in_stock() : $product->is_in_stock(),
                                'trueText' => 'Add to Cart',
                                'falseText' => 'Out of Stock',
                            ],
                            [
                                'check' => $variation ? $variation->is_in_stock() : $product->is_in_stock(),
                                'trueText' => 'Bag It',
                                'falseText' => 'Limited Drop',
                            ]
                        ];

                        // Iterate over the items array to output the conditional texts and SVGs
                        foreach ($items as $item) {
                            // Determine the text based on the condition
                            $text = $item['check'] ? $item['trueText'] : $item['falseText'];
                            // Translate the text
                            $translated_text = __($text, 'ayayves');
                            ?>
                            <div><?php echo esc_html($translated_text); ?></div>
                            <svg width="0.875rem" height="100%" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5.76283 0.711511C5.8388 0.483587 6.1612 0.483588 6.23717 0.711513L7.46047 4.38141C7.48536 4.45607 7.54393 4.51465 7.61859 4.53953L11.2885 5.76283C11.5164 5.8388 11.5164 6.1612 11.2885 6.23717L7.61859 7.46047C7.54393 7.48536 7.48536 7.54393 7.46047 7.61859L6.23717 11.2885C6.1612 11.5164 5.8388 11.5164 5.76283 11.2885L4.53953 7.61859C4.51464 7.54393 4.45607 7.48536 4.38141 7.46047L0.711511 6.23717C0.483587 6.1612 0.483588 5.8388 0.711513 5.76283L4.38141 4.53953C4.45607 4.51464 4.51465 4.45607 4.53953 4.38141L5.76283 0.711511Z" fill="currentColor"></path>
                            </svg>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="edge-gradient-w">
                    <div class="gradient"></div>
                    <div class="gradient"></div>
                </div>
            </div>
        </div>
        <button type="submit" class="single_add_to_cart_button button alt button--atc" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>">
            <?php echo esc_html( $product->single_add_to_cart_text() ); ?>
        </button>
        <?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
    </div>
    <input type="hidden" name="add-to-cart" value="<?php echo absint( $product->get_id() ); ?>"/>
    <input type="hidden" name="product_id" value="<?php echo absint( $product->get_id() ); ?>"/>
    <input type="hidden" name="variation_id" class="variation_id" value="0"/>
</div>
