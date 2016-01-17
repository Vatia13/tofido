<?php
/*
Plugin Name: Custom post bottom
Description: To add some extra content for WP posts
Version: 0.1
Author: Vati Child
Author URI: https://www.facebook.com/vatia13
*/
if (!defined('ABSPATH')) exit;

function custom_content_one($atts){
    global $wpdb;
    $postid = get_the_ID();
    $table_name = $wpdb->prefix . "page_bottom_content";
    if($postid > 0){
        $check = $wpdb->get_var("SELECT count(id) FROM {$table_name} WHERE status=0 and page_id='{$postid}'");
    }
    $sql_res = ($check > 0) ? ' and page_id='.$postid : ' and page_id=0';

    $result = $wpdb->get_results("SELECT * FROM {$table_name} WHERE status=0 {$sql_res} LIMIT 1");

    if($atts[0] == 1){
        echo $result[0]->content1;
    }
    if($atts[0] == 2){
        echo $result[0]->content2;
    }
}
add_shortcode('custom_content','custom_content_one');
function custom_content_bottom(){
    global $wpdb;
    $message = array();
    $error = '';
    $table_name = $wpdb->prefix . "page_bottom_content";
    if($_GET['option'] != 'add') {
        $edit = ($_GET['edit'] > 0) ? "WHERE id=" . intval($_GET['edit']) : "";
        $result = $wpdb->get_results("SELECT * FROM {$table_name} {$edit}");
    }
    switch($_POST['option']):
        case 'add':
            unset($_POST['option']);
            unset($_POST['save']);
            if($_POST['page_id'] > 0){
                $check = $wpdb->get_var("SELECT count(id) FROM {$table_name} WHERE page_id='".intval($_POST['page_id'])."'");
                $msg = 'Content with this post id is already added, please check list and edit it if you want to make changes.';
            }else{
                $check = $wpdb->get_var("SELECT count(id) FROM {$table_name} WHERE page_id=0");
                $msg = 'Content for all Posts you can add one time, please check list and edit content for all Posts if you want to make changes.';
            }
            if($check > 0){
                $error = $msg;
            }
            if($error == '') {

                foreach($_POST as $key => $val){
                    $_POST[$key] = stripslashes_deep($val);
                }
                if ($wpdb->insert($table_name, $_POST)) {
                    $message[0] = 'updated';
                    $message[1] = 'Content has been added successfully.';
                } else {
                    $message[0] = 'error';
                    $message[1] = 'Can`t connect database table ' . $table_name;
                }
            }else{
                $message[0] = 'error';
                $message[1] = $msg;
            }
            break;
        case 'edit':
            unset($_POST['option']);
            unset($_POST['save']);
            foreach($_POST as $key => $val){
                $_POST[$key] = stripslashes_deep($val);
            }
            if($wpdb->update($table_name,$_POST,array('id'=>intval($_GET['edit'])))){
                $message[0] = 'updated';
                $message[1] = 'Content has been updated successfully.';
            }else{
                $message[0] = 'error';
                $message[1] = 'You can`t update content without changes.';
            }
            break;
        default:
            //
            break;
    endswitch;


    switch($_GET['option']):
        case 'add':
            $option_text = 'Add custom post bottom';
            @include_once('.form.php');
            break;
        case 'edit':
            $option_text = 'Edit custom post bottom';
            @include_once('.form.php');
            break;
        case 'status':
            if($wpdb->update($table_name,array("status"=>intval($_GET['status'])),array("id"=>intval($_GET['id'])))){
                echo "<script>jQuery(document).ready(function(){window.location.href='".site_url()."/wp-admin/edit.php?page=custom-content-index'});</script>";
            }
            break;
        case 'remove':
            if($wpdb->delete($table_name,array("id"=>intval($_GET['id'])))){
                echo "<script>jQuery(document).ready(function(){window.location.href='".site_url()."/wp-admin/edit.php?page=custom-content-index'});</script>";
            }
        default:
            @include_once('.list.php');
            break;
    endswitch;
}

function custom_content_options(){
    add_posts_page( 'Post Bottom Contents', 'Post Bottom Contents', 'manage_options', 'custom-content-index', 'custom_content_bottom');
}

add_action( 'admin_menu', 'custom_content_options' );

function create_content_table(){
    global $wpdb;
    $table_name = $wpdb->prefix . "page_bottom_content";
    $db_table = DB_NAME .".". $table_name;
    if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name){
        $sql = "CREATE TABLE {$db_table} ( `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY , `content1` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , `content2` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , `page_id` INT NOT NULL , `status` TINYINT NOT NULL ) ENGINE = InnoDB;";
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }
}

add_action( 'admin_head', 'create_content_table' );

