<?php
// namespace Elementor; // Custom widgets must be defined in the Elementor namespace
// if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

// /**
//  * Widget Name: Portfolio Filter
//  */


/*
Widget Name: Socials Sharing
Description: 
Author: Masterlayer
Author URI: http://masterlayer.edu.vn
Plugin URI: https://masterlayer.edu.vn/masterlayer-addons-for-masterlayer/
*/

namespace MasterlayerAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Repeater;
use Elementor\Icons_Manager;
use Elementor\Core\Schemes\Color;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use Elementor\Modules\DynamicTags\Module as TagsModule;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class MAE_Sharing_Widget extends Widget_Base{

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
    }

    // The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
    public function get_name() {
        return 'mae-sharing';
    }

    // The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
    public function get_title() {
        return __( 'Socials Sharing', 'masterlayer' );
    }

    // The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
    public function get_icon() {
        return 'eicon-share';
    }

    // The get_categories method, lets you set the category of the widget, return the category name as a string.
    public function get_categories() {
        return [ 'masterlayer-addons' ];
    } 

	protected function register_controls() {
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'masterlayer' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'social_share',
			[
				'label' => __( 'Social Share Buttons', 'masterlayer' ),
				'type' => Controls_Manager::SELECT2,
				'multiple' => true,
				'options' => [
					'facebook'  => __( 'Facebook', 'masterlayer' ),					
					'twitter' => __( 'Twitter', 'masterlayer' ),
					'google'  => __( 'Google Plus', 'masterlayer' ),					
					'pinterest' => __( 'Pinterest', 'masterlayer' ),
					'linkedin'  => __( 'Linkedin', 'masterlayer' ),					
					'buffer' => __( 'Buffer', 'masterlayer' ),
					'digg'  => __( 'Digg', 'masterlayer' ),					
					'reddit' => __( 'Reddit', 'masterlayer' ),
					'tumbleupon'  => __( 'Tumbleupon', 'masterlayer' ),					
					'tumblr' => __( 'Tumblr', 'masterlayer' ),
					'vk' => __( 'Vk', 'masterlayer' ),
					'email' => __( 'Email', 'masterlayer' ),
					'print' => __( 'Print', 'masterlayer' ),
				],
				'default' => [ 'facebook', 'twitter', 'pinterest', 'linkedin' ],
			]
		);

		$this->add_control(
			'style',
			[
				'label' => __( 'Style', 'masterlayer' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => [
					'style-1' => __( 'Style 1', 'masterlayer' ),
					'style-2' => __( 'Style 2', 'masterlayer' ),
				],
			]
		);

		$this->add_responsive_control(
			'text_align',
			[
				'label' => __( 'Alignment', 'masterlayer' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'masterlayer' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'masterlayer' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'masterlayer' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .master-social-share' => 'text-align: {{VALUE}};',
				],
				'default' => 'left',
				'toggle' => true,
			]
		);

		$this->end_controls_section();

		//Style
		$this->start_controls_section(
			'icon_section',
			[
				'label' => __( 'Icon', 'masterlayer' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'social_size',
			[
				'label' => __( 'Size', 'masterlayer' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 6,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .master-social-share a' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'social_space',
			[
				'label' => __( 'Spacing', 'masterlayer' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .master-social-share a:not(:last-child)' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();		
		
		global $post;
	    // Get current page URL 
	    $postURL = urlencode(get_permalink());

	    // Get current page title
	    $postTitle = htmlspecialchars(urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8');        
	    
	    // Get Post Thumbnail for pinterest
	    $postThumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );

	    // Get current page excerpt
	    $postExcerpt = wp_strip_all_tags( get_the_excerpt(), true );

	    // Get site name
	    $site_title = get_bloginfo( 'name' );

	    // Construct sharing URL without using any script
	    $twitterURL = 'https://twitter.com/intent/tweet?text='.$postTitle.'&amp;url='.$postURL.'&amp;via='.$site_title;
	    $linkedInURL = 'https://www.linkedin.com/shareArticle?mini=true&url='.$postURL.'&amp;title='.$postTitle;
	    $googleURL = 'https://plus.google.com/share?url='.$postURL;
	    $facebookURL = 'https://www.facebook.com/sharer/sharer.php?u='.$postURL;
	    $bufferURL = 'https://bufferapp.com/add?url='.$postURL.'&amp;text='.$postTitle;
	    $diggURL = 'https://www.digg.com/submit?url='.$postURL;
	    $redditURL = 'https://reddit.com/submit?url='.$postURL.'&amp;title='.$postTitle;
	    $stumbleuponURL = 'https://www.stumbleupon.com/submit?url='.$postURL.'&amp;title='.$postTitle;
	    $tumblrURL = 'https://www.tumblr.com/share/link?url='.$postURL.'&amp;title='.$postTitle;
	    $vkURL = 'https://vk.com/share.php?url='.$postURL;
	    $yummlyURL = 'https://www.yummly.com/urb/verify?url='.$postURL.'&amp;title='.$postTitle;
	    $mailURL = 'mailto:?Subject='.$postTitle.'&amp;Body=I%20saw%20this%20and%20thought%20of%20you!%20 '.$postURL;

	    $whatsappURL = 'whatsapp://send?text='.$postTitle . ' ' . $postURL;

	    // Based on popular demand added Pinterest too
	    $pinterestURL = 'https://pinterest.com/pin/create/button/?url='.$postURL.'&amp;media='.$postThumbnail[0].'&amp;description='.$postTitle;
		
		$variable = '';
	    $variable .= '<div class="master-social-share clearfix ' . $settings['style'] . '">';
	    foreach ( $settings['social_share'] as $item ) {
			if ($item == 'facebook') {
				$variable .= '<a class="share-facebook" href="'.$facebookURL.'" target="_blank"><i class="fab fa-facebook-f"></i></a>';
			}
			if ($item == 'twitter') {
				$variable .= '<a class="share-twitter" href="'. $twitterURL .'" target="_blank"><i class="fab fa-twitter"></i></a>';
			}
			if ($item == 'google') {
				$variable .= '<a class="share-google" href="'.$googleURL.'" target="_blank"><i class="fab fa-google-plus-g"></i></a>';  
			}
			if ($item == 'pinterest') {
				$variable .= '<a class="share-pinterest" href="'.$pinterestURL.'" data-pin-custom="true" target="_blank"><i class="fab fa-pinterest-p"></i></a>';
			}
			if ($item == 'linkedin') {
				$variable .= '<a class="share-linkedin" href="'.$linkedInURL.'" target="_blank"><i class="fab fa-linkedin-in"></i></a>';
			}
			if ($item == 'buffer') {
				$variable .= '<a class="share-buffer" href="'.$bufferURL.'" target="_blank"><i class="fab fa-buffer"></i></a>';
			}
			if ($item == 'digg') {
		    	$variable .= '<a class="share-digg" href="'.$diggURL.'" target="_blank"><i class="fab fa-digg"></i></a>';
		    }
			if ($item == 'reddit') {
		    	$variable .= '<a class="share-reddit" href="'.$redditURL.'" target="_blank"><i class="fab fa-reddit"></i></a>'; 
		    }
			if ($item == 'tumbleupon') {
		    	$variable .= '<a class="share-tumbleupon" href="'.$stumbleuponURL.'" target="_blank"><i class="fab fa-stumbleupon"></i></a>'; 
		    }
			if ($item == 'tumblr') {   
		    	$variable .= '<a class="share-tumblr" href="'.$tumblrURL.'" target="_blank"><i class="fab fa-tumblr"></i></a>'; 
		    }
			if ($item == 'vk') {    	        
		    	$variable .= '<a class="share-vk" href="'.$vkURL.'" target="_blank"><i class="fab fa-vk"></i></a>';   
		    }			
			if ($item == 'email') {
		    	$variable .= '<a class="share-email" href="'.$mailURL.'"><i class="fa fa-envelope"></i></a>';
		    }
			if ($item == 'print') {
			    $variable .= '<a class="share-print" href="javascript:;" onclick="window.print()"><i class="fa fa-print"></i></a>';
			}
		}
	    $variable .= '</div>';  

	    echo $variable;

	}

	protected function content_template() {}
}