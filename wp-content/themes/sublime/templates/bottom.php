<?php
/**
 * Bottom Bar
 *
 * @package sublime
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Exit if disabled via Customizer
if ( ! sublime_get_mod( 'bottom_bar', true ) ) return false;

$bottom_style = sublime_get_mod( 'bottom_bar_style', 'style-1' );
$copyright = sublime_get_mod( 'bottom_copyright', '&copy; Sublime - Creative Multipurpose WordPress Theme. All Right Reserved.' );

$css = sublime_element_bg_css( 'bottom_background_img' );
$cls = $bottom_style;
?>

<div id="bottom" class="<?php echo esc_attr( $cls ); ?>" style="<?php echo esc_attr( $css ); ?>">
    <div class="sublime-container">
        <div class="bottom-bar-inner-wrap">
            <div class="inner-wrap clearfix">

                <?php if ( $copyright ) : ?>
                    <div id="copyright">
                        <?php printf( '%s', do_shortcode( $copyright ) ); ?>
                    </div>
                <?php endif; ?>

                <?php if ( 'style-2' == $bottom_style ) : ?>
                    <div class="bottom-bar-menu">
                        <?php get_template_part( 'templates/bottom-nav' ); ?>
                    </div><!-- /.bottom-bar-menu -->
                <?php endif; ?>
            </div><!-- /.bottom-bar-copyright -->
        </div>
    </div>

    <?php get_template_part( 'templates/scroll-top'); ?>
</div><!-- /#bottom -->