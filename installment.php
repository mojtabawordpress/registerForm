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

function show_form($att, $content)
{
    $color = "#fff";
    if (isset($att['color'])) {
        $color = $att['color'];
    }

    $title = 'عنوان پیش فرض';
    if (isset($att['title'])) {
        $title = $att['title'];
    }

    if (isset($_POST['send'])) {

        if (!isset($_POST['f_name'], $_POST['l_name'], $_POST['nonce_field'])) {
            echo "error";
            return;
        }

        if (trim($_POST['f_name']) == "" || trim($_POST['l_name']) == "") {
            echo "error empty";
            return;
        }

        if (!wp_verify_nonce($_POST['nonce_field'], 'send_form_register')) {
            echo "error nonce";
            return;
        }

        echo "ok";
    }
    ?>
    <h5><?php echo $title ?></h5>
    <form action="" method="post" style="background-color: <?php echo $color ?>">
        <?php wp_nonce_field('send_form_register', 'nonce_field') ?>
        <label for="f_name">نام:</label><input pattern="[A-Za-z]" id="f_name" name="f_name" type="text">
        <label for="l_name">فامیلی:</label><input id="l_name" name="l_name" type="text">
        <button name="send">ثبت</button>
    </form>
    <?php
}

//1-Add meta box to posts
add_action('add_meta_boxes', 'add_meta_box_button', 10, 2);
function add_meta_box_button($post, $arg)
{
    add_meta_box('post-button',
        'دکمه لینک',
        function () {
        $nameButton = get_post_meta(get_the_ID(), 'button_name',true);
            ?>
            <label for="name-button">متن دکمه</label>
            <input id="name-button" type="text" name="name_button" value="<?php echo $nameButton?>">
            <label for="link-button">لینک دکمه</label>
            <input id="link-button" type="url" name="link_button">
            <?php
        },
        'post',
        'normal',
        'high'
    );
}

//2- save data
add_action('save_post', 'save_button_data');
function save_button_data($postId)
{
    if (isset($_POST['name_button'])){
//        add_post_meta($postId,'button_name',$_POST['name_button']);
        update_post_meta(get_the_ID(),'button_name',$_POST['name_button']);
    }

    if (isset($_POST['link_button'])){
//        add_post_meta($postId, 'button_link', $_POST['link_button']);
        update_post_meta($postId, 'button_link', $_POST['link_button']);
    }
}