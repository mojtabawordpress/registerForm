<?php
if (!defined('ABSPATH')) {
    exit;
}
?>
<div class="container-price">
    <div class="row-price">
        <label for='product-price'>قیمت محصول:</label>
        <input id='product-price' type="text" name="price">
    </div>
</div>

<button id="button-plus" type="button" class="button button-primary">افزودن</button>

<script>

    jQuery(document).ready(function ($) {
        $('#button-plus').on('click', function () {
            let row = $('.row-price').first().clone().appendTo(".container-price");
        });
    });
</script>