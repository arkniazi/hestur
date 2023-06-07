<?php
/**
 * General setting for Customizer
 *
 * @package sublime
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Accent Colors
$this->sections['sublime_accent_colors'] = array(
	'title' => esc_html__( 'Accent Colors', 'sublime' ),
	'panel' => 'sublime_general',
	'settings' => array(
		array(
			'id' => 'accent_color',
			'default' => '#4732d7',
			'control' => array(
				'label' => esc_html__( 'Accent Color', 'sublime' ),
				'type' => 'color',
			),
		),
	)
);

// PreLoader
$this->sections['sublime_preloader'] = array(
	'title' => esc_html__( 'PreLoader', 'sublime' ),
	'panel' => 'sublime_general',
	'settings' => array(
		array(
			'id' => 'preloader',
			'default' => 'animsition',
			'control' => array(
				'label' => esc_html__( 'Preloader Option', 'sublime' ),
				'type' => 'select',
				'choices' => array(
					'animsition' => esc_html__( 'Enable','sublime' ),
					'' => esc_html__( 'Disable','sublime' )
				),
			),
		),
		array(
			'id' => 'preload_color_1',
			'default' => '#4732d7',
			'control' => array(
				'label' => esc_html__( 'Color', 'sublime' ),
				'type' => 'color',
			),
			'inline_css' => array(
				'target' => array(
					'.animsition-loading',
					'.animsition-loading:before',
					'.animsition-loading:after'
				),
				'alter' => 'border-top-color',
			),
		),
	)
);

// Header Site
$this->sections['sublime_header_site'] = array(
	'title' => esc_html__( 'Header Site', 'sublime' ),
	'panel' => 'sublime_general',
	'settings' => array(
		array(
			'id' => 'header_site_style',
			'default' => 'style-1',
			'control' => array(
				'label' => esc_html__( 'Header Style', 'sublime' ),
				'type' => 'select',
				'choices' => array(
                    'style-1' => esc_html__( 'Basic', 'sublime' ),
                    'style-2' => esc_html__( 'Float - Light', 'sublime' ),
                    'style-3' => esc_html__( 'Float - Dark', 'sublime' ),
				),
				'desc' => esc_html__( 'Header Style for all pages on website. (e.g. pages, blog posts, single post, archives, etc ). Single page can override this setting in Elementor Page Settings when edit.', 'sublime' )
			),
		),
		array(
			'id' => 'header_fixed',
			'default' => false,
			'control' => array(
				'label' => esc_html__( 'Header Fixed: Enable', 'sublime' ),
				'type' => 'checkbox',
			),
		),
	),
);

// Scroll to top
$this->sections['sublime_scroll_top'] = array(
	'title' => esc_html__( 'Scroll Top Button', 'sublime' ),
	'panel' => 'sublime_general',
	'settings' => array(
		array(
			'id' => 'scroll_top',
			'default' => true,
			'control' => array(
				'label' => esc_html__( 'Enable', 'sublime' ),
				'type' => 'checkbox',
			),
		),
	),
);

// Forms
$this->sections['sublime_general_forms'] = array(
	'title' => esc_html__( 'Forms', 'sublime' ),
	'panel' => 'sublime_general',
	'settings' => array(
		array(
			'id' => 'input_border_rounded',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Border Rounded', 'sublime' ),
			),
			'inline_css' => array(
				'target' => array(
					'textarea,input[type="text"],input[type="password"],input[type="datetime"],input[type="datetime-local"],input[type="date"],input[type="month"],input[type="time"],input[type="week"],input[type="number"],input[type="email"],input[type="url"],input[type="search"],input[type="tel"],input[type="color"]',
				),
				'alter' => 'border-radius',
			),
		),
		array(
			'id' => 'input_background_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Background', 'sublime' ),
			),
			'inline_css' => array(
				'target' => array(
					'textarea,input[type="text"],input[type="password"],input[type="datetime"],input[type="datetime-local"],input[type="date"],input[type="month"],input[type="time"],input[type="week"],input[type="number"],input[type="email"],input[type="url"],input[type="search"],input[type="tel"],input[type="color"]',
				),
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'input_border_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Border Color', 'sublime' ),
			),
			'inline_css' => array(
				'target' => array(
					'textarea,input[type="text"],input[type="password"],input[type="datetime"],input[type="datetime-local"],input[type="date"],input[type="month"],input[type="time"],input[type="week"],input[type="number"],input[type="email"],input[type="url"],input[type="search"],input[type="tel"],input[type="color"]',
				),
				'alter' => 'border-color',
			),
		),
		array(
			'id' => 'input_border_width',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Border Width', 'sublime' ),
				'description' => esc_html__( 'Enter a value in pixels. Example: 1px', 'sublime' ),
			),
			'inline_css' => array(
				'target' => array(
					'textarea,input[type="text"],input[type="password"],input[type="datetime"],input[type="datetime-local"],input[type="date"],input[type="month"],input[type="time"],input[type="week"],input[type="number"],input[type="email"],input[type="url"],input[type="search"],input[type="tel"],input[type="color"]',
				),
				'alter' => 'border-width',
			),
		),
		array(
			'id' => 'input_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Color', 'sublime' ),
			),
			'inline_css' => array(
				'target' => array(
					'textarea,input[type="text"],input[type="password"],input[type="datetime"],input[type="datetime-local"],input[type="date"],input[type="month"],input[type="time"],input[type="week"],input[type="number"],input[type="email"],input[type="url"],input[type="search"],input[type="tel"],input[type="color"]',
				),
				'alter' => 'color',
			),
		),
	),
);

// Responsive
$this->sections['sublime_responsive'] = array(
	'title' => esc_html__( 'Responsive', 'sublime' ),
	'panel' => 'sublime_general',
	'settings' => array(
		// Mobile Logo
		array(
			'id' => 'heading_mobile_logo',
			'control' => array(
				'type' => 'sublime-heading',
				'label' => esc_html__( 'Mobile Logo', 'sublime' ),
			),
		),
		array(
			'id' => 'mobile_logo_width',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Mobile Logo: Width', 'sublime' ),
				'description' => esc_html__( 'Example: 150px', 'sublime' ),
			),
			'inline_css' => array(
				'media_query' => '(max-width: 991px)',
				'target' => '#site-logo',
				'alter' => 'max-width',
			),
		),
		array(
			'id' => 'mobile_logo_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Mobile Logo: Margin', 'sublime' ),
				'description' => esc_html__( 'Example: 20px 0px 20px 0px', 'sublime' ),
			),
			'inline_css' => array(
				'media_query' => '(max-width: 991px)',
				'target' => '#site-logo-inner',
				'alter' => 'margin',
			),
		),
		// Mobile Menu
		array(
			'id' => 'heading_mobile_menu',
			'control' => array(
				'type' => 'sublime-heading',
				'label' => esc_html__( 'Mobile Menu', 'sublime' ),
			),
		),
		array(
			'id' => 'mobile_menu_item_height',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Item Height', 'sublime' ),
				'description' => esc_html__( 'Example: 40px', 'sublime' ),
			),
			'inline_css' => array(
				'target' => array(
					'#main-nav-mobi ul > li > a',
					'#main-nav-mobi .menu-item-has-children .arrow'
				),
				'alter' => 'line-height'
			),
		),
		array(
			'id' => 'mobile_menu_logo',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Mobile Menu Logo', 'sublime' ),
				'type' => 'image',
			),
		),
		array(
			'id' => 'mobile_menu_logo_width',
			'control' => array(
				'label' => esc_html__( 'Mobile Menu Logo: Width', 'sublime' ),
				'type' => 'text',
			),
		),
		// Featured Title
		array(
			'id' => 'heading_featured_title',
			'control' => array(
				'type' => 'sublime-heading',
				'label' => esc_html__( 'Mobile Featured Title', 'sublime' ),
			),
		),
		array(
			'id' => 'mobile_featured_title_padding',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Padding', 'sublime' ),
				'description' => esc_html__( 'Top Right Bottom Left.', 'sublime' ),
				'active_callback' => 'sublime_cac_has_featured_title',
			),
			'inline_css' => array(
				'media_query' => '(max-width: 991px)',
				'target' => '#featured-title .inner-wrap, .header-style-2 #featured-title .inner-wrap, .header-style-3 #featured-title .inner-wrap',
				'alter' => 'padding',
			),
		),
	)
);