<?php
/**
 * Projects setting for Customizer
 *
 * @package sublime
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Project Related General
$this->sections['sublime_projects_general'] = array(
	'title' => esc_html__( 'General', 'sublime' ),
	'panel' => 'sublime_projects',
	'settings' => array(
		array(
			'id' => 'project_related',
			'default' => false,
			'control' => array(
				'label' => esc_html__( 'Enable Related Project', 'sublime' ),
				'type' => 'checkbox',
				'active_callback' => 'sublime_cac_has_single_project',
			),
		),
		array(
			'id' => 'project_single_featured_title_background_img',
			'control' => array(
				'type' => 'image',
				'label' => esc_html__( 'Single Project: Featured Title Background', 'sublime' ),
				'active_callback' => 'sublime_cac_has_related_project',
			),
		),
		array(
			'id' => 'related_pre_title', 
			'default' => esc_html__( 'EXPLORE PROJECTS', 'sublime' ),
			'control' => array(
				'label' => esc_html__( 'Project Related Pre-Title', 'sublime' ),
				'type' => 'sublime_textarea',
				'rows' => 3,
				'active_callback' => 'sublime_cac_has_related_project',
			),
		),
		array(
			'id' => 'related_title',
			'default' => esc_html__( 'OUR RECENT PROJECTS', 'sublime' ),
			'control' => array(
				'label' => esc_html__( 'Project Related Title', 'sublime' ),
				'type' => 'sublime_textarea',
				'rows' => 3,
				'active_callback' => 'sublime_cac_has_related_project',
			),
		),
		array(
			'id' => 'project_related_query',
			'default' => 7,
			'control' => array(
				'label' => esc_html__( 'Number of items', 'sublime' ),
				'type' => 'number',
				'active_callback' => 'sublime_cac_has_related_project',
			),
		),
		array(
			'id' => 'project_related_column',
			'default' => '3',
			'control' => array(
				'label' => esc_html__( 'Columns', 'sublime' ),
				'type' => 'select',
				'choices' => array(
					'4' => '4',
					'3' => '3',
					'2' => '2',
				),
				'active_callback' => 'sublime_cac_has_related_project',
			),
		),
		array(
			'id' => 'project_related_item_spacing',
			'default' => 30,
			'control' => array(
				'label' => esc_html__( 'Spacing between items', 'sublime' ),
				'type' => 'number',
				'active_callback' => 'sublime_cac_has_related_project',
			),
		),
	),
);