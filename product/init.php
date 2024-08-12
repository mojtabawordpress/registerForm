<?php
if (!defined('ABSPATH')) {
    exit;
}
function my_custom_post_product()
{
    $labels = [
        'name' => 'محصولات',
        'singular_name' => 'محصول',
        'add_new' => 'افزودن',
        'add_new_item' => 'افزودن یک محصول',
        'edit_item' => 'ویرایش یک محصول',
        'new_item' => 'محصول جدید',
        'all_items' => 'همه محصولات',
        'view_item' => 'دیدن محصول',
        'search_items' => 'جستجو در محصولات',
        'not_found' => 'محصولی پیدا نشد',
        'not_found_in_trash' => 'محصولی در سطل زباله پیدا نشد',
        'parent_item_colon' => '’',
        'menu_name' => 'محصولات'
    ];

    $args = [
        'labels' => $labels,
        'description' => 'تمامی محصولات سایت',
        'public' => true,
        'menu_position' => 5,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'comments'),
//        'supports' => array('title','editor'),
        'has_archive' => true,
    ];

    register_post_type('product', $args);
}

add_action('init', 'my_custom_post_product');

add_action('add_meta_boxes', 'add_meta_box_price');

function add_meta_box_price()
{
    add_meta_box(
        'product-price',
        'قیمت محصول',
        function () {
            $prices = get_post_meta(get_the_ID(), 'prices', true);
            include_once 'views/metabox_price.php';
        },
        'product'
    );
}

add_action('save_post_product', 'save_prices');
function save_prices($productId)
{
    if (isset($_POST['price'])) {
        $price = $_POST['price'];
        update_post_meta($productId, 'prices', $price);
    }
}

add_action('save_post_product', 'add_counter');

function add_counter($productId)
{
    $counter = intval(get_post_meta($productId, 'edit_count', true));
    $counter++;
    update_post_meta($productId, 'edit_count', $counter);
}