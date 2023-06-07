<?php
/**
 * Featured Title setting for Customizer
 *
 * @package sublime
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Featured Title General
$this->sections['sublime_featuredtitle_general'] = array(
	'title' => esc_html__( 'General', 'sublime' ),
	'panel' => 'sublime_featuredtitle',
	'settings' => array(
		array(
			'id' => 'featured_title',
			'default' => true,
			'control' => array(
				'label' => esc_html__( 'Enable', 'sublime' ),
				'type' => 'checkbox',
			),
		),
		array(
			'id' => 'featured_title_style',
			'default' => 'centered',
			'control' => array(
				'label'  => esc_html__( 'Style', 'sublime' ),
				'type' => 'select',
				'choices' => array(
					'simple' => esc_html__( 'Left', 'sublime' ),
					'centered' => esc_html__( 'Centered', 'sublime' ),
				),
				'active_callback' => 'sublime_cac_has_featured_title',
			),
		),
		array(
			'id' => 'featured_title_padding',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Padding', 'sublime' ),
				'description' => esc_html__( 'Example: 250px 0px 150px 0px', 'sublime' ),
				'active_callback' => 'sublime_cac_has_featured_title',
			),
			'inline_css' => array(
				'media_query' => '(min-width: 992px)',
				'target' => '#featured-title .inner-wrap, .header-style-2 #featured-title .inner-wrap, .header-style-3 #featured-title .inner-wrap',
				'alter' => 'padding',
			),
		),
		array(
			'id' => 'featured_title_background',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Background', 'sublime' ),
				'active_callback' => 'sublime_cac_has_featured_title',
			),
			'inline_css' => array(
				'target' => '#featured-title',
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'featured_title_background_img',
			'control' => array(
				'type' => 'image',
				'label' => esc_html__( 'Background Image', 'sublime' ),
				'active_callback' => 'sublime_cac_has_featured_title',
			),
		),
		array(
			'id' => 'featured_title_background_img_style',
			'default' => 'repeat',
			'control' => array(
				'label' => esc_html__( 'Background Image Style', 'sublime' ),
				'type'  => 'image',
				'type'  => 'select',
				'choices' => array(
					''             => esc_html__( 'Default', 'sublime' ),
					'cover'        => esc_html__( 'Cover', 'sublime' ),
					'center-top'        => esc_html__( 'Center Top', 'sublime' ),
					'fixed-top'    => esc_html__( 'Fixed Top', 'sublime' ),
					'fixed'        => esc_html__( 'Fixed Center', 'sublime' ),
					'fixed-bottom' => esc_html__( 'Fixed Bottom', 'sublime' ),
					'repeat'       => esc_html__( 'Repeat', 'sublime' ),
					'repeat-x'     => esc_html__( 'Repeat-x', 'sublime' ),
					'repeat-y'     => esc_html__( 'Repeat-y', 'sublime' ),
				),
				'active_callback' => 'sublime_cac_has_featured_title',
			),
		),
	),
);

// Featured Title Headings
$this->sections['sublime_featuredtitle_heading'] = array(
	'title' => esc_html__( 'Headings', 'sublime' ),
	'panel' => 'sublime_featuredtitle',
	'settings' => array(
		array(
			'id' => 'featured_title_heading',
			'default' => true,
			'control' => array(
				'label' => esc_html__( 'Enable', 'sublime' ),
				'type' => 'checkbox',
				'active_callback' => 'sublime_cac_has_featured_title',
			),
		),
		array(
			'id' => 'featured_title_heading_bottom_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Heading Bottom Margin', 'sublime' ),
				'active_callback' => 'sublime_cac_has_featured_title_center',
				'description' => esc_html__( 'Example: 30px.', 'sublime' ),
			),
			'inline_css' => array(
				'target' => '#featured-title.centered .title-group',
				'alter' => 'margin-bottom',
			),
		),
		array(
			'id' => 'featured_title_heading_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Title Color', 'sublime' ),
				'active_callback' => 'sublime_cac_has_featured_title_heading',
			),
			'inline_css' => array(
				'target' => '#featured-title .main-title',
				'alter' => 'color',
			),
		),
	),
);

// Featured Title Breadcrumbs
$this->sections['sublime_featuredtitle_breadcrumbs'] = array(
	'title' => esc_html__( 'Breadcrumbs', 'sublime' ),
	'panel' => 'sublime_featuredtitle',
	'settings' => array(
		array(
			'id' => 'featured_title_breadcrumbs',
			'default' => true,
			'control' => array(
				'label' => esc_html__( 'Enable', 'sublime' ),
				'type' => 'checkbox',
				'active_callback' => 'sublime_cac_has_featured_title',
			),
		),
		array(
			'id' => 'featured_title_breadcrumbs_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Text Color', 'sublime' ),
				'active_callback' => 'sublime_cac_has_featured_title_breadcrumbs',
			),
			'inline_css' => array(
				'target' => array(
					'#featured-title #breadcrumbs',
				),
				'alter' => 'color',
			),
		),
		array(
			'id' => 'featured_title_breadcrumbs_link_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Link Color', 'sublime' ),
				'active_callback' => 'sublime_cac_has_featured_title_breadcrumbs',
			),
			'inline_css' => array(
				'target' => '#featured-title #breadcrumbs a',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'featured_title_breadcrumbs_link_hover_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Link Color: Hover', 'sublime' ),
				'active_callback' => 'sublime_cac_has_featured_title_breadcrumbs',
			),
			'inline_css' => array(
				'target' => '#featured-title #breadcrumbs a:hover',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'portfolio_page',
			'control' => array(
				'label'  => esc_html__( 'Projects', 'sublime' ),
				'type' => 'select',
				'choices' => sublime_get_pages(),
				'active_callback' => 'sublime_cac_has_single_project',
			),
		),
		array(
			'id' => 'service_page',
			'control' => array(
				'label'  => esc_html__( 'Services', 'sublime' ),
				'type' => 'select',
				'choices' => sublime_get_pages(),
				'active_callback' => 'sublime_cac_has_single_service',
			),
		),
	),
);