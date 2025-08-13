<?php
// 🔧 Custom Post Type 'project' registreren
function pm_register_project_post_type() {
    $labels = [
        'name' => 'Projecten',
        'singular_name' => 'Project',
        'add_new' => 'Nieuw project',
        'add_new_item' => 'Nieuw project toevoegen',
        'edit_item' => 'Project bewerken',
        'new_item' => 'Nieuw project',
        'view_item' => 'Bekijk project',
        'all_items' => 'Alle projecten',
        'menu_name' => 'Projecten',
    ];


    $args = [
        'labels' => $labels,
        'public' => true,
        'show_ui' => true,
        'show_in_rest' => true,
        'has_archive' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-portfolio',
        'supports' => ['title', 'editor', 'custom-fields', 'revisions'],
        'capability_type' => 'post',

        'taxonomies' => ['project_category'],
    ];

// 🔖 Custom taxonomie 'project_category' registreren
    register_taxonomy('project_category', 'project', [
        'labels' => [
            'name' => 'Categorieën',
            'singular_name' => 'Categorie',
            'search_items' => 'Zoek categorieën',
            'all_items' => 'Alle categorieën',
            'edit_item' => 'Bewerk categorie',
            'update_item' => 'Update categorie',
            'add_new_item' => 'Voeg nieuwe categorie toe',
            'new_item_name' => 'Nieuwe categorienaam',
            'menu_name' => 'Categorieën',
        ],
        'hierarchical' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_rest' => true,
        'public' => true,
        'rewrite' => ['slug' => 'project-categorie'],
    ]);

    register_post_type('project', $args);
}
add_action('init', 'pm_register_project_post_type');
//nieuw commit