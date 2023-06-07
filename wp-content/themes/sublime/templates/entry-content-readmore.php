<?php
/**
 * Entry Content / Read More
 *
 * @package sublime
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Get defaults from Customizer
$text_more = sublime_get_mod( 'blog_entry_button_read_more_text' );
$text_more   = $text_more ? $text_more : esc_html__( 'Read More', 'sublime' ); ?>

<div class="post-read-more master-button">
	<a href="<?php esc_url( the_permalink() ); ?>" class="" title="<?php echo esc_attr( $text_more ); ?>">
		<?php echo esc_html( $text_more ); ?>
		<span class="hover-effect"></span>
	</a>
</div>