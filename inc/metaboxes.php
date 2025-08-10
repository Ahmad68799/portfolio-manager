<?php
//Technologieën
function pfm_add_project_metabox()
{
    add_meta_box(
        'pfm_project_tech',              // 🔹 Unieke ID van de metabox
        'Technologieën',                 // 🔹 Titel boven de metabox
        'pfm_project_tech_callback',     // 🔹 Functie die HTML laat zien
        'project',                       // 🔹 Voor post type 'project'
        'normal',                        // 🔹 Locatie op de pagina
        'default'                        // 🔹 Prioriteit
    );
}
add_action('add_meta_boxes', 'pfm_add_project_metabox');

function pfm_project_tech_callback($post) {
    $value = get_post_meta($post->ID, '_pfm_project_tech', true);

    wp_nonce_field('pfm_save_project_tech', 'pfm_project_tech_nonce');

    echo '<label for="pfm_project_tech">Bijv: HTML, CSS, JS</label><br>';
    echo '<input type="text" id="pfm_project_tech" name="pfm_project_tech" value="' . esc_attr($value) . '" style="width:100%;">';
}

function pfm_save_project_tech($post_id) {
    // Check nonce
    if (!isset($_POST['pfm_project_tech_nonce']) || !wp_verify_nonce($_POST['pfm_project_tech_nonce'], 'pfm_save_project_tech')) {
        return;
    }

    // Check user permissie
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Check post type (optioneel maar handig)
    if (get_post_type($post_id) !== 'project') {
        return;
    }

    // Waarde opslaan
    if (isset($_POST['pfm_project_tech'])) {
        update_post_meta($post_id, '_pfm_project_tech', sanitize_text_field($_POST['pfm_project_tech']));
    }
}
add_action('save_post', 'pfm_save_project_tech');


//description

function pfm_add_description_metabox() {
    add_meta_box(
        'pfm_project_description',
        'Description',
        'pfm_project_description_callback',
        'project',
        'normal',
        'default'
    );
}
add_action( 'add_meta_boxes', 'pfm_add_description_metabox' );

function pfm_project_description_callback($post) {
    $value = get_post_meta($post->ID, '_pfm_project_description', true);
    wp_nonce_field('pfm_save_project_description', 'pfm_project_description_nonce');
    echo '<textarea rows="5" cols="30" id="pfm_project_description" name="pfm_project_description">' . esc_textarea($value) . '</textarea>';
}

function pfm_save_project_description($post_id) {

    if (!isset($_POST['pfm_project_description_nonce']) || !wp_verify_nonce($_POST['pfm_project_description_nonce'], 'pfm_save_project_description')) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    if(get_post_type($post_id) !== 'project'){
        return;
    }
    if(isset($_POST['pfm_project_description'])){
        update_post_meta($post_id, '_pfm_project_description', sanitize_textarea_field($_POST['pfm_project_description']));
    }
}
add_action('save_post', 'pfm_save_project_description');

// Externe link

function pfm_add_external_link_metabox() {
    add_meta_box(
        'pfm_project_external_link',
        'Externe link',
        'pfm_project_external_link_callback',
        'project',
        'normal',
        'default'
    );
}
add_action('add_meta_boxes', 'pfm_add_external_link_metabox');

function pfm_project_external_link_callback($post) {
    $value = get_post_meta($post->ID, '_pfm_project_external_link', true);
    wp_nonce_field('pfm_save_project_external_link', 'pfm_project_external_link_nonce');
    echo '<input type="url" id="pfm_project_external_link" name="pfm_project_external_link" value="' . esc_url($value) . '" style="width:100%;" placeholder="https://example.com">';
}

function pfm_save_project_external_link($post_id) {
    if (!isset($_POST['pfm_project_external_link_nonce']) || !wp_verify_nonce($_POST['pfm_project_external_link_nonce'], 'pfm_save_project_external_link')) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (get_post_type($post_id) !== 'project') {
        return;
    }

    if (isset($_POST['pfm_project_external_link'])) {
        update_post_meta($post_id, '_pfm_project_external_link', esc_url_raw($_POST['pfm_project_external_link']));
    }
}
add_action('save_post', 'pfm_save_project_external_link');


// Opleverdatum

function pfm_add_delivery_date_metabox() {
    add_meta_box(
        'pfm_project_delivery_date',
        'Opleverdatum',
        'pfm_project_delivery_date_callback',
        'project',
        'normal', // was 'side'
        'default' // was 'default' maar laten we het duidelijk houden
    );
}
add_action('add_meta_boxes', 'pfm_add_delivery_date_metabox');

function pfm_project_delivery_date_callback($post) {
    $value = get_post_meta($post->ID, '_pfm_project_delivery_date', true);
    wp_nonce_field('pfm_save_project_delivery_date', 'pfm_project_delivery_date_nonce');
    echo '<input type="date" id="pfm_project_delivery_date" name="pfm_project_delivery_date" value="' . esc_attr($value) . '" />';
}

function pfm_save_project_delivery_date($post_id) {
    if (!isset($_POST['pfm_project_delivery_date_nonce']) || !wp_verify_nonce($_POST['pfm_project_delivery_date_nonce'], 'pfm_save_project_delivery_date')) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (get_post_type($post_id) !== 'project') {
        return;
    }

    if (isset($_POST['pfm_project_delivery_date'])) {
        update_post_meta($post_id, '_pfm_project_delivery_date', sanitize_text_field($_POST['pfm_project_delivery_date']));
    }
}
add_action('save_post', 'pfm_save_project_delivery_date');

// === Extra afbeelding metabox ===

function pfm_add_extra_image_metabox() {
    add_meta_box(
        'pfm_project_extra_image',
        'Extra afbeelding',
        'pfm_project_extra_image_callback',
        'project',
        'normal',
        'default'
    );
}
add_action('add_meta_boxes', 'pfm_add_extra_image_metabox');

function pfm_project_extra_image_callback($post) {
    wp_nonce_field('pfm_save_project_extra_image', 'pfm_project_extra_image_nonce');

    $image_id = get_post_meta($post->ID, '_pfm_project_extra_image', true);
    $image_url = $image_id ? wp_get_attachment_url($image_id) : '';

    echo '<p>JS geladen? Zie Console: Portfolio Manager geladen</p>'; // ✅ Debug

    echo '<div id="pfm-extra-image-wrapper">';
    echo '<input type="hidden" name="pfm_project_extra_image" id="pfm_project_extra_image" value="' . esc_attr($image_id) . '">';
    echo '<div id="pfm-extra-image-preview">';
    if ($image_url) {
        echo '<img src="' . esc_url($image_url) . '" style="max-width:100%; margin-bottom:10px;">';
    }
    echo '</div>';
    echo '<button type="button" class="button" id="pfm_upload_image_button">Kies afbeelding</button>';
    echo '</div>';

    echo '<script>
    jQuery(document).ready(function($) {
        let image_frame;

        $("#pfm_upload_image_button").on("click", function(e) {
            e.preventDefault();

            if (image_frame) {
                image_frame.open();
                return;
            }

            image_frame = wp.media({
                title: "Kies een afbeelding",
                multiple: false,
                library: { type: "image" },
                button: { text: "Gebruik deze afbeelding" }
            });

            image_frame.on("select", function () {
                const attachment = image_frame.state().get("selection").first().toJSON();
                $("#pfm_project_extra_image").val(attachment.id);
                $("#pfm-extra-image-preview").html(`<img src="${attachment.url}" style="max-width:100%; margin-bottom:10px;">`);
            });

            image_frame.open();
        });
    });
    </script>';
}

function pfm_save_project_extra_image($post_id) {
    if (!isset($_POST['pfm_project_extra_image_nonce']) || !wp_verify_nonce($_POST['pfm_project_extra_image_nonce'], 'pfm_save_project_extra_image')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;
    if (get_post_type($post_id) !== 'project') return;

    if (isset($_POST['pfm_project_extra_image'])) {
        $image_id = absint($_POST['pfm_project_extra_image']);

        if ($image_id > 0) {
            update_post_meta($post_id, '_pfm_project_extra_image', $image_id);
        } else {
            delete_post_meta($post_id, '_pfm_project_extra_image');
        }
    }
}
add_action('save_post_project', 'pfm_save_project_extra_image');