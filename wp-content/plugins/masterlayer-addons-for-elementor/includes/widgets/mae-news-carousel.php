<?php
/*
Widget Name: News Carousel
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

class MAE_News_Carousel_Widget extends Widget_Base {

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
    }

    public function get_script_depends() {
        return [ 'flickity', 'waitforimages' ];
    }

    public function get_style_depends() {
        return [ 'flickity' ];
    }

    // The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
    public function get_name() {
        return 'mae-news-carousel';
    }

    // The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
    public function get_title() {
        return __( 'News Carousel', 'masterlayer' );
    }

    // The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
    public function get_icon() {
        return 'eicon-carousel';
    }

    // The get_categories method, lets you set the category of the widget, return the category name as a string.
    public function get_categories() {
        return [ 'masterlayer-addons' ];
    } 

    protected function register_controls() {
        // General
        $this->start_controls_section( 'content_section',
            [
                'label' => __( 'Content', 'masterlayer' ),
            ]
        );

        $this->add_control(
            'style',
            [
                'label'     => __( 'Style', 'masterlayer'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'style-1',
                'options'   => [
                    'style-1'      => __( 'Style 1', 'masterlayer'),
                    'style-2'      => __( 'Style 2', 'masterlayer'),
                ],
                'prefix_class' => 'news-'
            ]
        );

        $this->add_control(
            'posts_per_page',
            [
                'label'     => __( 'Posts to show', 'masterlayer'),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 6,
                'min'     => 3,
                'max'     => 20,
                'step'    => 1
            ]
        );

        $this->add_control(
            'cat_slug',
            [
                'label'   => __( 'Category Slug (optional)', 'masterlayer' ),
                'type'    => Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'exclude_cat_slug',
            [
                'label'   => __( 'Exclude Cat Slug (optional)', 'masterlayer' ),
                'type'    => Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'image_crop',
            [
                'label'     => __( 'Image Crop', 'masterlayer'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'mae-std4',
                'options'   => [
                    'full'      => __( 'Full', 'masterlayer'),
                    'mae-std1'      => __( '570 x 700', 'masterlayer'),
                    'mae-std2'      => __( '570 x 400', 'masterlayer'),
                    'mae-std2'      => __( '570 x 350', 'masterlayer'),
                    'mae-std3'      => __( '430 x 570', 'masterlayer'),
                    'mae-std4'      => __( '370 x 440', 'masterlayer'),
                    'mae-std5'      => __( '370 x 400', 'masterlayer'),
                    'mae-std6'      => __( '370 x 270', 'masterlayer'),
                    'mae-std7'      => __( '370 x 210', 'masterlayer'),
                ]
            ]
        );

        $this->add_responsive_control(
            'align',
            [
                'label' => __( 'Alignment', 'masterlayer' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'masterlayer' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'masterlayer' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'masterlayer' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'separator' => 'before',
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} .master-news .content-wrap' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'show_post_date',
            [
                'label'        => __( 'Show Post Date', 'masterlayer' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'On', 'masterlayer' ),
                'label_off'    => __( 'Off', 'masterlayer' ),
                'return_value' => 'true',
                'default'      => 'true',
            ]
        );

        $this->add_control(
            'show_post_cat',
            [
                'label'        => __( 'Show Post Categories', 'masterlayer' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'On', 'masterlayer' ),
                'label_off'    => __( 'Off', 'masterlayer' ),
                'return_value' => 'true',
                'default'      => 'true',
            ]
        );

        $this->add_control(
            'show_desc',
            [
                'label'        => __( 'Show Description', 'masterlayer' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'On', 'masterlayer' ),
                'label_off'    => __( 'Off', 'masterlayer' ),
                'return_value' => 'true',
                'default'      => '',
            ]
        );

        $this->add_control(
            'url_heading',
            [
                'label'     => __( 'URL', 'masterlayer'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'after'
            ]
        );

        $this->add_control(
            'url_type',
            [
                'label'     => __( 'URL Type', 'masterlayer'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'none',
                'options'   => [
                    'none'      => __( 'None', 'masterlayer'),
                    'link'      => __( 'Link', 'masterlayer'),
                    'button'    => __( 'Button', 'masterlayer'),
                ],
            ]
        );

        $this->add_control(
            'url_text',
            [
                'label'   => __( 'URL Text', 'masterlayer' ),
                'type'    => Controls_Manager::TEXT,
                'default' => __( 'Read More', 'masterlayer' ),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [ 'url_type!' => ['none'] ]
            ]
        );

        $this->add_control(
            'link_icon_position',
            [
                'label'     => __( 'Has Icon ?', 'masterlayer'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'right',
                'options'   => [
                    'none'      => __( 'None', 'masterlayer'),
                    'left'      => __( 'Icon Left', 'masterlayer'),
                    'right'     => __( 'Icon Right', 'masterlayer')
                ],
                'condition' => [ 'url_type' => 'link' ]
            ]
        );

        $this->add_control(
            'link_icon',
            [
                'label' => __( 'Link Icon', 'masterlayer' ),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'default' => [
                    'value' => 'fa fa-arrow-right',
                    'library' => 'solid',
                ],
                'label_block'      => false,
                'skin'             => 'inline',
                'condition' => [ 
                    'link_icon_position!' => 'none', 
                    'url_type' => 'link',
                ]
            ]
        );

        $this->add_control(
            'button_style',
            [
                'label'     => __( 'Button Style', 'masterlayer'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'btn-accent',
                'options'   => [
                    'btn-accent'      => __( 'Accent', 'masterlayer'),
                    'btn-light'       => __( 'Light', 'masterlayer'),
                    'btn-dark'     => __( 'Dark', 'masterlayer')
                ],
                'condition' => [ 'url_type' => 'button' ]
            ]
        );

        $this->add_control(
            'button_icon_position',
            [
                'label'     => __( 'Has Icon ?', 'masterlayer'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'right',
                'options'   => [
                    'none'      => __( 'None', 'masterlayer'),
                    'left'      => __( 'Icon Left', 'masterlayer'),
                    'right'     => __( 'Icon Right', 'masterlayer')
                ],
                'condition' => [ 'url_type' => 'button' ]
            ]
        );

        $this->add_control(
            'button_icon',
            [
                'label' => __( 'Button Icon', 'masterlayer' ),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'default' => [
                    'value' => 'fa fa-arrow-right',
                    'library' => 'solid',
                ],
                'label_block'      => false,
                'skin'             => 'inline',
                'condition' => [ 
                    'button_icon_position!' => 'none', 
                    'url_type' => 'button',
                ]
            ]
        );

        $this->end_controls_section();

        // Carousel
        $this->start_controls_section( 'setting_carousel_section',
            [
                'label' => __( 'Carousel', 'masterlayer' ),
                'tab' => Controls_Manager::TAB_SETTINGS,
            ]
        );

        $this->add_control(
            'column',
            [
                'label'     => __( 'Columns', 'masterlayer'),
                'type'      => Controls_Manager::SELECT,
                'default'   => '3',
                'options'   => [
                    '2'      => __( '2', 'masterlayer'),
                    '3'      => __( '3', 'masterlayer'),
                    '4'      => __( '4', 'masterlayer'),
                    '5'      => __( '5', 'masterlayer'),
                ],
            ]
        );

        $this->add_control(
            'gap',
            [
                'label'     => __( 'Gap', 'masterlayer'),
                'type'      => Controls_Manager::SELECT,
                'default'   => '30px',
                'options'   => [
                    '0px'      => __( '0px', 'masterlayer'),
                    '10px'     => __( '10px', 'masterlayer'),
                    '20px'     => __( '20px', 'masterlayer'),
                    '30px'     => __( '30px', 'masterlayer'),
                    '40px'     => __( '40px', 'masterlayer'),
                ],
            ]
        );

        $this->add_control(
            'fullRight',
            [
                'label'        => __( 'Full Right', 'masterlayer' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'On', 'masterlayer' ),
                'label_off'    => __( 'Off', 'masterlayer' ),
                'return_value' => 'true',
                'default'      => 'false',
            ]
        );

        $this->add_control(
            'fullRightOpacity',
            [
                'label'     => __( 'Right Box Opacity', 'masterlayer'),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 0.7,
                'min'     => 0,
                'max'     => 1,
                'step'    => 0.1,
                'condition'             => [
                    'fullRight'   => 'true',
                ],
                'selectors' => [
                    '{{WRAPPER}} .master-carousel-box .item-carousel' => 'opacity: {{VALUE}};',
                    '{{WRAPPER}} .master-carousel-box .item-carousel.is-selected' => 'opacity: 1;',
                    '{{WRAPPER}} .master-carousel-box:hover .item-carousel' => 'opacity: {{VALUE}};',
                    '{{WRAPPER}} .master-carousel-box:hover .item-carousel.is-selected' => 'opacity: 1;',
                ],
            ]
        );

        $this->add_control(
            'autoPlay',
            [
                'label'        => __( 'Auto Play', 'masterlayer' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'On', 'masterlayer' ),
                'label_off'    => __( 'Off', 'masterlayer' ),
                'return_value' => 'true',
                'default'      => 'true',
            ]
        );

        $this->add_control(
            'prevNextButtons',
            [
                'label'        => __( 'Show Arrows?', 'masterlayer' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'On', 'masterlayer' ),
                'label_off'    => __( 'Off', 'masterlayer' ),
                'return_value' => 'true',
                'default'      => 'false',
            ]
        );

        $this->add_control(
            'arrowPosition',
            [
                'label'     => __( 'Arrows Position', 'masterlayer'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'middle',
                'options'   => [
                    'top'      => __( 'Top', 'masterlayer'),
                    'middle'     => __( 'Middle', 'masterlayer'),
                ],
                'condition' => [
                     'prevNextButtons' => 'true'
                ]
            ]
        );

        $this->add_responsive_control(
            'arrowMiddleOffset',
            [
                'label'     => __( 'Arrows Offset', 'masterlayer'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ]
                ],
                'selectors'  => [
                    '{{WRAPPER}} .flickity-button.previous' => 'left: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .flickity-button.next' => 'right: {{SIZE}}{{UNIT}};',
                ],
                50,
                'condition' => [ 'arrowPosition' => 'middle', 'prevNextButtons' => 'true' ]
            ]
        );

        $this->add_responsive_control(
            'arrowTopOffset',
            [
                'label'     => __( 'Arrows Offset', 'masterlayer'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ]
                ],
                'selectors'  => [
                    '{{WRAPPER}} .flickity-button.previous' => 'top: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .flickity-button.next' => 'top: {{SIZE}}{{UNIT}};',
                ],
                50,
                'condition' => [ 'arrowPosition' => 'top', 'prevNextButtons' => 'true' ]
            ]
        );

        $this->add_control(
            'pageDots',
            [
                'label'        => __( 'Show Bullets?', 'masterlayer' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'On', 'masterlayer' ),
                'label_off'    => __( 'Off', 'masterlayer' ),
                'return_value' => 'true',
                'default'      => 'false',
            ]
        );

        $this->add_control(
            'dotOffset',
            [
                'label'     => __( 'Bullets Offset', 'masterlayer'),
                'type'      => Controls_Manager::SELECT,
                'default'   => '60px',
                'options'   => [
                    '0px'      => __( '0px', 'masterlayer'),
                    '10px'      => __( '10px', 'masterlayer'),
                    '20px'      => __( '20px', 'masterlayer'),
                    '30px'      => __( '30px', 'masterlayer'),
                    '40px'      => __( '40px', 'masterlayer'),
                    '50px'      => __( '50px', 'masterlayer'),
                    '60px'      => __( '60px', 'masterlayer'),
                    '70px'      => __( '70px', 'masterlayer'),
                    '80px'      => __( '80px', 'masterlayer'),
                    '90px'      => __( '90px', 'masterlayer'),
                    '100px'      => __( '100px', 'masterlayer'),

                ],
                'condition' => [
                     'pageDots' => 'true'
                ]
            ]
        );

        $this->end_controls_section();

        // General Style
        $this->start_controls_section( 'general_style_section',
            [
                'label' => __( 'General', 'masterlayer' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs( 'box' );

        $this->start_controls_tab(
            'box_normal',
            [
                'label' => __( 'Normal', 'masterlayer' ),
            ]
        );

        $this->add_control(
            'color_heading',
            [
                'label' => __( 'Color', 'masterlayer' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after'
            ]
        );

        $this->add_control(
            'post_date_color',
            [
                'label' => __( 'Date Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .master-news .post-date' => 'color: {{VALUE}};',
                ],
                'condition' => [ 'show_post_date' => 'true' ]
            ]
        );

        $this->add_control(
            'post_cat_color',
            [
                'label' => __( 'Categories Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .master-news .post-cat' => 'color: {{VALUE}};',
                ],
                'condition' => [ 'show_post_cat' => 'true' ]
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __( 'Title Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .master-news .headline-2' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'desc_color',
            [
                'label' => __( 'Description Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .master-news .desc' => 'color: {{VALUE}};',
                ],
                'condition' => [ 'show_desc' => 'true' ]
            ]
        );

        $this->add_control(
            'bg_heading',
            [
                'label' => __( 'Background', 'masterlayer' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after'
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'box_bg',
                'label' => __( 'Background', 'masterlayer' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .master-news .content-wrap',
            ]
        );

        $this->add_control(
            'border_heading',
            [
                'label' => __( 'Border', 'masterlayer' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after'
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'border',
                'label' => __( 'Border', 'masterlayer' ),
                'selector' => '{{WRAPPER}} .master-project',
            ]
        );

        $this->add_control(
            'rounded_heading',
            [
                'label' => __( 'Rounded', 'masterlayer' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after'
            ]
        );

        $this->add_control(
            'border_radius',
            [
                'label' => __('Rounded', 'masterlayer'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .master-news' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'shadow_heading',
            [
                'label' => __( 'Box Shadow', 'masterlayer' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after'
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow',
                'selector' => '{{WRAPPER}} .master-news',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'news_box_hover',
            [
                'label' => __( 'Hover', 'masterlayer' ),
            ]
        );

        $this->add_control(
            'color_heading_hover',
            [
                'label' => __( 'Color', 'masterlayer' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after'
            ]
        );

        $this->add_control(
            'post_date_color_hover',
            [
                'label' => __( 'Post Date Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .master-news:hover .post-date' => 'color: {{VALUE}};',
                ],
                'condition' => [ 'show_post_date' => 'true' ]
            ]
        );

        $this->add_control(
            'title_color_hover',
            [
                'label' => __( 'Title Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .master-news:hover .headline-2' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'desc_color_hover',
            [
                'label' => __( 'Description Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .master-news:hover .desc' => 'color: {{VALUE}};',
                ],
                'condition' => [ 'show_desc' => 'true' ]
            ]
        );

        $this->add_control(
            'bg_heading_hover',
            [
                'label' => __( 'Background', 'masterlayer' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after'
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'box_bg_hover',
                'label' => __( 'Background', 'masterlayer' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .master-news .content-wrap',
            ]
        );

        $this->add_control(
            'border_heading_hover',
            [
                'label' => __( 'Border', 'masterlayer' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after'
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'border_hover',
                'label' => __( 'Border', 'masterlayer' ),
                'selector' => '{{WRAPPER}} .master-project:hover',
            ]
        );

        $this->add_control(
            'rounded_heading_hover',
            [
                'label' => __( 'Rounded', 'masterlayer' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after'
            ]
        );

        $this->add_control(
            'border_radius_hover',
            [
                'label' => __('Rounded', 'masterlayer'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .master-news:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'shadow_heading_hover',
            [
                'label' => __( 'Box Shadow', 'masterlayer' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after'
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow_hover',
                'selector' => '{{WRAPPER}} .master-news:hover',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        // URL
        $this->start_controls_section( 'setting_url_section',
            [
                'label' => __( 'URL', 'masterlayer' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [ 'url_type!' => 'none' ]
            ]
        );

        $this->add_control(
            'url_title_color_hover',
            [
                'label' => __( 'Title Hover Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .master-news .headline-2:hover' => 'color: {{VALUE}};',
                ],
                'condition' => [ 
                    'url_type' => 'title',
                ]
            ]
        );

        // URL - Link
        $this->add_responsive_control(
            'link_icon_font_size',
            [
                'label'      => __( 'Icon Font Size', 'masterlayer' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range'      => [
                    'px' => [
                        'min' => 10,
                        'max' => 50,
                    ],
                    '%' => [
                        'min' => 50,
                        'max' => 150,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 16,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .master-link .icon ' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                50,
                'condition' => [ 
                    'link_icon_position!' => 'none', 
                    'url_type' => 'link',
                ]
            ]
        );

        $this->add_control(
            'link_icon_margin',
            [
                'label' => __('Icon Margin', 'masterlayer'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .master-link .icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [ 
                    'link_icon_position!' => 'none', 
                    'url_type' => 'link',
                ]
            ]
        );

        $this->start_controls_tabs( 'link_hover_tabs' );

        // Link normal
        $this->start_controls_tab(
            'link_normal',
            [
                'label' => __( 'Normal', 'masterlayer' ),
                'condition' => [ 'url_type' => 'link' ]
            ]
        );

        $this->add_control(
            'link_color',
            [
                'label' => __( 'Text Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .master-link' => 'color: {{VALUE}};',
                ],
                'condition' => [ 
                    'url_type' => 'link',
                ]
            ]
        );

        $this->add_control(
            'link_icon_color',
            [
                'label' => __( 'Icon Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .master-link .icon' => 'color: {{VALUE}};',
                ],
                'condition' => [ 
                    'link_icon_position!' => 'none', 
                    'url_type' => 'link',
                ]
            ]
        );

        $this->end_controls_tab();

        // Box hover
        $this->start_controls_tab(
            'link_box_hover',
            [
                'label' => __( 'Box Hover', 'masterlayer' ),
                'condition' => [ 'url_type' => 'link' ]
            ]
        );

        $this->add_control(
            'link_color_box_hover',
            [
                'label' => __( 'Text Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .master-news:hover .master-link' => 'color: {{VALUE}};',
                ],
                'condition' => [ 
                    'url_type' => 'link',
                ]
            ]
        );

        $this->add_control(
            'link_icon_color_box_hover',
            [
                'label' => __( 'Icon Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .master-news:hover .master-link .icon' => 'color: {{VALUE}};',
                ],
                'condition' => [ 
                    'link_icon_position!' => 'none', 
                    'url_type' => 'link',
                ]
            ]
        );

        $this->end_controls_tab();

        // Link hover
        $this->start_controls_tab(
            'link_hover',
            [
                'label' => __( 'URL Hover', 'masterlayer' ),
                'condition' => [ 'url_type' => 'link' ]
            ]
        );

        $this->add_control(
            'link_color_hover',
            [
                'label' => __( 'Text Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .master-link:hover' => 'color: {{VALUE}} !important;',
                ],
                'condition' => [ 
                    'url_type' => 'link',
                ]
            ]
        );

        $this->add_control(
            'link_icon_color_hover',
            [
                'label' => __( 'Icon Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .master-link:hover .icon' => 'color: {{VALUE}} !important;',
                ],
                'condition' => [ 
                    'link_icon_position!' => 'none', 
                    'url_type' => 'link',
                ]
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        // URL - Button
        $this->add_responsive_control(
            'button_icon_font_size',
            [
                'label'      => __( 'Icon Font Size', 'masterlayer' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range'      => [
                    'px' => [
                        'min' => 10,
                        'max' => 50,
                    ],
                    '%' => [
                        'min' => 50,
                        'max' => 150,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 16,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .master-button .icon ' => 'font-size: {{SIZE}}{{UNIT}}',
                ],
                50,
                'condition' => [ 
                    'button_icon_position!' => 'none', 
                    'url_type' => 'button',
                ]
            ]
        );

        $this->add_control(
            'button_icon_margin',
            [
                'label' => __('Icon Margin', 'masterlayer'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .master-button .icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [ 
                    'button_icon_position!' => 'none', 
                    'url_type' => 'button',
                ]
            ]
        );

        $this->start_controls_tabs( 'button_hover_tabs' );

        // Button normal
        $this->start_controls_tab(
            'button_normal',
            [
                'label' => __( 'Normal', 'masterlayer' ),
                'condition' => [ 'url_type' => 'button' ]
            ]
        );

        $this->add_control(
            'button_color',
            [
                'label' => __( 'Text Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .master-button' => 'color: {{VALUE}};',
                ],
                'condition' => [ 
                    'url_type' => 'button',
                ]
            ]
        );

        $this->add_control(
            'button_icon_color',
            [
                'label' => __( 'Icon Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .master-button .icon' => 'color: {{VALUE}};',
                ],
                'condition' => [ 
                    'button_icon_position!' => 'none', 
                    'url_type' => 'button',
                ]
            ]
        );

        $this->add_control(
            'button_bg_color',
            [
                'label' => __( 'Background Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .master-button' => 'background-color: {{VALUE}};',
                ],
                'condition' => [ 
                    'url_type' => 'button',
                ]
            ]
        );

        $this->add_control(
            'button_rounded',
            [
                'label' => __('Rounded', 'masterlayer'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'default' => [
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .master-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [ 
                    'url_type' => 'button',
                ]
            ]
        );

        $this->add_control(
            'button_border_color',
            [
                'label' => __( 'Border Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .master-button' => 'border-color: {{VALUE}};'
                ],
                'condition' => [ 
                    'url_type' => 'button',
                    'button_style' => [ 'btn-outline' ]
                ]
            ]
        );

        $this->add_control(
            'button_border_width',
            [
                'label' => __('Border Width', 'masterlayer'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'default' => [
                    'top' => 1,
                    'right' => 1,
                    'bottom' => 1,
                    'left' => 1,
                    'unit' => 'px',
                    'isLinked' => true
                ],
                'selectors' => [
                    '{{WRAPPER}} .master-button' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [ 
                    'url_type' => 'button',
                    'button_style' => [ 'btn-outline' ]
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_box_shadow',
                'selector' => '{{WRAPPER}} .master-button',
                'condition' => [ 'url_type' => 'button' ]
            ]
        );

        $this->end_controls_tab();

        // Box hover
        $this->start_controls_tab(
            'button_box_hover',
            [
                'label' => __( 'Box Hover', 'masterlayer' ),
                'condition' => [ 'url_type' => 'button' ]
            ]
        );

        $this->add_control(
            'button_color_box_hover',
            [
                'label' => __( 'Text Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .master-news:hover .master-button .hover-effect' => 'color: {{VALUE}};',
                ],
                'condition' => [ 
                    'url_type' => 'button',
                ]
            ]
        );

        $this->add_control(
            'button_icon_color_box_hover',
            [
                'label' => __( 'Icon Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .master-news:hover .master-button .icon' => 'color: {{VALUE}};',
                ],
                'condition' => [ 
                    'button_icon_position!' => 'none', 
                    'url_type' => 'button',
                ]
            ]
        );

        $this->add_control(
            'button_bg_color_box_hover',
            [
                'label' => __( 'Background Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .master-news:hover .master-button .hover-effect' => 'background-color: {{VALUE}};',
                ],
                'condition' => [ 
                    'url_type' => 'button',
                ]
            ]
        );

        $this->add_control(
            'button_rounded_box_hover',
            [
                'label' => __('Rounded', 'masterlayer'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .master-news:hover .master-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [ 
                    'url_type' => 'button',
                ]
            ]
        );

        $this->add_control(
            'button_border_color_box_hover',
            [
                'label' => __( 'Border Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .master-news:hover .master-button' => 'border-color: {{VALUE}};'
                ],
                'condition' => [ 
                    'url_type' => 'button',
                    'button_style' => [ 'btn-outline' ]
                ]
            ]
        );

        $this->add_control(
            'button_border_width_box_hover',
            [
                'label' => __('Border Width', 'masterlayer'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'default' => [
                    'top' => 1,
                    'right' => 1,
                    'bottom' => 1,
                    'left' => 1,
                    'unit' => 'px',
                    'isLinked' => true
                ],
                'selectors' => [
                    '{{WRAPPER}} .master-news:hover .master-button' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [ 
                    'url_type' => 'button',
                    'button_style' => [ 'btn-outline' ]
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_box_shadow_box_hover',
                'selector' => '{{WRAPPER}} .master-news:hover .master-button',
                'condition' => [ 'url_type' => 'button' ]
            ]
        );

        $this->end_controls_tab();

        // Button hover
        $this->start_controls_tab(
            'button_hover',
            [
                'label' => __( 'URL Hover', 'masterlayer' ),
                'condition' => [ 'url_type' => 'button' ]
            ]
        );

        $this->add_control(
            'button_color_hover',
            [
                'label' => __( 'Text Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .master-button:hover' => 'color: {{VALUE}} !important;',
                ],
                'condition' => [ 
                    'url_type' => 'button',
                ]
            ]
        );

        $this->add_control(
            'button_icon_color_hover',
            [
                'label' => __( 'Icon Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .master-button:hover .icon' => 'color: {{VALUE}} !important;',
                ],
                'condition' => [ 
                    'button_icon_position!' => 'none', 
                    'url_type' => 'button',
                ]
            ]
        );

        $this->add_control(
            'button_bg_color_hover',
            [
                'label' => __( 'Background Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .master-news .master-button .hover-effect' => 'background-color: {{VALUE}};',
                ],
                'condition' => [ 
                    'url_type' => 'button',
                ]
            ]
        );

        $this->add_control(
            'button_rounded_hover',
            [
                'label' => __('Rounded', 'masterlayer'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .master-news .master-button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [ 
                    'url_type' => 'button',
                ]
            ]
        );

        $this->add_control(
            'button_border_color_hover',
            [
                'label' => __( 'Border Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .master-news .master-button:hover' => 'border-color: {{VALUE}};'
                ],
                'condition' => [ 
                    'url_type' => 'button',
                    'button_style' => [ 'btn-outline' ]
                ]
            ]
        );

        $this->add_control(
            'button_border_width_hover',
            [
                'label' => __('Border Width', 'masterlayer'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'default' => [
                    'top' => 1,
                    'right' => 1,
                    'bottom' => 1,
                    'left' => 1,
                    'unit' => 'px',
                    'isLinked' => true
                ],
                'selectors' => [
                    '{{WRAPPER}} .master-news .master-button:hover' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [ 
                    'url_type' => 'button',
                    'button_style' => [ 'btn-outline' ]
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_box_shadow_hover',
                'selector' => '{{WRAPPER}} .master-news .master-button:hover',
                'condition' => [ 'url_type' => 'button' ]
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        // Spacing
        $this->start_controls_section( 'setting_spacing_section',
            [
                'label' => __( 'Spacing', 'masterlayer' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'padding',
            [
                'label' => __('Content Padding', 'masterlayer'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'default' => [
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .master-news .content-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .master-news .sep' => 'width: calc(100% + {{RIGHT}}{{UNIT}});',
                ],
            ]
        );

        $this->add_responsive_control(
            'title_margin',
            [
                'label' => __('Title Margin', 'masterlayer'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'default' => [
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .master-news .headline-2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_responsive_control(
            'desc_margin',
            [
                'label' => __('Description Margin', 'masterlayer'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'default' => [
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .master-news .desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [ 'show_desc' => 'true' ]
            ]
        );

        $this->add_responsive_control(
            'post_date_margin',
            [
                'label' => __('Post Date Margin', 'masterlayer'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'default' => [
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .master-news .post-date' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [ 'show_post_date' => 'true' ]
            ]
        );

        $this->end_controls_section();

        // Typography
        $this->start_controls_section( 'setting_typography_section',
            [
                'label' => __( 'Typography', 'masterlayer' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'headline_typography',
                'label' => __('Heading', 'masterlayer'),
                'selector' => '{{WRAPPER}} .headline-2'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'desc_typography',
                'label' => __('Description', 'masterlayer'),
                'selector' => '{{WRAPPER}} .desc',
                'condition' => [ 'show_desc' => 'true' ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'post_date_typography',
                'label' => __('Post Date', 'masterlayer'),
                'selector' => '{{WRAPPER}} .post-date',
                'condition' => [ 'show_post_date' => 'true' ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'link_typography',
                'label' => __('Link', 'masterlayer'),
                'selector' => '{{WRAPPER}} .master-link',
                'condition' => [ 'url_type' => 'link' ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'label' => __('Button', 'masterlayer'),
                'selector' => '{{WRAPPER}} .master-button',
                'condition' => [ 'url_type' => 'button' ]
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $config = array();
        $cls = $css = $data = "";
        $settings = $this->get_settings_for_display();

        $args = array(
            'post_type' => 'post',
            'posts_per_page' => $settings['posts_per_page']
        );

        if ( $settings['cat_slug'] ) {
                $args['tax_query'] = array(
                    array(
                        'taxonomy' => 'category',
                        'field'    => 'slug',
                        'terms'    => $settings['cat_slug']
                    ),
                );
            }

            if ( $settings['exclude_cat_slug'] ) {
                $args['tax_query'] = array(
                    array(
                        'taxonomy' => 'category',
                        'field' => 'slug',
                        'terms' => $settings['exclude_cat_slug'],
                        'operator' => 'NOT IN'
                    ),
                );
            }

        $query = new \WP_Query( $args );
        if ( ! $query->have_posts() ) { esc_html_e( 'News item not found!', 'deeper' ); return; }

        // Data config for carousel
        $config['column'] = $settings['column'];
        $config['gap'] = $settings['gap'];
        $config['arrowPosition'] = $settings['arrowPosition'];
        $config['arrowMiddleOffset'] = $settings['arrowMiddleOffset'];
        $config['arrowTopOffset'] = $settings['arrowTopOffset'];
        $config['dotOffset'] = $settings['dotOffset'];
        $config['fullRight'] = $settings['fullRight'] == 'true' ? true : false;
        $config['autoPlay'] = $settings['autoPlay'] == 'true' ? true : false;
        $config['prevNextButtons'] = $settings['prevNextButtons'] == 'true' ? true : false;
        $config['pageDots'] = $settings['pageDots'] == 'true' ? true : false;

        $data = 'data-config=\'' . json_encode( $config ) . '\'';

        ?>

        <div class="master-carousel-box master-news-carousel" <?php echo $data; ?>>
            <?php
            if ( $query->have_posts() ) : ?>
                <?php while ( $query->have_posts() ) : $query->the_post(); 
                    $url = $desc = $title = $cls = $post_date = '';
                    $cls .= 'mlr-' . rand() . ' item-carousel ';

                    // Post date
                    if ( $settings['show_post_date'] )
                        $post_date = sprintf('<span class="post-date">%1$s</span>', 
                            get_the_date()
                        );

                    // Title
                    $title = sprintf(
                        '<h3 class="headline-2"><a href="%2$s">%1$s</a></h3>',
                        esc_html( get_the_title() ),
                        esc_url( get_the_permalink() ) );  

                    // Desciption
                    if ( $settings['show_desc'] )
                        $desc = sprintf('<div class="desc">%1$s</div>', get_the_excerpt() );

                    // Image
                    $image = sprintf(
                        '<div class="thumb">%1$s</div>',
                        get_the_post_thumbnail( get_the_ID(), $settings['image_crop'] ));

                    // URL
                    if ( $settings['url_type'] == 'link' || 'button')
                        $url = $this->render_link( get_the_permalink(), $settings['url_text'] );
                    
                    ?>

                    <div class="master-news <?php echo esc_attr($cls); ?>">
                        <?php 
                        echo $image;

                        echo '<div class="content-wrap">';
                        echo '<div class="text-wrap">';
                        echo $post_date;
                        echo $title;
                        echo $desc;
                        echo '</div>';
                        echo $url;
                        echo '</div>'
                        ?>

                    </div>
                <?php endwhile; 
            endif; wp_reset_postdata(); ?>
        </div>
    <?php }

    public function render_link( $url, $text ) {
        $link = $this->get_settings_for_display();

        if ($link['url_type'] == 'link') {
            $cls = "";
            $cls .= ' icon-' . $link['link_icon_position'];

            $link_icon = '';
            if ($link['link_icon'])  {
                $link_icon = sprintf('<span class="icon %1$s"></span>', $link['link_icon']['value']);
            }
            
            ob_start(); ?>
            <div class="url-wrap">
                <a class="master-link <?php echo esc_attr($cls); ?>" href="<?php echo esc_url($url); ?>">
                    <?php if ( $link['link_icon_position'] == 'left' ) echo $link_icon; ?>
                    <span><?php echo $text; ?></span>
                    <?php if ( $link['link_icon_position'] == 'right' ) echo $link_icon; ?>
                </a>
            </div>

            <?php
            $return = ob_get_clean();
            return $return;
        } else if ($link['url_type'] == 'button') {
            $button = $link;
            $cls = "";
            $cls .= $button['button_style'] . ' icon-' . $button['button_icon_position'];

            $button_icon = '';
            if ($button['button_icon'])  {
                $button_icon = sprintf('<span class="icon %1$s"></span>', $button['button_icon']['value']);
            }
            
            ob_start(); ?>
            <div class="url-wrap">
                <a class="master-button small <?php echo esc_attr($cls); ?>" href="<?php echo esc_url($url); ?>">
                    <?php if ( $button['button_icon_position'] == 'left' ) echo $button_icon; ?>
                    <?php echo $text; ?>
                    <span class="hover-effect"></span>
                    <?php if ( $button['button_icon_position'] == 'right' ) echo $button_icon; ?>
                </a>
            </div>

            <?php
            $return = ob_get_clean();
            return $return;
        }
    }

    protected function content_template() {}
}

