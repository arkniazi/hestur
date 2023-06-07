<?php
namespace Sublime\Settings;

if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Plugin;
use Elementor\Repeater;
use Elementor\Icons_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow as Group_Control_Box_Shadow;
use Elementor\Modules\DynamicTags\Module as TagsModule;

class Sublime_Settings {

    public function __construct() {	
    	add_action('elementor/documents/register_controls', [$this, 'sublime_register_settings'], 10);
    }

    public function sublime_register_settings($element) {	 	
    	$post_id = $element->get_id();
    	$post_type = get_post_type($post_id);

        $this->sublime_page_settings($element);

    	if ( is_singular( 'project' ) ) 
    		$this->sublime_project_settings($element);

        if ( is_singular( 'post' ) ) {
            $this->sublime_post_settings($element);
        }
    }

    public function sublime_page_settings($element) {

        // Featured Title
        $element->start_controls_section(
            'sublime_featured_title_settings',
            [
                'label' => __('Featured Title', 'sublime'),
                'tab' => Controls_Manager::TAB_SETTINGS,
            ]
        );

        $element->add_control(
            'hide_featured_title',
            [
                'label'     => __( 'Hide?', 'sublime'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'block',
                'options'   => [
                    'none'       => __( 'Yes', 'sublime'),
                    'block'      => __( 'No', 'sublime'),
                ],
                'selectors'  => [
                    '{{WRAPPER}} #featured-title' => 'display: {{VALUE}};',
                ],
            ]
        );

        $element->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'featured_title_bg',
                'label' => __( 'Background', 'sublime' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} #featured-title',
                'condition' => [ 'hide_featured_title' => 'block' ]
            ]
        );

        $element->end_controls_section();

        // Header
        $element->start_controls_section(
            'sublime_header_settings',
            [
                'label' => __('Header', 'sublime'),
                'tab' => Controls_Manager::TAB_SETTINGS,
            ]
        );

        $element->add_control(
            'header_heading',
            [
                'label'     => __( 'Header', 'sublime'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'after'
            ]
        );

        $element->add_control(
            'header_style',
            [
                'label'     => __( 'Header Style', 'sublime'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'style-1',
                'options'   => [
                    'style-1' => esc_html__( 'Basic', 'sublime' ),
                    'style-2' => esc_html__( 'Float - Light', 'sublime' ),
                    'style-3' => esc_html__( 'Float - Dark', 'sublime' ),
                ]
            ]
        );

        $element->add_control(
            'hide_top',
            [
                'label'     => __( 'Top Hide?', 'sublime'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'block',
                'options'   => [
                    'none'       => __( 'Yes', 'sublime'),
                    'block'      => __( 'No', 'sublime'),
                ],
                'selectors'  => [
                    '{{WRAPPER}} .top-bar' => 'display: {{VALUE}};' 
                ],
            ]
        );

        $element->add_control(
            'top_style',
            [
                'label'     => __( 'Top Style', 'sublime'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'style-1',
                'options'   => [
                    'style-1' => esc_html__( 'Background', 'sublime' ),
                    'style-2' => esc_html__( 'Line', 'sublime' ),
                ],
                'condition' => [
                     'hide_top' => 'block'
                ]
            ]
        );

        $element->add_control(
            'logo_heading',
            [
                'label'     => __( 'Logo', 'sublime'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'after'
            ]
        );

        $element->add_control(
            'custom_logo',
            [
                'label'   => __( 'Logo Image', 'sublime' ),
                'type'    => Controls_Manager::MEDIA,
            ]
        );

        $element->add_responsive_control(
            'logo_width',
            [
                'label'      => __( 'Logo Width', 'sublime' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range'      => [
                    'px' => [
                        'min' => 30,
                        'max' => 500,
                    ],
                    '%' => [
                        'min' => 50,
                        'max' => 150,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} #site-logo #site-logo-inner' => 'max-width: {{SIZE}}{{UNIT}} !important;',
                ],
                50
            ]
        );

        $element->add_control(
            'hbn_style',
            [
                'label'     => __( 'Button Style', 'sublime'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'style-1',
                'options'   => [
                    'style-1' => esc_html__( 'Accent', 'sublime' ),
                    'style-2' => esc_html__( 'Accent 2', 'sublime' ),
                    'style-3' => esc_html__( 'Accent 3', 'sublime' ),
                    'style-4' => esc_html__( 'Accent 4', 'sublime' ),
                    'style-5' => esc_html__( 'White', 'sublime' ),
                ]
            ]
        );

        $element->end_controls_section();

        // Main Content
        $element->start_controls_section(
            'sublime_main_content_settings',
            [
                'label' => __('Main Content', 'sublime'),
                'tab' => Controls_Manager::TAB_SETTINGS,
            ]
        );

        $element->add_control(
            'main_content_heading',
            [
                'label'     => __( 'Main Content', 'sublime'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'after'
            ]
        );

        $element->add_responsive_control(
            'content_padding',
            [
                'label' => __('Content Padding', 'sublime'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'allowed_dimensions' => [ 'top', 'bottom' ],
                'selectors' => [ 
                    '{{WRAPPER}} #page #main-content' => 'padding-top: {{TOP}}{{UNIT}}; padding-bottom: {{BOTTOM}}{{UNIT}};',
                ],
            ]
        );

        $element->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'main_content_bg',
                'label' => __( 'Background', 'sublime' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} #main-content',
            ]
        );

        $element->end_controls_section();

        // Footer
        $element->start_controls_section(
            'sublime_footer_settings',
            [
                'label' => __('Footer', 'sublime'),
                'tab' => Controls_Manager::TAB_SETTINGS,
            ]
        );

        $element->add_control(
            'footer_style',
            [
                'label'     => __( 'Footer Fixed', 'sublime'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'basic',
                'options'   => [
                    ''             => __( 'Default', 'sublime'),
                    'basic' => esc_html__( 'Basic', 'sublime' ),
                    'fixed' => esc_html__( 'Fixed', 'sublime' ),
                ],
                'description' => __( 'Update and refresh page to view change', 'sublime' )
            ]
        );

        $element->add_control(
            'hide_footer',
            [
                'label'     => __( 'Hide?', 'sublime'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'block',
                'options'   => [
                    'none'       => __( 'Yes', 'sublime'),
                    'block'      => __( 'No', 'sublime'),
                ],
                'selectors'  => [
                    '{{WRAPPER}} #footer' => 'display: {{VALUE}};' 
                ],
            ]
        );

        $element->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'footer_bg',
                'label' => __( 'Background', 'sublime' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} #footer',
                'condition' => [ 'hide_footer' => 'block' ]
            ]
        );

        // Bottom
        $element->add_control(
            'bottom_heading',
            [
                'label'     => __( 'Bottom Bar', 'sublime'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'after'
            ]
        );

        $element->add_control(
            'hide_bottom',
            [
                'label'     => __( 'Hide?', 'sublime'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'block',
                'options'   => [
                    'none'       => __( 'Yes', 'sublime'),
                    'block'      => __( 'No', 'sublime'),
                ],
                'selectors'  => [
                    '{{WRAPPER}} #bottom' => 'display: {{VALUE}};' 
                ],
            ]
        );

        $element->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'bottom_bg',
                'label' => __( 'Background', 'sublime' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} #bottom',
                'condition' => [ 'hide_bottom!' => 'none']
            ]
        );

        $element->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'bottom_border',
                'label' => __( 'Border', 'sublime' ),
                'selector' => '{{WRAPPER}} #bottom',
                'fields_options' => [
                    'border' => [ 'default' => 'solid', ],
                    'width' => [ 
                        'default' => [
                            'top' => 1,
                            'left' => 0,
                            'bottom' => 0,
                            'right' => 0,
                        ] 
                    ]
                ],
                'condition' => [ 'hide_bottom!' => 'none']
            ]
        );

        $element->end_controls_section();
    }

    public function sublime_project_settings($element) {
    	$element->start_controls_section(
            'sublime_project_settings',
            [
                'label' => __('Project Settings', 'sublime'),
                'tab' => Controls_Manager::TAB_SETTINGS,
            ]
        );

        $element->add_control(
            'project_title',
            [
                'label'   => __( 'Custom Title', 'sublime' ),
                'type'    => Controls_Manager::TEXT,
            ]
        );

        $element->add_control(
            'project_desc',
            [
                'label'      => __( 'Short Description', 'sublime' ),
                'type'       => Controls_Manager::WYSIWYG,
            ]
        );

        $element->end_controls_section();
    }

    public function sublime_post_settings($element) {

        $element->start_controls_section(
            'sublime_post_settings',
            [
                'label' => __('Post Settings', 'sublime'),
                'tab' => Controls_Manager::TAB_SETTINGS,
            ]
        );


        $element->add_control(
            'video_url',
            [
                'label'     => __( 'Video URL or Embeded Code', 'sublime'),
                'type'      => Controls_Manager::TEXT,
                'default'   => '',
            ]
        );

        $element->add_control(
            'gallery_images',
            [
                'label' => __( 'Add Images', 'sublime' ),
                'type' => Controls_Manager::GALLERY,
                'default' => [],
            ]
        );

        $element->end_controls_section();
    }
}

new Sublime_Settings();