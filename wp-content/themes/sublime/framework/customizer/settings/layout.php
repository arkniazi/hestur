<?php
/**
 * Layout setting for Customizer
 *
 * @package sublime
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Layout Style
$this->sections['sublime_layout_style'] = array(
	'title' => esc_html__( 'Layout Site', 'sublime' ),
	'panel' => 'sublime_layout',
	'settings' => array(
		array(
			'id' => 'site_layout_style',
			'default' => 'full-width',
			'control' => array(
				'label' => esc_html__( 'Layout Style', 'sublime' ),
				'type' => 'select',
				'choices' => array(
					'full-width' => esc_html__( 'Full Width','sublime' ),
					'boxed' => esc_html__( 'Boxed','sublime' )
				),
			),
		),
		array(
			'id' => 'site_layout_boxed_shadow',
			'control' => array(
				'label' => esc_html__( 'Box Shadow', 'sublime' ),
				'type' => 'checkbox',
				'active_callback' => 'sublime_cac_has_boxed_layout',
			),
		),
		array(
			'id' => 'site_layout_wrapper_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Wrapper Margin', 'sublime' ),
				'desc' => esc_html__( 'Top Right Bottom Left. Default: 30px 0px 30px 0px.', 'sublime' ),
				'active_callback' => 'sublime_cac_has_boxed_layout',
			),
			'inline_css' => array(
				'target' => '.site-layout-boxed #wrapper',
				'alter' => 'padding',
			),
		),
		array(
			'id' => 'wrapper_background_color',
			'transport' => 'postMessage',
			'control' => array(
				'label' => esc_html__( 'Outer Background Color', 'sublime' ),
				'type' => 'color',
				'active_callback' => 'sublime_cac_has_boxed_layout',
			),
			'inline_css' => array(
				'target' => '.site-layout-boxed #wrapper',
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'wrapper_background_img',
			'control' => array(
				'label' => esc_html__( 'Outer Background Image', 'sublime' ),
				'type' => 'image',
				'active_callback' => 'sublime_cac_has_boxed_layout',
			),
		),
		array(
			'id' => 'wrapper_background_img_style',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Outer Background Image Style', 'sublime' ),
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
				'active_callback' => 'sublime_cac_has_boxed_layout',
			),
		),
	),
);

// Layout Position
$this->sections['sublime_layout_position'] = array(
	'title' => esc_html__( 'Layout Position', 'sublime' ),
	'panel' => 'sublime_layout',
	'settings' => array(
		array(
			'id' => 'site_layout_position',
			'default' => 'sidebar-right',
			'control' => array(
				'label' => esc_html__( 'Site Layout Position', 'sublime' ),
				'type' => 'select',
				'choices' => array(
					'sidebar-right' => esc_html__( 'Right Sidebar', 'sublime' ),
					'sidebar-left'  => esc_html__( 'Left Sidebar', 'sublime' ),
					'no-sidebar'    => esc_html__( 'No Sidebar', 'sublime' ),
				),
			),
		),
		array(
			'id' => 'single_post_layout_position',
			'default' => 'sidebar-right',
			'control' => array(
				'label' => esc_html__( 'Single Post Layout Position', 'sublime' ),
				'type' => 'select',
				'choices' => array(
					'sidebar-right' => esc_html__( 'Right Sidebar', 'sublime' ),
					'sidebar-left'  => esc_html__( 'Left Sidebar', 'sublime' ),
					'no-sidebar'    => esc_html__( 'No Sidebar', 'sublime' ),
				),
				'desc' => esc_html__( 'Specify layout for all single post pages.', 'sublime' )
			),
		),
		array(
			'id' => 'single_project_layout_position',
			'default' => 'no-sidebar',
			'control' => array(
				'label' => esc_html__( 'Single Project Layout Position', 'sublime' ),
				'type' => 'select',
				'choices' => array(
					'sidebar-right' => esc_html__( 'Right Sidebar', 'sublime' ),
					'sidebar-left'  => esc_html__( 'Left Sidebar', 'sublime' ),
					'no-sidebar'    => esc_html__( 'No Sidebar', 'sublime' ),
				),
				'desc' => esc_html__( 'Specify layout for all single project pages.', 'sublime' ),
				'active_callback' => 'sublime_cac_has_single_project',
			),
		),
		array(
			'id' => 'single_service_layout_position',
			'default' => 'no-sidebar',
			'control' => array(
				'label' => esc_html__( 'Single Service Layout Position', 'sublime' ),
				'type' => 'select',
				'choices' => array(
					'sidebar-right' => esc_html__( 'Right Sidebar', 'sublime' ),
					'sidebar-left'  => esc_html__( 'Left Sidebar', 'sublime' ),
					'no-sidebar'    => esc_html__( 'No Sidebar', 'sublime' ),
				),
				'desc' => esc_html__( 'Specify layout for all single service pages.', 'sublime' ),
				'active_callback' => 'sublime_cac_has_single_service',
			),
		),
	),
);

// Layout Widths
$this->sections['sublime_layout_widths'] = array(
	'title' => esc_html__( 'Layout Widths', 'sublime' ),
	'panel' => 'sublime_layout',
	'settings' => array(
		array(
			'id' => 'site_desktop_container_width',
			'transport' => 'postMessage',
			'control' => array(
				'label' => esc_html__( 'Container', 'sublime' ),
				'type' => 'text',
				'desc' => esc_html__( 'Default: 1170px', 'sublime' ),
			),
			'inline_css' => array(
				'target' => array( 
					'.site-layout-full-width .sublime-container',
					'.site-layout-boxed #page'
				),
				'alter' => 'width',
			),
		),
		array(
			'id' => 'left_container_width',
			'transport' => 'postMessage',
			'control' => array(
				'label' => esc_html__( 'Content', 'sublime' ),
				'type' => 'text',
				'desc' => esc_html__( 'Example: 66%', 'sublime' ),
			),
			'inline_css' => array(
				'target' => '#site-content',
				'alter' => 'width',
			),
		),
		array(
			'id' => 'sidebar_width',
			'transport' => 'postMessage',
			'control' => array(
				'label' => esc_html__( 'Sidebar', 'sublime' ),
				'type' => 'text',
				'desc' => esc_html__( 'Example: 28%', 'sublime' ),
			),
			'inline_css' => array(
				'target' => '#sidebar',
				'alter' => 'width',
			),
		),
	),
);