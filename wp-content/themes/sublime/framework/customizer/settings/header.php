<?php
/**
 * Header setting for Customizer
 *
 * @package sublime
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Header General
$this->sections['sublime_header_general'] = array(
	'title' => esc_html__( 'General', 'sublime' ),
	'panel' => 'sublime_header',
	'settings' => array(
		array(
			'id' => 'header_topbar',
			'default' => false,
			'control' => array(
				'label' => esc_html__( 'Top Bar: Enable', 'sublime' ),
				'type' => 'checkbox',
			),
		),
		array(
			'id' => 'header_background',
			'transport' => 'postMessage',
			'control' => array(
				'label' => esc_html__( 'Background', 'sublime' ),
				'type' => 'color',
			),
			'inline_css' => array(
				'target' => array(
					'#site-header:after'
				),
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'header_padding',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Padding', 'sublime' ),
				'description' => esc_html__( 'Top Right Bottom Left.', 'sublime' ),
			),
			'inline_css' => array(
				'media_query' => '(min-width: 1199px)',
				'target' => '.site-header-inner',
				'alter' => 'padding',
			),
			'sanitize_callback' => 'esc_url',
		),
		array(
			'id' => 'header_class',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Extra Class', 'sublime' ),
				'type' => 'text',
			),
		),
	)
);

// Header Logo
$this->sections['sublime_header_logo'] = array(
	'title' => esc_html__( 'Logo', 'sublime' ),
	'panel' => 'sublime_header',
	'settings' => array(
		array(
			'id' => 'custom_logo',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Logo Image', 'sublime' ),
				'type' => 'image',
			),
		),
		array(
			'id' => 'logo_width',
			'control' => array(
				'label' => esc_html__( 'Logo Width', 'sublime' ),
				'type' => 'text',
			),
		),
	)
);

// Header Menu
$this->sections['sublime_header_menu'] = array(
	'title' => esc_html__( 'Menu', 'sublime' ),
	'panel' => 'sublime_header',
	'settings' => array(
		// General
		array(
			'id' => 'menu_link_spacing',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Link Spacing', 'sublime' ),
				'description' => esc_html__( 'Example: 20px', 'sublime' ),
			),
			'inline_css' => array(
				'target' => array(
					'#main-nav > ul > li',
				),
				'alter' => array(
					'padding-left',
					'padding-right',
				),
			),
		),
		array(
			'id' => 'menu_height',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Menu Height', 'sublime' ),
				'description' => esc_html__( 'Example: 100px', 'sublime' ),
			),
			'inline_css' => array(
				'target' => array(
					'#site-header #main-nav > ul > li > a',
				),
				'alter' => array(
					'height',
					'line-height',
				),
			),
		),
		array(
			'id' => 'menu_link_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Link Color', 'sublime' ),
				'active_callback' => 'sublime_cac_has_header_style1',
			),
			'inline_css' => array(
				'target' => array(
					'.header-style-1 #main-nav > ul > li > a > span',
				),
				'alter' => 'color',
			),
		),
		array(
			'id' => 'menu_link_color_hover',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Link Color: Hover', 'sublime' ),
				'active_callback' => 'sublime_cac_has_header_style1',
			),
			'inline_css' => array(
				'target' => array(
					'.header-style-1 #main-nav > ul > li > a:hover > span',
				),
				'alter' => 'color',
			),
		),
		array(
			'id' => 'menu_link_color2',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Link Color', 'sublime' ),
				'active_callback' => 'sublime_cac_has_header_style2',
			),
			'inline_css' => array(
				'target' => array(
					'.header-style-1 #main-nav > ul > li > a > span',
				),
				'alter' => 'color',
			),
		),
		array(
			'id' => 'menu_link_color_hover2',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Link Color: Hover', 'sublime' ),
				'active_callback' => 'sublime_cac_has_header_style2',
			),
			'inline_css' => array(
				'target' => array(
					'.header-style-1 #main-nav > ul > li > a:hover > span',
				),
				'alter' => 'color',
			),
		),
		array(
			'id' => 'menu_link_color3',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Link Color', 'sublime' ),
				'active_callback' => 'sublime_cac_has_header_style3',
			),
			'inline_css' => array(
				'target' => array(
					'.header-style-3 #main-nav > ul > li > a > span',
				),
				'alter' => 'color',
			),
		),
		array(
			'id' => 'menu_link_color_hover3',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Link Color: Hover', 'sublime' ),
				'active_callback' => 'sublime_cac_has_header_style3',
			),
			'inline_css' => array(
				'target' => array(
					'.header-style-3 #main-nav > ul > li > a:hover > span',
				),
				'alter' => 'color',
			),
		),
	)
);

// Search & Cart
$this->sections['sublime_header_search_cart'] = array(
	'title' => esc_html__( 'Search & Cart', 'sublime' ),
	'panel' => 'sublime_header',
	'settings' => array(
		// Search Icon
		array(
			'id' => 'header_search_icon',
			'default' => false,
			'control' => array(
				'label' => esc_html__( 'Search Icon', 'sublime' ),
				'type' => 'checkbox',
			),
		),
		// Cart Icon
		array(
			'id' => 'header_cart_icon',
			'default' => false,
			'control' => array(
				'label' => esc_html__( 'Cart Icon', 'sublime' ),
				'type' => 'checkbox',
				'active_callback' => 'sublime_cac_has_woo',
			),
		),
	)
);

// Button
$this->sections['sublime_header_button'] = array(
	'title' => esc_html__( 'Button', 'sublime' ),
	'panel' => 'sublime_header',
	'settings' => array(
		array(
			'id' => 'header_button',
			'default' => false,
			'control' => array(
				'label' => esc_html__( 'Enable', 'sublime' ),
				'type' => 'checkbox',
			),
		),
		array(
			'id' => 'header_button_text',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Text', 'sublime' ),
				'type' => 'text',
			),
		),
		array(
			'id' => 'header_button_url',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Url', 'sublime' ),
				'type' => 'text',
			),
		),
	),
);

// Header Info
$this->sections['sublime_header_info'] = array(
	'title' => esc_html__( 'Header Information', 'sublime' ),
	'panel' => 'sublime_header',
	'settings' => array(
		// Content
		array(
			'id' => 'header_info_phone_prefix',
			'default' => 'Phone:',
			'control' => array(
				'label' => esc_html__( 'Phone', 'sublime' ),
				'type' => 'text',
				'rows' => 3,
				'active_callback' => 'sublime_cac_has_header_topbar',
			),
		),
		array(
			'id' => 'header_info_phone',
			'default' => '',
			'control' => array(
				'type' => 'text',
				'rows' => 3,
				'active_callback' => 'sublime_cac_has_header_topbar',
			),
		),
		array(
			'id' => 'header_info_email_prefix',
			'default' => 'Email:',
			'control' => array(
				'label' => esc_html__( 'Email', 'sublime' ),
				'type' => 'text',
				'rows' => 3,
				'active_callback' => 'sublime_cac_has_header_topbar',
			),
		),
		array(
			'id' => 'header_info_email',
			'default' => '',
			'control' => array(
				'type' => 'text',
				'rows' => 3,
				'active_callback' => 'sublime_cac_has_header_topbar',
			),
		),	
		array(
			'id' => 'header_info_address_prefix',
			'default' => 'Address:',
			'control' => array(
				'label' => esc_html__( 'Address', 'sublime' ),
				'type' => 'text',
				'rows' => 3,
				'active_callback' => 'sublime_cac_has_header_topbar',
			),
		),
		array(
			'id' => 'header_info_address',
			'default' => '',
			'control' => array(
				'type' => 'text',
				'rows' => 3,
				'active_callback' => 'sublime_cac_has_header_topbar',
			),
		),
		// Style
		array(
			'id' => 'header_info_color',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Header Infor Color', 'sublime' ),
				'type' => 'color',
				'active_callback' => 'sublime_cac_has_header_topbar',
			),
			'inline_css' => array(
				'target' => '.header-info .content, #header.header-dark .header-info .content',
				'alter' => 'color',
			),
		),
	),
);

// Top Bar Socials
$this->sections['sublime_header_socials'] = array(
	'title' => esc_html__( 'Social', 'sublime' ),
	'panel' => 'sublime_header',
	'settings' => array(
		array(
			'id' => 'header_socials',
			'default' => false,
			'control' => array(
				'label' => esc_html__( 'Enable', 'sublime' ),
				'type' => 'checkbox',
				'active_callback' => 'sublime_cac_has_header_topbar',
			),
		),
		array(
			'id' => 'header_socials_spacing',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Socials Spacing', 'sublime' ),
				'description' => esc_html__( 'Gap Between Each Social. Example: 10px.', 'sublime' ),
				'type' => 'text',
				'active_callback' => 'sublime_cac_has_header_socials',
			),
		),
	),
);

// Social settings
$social_options = sublime_header_social_options();
foreach ( $social_options as $key => $val ) {
	$this->sections['sublime_header_socials']['settings'][] = array(
		'id' => 'header_social_profiles[' . $key .']',
		'control' => array(
			'label' => $val['label'],
			'type' => 'text',
			'active_callback' => 'sublime_cac_has_header_socials',
		),
	);
}

// Remove var from memory
unset( $social_options );
