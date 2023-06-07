<?php

// Add new image size
function mae_custom_image_sizes() {
	add_image_size( 'mae-std1', 380, 255, true );
}
add_action( 'after_setup_theme', 'mae_custom_image_sizes' );