<?php

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly


// Get Settings options of elementor
function mae_get_mod( $settings ) {
	// Get the current post id
	$post_id = get_the_ID();

	// Get the page settings manager
	$page_settings_manager = \Elementor\Core\Settings\Manager::get_settings_managers( 'page' );

	// Get the settings model for current post
	$page_settings_model = $page_settings_manager->get_model( $post_id );

	return  $page_settings_model->get_settings( $settings );
}

// Get page templages
function mae_get_templates() {
	$args = [
        'post_type' => 'elementor_library',
        'posts_per_page' => -1,
    ];

    $page_templates = get_posts($args);
    $options = [];

    if (!empty($page_templates) && !is_wp_error($page_templates)) {
        foreach ($page_templates as $post) {
            if ($post->post_title !== 'Default Kit')
                $options[$post->ID] = $post->post_title;
        }
    }
    return $options;
}
