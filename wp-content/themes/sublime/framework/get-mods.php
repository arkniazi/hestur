<?php
/**
 * Gets all theme mods and stores them in an easily accessable global var to limit DB requests
 *
 * @package sublime
 * @version 3.6.8
 */

global $sublime_theme_mods;
$sublime_theme_mods = get_theme_mods();

// Returns theme mod from global var
function sublime_get_mod( $id, $default = '' ) {

	// Return get_theme_mod on customize_preview
	if ( is_customize_preview() ) {
		return get_theme_mod( $id, $default );
	}
   
	// Get global object
	global $sublime_theme_mods;

	// Return data from global object
	if ( ! empty( $sublime_theme_mods ) ) {

		// Return value
		if ( isset( $sublime_theme_mods[$id] ) ) {
			return $sublime_theme_mods[$id];
		} 
		else {
			return $default;
		}
	}

	// Global object not found return using get_theme_mod
	else {
		return get_theme_mod( $id, $default );
	}
}

// Returns global mods
function sublime_get_mods() {
	global $sublime_theme_mods;
	return $sublime_theme_mods;
}