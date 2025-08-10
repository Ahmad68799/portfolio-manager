<?php
// uninstall.php
if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit; // Exit if accessed directly
}

// Verwijder alle projecten
$projects = get_posts([
    'post_type' => 'project',
    'numberposts' => -1,
    'post_status' => 'any',
    'fields' => 'ids'
]);

foreach ($projects as $project_id) {
    wp_delete_post($project_id, true); // true = force delete (overslaan prullenbak)
}

// Verwijder de custom taxonomy terms
$terms = get_terms([
    'taxonomy' => 'project_category',
    'hide_empty' => false,
    'fields' => 'ids'
]);

foreach ($terms as $term_id) {
    wp_delete_term($term_id, 'project_category');
}

// Verwijder plugin opties (als je die hebt)
delete_option('portfolio_manager_settings');

// Verwijder alle custom meta velden (globale cleanup)
global $wpdb;
$wpdb->query(
    $wpdb->prepare(
        "DELETE FROM $wpdb->postmeta WHERE meta_key LIKE %s",
        '_pfm_%' // Verwijder alle meta keys die beginnen met _pfm_
    )
);

// Verwijder eventuele transients
$wpdb->query(
    $wpdb->prepare(
        "DELETE FROM $wpdb->options WHERE option_name LIKE %s OR option_name LIKE %s",
        '_transient_portfolio_%',
        '_transient_timeout_portfolio_%'
    )
);