<?php

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly


add_filter( 'elementor/icons_manager/additional_tabs', 'mae_iconpicker_register' );

function mae_iconpicker_register( $icons = array() ) {

	$icons['linea'] = array(
		'name'          => 'linea',
		'label'         => esc_html__( 'Linea Icons', 'masterlayer' ),
		'labelIcon'     => 'linea-basic-alarm',
		'prefix'        => 'linea-',
		'displayPrefix' => '',
		'url'           => MAE_URL . 'assets/css/linea-icons.css',
		'fetchJson'     => MAE_URL . 'assets/fonts/linea-icons/linea.json',
		'ver'           => '1.0.0',
	);

	$icons['arts'] = array(
		'name'          => 'art',
		'label'         => esc_html__( 'General Arts Icons', 'masterlayer' ),
		'labelIcon'     => 'aicon-picture',
		'prefix'        => 'aicon-',
		'displayPrefix' => '',
		'url'           => MAE_URL . 'assets/css/arts-icons.css',
		'fetchJson'     => MAE_URL . 'assets/fonts/arts-icons/arts-icons.json',
		'ver'           => '1.0.0',
	);

	$icons['socials'] = array(
		'name'          => 'socials',
		'label'         => esc_html__( 'Socials Icons', 'masterlayer' ),
		'labelIcon'     => 'sicon-001-cloud-computing',
		'prefix'        => 'sicon-',
		'displayPrefix' => '',
		'url'           => MAE_URL . 'assets/css/socials-icons.css',
		'fetchJson'     => MAE_URL . 'assets/fonts/socials-icons/socials-icons.json',
		'ver'           => '1.0.0',
	);

	$icons['feather'] = array(
		'name'          => 'feather',
		'label'         => esc_html__( 'Feather Icons', 'masterlayer' ),
		'labelIcon'     => 'fe-feather',
		'prefix'        => 'fe-',
		'displayPrefix' => '',
		'url'           => MAE_URL . 'assets/css/feather-icons.css',
		'fetchJson'     => MAE_URL . 'assets/fonts/feather-icons/feather.json',
		'ver'           => '1.0.0',
	);

	$icons['unicons'] = array(
		'name'          => 'unicons',
		'label'         => esc_html__( 'Unicons Icons', 'masterlayer' ),
		'labelIcon'     => 'unic-px',
		'prefix'        => 'unic-',
		'displayPrefix' => '',
		'url'           => MAE_URL . 'assets/css/unicons-icons.css',
		'fetchJson'     => MAE_URL . 'assets/fonts/unicons-icons/unicons.json',
		'ver'           => '1.0.0',
	);

	return $icons;
}
