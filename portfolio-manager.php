<?php
/*
Plugin Name: Portfolio Manager
Description: Een eenvoudige plugin om projecten te beheren en te tonen via een shortcode.
Version: 1.0
Author: [ahmad Eknan]
*/

defined('ABSPATH') or die('Toegang verboden.');

require_once plugin_dir_path(__FILE__) . 'inc/post-type.php';
require_once plugin_dir_path(__FILE__) . 'inc/metaboxes.php';
require_once plugin_dir_path(__FILE__) . 'inc/shortcode.php';

function pm_enqueue_assets() {
    wp_enqueue_style('pm-style', plugin_dir_url(__FILE__) . 'assets/style.css');
    wp_enqueue_script('pm-script', plugin_dir_url(__FILE__) . 'assets/script.js', [], false, true);
}
add_action('wp_enqueue_scripts', 'pm_enqueue_assets');

function pm_enqueue_admin_assets($hook) {
    // Alleen op project toevoegen/bewerken pagina
    if ($hook !== 'post-new.php' && $hook !== 'post.php') {
        return;
    }

    wp_enqueue_media(); // Nodig voor uploader
    wp_enqueue_script(
        'pm-admin-script',
        plugin_dir_url(__FILE__) . 'assets/script.js',
        ['jquery'],
        null,
        true
    );
}
add_action('admin_enqueue_scripts', 'pm_enqueue_admin_assets');