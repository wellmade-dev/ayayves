<?php
defined( 'ABSPATH' ) || exit;
?>

    <script type="text/template" id="tmpl-variation-template">
        <div class="woocommerce-variation-description">{{{data.variation.variation_description}}}</div>
        <div class="woocommerce-variation-price">{{{data.variation.price_html}}}</div>
        <div class="woocommerce-variation-availability">{{{data.variation.availability_html}}}</div>
    </script>
    <script type="text/template" id="tmpl-unavailable-variation-template">
        <div class="woocommerce-variation-availability"></div>
    </script>

