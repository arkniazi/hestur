<?php
// Get layout position
$layout = sublime_layout_position();

$sidebar = 'sidebar-blog';

if ( is_page() ) $sidebar = 'no-sidebar';

if ( sublime_is_woocommerce_page() )
	$sidebar = 'sidebar-shop';

if ( is_active_sidebar( $sidebar ) ) : ?>


<div id="sidebar">
	<div id="inner-sidebar" class="inner-content-wrap">
		<?php dynamic_sidebar( $sidebar ); ?>
	</div>
</div><!-- /#sidebar -->



<?php endif; ?>