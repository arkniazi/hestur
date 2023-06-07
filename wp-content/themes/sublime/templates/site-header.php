<?php
/**
 * Header
 *
 * @package sublime
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
$cls ='';

// Get header style
$cls = sublime_get_mod( 'header_class' );
$header_style = sublime_get_mod( 'header_site_style', 'style-1' );

if ( is_page() && sublime_elementor( 'header_style' ) )
    $header_style = sublime_elementor( 'header_style' );

// Extra class
if ( sublime_elementor( 'header_extra' ) ) $cls = sublime_elementor( 'header_extra' );
?>

<?php get_template_part( 'templates/header-extra-nav' ); ?>

<?php if ( sublime_get_mod( 'header_topbar', false ) ) { ?>
    <div class="top-bar clearfix">
        <div class="sublime-container">
            <div class="topbar-left">
                <?php get_template_part( 'templates/header-info'); ?>

                <div class="top-menu">
                    <?php
                    wp_nav_menu( array(
                        'theme_location' => 'top',
                        'fallback_cb'    => false,
                        'container'      => false,
                        'menu_class'     => 'top-nav',
                    ) );
                    ?>
                </div>
            </div>
            
            <div class="topbar-right">
                <?php get_template_part( 'templates/header-social'); ?>
            </div>        
        </div>
    </div>
<?php } ?>

<header id="site-header" class="<?php echo esc_attr( $cls ); ?>">
    <div class="sublime-container">
    	<div class="site-header-inner">
            <div class="wrap-inner">
                <?php get_template_part( 'templates/header-logo'); ?>
                <div class="append"></div>
                <?php get_template_part( 'templates/header-menu'); ?>
                
                <div class="search-cart-wrap">
            		<?php 
                    get_template_part( 'templates/header-search');       
                    get_template_part( 'templates/header-cart');       
            		get_template_part( 'templates/header-button');
            		?>
                </div>
            </div>
    	</div>
    </div>
</header><!-- /#site-header -->
