<?php

/* Headers */

function sublime_cac_has_header_style1() {
	$header_style = sublime_get_mod( 'header_site_style', 'style-1' );
	if ( is_page() && sublime_elementor( 'header_style' ) )
		$header_style = sublime_elementor( 'header_style' );

	if ( 'style-1' == $header_style ) { return true;
	} else { return false; }
}

function sublime_cac_has_header_style2() {
	$header_style = sublime_get_mod( 'header_site_style', 'style-1' );
	if ( is_page() && sublime_elementor( 'header_style' ) )
		$header_style = sublime_elementor( 'header_style' );

	if ( 'style-2' == $header_style ) { return true;
	} else { return false; }
}

function sublime_cac_has_header_style3() {
	$header_style = sublime_get_mod( 'header_site_style', 'style-1' );
	if ( is_page() && sublime_elementor( 'header_style' ) )
		$header_style = sublime_elementor( 'header_style' );

	if ( 'style-3' == $header_style ) { return true;
	} else { return false; }
}

function sublime_cac_has_header_topbar() {
	return get_theme_mod( 'header_topbar', true );
}

function sublime_cac_has_header_socials() {
	return get_theme_mod( 'header_socials', true );
}

function sublime_cac_header_search_icon() {
	return get_theme_mod( 'header_search_icon', true );
}

function sublime_cac_header_cart_icon() {
	if ( class_exists( 'woocommerce' ) && get_theme_mod( 'header_cart_icon', true ) ) {
		return true;	
	} else {
		return false;
	}
}

function sublime_cac_has_header_fixed() {
	return get_theme_mod( 'header_fixed', true );
}

/* WooCommerce */
function sublime_cac_has_woo() {
	if ( class_exists( 'woocommerce' ) ) { return true;	}
	else { return false; }
}

/* Scroll Top Button */
function sublime_cac_has_scroll_top() {
	return get_theme_mod( 'scroll_top', true );
}

/* Layout */
function sublime_cac_has_boxed_layout() {
	if ( 'boxed' == get_theme_mod( 'site_layout_style', 'full-width' ) ) {
		return true;
	} else {
		return false;
	}
}

/* Featured Title */
function sublime_cac_has_featured_title() {
	return get_theme_mod( 'featured_title', true );
}

function sublime_cac_has_featured_title_center() {
	if ( sublime_cac_has_featured_title_heading()
		&& 'centered' == get_theme_mod( 'featured_title_style' ) ) {
		return true;
	} else {
		return false;
	}
}

function sublime_cac_has_featured_title_breadcrumbs() {
	if ( sublime_cac_has_featured_title() && get_theme_mod( 'featured_title_breadcrumbs' ) ) {
		return true;
	} else {
		return false;
	}
}

function sublime_cac_has_featured_title_heading() {
	if ( sublime_cac_has_featured_title() && get_theme_mod( 'featured_title_heading' ) ) {
		return true;
	} else {
		return false;
	}
}

/* Project Single */
function sublime_cac_has_single_project() {
	if ( is_singular( 'project' ) ) {
		return true;
	} else {
		return false;
	}
}

function sublime_cac_has_related_project() {
	if ( sublime_get_mod( 'project_related', true ) && sublime_cac_has_single_project() ) {
		return true;
	};
}

/* Service Single */
function sublime_cac_has_single_service() {
	if ( is_singular( 'service' ) ) {
		return true;
	} else {
		return false;
	}
}

/* Footer */
function sublime_cac_has_footer_widgets() {
	return get_theme_mod( 'footer_widgets', true );
}

function sublime_cac_has_subscribe_box() {
	return get_theme_mod( 'subscribe_box', true );
}

/* Bottom Bar */
function sublime_cac_has_bottombar() {
	return get_theme_mod( 'bottom_bar', true );
}
