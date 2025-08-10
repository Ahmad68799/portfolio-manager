    <?php
    function portfolio_projects_shortcode($atts) {
    // Standaardwaarden en filters uit shortcode ophalen
    $atts = shortcode_atts([
    'category' => '',
    'order' => 'DESC',
    ], $atts, 'portfolio_projects');

    $args = [
        'post_type' => 'project',
        'posts_per_page' => -1,
        'orderby' => 'date',
        'order' => strtoupper($atts['order']) === 'ASC' ? 'ASC' : 'DESC',
    ];

// Als category is meegegeven, filter dan op taxonomie
    if (!empty($atts['category'])) {
        $args['tax_query'] = [
            [
                'taxonomy' => 'project_category',
                'field'    => 'slug',
                'terms'    => sanitize_text_field($atts['category']),
            ],
        ];
    }

$projects = new WP_Query($args);

ob_start();

if ($projects->have_posts()) {
echo '<div class="pm-projects">';

    while ($projects->have_posts()) {
    $projects->the_post();

    $tech = get_post_meta(get_the_ID(), '_pfm_project_tech', true);
    $desc = get_post_meta(get_the_ID(), '_pfm_project_description', true);
    $link = get_post_meta(get_the_ID(), '_pfm_project_external_link', true);
    $date = get_post_meta(get_the_ID(), '_pfm_project_delivery_date', true);
    $image_id = get_post_meta(get_the_ID(), '_pfm_project_extra_image', true);
    $image_url = $image_id ? wp_get_attachment_url($image_id) : '';

    echo '<div class="pm-project">';
        echo '<h3>' . get_the_title() . '</h3>';

        if ($image_url) {
        echo '<img src="' . esc_url($image_url) . '" alt="Afbeelding van project" class="pm-project-image">';
        } else {
        echo '<p><em>Geen afbeelding gevonden.</em></p>';
        }

        if (!empty($desc)) {
        echo '<p><strong>Beschrijving:</strong> ' . esc_html($desc) . '</p>';
        }

        if (!empty($tech)) {
        echo '<p><strong>Technologieën:</strong> ' . esc_html($tech) . '</p>';
        }

        if (!empty($date)) {
        echo '<p><strong>Opleverdatum:</strong> ' . esc_html($date) . '</p>';
        }

        if (!empty($link)) {
        echo '<p><a href="' . esc_url($link) . '" target="_blank" rel="noopener">Bekijk project</a></p>';
        }
        echo '</div>';
    }

    echo '</div>';
wp_reset_postdata();
} else {
echo '<p>Geen projecten gevonden.</p>';
}

return ob_get_clean();
}
add_shortcode('portfolio_projects', 'portfolio_projects_shortcode');