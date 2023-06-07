<?php
/**
 * Header / Search
 *
 * @package sublime
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Search Icon
if ( sublime_get_mod( 'header_search_icon', false ) ) {
	echo '<div class="header-search-wrap"><a href="#" class="header-search-trigger">' .
		sublime_svg( 'search' ) . '</a></div>';
} ?>


