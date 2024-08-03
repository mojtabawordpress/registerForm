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
            echo 'hello';
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

