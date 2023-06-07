<?php
/**
 * Header / Button
 *
 * @package sublime
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$button = sublime_get_mod( 'header_button', true );
if ( ! $button ) return false;

// Get defaults from Customizer
$text = sublime_get_mod( 'header_button_text', '' );
$url = sublime_get_mod( 'header_button_url', '' );

if ( $text && $url ) : ?>
	<div class="master-button header-button">
	    <?php
	    if ( $text && $url ) : ?>
	        <a href="<?php echo esc_url( do_shortcode( $url ) ); ?>">
	            <?php echo do_shortcode( $text ); ?>
	            <span class="hover-effect"></span>
	        </a>
	    <?php endif; ?>
	</div><!-- /.header-info -->
<?php endif; ?>