<?php
/**
 * Bottom Bar setting for Customizer
 *
 * @package sublime
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Bottom Bar General
$this->sections['sublime_bottombar_general'] = array(
	'title' => esc_html__( 'General', 'sublime' ),
	'panel' => 'sublime_bottombar',
	'settings' => array(
		array(
			'id' => 'bottom_bar',
			'default' => true,
			'control' => array(
				'label' => esc_html__( 'Enable', 'sublime' ),
				'type' => 'checkbox',
			),
		),
		array(
			'id' => 'bottom_bar_style',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Style', 'sublime' ),
				'type' => 'select',
				'default' => 'style-1',
				'choices' => array(
					'style-1' => esc_html__( 'Copyright', 'sublime' ),
					'style-2' => esc_html__( 'Copyright + Menu', 'sublime' ),
				),
				'active_callback' => 'sublime_cac_has_bottombar',
			),
		),
		array(
			'id' => 'bottom_copyright',
			'transport' => 'postMessage',
			'default' => '&copy; Sublime - Creative Multipurpose WordPress Theme. All Right Reserved.',
			'control' => array(
				'label' => esc_html__( 'Copyright', 'sublime' ),
				'type' => 'sublime_textarea',
				'active_callback' => 'sublime_cac_has_bottombar',
			),
		),
		array(
			'id' => 'bottom_padding',
			'transport' => 'postMessage',
			'control' =>  array(
				'type' => 'text',
				'label' => esc_html__( 'Padding', 'sublime' ),
				'description' => esc_html__( 'Top Right Bottom Left.', 'sublime' ),
				'active_callback'=> 'sublime_cac_has_bottombar',
			),
			'inline_css' => array(
				'target' => '#bottom .bottom-bar-inner-wrap',
				'alter' => 'padding',
			),
		),
		array(
			'id' => 'bottom_background',
			'transport' => 'postMessage',
			'control' =>  array(
				'type' => 'color',
				'label' => esc_html__( 'Background', 'sublime' ),
				'active_callback'=> 'sublime_cac_has_bottombar',
			),
			'inline_css' => array(
				'target' => '#bottom',
				'alter' => 'background',
			),
		),
		array(
			'id' => 'bottom_background_img',
			'control' => array(
				'type' => 'image',
				'label' => esc_html__( 'Background Image', 'sublime' ),
				'active_callback' => 'sublime_cac_has_bottombar',
			),
		),
		array(
			'id' => 'bottom_background_img_style',
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
				'active_callback' => 'sublime_cac_has_bottombar',
			),
		),
		array(
			'id' => 'bottom_color',
			'transport' => 'postMessage',
			'control' =>  array(
				'type' => 'color',
				'label' => esc_html__( 'Color', 'sublime' ),
				'active_callback'=> 'sublime_cac_has_bottombar',
			),
			'inline_css' => array(
				'target' => '#bottom',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'line_color',
			'transport' => 'postMessage',
			'control' =>  array(
				'type' => 'color',
				'label' => esc_html__( 'Line Color', 'sublime' ),
				'active_callback'=> 'sublime_cac_has_bottombar',
			),
			'inline_css' => array(
				'target' => '#bottom:before',
				'alter' => 'background-color',
			),
		),
	),
);
