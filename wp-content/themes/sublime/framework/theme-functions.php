<?php
/**
 * Framework functions
 *
 * @package sublime
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get Settings options of elementor
function sublime_elementor( $settings ) {
	if ( ! class_exists( '\Elementor\Plugin' ) ) { return false; }

	// Get the current post id
	$post_id = get_the_ID();

	// Get the page settings manager
	$page_settings_manager = \Elementor\Core\Settings\Manager::get_settings_managers( 'page' );

	// Get the settings model for current post
	$page_settings_model = $page_settings_manager->get_model( $post_id );

	return  $page_settings_model->get_settings( $settings );
}

// Return class for reploader site
function sublime_preloader_class() {
	// Get page preloader option from theme mod
	$class = sublime_get_mod( 'preloader', 'animsition' );
	return esc_attr( $class );
}

// Get layout position for pages
function sublime_layout_position() {
	// Default layout position
	$layout = 'sidebar-right';

	// Get layout position for site
	$layout = sublime_get_mod( 'site_layout_position', 'sidebar-right' );

	// Get layout position for single post
	if ( is_singular( 'post' ) )
		$layout = sublime_get_mod( 'single_post_layout_position', 'sidebar-right' );

	// Get layout position for shop pages
	if ( class_exists( 'woocommerce' ) ) {
		if ( is_shop() || is_product_category() )
			$layout = sublime_get_mod( 'shop_layout_position', 'no-sidebar' );  
		if ( is_singular( 'product' ) )
			$layout = sublime_get_mod( 'shop_single_layout_position', 'no-sidebar' );
		if ( is_cart() || is_checkout() ) {
			$layout = 'no-sidebar';
		}
	}

	// Other single except single post
	if ( is_single() && !is_singular( 'post' ) ) 
		$layout = 'no-sidebar';

	// Get layout position for single project
	if ( is_singular( 'project' ) )
		$layout = sublime_get_mod( 'single_project_layout_position', 'no-sidebar' );

	// Get layout position for single service
	if ( is_singular( 'service' ) )
		$layout = sublime_get_mod( 'single_service_layout_position', 'no-sidebar' );

	return $layout;
}

// Theme pagination
function sublime_pagination( $query = '', $echo = true ) {
	
	$prev_arrow = '<i class="elegant-arrow_carrot-left"></i>';
	$next_arrow = '<i class="elegant-arrow_carrot-right"></i>';

	if ( ! $query ) {
		global $wp_query;
		$query = $wp_query;
	}

	$total  = $query->max_num_pages;
	$big    = 999999999;

	// Display pagination
	if ( $total > 1 ) {

		// Get current page
		if ( $current_page = get_query_var( 'paged' ) ) {
			$current_page = $current_page;
		} elseif ( $current_page = get_query_var( 'page' ) ) {
			$current_page = $current_page;
		} else {
			$current_page = 1;
		}

		// Get permalink structure
		if ( get_option( 'permalink_structure' ) ) {
			if ( is_page() ) {
				$format = 'page/%#%/';
			} else {
				$format = '/%#%/';
			}
		} else {
			$format = '&paged=%#%';
		}

		$args = array(
			'base'      => str_replace( $big, '%#%', html_entity_decode( get_pagenum_link( $big ) ) ),
			'format'    => $format,
			'current'   => max( 1, $current_page ),
			'total'     => $total,
			'mid_size'  => 3,
			'type'      => 'list',
			'prev_text' => $prev_arrow,
			'next_text' => $next_arrow
		);

		// Output
		if ( $echo ) {
			echo '<div class="sublime-pagination clearfix">'. paginate_links( $args ) .'</div>';
		} else {
			return '<div class="sublime-pagination clearfix">'. paginate_links( $args ) .'</div>';
		}

	}
}

// Render blog entry blocks
function sublime_blog_entry_layout_blocks() {

	// Get layout blocks
	$blocks = sublime_get_mod( 'blog_entry_composer' );

	// If blocks are 100% empty return defaults
	$blocks = $blocks ? $blocks : 'title,meta,excerpt_content,readmore';

	// Convert blocks to array so we can loop through them
	if ( ! is_array( $blocks ) ) {
		$blocks = explode( ',', $blocks );
	}

	// Set block keys equal to vals
	$blocks = array_combine( $blocks, $blocks );

	// Return blocks
	return $blocks;
}

// Render blog meta items
function sublime_entry_meta() {
	// Get meta items from theme mod
	$meta_item = sublime_get_mod( 'blog_entry_meta_items', array( 'date', 'comments' ) );

	// If blocks are 100% empty return defaults
	$meta_item = $meta_item ? $meta_item : 'author,comments';

	// Turn into array if string
	if ( $meta_item && ! is_array( $meta_item ) ) {
		$meta_item = explode( ',', $meta_item );
	}

	// Set keys equal to values
	$meta_item = array_combine( $meta_item, $meta_item );

	// Loop through items
	foreach ( $meta_item as $item ) :
		if ( 'author' == $item ) {
			printf( '<span class="post-by-author item">%4$s <a class="name" href="%1$s" title="%2$s">%3$s</a></span>',
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				esc_attr( sprintf( esc_html__( 'View all posts by %s', 'sublime' ), get_the_author() ) ),
				get_the_author(),
				esc_html__( 'by', 'sublime' )
			);
		}
		else if ( 'comments' == $item ) {
			if ( comments_open() || get_comments_number() ) {
				echo '<span class="post-comment item"><span class="inner">';
				comments_popup_link( esc_html__( '0 Comments', 'sublime' ), esc_html__( '1 Comment', 'sublime' ), esc_html__( '% Comments', 'sublime' ) );
				echo '</span></span>';
			}
		}
		else if ( 'date' == $item ) {
			printf( '<span class="post-date item"><span class="entry-date">%1$s</span></span>',
				get_the_date()
			);
		}
		else if ( 'categories' == $item ) {
			echo '<span class="post-meta-categories item">' . esc_html__( 'in ', 'sublime' );
			the_category( ', ', get_the_ID() );
			echo '</span>';
		}
	endforeach;
}

// Render blog avatar items
function sublime_entry_avatar() {
	$avarta = get_avatar( get_the_author_meta('email'), '120' );
	$category = get_the_category(); 

	printf( '<span class="post-by-avatar item"><span class="gravatar">%s</span> <span class="text-wrap"><span><span class="text">%s</span> <a class="name" href="%s" title="%s">%s</a></span></span></span>',
		$avarta,
		esc_html__( 'Written by', 'sublime' ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( esc_html__( 'View all posts by %s', 'sublime' ), get_the_author() ) ),
		get_the_author()
	);
}

// Return background CSS
function sublime_bg_css( $style ) {
	$css = '';
	if ( $style = sublime_get_mod( $style ) ) {
		if ( 'fixed' == $style ) {
			$css .= ' background-position: center center; background-repeat: no-repeat; background-attachment: fixed; background-size: cover;';
		} elseif ( 'fixed-top' == $style ) {
			$css .= ' background-position: center top; background-repeat: no-repeat; background-attachment: fixed; background-size: cover;';
		} elseif ( 'fixed-bottom' == $style ) {
			$css .= ' background-position: center bottom; background-repeat: no-repeat; background-attachment: fixed; background-size: cover;';
		} elseif ( 'cover' == $style ) {
			$css .= ' background-repeat: no-repeat; background-position: center top; background-size: cover;';
		} elseif ( 'center-top' == $style ) {
			$css .= ' background-repeat: no-repeat; background-position: center top;';
		} elseif ( 'repeat' == $style ) {
			$css .= ' background-repeat: repeat;';
		} elseif ( 'repeat-x' == $style ) {
			$css .= ' background-repeat: repeat-x;';
		} elseif ( 'repeat-y' == $style ) {
			$css .= ' background-repeat: repeat-y;';
		}
	}

	return esc_attr( $css );
}

// Return background css for elements
function sublime_element_bg_css( $bg ) {
	$css = '';
	$style = $bg .'_style';

	if ( $bg_img = sublime_get_mod( $bg ) )
		$css .= 'background-image: url('. esc_url( $bg_img ). ');';

	$css .= sublime_bg_css( $style );

	return esc_attr( $css );
}

// Return background css for featured title area
function sublime_featured_title_bg() {
	$css = '';
	
	if ( is_page() ) {
		$page_bg_url = '';
		$bg_img = sublime_get_mod( 'featured_title_background_img' );
		if ( !$page_bg_url && $bg_img ) {
			$css .= 'background-image: url('. esc_url( $bg_img ) .');';
		} else {
			$css .= 'background-image: url('. esc_url( $page_bg_url ) .');';
		}
		
	} elseif ( is_single() && ( $bg_img = sublime_get_mod( 'blog_single_featured_title_background_img' ) ) ) {
		$css .= 'background-image: url('. esc_url( $bg_img ) .');';
	} elseif ( $bg_img = sublime_get_mod( 'featured_title_background_img' ) ) {
		$css .= 'background-image: url('. esc_url( $bg_img ) .');';
	}

	if ( sublime_is_woocommerce_shop() && $bg_img = sublime_get_mod( 'shop_featured_title_background_img' ) ) {
		$css .= 'background-image: url('. esc_url( $bg_img ) .');';
	}

	if ( is_singular( 'product' ) && $bg_img = sublime_get_mod( 'shop_single_featured_title_background_img' ) ) {
		$css .= 'background-image: url('. esc_url( $bg_img ) .');';
	}

	if ( is_tax() || is_singular( 'project' ) ) {
		if ( $bg_img = sublime_get_mod( 'project_single_featured_title_background_img' ) )
			$css .= 'background-image: url('. esc_url( $bg_img ) .');';
	}

	$css .= sublime_bg_css('featured_title_background_img_style');

	return esc_attr( $css );
}

// Return background for main content area
function sublime_main_content_bg() {
	$css = '';

	if ( $bg_img = sublime_get_mod( 'main_content_background_img' ) ) {
		$css = 'background-image: url('. esc_url( $bg_img ). ');';
	}

	$css .= sublime_bg_css('main_content_background_img_style');

	return esc_attr( $css );
}

add_action( 'after_setup_theme', 'sublime_main_content_bg' );

// Return background for footer area
function sublime_footer_bg() {
	$css = '';

	if ( $bg_img = sublime_get_mod( 'footer_bg_img' ) ) {
		$css .= 'background-image: url('. esc_url( $bg_img ) .');';
	}

	$css .= sublime_bg_css('footer_bg_img_style');

	return esc_attr( $css );
}

// Returns array of social
function sublime_header_social_options() {
	return apply_filters ( 'sublime_header_social_options', array(
		'facebook' => array(
			'label' => esc_html__( 'Facebook', 'sublime' ),
			'icon_class' => 'fab fa-facebook-f',
		),
		'twitter' => array(
			'label' => esc_html__( 'Twitter', 'sublime' ),
			'icon_class' => 'fab fa-twitter',
		),
		'instagram'  => array(
			'label' => esc_html__( 'Instagram', 'sublime' ),
			'icon_class' => 'fab fa-instagram',
		),
		'youtube' => array(
			'label' => esc_html__( 'Youtube', 'sublime' ),
			'icon_class' => 'fab fa-youtube',
		),
		'dribbble'  => array(
			'label' => esc_html__( 'Dribbble', 'sublime' ),
			'icon_class' => 'fab fa-dribbble',
		),
		'vimeo' => array(
			'label' => esc_html__( 'Vimeo', 'sublime' ),
			'icon_class' => 'fab fa-vimeo',
		),
		'tumblr'  => array(
			'label' => esc_html__( 'Tumblr', 'sublime' ),
			'icon_class' => 'fab fa-tumblr',
		),
		'pinterest'  => array(
			'label' => esc_html__( 'Pinterest', 'sublime' ),
			'icon_class' => 'fab fa-pinterest',
		),
		'linkedin'  => array(
			'label' => esc_html__( 'LinkedIn', 'sublime' ),
			'icon_class' => 'fab fa-linkedin',
		),
	) );
}

// Check if it is WooCommerce Pages
function sublime_is_woocommerce_page() {
    if ( function_exists ( "is_woocommerce" ) && is_woocommerce() )
		return true;

    $woocommerce_keys = array (
    	"woocommerce_shop_page_id" ,
        "woocommerce_terms_page_id" ,
        "woocommerce_cart_page_id" ,
        "woocommerce_checkout_page_id" ,
        "woocommerce_pay_page_id" ,
        "woocommerce_thanks_page_id" ,
        "woocommerce_myaccount_page_id" ,
        "woocommerce_edit_address_page_id" ,
        "woocommerce_view_order_page_id" ,
        "woocommerce_change_password_page_id" ,
        "woocommerce_logout_page_id" ,
        "woocommerce_lost_password_page_id" );

    foreach ( $woocommerce_keys as $wc_page_id ) {
		if ( get_the_ID () == get_option ( $wc_page_id , 0 ) ) {
			return true ;
		}
    }
    
    return false;
}

// Checks if is WooCommerce Shop page
function sublime_is_woocommerce_shop() {
	if ( ! class_exists( 'woocommerce' ) ) {
		return false;
	} elseif ( is_shop() ) {
		return true;
	}
}

// Checks if is WooCommerce archive product page
function sublime_is_woocommerce_archive_product() {
	if ( ! class_exists( 'woocommerce' ) ) {
		return false;
	} elseif ( is_product_category() || is_product_tag() ) {
		return true;
	}
}

// Returns correct ID for any object
function sublime_parse_obj_id( $id = '', $type = 'page' ) {
	if ( $id && function_exists( 'icl_object_id' ) ) {
		$id = icl_object_id( $id, $type );
	}
	return $id;
}

// Hexdec color string to rgb(a) string
function sublime_hex2rgba( $color, $opacity = false ) {
 	$default = 'rgb(0,0,0)';

	if ( empty( $color ) ) return $default; 
    if ( $color[0] == '#' ) $color = substr( $color, 1 );

    if ( strlen( $color ) == 6 ) {
		$hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
    } elseif ( strlen( $color ) == 3 ) {
        $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
    } else {
        return $default;
    }

    $rgb =  array_map( 'hexdec', $hex );

    if ( $opacity ) {
    	if ( abs($opacity ) > 1 ) $opacity = 1.0;
    	$output = 'rgba('. implode( ",", $rgb ) .','. $opacity .')';
    } else {
    	$output = 'rgb('. implode( ",", $rgb ) .')';
    }

    return $output;
}

// SVG Core Icons
function sublime_svg( $icon ) {
	$svg = array(
		'cart' => '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 23" xml:space="preserve"><path d="M9,20c0.6,0,1,0.4,1,1s-0.4,1-1,1c-0.6,0-1-0.4-1-1S8.4,20,9,20z M19,21c0,0.6,0.4,1,1,1c0.6,0,1-0.4,1-1s-0.4-1-1-1C19.4,20,19,20.4,19,21z M1,1h4l2.7,13.4c0.2,0.9,1,1.6,2,1.6h9.7c1,0,1.8-0.7,2-1.6L23,6H6"/></svg>',

		'search' => '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 20 20" xml:space="preserve"><path d="M9,1c4.4,0,8,3.6,8,8s-3.6,8-8,8s-8-3.6-8-8S4.6,1,9,1z M19,19l-4.4-4.4"/></svg>',

		'menu' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M28.5,4.5h-27C0.7,4.5,0,3.8,0,3s0.7-1.5,1.5-1.5h27C29.3,1.5,30,2.2,30,3S29.3,4.5,28.5,4.5zM15,13.5H1.5C0.7,13.5,0,12.8,0,12s0.7-1.5,1.5-1.5H15c0.8,0,1.5,0.7,1.5,1.5S15.8,13.5,15,13.5z M28.5,22.5h-27C0.7,22.5,0,21.8,0,21s0.7-1.5,1.5-1.5h27c0.8,0,1.5,0.7,1.5,1.5S29.3,22.5,28.5,22.5z"/>
					</svg>',
		'arrow_left' => '',
		'arrow_right' => '',
	);

	if ( array_key_exists( $icon, $svg) ) {
		return $svg[$icon];
	} else {
		return null;
	}
}

// Get All Pages
function sublime_get_pages() {
	$args = [
        'post_type' => 'page',
        'posts_per_page' => -1,
    ];

    $pages = get_posts($args);
    $options = [];

    if (!empty($pages) && !is_wp_error($pages)) {
        foreach ($pages as $page) {
            $options[$page->ID] = $page->post_title;
        }
    }
    return $options;
}
