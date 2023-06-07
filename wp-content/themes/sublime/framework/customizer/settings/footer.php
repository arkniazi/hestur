<?php
/**
 * Footer setting for Customizer
 *
 * @package sublime
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Footer General
$this->sections['sublime_footer_general'] = array(
	'title' => esc_html__( 'General', 'sublime' ),
	'panel' => 'sublime_footer',
	'settings' => array(
		array(
			'id' => 'footer_site_style',
			'default' => 'basic',
			'control' => array(
				'label' => esc_html__( 'Footer Style', 'sublime' ),
				'type' => 'select',
				'choices' => array(
                    'basic' => esc_html__( 'Basic', 'sublime' ),
                    'fixed' => esc_html__( 'Fixed', 'sublime' ),
				),
			),
		),
		array(
			'id' => 'footer_columns',
			'default' => '4',
			'control' => array(
				'label' => esc_html__( 'Footer Column(s)', 'sublime' ),
				'type' => 'select',
				'choices' => array(
					'5' => '5-3-4',
					'4' => '3-3-3-3',
					'3' => '4-4-4',
					'2' => '6-6',
					'1' => '12',
				),
			),
		),
		array(
			'id' => 'footer_column_gutter',
			'default' => '30',
			'transport' => 'postMessage',
			'control' => array(
				'label' => esc_html__( 'Footer Column Gutter', 'sublime' ),
				'type' => 'select',
				'choices' => array(
					'5'    => '5px',
					'10'   => '10px',
					'15'   => '15px',
					'20'   => '20px',
					'25'   => '25px',
					'30'   => '30px',
					'35'   => '35px',
					'40'   => '40px',
					'45'   => '45px',
					'50'   => '50px',
					'60'   => '60px',
					'70'   => '70px',
					'80'   => '80px',
				),
			),
		),
		array(
			'id' => 'footer_text_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Text Color', 'sublime' ),
			),
			'inline_css' => array(
				'target' => '#footer-widgets .widget',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'footer_background',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Background Color', 'sublime' ),
			),
			'inline_css' => array(
				'target' => '#footer',
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'footer_bg_img',
			'control' => array(
				'type' => 'image',
				'label' => esc_html__( 'Background Image', 'sublime' ),
			),
		),
		array(
			'id' => 'footer_bg_img_style',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Background Image Style', 'sublime' ),
				'type'  => 'image',
				'type'  => 'select',
				'choices' => array(
					''             => esc_html__( 'Default', 'sublime' ),
					'cover'        => esc_html__( 'Cover', 'sublime' ),
					'center-top'   => esc_html__( 'Center Top', 'sublime' ),
					'fixed-top'    => esc_html__( 'Fixed Top', 'sublime' ),
					'fixed'        => esc_html__( 'Fixed Center', 'sublime' ),
					'fixed-bottom' => esc_html__( 'Fixed Bottom', 'sublime' ),
					'repeat'       => esc_html__( 'Repeat', 'sublime' ),
					'repeat-x'     => esc_html__( 'Repeat-x', 'sublime' ),
					'repeat-y'     => esc_html__( 'Repeat-y', 'sublime' ),
				),
			),
		),
		array(
			'id' => 'footer_top_padding',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Top Padding', 'sublime' ),
				'description' => esc_html__( 'Example: 60px.', 'sublime' ),
			),
			'inline_css' => array(
				'target' => '#footer',
				'alter' => 'padding-top',
			),
		),
		array(
			'id' => 'footer_bottom_padding',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Bottom Padding', 'sublime' ),
				'description' => esc_html__( 'Example: 60px.', 'sublime' ),
			),
			'inline_css' => array(
				'target' => '#footer',
				'alter' => 'padding-bottom',
			),
		),
	),
);

// Footer Promotion
$this->sections['sublime_footer_promotion'] = array(
	'title' => esc_html__( 'Subscribe Block', 'sublime' ),
	'panel' => 'sublime_footer',
	'settings' => array(
		array(
			'id' => 'subscribe_box',
			'default' => false,
			'control' => array(
				'label' => esc_html__( 'Enable', 'sublime' ),
				'type' => 'checkbox',
			),
		),
		array(
			'id' => 'subs_heading',
			'default' => esc_html__( 'Subscribe to our mailing list. Join our mail list to receive our newsletter', 'sublime' ),
			'control' => array(
				'label' => esc_html__( 'Heading', 'sublime' ),
				'type' => 'sublime_textarea',
				'rows' => 3,
				'active_callback' => 'sublime_cac_has_subscribe_box',
			),
		),
		array(
			'id' => 'subs_subheading',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Sub-Heading', 'sublime' ),
				'type' => 'sublime_textarea',
				'rows' => 3,
				'active_callback' => 'sublime_cac_has_subscribe_box',
			),
		),
		array(
			'id' => 'subs_text',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Text', 'sublime' ),
				'type' => 'sublime_textarea',
				'rows' => 3,
				'active_callback' => 'sublime_cac_has_subscribe_box',
			),
		),
		array(
			'id' => 'subs_background',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Background Color', 'sublime' ),
				'active_callback' => 'sublime_cac_has_subscribe_box',
			),
			'inline_css' => array(
				'target' => '.footer-subscribe',
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'subs_background_img',
			'control' => array(
				'type' => 'image',
				'label' => esc_html__( 'Background Image', 'sublime' ),
				'active_callback' => 'sublime_cac_has_subscribe_box',
			),
		),
		array(
			'id' => 'subs_background_img_style',
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
				'active_callback' => 'sublime_cac_has_subscribe_box',
			),
		),
	),
);