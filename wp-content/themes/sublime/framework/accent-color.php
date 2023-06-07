<?php
/**
 * Accent color
 *
 * @package sublime
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Start class
if ( ! class_exists( 'Sublime_Accent_Color' ) ) {
	class Sublime_Accent_Color {
		// Main constructor
		function __construct() {
			add_filter( 'sublime_custom_colors_css', array( 'Sublime_Accent_Color', 'head_css' ), 999 );
		}

		// Generates arrays of elements to target
		public static function arrays( $return ) {
			// Color
			$texts = apply_filters( 'sublime_accent_texts', array(
				 // Default Link
				 'a',
				'.accent-color',
				'#site-logo .site-logo-text:hover',
				'.header-socials a:hover',
				'.hentry .page-links>span',
				'.hentry .page-links a>span',
				'.hentry .post-media .post-date-custom',
				'.hentry .post-title a:hover',
				'.hentry .post-meta a:hover',
				'.hentry .post-author .author-socials .socials a:hover',
				'#post-nav .link:hover',
				'#post-nav .content-wrap h4:hover a ',
				'.related-news .post-item .post-categories a:hover',
				'.related-news .post-item .text-wrap h3 a:hover',
				'.related-news .related-post .slick-next:hover:before',
				'.related-news .related-post .slick-prev:hover:before',
				'.comment-reply-link',
				'.comment-edit-link',
				'#cancel-comment-reply-link',
				'.unapproved',
				'.logged-in-as a',
				'.widget.widget_archive ul li a:hover',
				'.widget.widget_categories ul li a:hover',
				'.widget.widget_meta ul li a:hover',
				'.widget.widget_nav_menu ul li a:hover',
				'.widget.widget_pages ul li a:hover',
				'.widget.widget_recent_entries ul li a:hover',
				'.widget.widget_recent_comments ul li a:hover',
				'.widget.widget_rss ul li a:hover',
				'#sidebar .widget.widget_calendar caption',
				'.widget.widget_latest_posts .categories a:hover',
				'.widget.widget_latest_posts .current .post-title a',
				'.widget.widget_latest_posts .post-title:hover a ',
				'.widget.widget_nav_menu .menu>li.current-menu-item>a',
				'.widget.widget_nav_menu .menu>li.current-menu-item',
				'.widget.widget_calendar a',
				'.widget.widget_calendar tbody #today',
				'#footer .widget_mc4wp_form_widget .submit-wrap button:after',
				'.widget.widget_socials .socials a:hover',
				'.widget.widget_recent_posts h3 a:hover',
				'.widget.widget_recent_posts .post-author a ',
				'.cf7-widget .submit-wrap:after',
				// shortcodes
				'.master-link:hover',
				'.master-button.btn-white',
				'.master-button.btn-outline',
				'.master-icon',
				'.master-quote .name a',
				'.master-quote .name a:hover',
				'.master-quote .role',
				'.master-counter .icon-wrap',
				'.master-subscribe-form button:hover',
				'.master-subscribe-form.style-3 button',
				'.wpcf7 .cf7-style-1 .wpcf7-submit',
				'.master-project:hover .headline-2 a',
				'.projects-filter .cbp-filter-item:hover',
				'.projects-filter .cbp-filter-item.cbp-filter-item-active',
				'.news-style-1 .master-news:hover .headline-2 a',
				'.master-price-box .desc ul.has-arrow li > span:before',
				'.master-team .team-name:hover',
				'.master-team .socials-wrap a',
				'.master-team-slider .slick-content .position',
				'.master-timeline .timeline-number .number',
				'.master-project-widget .widget-project-related .project-title:hover',
				'.master-project-widget .widget-project-related .project-cat:hover',
				 // Woocommerce
				'.woocommerce-page .woocommerce-MyAccount-content .woocommerce-info .button',
				'.products li .product-info .button',
				'.products li .product-info .added_to_cart',
				'.products li .product-cat:hover',
				'.products li h2:hover',
				'.woo-single-post-class .images .woocommerce-product-gallery__trigger:hover:after',
				'.woo-single-post-class .woocommerce-grouped-product-list-item__label a:hover',
				'.woo-single-post-class .summary .product_meta>span a:hover',
				'.woocommerce-page .shop_table.cart .product-name a:hover',
				'form.login .input-submit~span.lost_password a',
				'form.register .input-submit~span.lost_password a',
				'.product_list_widget .product-title:hover',
				'.widget_recent_reviews .product_list_widget a:hover',
				'.widget_product_categories ul li a:hover',
				'.widget.widget_product_search .woocommerce-product-search .search-submit:hover:before',
				'.widget_shopping_cart_content ul li a:hover',
				'.widget_shopping_cart_content ul li a.remove',
			) );

			// Background color
			$backgrounds = apply_filters( 'sublime_accent_backgrounds', array(
				'bg-accent',
				'blockquote:before',
				'.button',
				'button',
				'input[type="button"]',
				'input[type="reset"]',
				'input[type="submit"]',
				'.hbt-style-1 .header-button.master-button',
				'.post-media .slick-prev:hover',
				'.post-media .slick-next:hover',
				'.post-media .slick-dots li.slick-active:after',
				'.post-media .post-cat-custom a',
				'.hentry .post-tags a:hover',
				'.widget.widget_links ul li a:after',
				'.widget.widget_tag_cloud .tagcloud a:hover',
				'#footer .widget.widget_tag_cloud .tagcloud a:hover',
				'.widget.widget_banner .btn a',
				'#scroll-top:before',
				'#scroll-top:hover:before',
				'.sublime-pagination ul li .page-numbers:hover',
				'.woocommerce-pagination .page-numbers li .page-numbers:hover',
				'.sublime-pagination ul li .page-numbers.current',
				'.woocommerce-pagination .page-numbers li .page-numbers.current ',
				// shortcodes
				'.master-button',
				'.master-heading .divider:before',
				'.master-heading .divider:after',
				'.master-heading .divider > span:before',
				'.master-heading .divider > span:after',
				'.hover-effect-style-1 .elementor-widget-container:before',
				'.master-carousel-box .flickity-page-dots .dot.is-selected',
				'.master-quote .name a:before',
				'.master-progress-bar .progress',
				'.master-tabs .tab-link .hover-effect',
				'.master-subscribe-form button',
				'.coming-soon .master-demo-box .image-wrap',
				'.master-team .socials-wrap a:hover',
				'.master-team-carousel .master-team .content-wrap',
				'.master-slick-slider .slick-dots>li.slick-active>button:after ',
				'.master-project-widget .widget-socials a:hover ',
				// woocemmerce
				'.woo-single-post-class .woocommerce-tabs ul li:after',
				'.woocommerce-page .return-to-shop a',
				'.woocommerce-MyAccount-navigation ul li.is-active',
				'.widget_price_filter .price_slider_amount .button:hover',
				'.widget_price_filter .ui-slider .ui-slider-range',
				'.widget_shopping_cart_content .buttons a.checkout',
			) );

			// Border color
			$borders = apply_filters( 'sublime_accent_borders', array(
				'border-accent',
				'.underline-solid:after, .underline-dotted:after, .underline-dashed:after' => array('bottom'),
				'.post.sticky',
				'.sublime-pagination ul li .page-numbers:hover',
				'.woocommerce-pagination .page-numbers li .page-numbers:hover',
				'.sublime-pagination ul li .page-numbers.current',
				'.woocommerce-pagination .page-numbers li .page-numbers.current',
				// shortcodes
				'.master-button.btn-outline',
				'.master-carousel-box .flickity-page-dots .dot',
				'.wpcf7 .cf7-style-1 .wpcf7-submit',
				'.master-team .socials-wrap a',
				'.master-project-widget .widget-socials a:hover ',
				// woocommerce
				'.widget_price_filter .price_slider_amount .button',
			) );

			// Gradient color
			$gradients = apply_filters( 'sublime_accent_gradients', array(
				'.sublime-progress .progress-animate.accent.gradient'
			) );

			// Stroke color
			$strokes = apply_filters( 'sublime_accent_strokes', array(
				'.header-style-1 .header-search-trigger:hover svg',
				'.header-style-1 .nav-top-cart-wrapper .nav-cart-trigger:hover svg',
				'.header-style-3 .header-search-trigger:hover svg', 
				'.header-style-3 .nav-top-cart-wrapper .nav-cart-trigger:hover svg',
				'#main-nav-mobi .search-form .search-submit:hover',
				'.search-style-fullscreen .search-submit:hover svg',
				'.no-results-content .search-form .search-submit:hover svg',
			) );

			// Return array
			if ( 'texts' == $return ) {
				return $texts;
			} elseif ( 'backgrounds' == $return ) {
				return $backgrounds;
			} elseif ( 'borders' == $return ) {
				return $borders;
			} elseif ( 'gradients' == $return ) {
				return $gradients;
			} elseif ( 'strokes' == $return ) {
				return $strokes;
			}
		}

		// Generates the CSS output
		public static function head_css( $output ) {

			// Get custom accent
			$default_accent = '#4732d7';
			$custom_accent  = sublime_get_mod( 'accent_color' );

			// Return if accent color is empty or equal to default
			if ( ! $custom_accent || ( $default_accent == $custom_accent ) )
				return $output;

			// Define css var
			$css = '';

			// Get arrays
			$texts       = self::arrays( 'texts' );
			$backgrounds = self::arrays( 'backgrounds' );
			$borders     = self::arrays( 'borders' );
			$gradients    = self::arrays( 'gradients' );
			$strokes    = self::arrays( 'strokes' );

			// Texts
			if ( ! empty( $texts ) )
				$css .= implode( ',', $texts ) .'{color:'. $custom_accent .';}';

			// Backgrounds
			if ( ! empty( $backgrounds ) )
				$css .= implode( ',', $backgrounds ) .'{background-color:'. $custom_accent .';}';

			// Borders
			if ( ! empty( $borders ) ) {
				foreach ( $borders as $key => $val ) {
					if ( is_array( $val ) ) {
						$css .= $key .'{';
						foreach ( $val as $key => $val ) {
							$css .= 'border-'. $val .'-color:'. $custom_accent .';';
						}
						$css .= '}'; 
					} else {
						$css .= $val .'{border-color:'. $custom_accent .';}';
					}
				}
			}

			// Gradients
			if ( ! empty( $gradients ) )
				$css .= implode( ',', $gradients ) .'{background: '. sublime_hex2rgba($custom_accent, 1) .';background: -moz-linear-gradient(left, '. sublime_hex2rgba($custom_accent, 1) .' 0%, '. sublime_hex2rgba($custom_accent, 0.3) .' 100%);background: -webkit-linear-gradient( left, '. sublime_hex2rgba($custom_accent, 1) .' 0%, '. sublime_hex2rgba($custom_accent, 0.3) .' 100% );background: linear-gradient(to right, '. sublime_hex2rgba($custom_accent, 1) .' 0%, '. sublime_hex2rgba($custom_accent, 0.3) .' 100%) !important;}';

			// Strokes
			if ( ! empty( $strokes ) )
				$css .= implode( ',', $strokes ) .'{stroke:'. $custom_accent .';}';


			// Return CSS
			if ( ! empty( $css ) )
				$output .= '/*ACCENT COLOR*/'. $css;

			// Return output css
			return $output;
		}
	}
}

new Sublime_Accent_Color();
