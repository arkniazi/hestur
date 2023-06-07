<?php
/**
 * Shop setting for Customizer
 *
 * @package sublime
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Main Shop
$this->sections['sublime_shop_general'] = array(
	'title' => esc_html__( 'Main Shop', 'sublime' ),
	'panel' => 'sublime_shop',
	'settings' => array(
		array(
			'id' => 'shop_layout_position',
			'default' => 'no-sidebar',
			'control' => array(
				'label' => esc_html__( 'Shop Layout Position', 'sublime' ),
				'type' => 'select',
				'choices' => array(
					'sidebar-right' => esc_html__( 'Right Sidebar', 'sublime' ),
					'sidebar-left'  => esc_html__( 'Left Sidebar', 'sublime' ),
					'no-sidebar'    => esc_html__( 'No Sidebar', 'sublime' ),
				),
				'desc' => esc_html__( 'Specify layout for main shop page.', 'sublime' ),
				'active_callback' => 'sublime_cac_has_woo',
			),
		),
		array(
			'id' => 'shop_featured_title',
			'default' => esc_html__( 'Our Shop', 'sublime' ),
			'control' => array(
				'label' => esc_html__( 'Shop: Featured Title', 'sublime' ),
				'type' => 'sublime_textarea',
				'active_callback' => 'sublime_cac_has_woo',
			),
		),
		array(
			'id' => 'shop_featured_title_background_img',
			'control' => array(
				'type' => 'image',
				'label' => esc_html__( 'Shop: Featured Title Background', 'sublime' ),
				'active_callback' => 'sublime_cac_has_woo',
			),
		),
		array(
			'id' => 'shop_products_per_page',
			'default' => 6,
			'control' => array(
				'label' => esc_html__( 'Products Per Page', 'sublime' ),
				'type' => 'number',
				'active_callback' => 'sublime_cac_has_woo',
			),
		),
		array(
			'id' => 'shop_columns',
			'default' => '3',
			'control' => array(
				'label' => esc_html__( 'Shop Columns', 'sublime' ),
				'type' => 'select',
				'choices' => array(
					'2' => '2',
					'3' => '3',
					'4' => '4',
				),
				'active_callback' => 'sublime_cac_has_woo',
			),
		),
		array(
			'id' => 'shop_item_bottom_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Item Bottom Margin', 'sublime' ),
				'description' => esc_html__( 'Example: 30px.', 'sublime' ),
				'active_callback' => 'sublime_cac_has_woo',
			),
			'inline_css' => array(
				'target' => '.products li',
				'alter' => 'margin-top',
			),
		),
	),
);

// Single Shop
$this->sections['sublime_single_shop_general'] = array(
	'title' => esc_html__( 'Single Shop', 'sublime' ),
	'panel' => 'sublime_shop',
	'settings' => array(
		array(
			'id' => 'shop_single_layout_position',
			'default' => 'no-sidebar',
			'control' => array(
				'label' => esc_html__( 'Shop Single Layout Position', 'sublime' ),
				'type' => 'select',
				'choices' => array(
					'sidebar-right' => esc_html__( 'Right Sidebar', 'sublime' ),
					'sidebar-left'  => esc_html__( 'Left Sidebar', 'sublime' ),
					'no-sidebar'    => esc_html__( 'No Sidebar', 'sublime' ),
				),
				'desc' => esc_html__( 'Specify layout on the shop single page.', 'sublime' ),
				'active_callback' => 'sublime_cac_has_woo',
			),
		),
		array(
			'id' => 'shop_single_featured_title',
			'default' => esc_html__( 'Our Shop', 'sublime' ),
			'control' => array(
				'label' => esc_html__( 'Shop Single: Featured Title', 'sublime' ),
				'type' => 'text',
				'active_callback' => 'sublime_cac_has_woo',
			),
		),
		array(
			'id' => 'shop_single_featured_title_background_img',
			'control' => array(
				'type' => 'image',
				'label' => esc_html__( 'Shop Single: Featured Title Background', 'sublime' ),
				'active_callback' => 'sublime_cac_has_woo',
			),
		),
		array(
			'id' => 'shop_realted_columns',
			'default' => '3',
			'control' => array(
				'label' => esc_html__( 'Related Product Columns', 'sublime' ),
				'type' => 'select',
				'choices' => array(
					'2' => '2',
					'3' => '3',
					'4' => '4',
				),
				'active_callback' => 'sublime_cac_has_woo',
			),
		),
	),
);
