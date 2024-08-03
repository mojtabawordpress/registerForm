<?php
/*
Plugin Name: پلاگین اقساطی محصولات
Plugin URI: https://installment.com/
Description: مدیریت محصولات و فروش آن ها بصورت اقساطی
Version: 1.0.0
Requires at least: 5.8
Requires PHP: 7.4
Author: Mojtaba Fallah
Author URI: https://github.com/mojtabafallah
Text Domain: installment
*/

add_action('admin_menu', function () {
    add_menu_page('محصولات اقساطی',
        'اقساط',
        'manage_options',
        'installment',
        function () {
            echo "hello world";
        },
        'dashicons-admin-site',
        1);

    add_submenu_page('installment',
        'اضافه کردن',
        'اضافه کردن',
        'manage_options',
        'installment_add',
        function () {
            echo 'tetetet';
        });

}, 15);

//Add shortcodes

add_shortcode('academy-form', 'show_form');

function show_form()
{
    if (isset($_POST['send'])) {

        if (!isset($_POST['f_name'], $_POST['l_name'], $_POST['nonce_field'])) {
            echo "error";
            return;
        }

        if (trim($_POST['f_name']) == "" || trim($_POST['l_name']) == "") {
            echo "error empty";
            return;
        }

        if (!wp_verify_nonce($_POST['nonce_field'],'send_form_register')){

            echo "error nonce";
            return;
        }

        echo "ok";


    }
    ?>
    <form action="" method="post">
        <?php wp_nonce_field('send_form_register','nonce_field') ?>
        <label for="f_name">نام:</label><input pattern="[A-Za-z]" id="f_name" name="f_name" type="text">
        <label for="l_name">فامیلی:</label><input id="l_name" name="l_name" type="text">
        <button name="send">ثبت</button>
    </form>
    <?php
}
