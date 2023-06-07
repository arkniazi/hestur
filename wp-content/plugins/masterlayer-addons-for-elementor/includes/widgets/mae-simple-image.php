<?php
/*
Widget Name: Simple Image
Description: 
Author: Masterlayer
Author URI: http://masterlayer.edu.vn
Plugin URI: https://masterlayer.edu.vn/masterlayer-addons-for-elementor/
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
use Elementor\Group_Control_Border;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Box_Shadow;
use Elementor\Modules\DynamicTags\Module as TagsModule;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class MAE_Simple_Image_Widget extends Widget_Base {

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
    }

    // The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
    public function get_name() {
        return 'mae-simple-image';
    }

    // The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
    public function get_title() {
        return __( 'Simple Image', 'masterlayer' );
    }

    // The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
    public function get_icon() {
        return 'eicon-image-rollover';
    }

    // The get_categories method, lets you set the category of the widget, return the category name as a string.
    public function get_categories() {
        return [ 'masterlayer-addons' ];
    }

    protected function register_controls() {
        // Content
        $this->start_controls_section( 'content_section',
            [
                'label' => __( 'Content', 'masterlayer' ),
            ]
        );

        $this->add_control(
            'image',
            [
                'label'   => __( 'Image', 'masterlayer' ),
                'type'    => Controls_Manager::MEDIA,
                'default' => [ 'url' => Utils::get_placeholder_image_src(), ]
            ]
        );

        $this->add_control(
            'url',
            [
                'label'      => __( 'URL', 'masterlayer'),
                'type'       => Controls_Manager::URL,
                'placeholder'       => 'https://www.your-link.com',
                'default'           => [
                    'url' => '',
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section( 'style_section',
            [
                'label' => __( 'General', 'masterlayer' ),
                'tab' => Controls_Manager::TAB_STYLE,
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
                'default' => 'left',
                'prefix_class' => 'align-%s'
            ]
        );

        $this->add_responsive_control(
            'max_width',
            [
                'label' => __( 'Image Width', 'masterlayer' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ '%', 'px', 'vw' ],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 1000,
                    ],
                    'vw' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .master-image' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
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
            'opacity',
            [
                'label'     => __( 'Opacity', 'masterlayer'),
                'type'      => Controls_Manager::NUMBER,
                'min'     => 0,
                'max'     => 1,
                'step'    => 0.1,
                'selectors' => [
                    '{{WRAPPER}} .master-image' => 'opacity: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'grayscale',
            [
                'label'     => __( 'Grayscale', 'masterlayer'),
                'type'      => Controls_Manager::NUMBER,
                'min'     => 0,
                'max'     => 100,
                'step'    => 10,
                'selectors' => [
                    '{{WRAPPER}} .master-image' => 'filter: grayscale({{VALUE}}%);',
                ],
            ]
        );

        $this->add_control(
            'scale',
            [
                'label'     => __( 'Scale', 'masterlayer'),
                'type'      => Controls_Manager::NUMBER,
                'min'     => 0,
                'max'     => 2,
                'step'    => 0.1,
                'selectors' => [
                    '{{WRAPPER}} .master-image' => 'transform: scale({{VALUE}});',
                ],
            ]
        );

        $this->add_control(
            'border_radius',
            [
                'label' => __('Rounded', 'masterlayer'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .master-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow',
                'selector' => '{{WRAPPER}} .master-image',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'box_hover',
            [
                'label' => __( 'Hover', 'masterlayer' ),
            ]
        );

        $this->add_control(
            'opacity_hover',
            [
                'label'     => __( 'Opacity', 'masterlayer'),
                'type'      => Controls_Manager::NUMBER,
                'min'     => 0,
                'max'     => 1,
                'step'    => 0.1,
                'selectors' => [
                    '{{WRAPPER}} .master-image:hover' => 'opacity: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'grayscale_hover',
            [
                'label'     => __( 'Grayscale', 'masterlayer'),
                'type'      => Controls_Manager::NUMBER,
                'min'     => 0,
                'max'     => 100,
                'step'    => 10,
                'selectors' => [
                    '{{WRAPPER}} .master-image:hover' => 'filter: grayscale({{VALUE}}%);',
                ],
            ]
        );

        $this->add_control(
            'scale_hover',
            [
                'label'     => __( 'Scale', 'masterlayer'),
                'type'      => Controls_Manager::NUMBER,
                'min'     => 0,
                'max'     => 2,
                'step'    => 0.1,
                'selectors' => [
                    '{{WRAPPER}} .master-image:hover' => 'transform: scale({{VALUE}});',
                ],
            ]
        );

        $this->add_control(
            'border_radius_hover',
            [
                'label' => __('Rounded', 'masterlayer'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .master-image:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow_hover',
                'selector' => '{{WRAPPER}} .master-image:hover',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        $img = '';

        if ($settings['url']['url']) {
            $img = sprintf('<a href="%2$s"><img alt="Image" src="%1$s" /></a>', 
                esc_url($settings['image']['url']),
                esc_url($settings['url']['url'])
            );
        } else {
            $img = sprintf('<img alt="Image" src="%1$s" />', esc_url($settings['image']['url']));
        }
        
        ?>
        <div class="master-image">
            <?php echo $img; ?>
        </div>
        <?php
    }

    protected function content_template() {}
}

