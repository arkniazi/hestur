<?php
/*
Widget Name: Price Box
Description: 
Author: Masterlayer
Author URI: http://masterlayer.edu.vn
Plugin URI: https://masterlayer.edu.vn/masterlayer-addons-for-elementor/
*/

namespace MasterlayerAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Icons_Manager;
use Elementor\Core\Schemes\Color;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use Elementor\Modules\DynamicTags\Module as TagsModule;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class MAE_Price_Box_Widget extends Widget_Base {

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
    }

    // The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
    public function get_name() {
        return 'mae-price-box';
    }

    // The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
    public function get_title() {
        return __( 'Price Box', 'masterlayer' );
    }

    // The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
    public function get_icon() {
        return 'eicon-price-table';
    }

    // The get_categories method, lets you set the category of the widget, return the category name as a string.
    public function get_categories() {
        return [ 'masterlayer-addons' ];
    }

	protected function register_controls() {

		$this->start_controls_section(
			'section__content',
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
                    ''              => __( 'Default', 'masterlayer'),
                    'style-1'       => __( 'Style 1', 'masterlayer'),
                    'style-2'       => __( 'Style 2', 'masterlayer'),
                    'style-3'       => __( 'Style 3', 'masterlayer'),
                ],
                'prefix_class' => 'pricebox-'
            ]
        );


        $this->add_control(
            'plan',
            [
                'label'     => __( 'Plan', 'masterlayer'),
                'type'      => Controls_Manager::TEXT,
                'default'   => __( 'Plan Basic', 'masterlayer'),
            ]
        );  

        $this->add_control(
            'sub',
            [
                'label'     => __( 'Sub', 'masterlayer'),
                'type'      => Controls_Manager::TEXT,
                'default'   => __( 'For individuals or teams', 'masterlayer'),
            ]
        );

        $this->add_control(
            'price',
            [
                'label'     => __( 'Price', 'masterlayer'),
                'type'      => Controls_Manager::TEXT,
                'default'   => __( '100$', 'masterlayer'),
            ]
        );

        $this->add_control(
            'desc',
            [
                'label'      => __( 'Description', 'masterlayer' ),
                'type'       => Controls_Manager::WYSIWYG,
                'default'    => __( 'We believe architecture and design are critically important to addressing the most pressing challenges of our time.', 'masterlayer' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'url_heading',
            [
                'label' => __( 'URL', 'masterlayer' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after'
            ]
        );

        $this->add_control(
            'url_type',
            [
                'label'     => __( 'URL Type', 'masterlayer'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'button',
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
                'label'     => __( 'URL Text', 'masterlayer'),
                'type'      => Controls_Manager::TEXT,
                'dynamic'   => [
                    'active'   => true,
                ],
                'default'   => __( 'Read More', 'masterlayer'),
                'condition' => [ 'url_type!' => [ 'none', '' ] ]
            ]
        );

        $this->add_control(
            'url',
            [
                'label'      => __( 'URL', 'masterlayer'),
                'type'       => Controls_Manager::URL,
                'dynamic'    => [
                    'active'        => true,
                    'categories'    => [
                        TagsModule::POST_META_CATEGORY,
                        TagsModule::URL_CATEGORY
                    ],
                ],
                'placeholder'       => 'https://www.your-link.com',
                'default'           => [
                    'url' => '#',
                ],
                'condition' => [ 'url_type!' => 'none' ]
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

        // Button
        $this->add_control(
            'button_style',
            [
                'label'     => __( 'Button Style', 'masterlayer'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'btn-accent',
                'options'   => [
                    'btn-accent'      => __( 'Accent', 'masterlayer'),
                    'btn-outline'     => __( 'Outline', 'masterlayer'),
                    'btn-light'       => __( 'Light', 'masterlayer'),
                    'btn-dark'     => __( 'Dark', 'masterlayer'),
                    'btn-accent-2'     => __( 'Accent 2', 'masterlayer'),
                    'btn-outline-2'     => __( 'Outline 2', 'masterlayer'),
                    'btn-accent-3'     => __( 'Accent 3', 'masterlayer'),
                    'btn-outline-3'     => __( 'Outline 3', 'masterlayer'),
                    'btn-accent-4'     => __( 'Accent 4', 'masterlayer'),
                    'btn-accent-5'     => __( 'Accent 5', 'masterlayer'),
                    'btn-outline-5'     => __( 'Outline 5', 'masterlayer')
                ],
                'condition' => [ 'url_type' => 'button' ]
            ]
        );

        $this->add_control(
            'button_size',
            [
                'label'     => __( 'Button Size', 'masterlayer'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'medium',
                'options'   => [
                    'big'      => __( 'Big', 'masterlayer'),
                    'medium'       => __( 'Medium', 'masterlayer'),
                    'small'     => __( 'Small', 'masterlayer')
                ],
                'condition' => [ 'url_type' => 'button' ]
            ]
        );

        $this->add_control(
            'button_icon_position',
            [
                'label'     => __( 'Has Icon ?', 'masterlayer'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'none',
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

        $this->start_controls_section( 'setting_service_section',
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
            'plan_color',
            [
                'label' => __( 'Plan Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .master-price-box .plan' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'sub_color',
            [
                'label' => __( 'Sub Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .master-price-box .sub-headline' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'price_color',
            [
                'label' => __( 'Price Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .master-price-box .price' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'desc_color',
            [
                'label' => __( 'Description Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .master-price-box .desc' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'service_box_hover',
            [
                'label' => __( 'Hover', 'masterlayer' ),
            ]
        );

        $this->add_control(
            'plan_color_hover',
            [
                'label' => __( 'Plan Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}:hover .master-price-box .plan' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'sub_color_hover',
            [
                'label' => __( 'Sub Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}:hover .master-price-box .sub-headline' => 'color: {{VALUE}};',
                ]
            ]
        );


        $this->add_control(
            'price_color_hover',
            [
                'label' => __( 'Price Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}:hover .master-price-box .price' => 'color: {{VALUE}};',
                ]
            ]
        );



        $this->add_control(
            'desc_color_hover',
            [
                'label' => __( 'Description Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}:hover .master-price-box .desc' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        // URL
        $this->start_controls_section( 'style_url_section',
            [
                'label' => __( 'URL', 'masterlayer' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [ 'url_type!' => 'none' ]
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
                    '{{WRAPPER}}:hover .master-price-box .master-link' => 'color: {{VALUE}};',
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
                    '{{WRAPPER}}:hover .master-price-box .master-link .icon' => 'color: {{VALUE}};',
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
                    '{{WRAPPER}}:hover .master-price-box .master-button' => 'color: {{VALUE}};',
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
                    '{{WRAPPER}}:hover .master-price-box .master-button .icon' => 'color: {{VALUE}};',
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
                    '{{WRAPPER}}:hover .master-price-box .master-button' => 'background-color: {{VALUE}};',
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
                    '{{WRAPPER}}:hover .master-price-box .master-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}}:hover .master-price-box .master-button' => 'border-color: {{VALUE}};'
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
                    '{{WRAPPER}}:hover .master-price-box .master-button' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                'selector' => '{{WRAPPER}}:hover .master-price-box .master-button',
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
                    '{{WRAPPER}} .master-price-box .master-button .hover-effect' => 'background-color: {{VALUE}};',
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
                    '{{WRAPPER}} .master-price-box .master-button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .master-price-box .master-button:hover' => 'border-color: {{VALUE}};'
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
                    '{{WRAPPER}} .master-price-box .master-button:hover' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                'selector' => '{{WRAPPER}} .master-price-box .master-button:hover',
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
            'price_spacing',
            [
                'label'      => __( 'Price Bottom Spacing', 'masterlayer' ),
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
                'selectors'  => [
                    '{{WRAPPER}} .master-price-box .price ' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                ],
                50,
            ]
        );

        $this->add_responsive_control(
            'sub_spacing',
            [
                'label'      => __( 'Sub Headline Bottom Spacing', 'masterlayer' ),
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
                'selectors'  => [
                    '{{WRAPPER}} .master-price-box .sub-headline ' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                ],
                50,
            ]
        );

        $this->add_responsive_control(
            'plan_spacing',
            [
                'label'      => __( 'Plan Bottom Spacing', 'masterlayer' ),
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
                'selectors'  => [
                    '{{WRAPPER}} .master-price-box .plan ' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                ],
                50,
            ]
        );

        $this->add_responsive_control(
            'desc_spacing',
            [
                'label'      => __( 'Description Bottom Spacing', 'masterlayer' ),
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
                'selectors'  => [
                    '{{WRAPPER}} .master-price-box .desc ' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                ],
                50,
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
                'name' => 'plan_typography',
                'label' => __('Plan', 'masterlayer'),
                'selector' => '{{WRAPPER}} .master-price-box .plan'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'sub_typography',
                'label' => __('Sub', 'masterlayer'),
                'selector' => '{{WRAPPER}} .master-price-box .sub-headline'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'price_typography',
                'label' => __('Price', 'masterlayer'),
                'selector' => '{{WRAPPER}} .master-price-box .price'
            ]
        );



        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'desc_typography',
                'label' => __('Description', 'masterlayer'),
                'selector' => '{{WRAPPER}} .master-price-box .desc'
            ]
        );

        $this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
        $price = $plan = $desc = $url = '';
        $style = $this->get_settings_for_display( 'style' );

        // URL
        if ($settings['url_type'] != 'none')
            $url = $this->render_link( $settings['url'], $settings['url_text']);
		?>

		<div class="master-price-box">
            <div class="price-wrap">
                <h2 class="plan headline-2"><?php echo $settings['plan']; ?></h2>
                <div class="sub-headline"><?php echo $settings['sub']; ?></div>
                <div class="price"><?php echo $settings['price']; ?></div>
            </div>
			<div class="desc"><?php echo $settings['desc']; ?></div>
            <?php echo $url; ?>
	    </div>

	    <?php
	}

    public function render_link( $url, $text ) {
        $link = $this->get_settings_for_display();

        if ($link['url_type'] == 'link') {
            $cls = $url_attr = "";
            $cls .= ' icon-' . $link['link_icon_position'];

            if ( $url['is_external'] ) {
                $url_attr .= 'target="_blank" ';
            }

            if ( ! empty( $url['nofollow'] ) ) {
                $url_attr .= 'rel="nofollow" ';
            }

            $link_icon = '';
            if ($link['link_icon'])  {
                $link_icon = sprintf('<span class="icon %1$s"></span>', $link['link_icon']['value']);
            }
            
            ob_start(); ?>
            <div class="url-wrap">
                <a class="master-link <?php echo esc_attr($cls); ?>" href="<?php echo esc_url($url['url']); ?>" <?php echo esc_attr($url_attr); ?>>
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
            $cls = $url_attr = "";
            $cls .= $button['button_style'] . ' icon-' . $button['button_icon_position'] . ' ' . $button['button_size'];

            if ( $url['is_external'] ) {
                $url_attr .= 'target="_blank" ';
            }

            if ( ! empty( $url['nofollow'] ) ) {
                $url_attr .= 'rel="nofollow" ';
            }

            $button_icon = '';
            if ($button['button_icon'])  {
                $button_icon = sprintf('<span class="icon %1$s"></span>', $button['button_icon']['value']);
            }
            
            ob_start(); ?>
            <div class="url-wrap">
                <a class="master-button <?php echo esc_attr($cls); ?>" href="<?php echo esc_url($url['url']); ?>" <?php echo esc_attr($url_attr); ?>>
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

