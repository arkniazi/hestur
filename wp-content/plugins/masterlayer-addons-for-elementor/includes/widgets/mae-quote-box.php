<?php
/*
Widget Name: Quote Box
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

class MAE_Quote_Box_Widget extends Widget_Base {

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
        return 'mae-quote-box';
    }

    // The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
    public function get_title() {
        return __( 'Quote Box', 'masterlayer' );
    }

    // The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
    public function get_icon() {
        return 'eicon-person';
    }

    // The get_categories method, lets you set the category of the widget, return the category name as a string.
    public function get_categories() {
        return [ 'masterlayer-addons' ];
    } 

    protected function register_controls() {

        // Content Section
        $this->start_controls_section( 'content_section',
            [
                'label' => __( 'Content', 'masterlayer' ),
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
                'default' => 'center',
                'prefix_class' => 'align-%s'
            ]
        );

        $this->add_control(
            'name',
            [
                'label'   => __( 'Name', 'masterlayer' ),
                'type'    => Controls_Manager::TEXT,
                'default' => __( 'Luke Soul', 'masterlayer' ),
            ]
        );

        $this->add_control(
            'role',
            [
                'label'   => __( 'Position', 'masterlayer' ),
                'type'    => Controls_Manager::TEXT,
                'default' => __( 'Manager', 'masterlayer' ),
            ]
        );

        $this->add_control(
            'url',
            [
                'label'      => __( 'Bio URL', 'masterlayer'),
                'type'       => Controls_Manager::URL,
                'placeholder'       => 'https://www.your-link.com',
                'default'           => [
                    'url' => '#',
                ]
            ]
        );

        $this->add_control(
            'avatar',
            [
                'label'   => __( 'Avatar', 'masterlayer' ),
                'type'    => Controls_Manager::MEDIA,
                'default' => [ 'url' => Utils::get_placeholder_image_src(), ]
            ]
        );

        $this->add_control(
            'socials_heading',
            [
                'label' => __( 'Socials Link', 'masterlayer' ),
                'type' => Controls_Manager::HEADING
            ]
        );

        $this->add_control(
            'facebook',
            [   
                'separator' => 'before',
                'label'        => __( 'Facebook', 'masterlayer' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'On', 'masterlayer' ),
                'label_off'    => __( 'Off', 'masterlayer' ),
                'return_value' => 'true',
                'default'      => '',
            ]
        );

        $this->add_control(
            'facebook_url',
            [
                'label'      => __( 'Facebook URL', 'masterlayer'),
                'type'       => Controls_Manager::URL,
                'placeholder'       => 'https://www.your-link.com',
                'default'           => [
                    'url' => '#',
                ],
                'condition' => [ 'facebook' => 'true' ],
                'show_label' => false
            ]
        );

        $this->add_control(
            'twitter',
            [
                'label'        => __( 'Twitter', 'masterlayer' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'On', 'masterlayer' ),
                'label_off'    => __( 'Off', 'masterlayer' ),
                'return_value' => 'true',
                'default'      => '',
            ]
        );

        $this->add_control(
            'twitter_url',
            [
                'label'      => __( 'Twitter URL', 'masterlayer'),
                'type'       => Controls_Manager::URL,
                'placeholder'       => 'https://www.your-link.com',
                'default'           => [
                    'url' => '#',
                ],
                'condition' => [ 'twitter' => 'true' ],
                'show_label' => false
            ]
        );

        $this->add_control(
            'instagram',
            [
                'label'        => __( 'Instagram', 'masterlayer' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'On', 'masterlayer' ),
                'label_off'    => __( 'Off', 'masterlayer' ),
                'return_value' => 'true',
                'default'      => '',
            ]
        );

        $this->add_control(
            'instagram_url',
            [
                'label'      => __( 'Instagram URL', 'masterlayer'),
                'type'       => Controls_Manager::URL,
                'placeholder'       => 'https://www.your-link.com',
                'default'           => [
                    'url' => '#',
                ],
                'condition' => [ 'instagram' => 'true' ],
                'show_label' => false
            ]
        );

        $this->add_control(
            'linkedin',
            [
                'label'        => __( 'Linkedin', 'masterlayer' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'On', 'masterlayer' ),
                'label_off'    => __( 'Off', 'masterlayer' ),
                'return_value' => 'true',
                'default'      => '',
            ]
        );

        $this->add_control(
            'linkedin_url',
            [
                'label'      => __( 'Linkedin URL', 'masterlayer'),
                'type'       => Controls_Manager::URL,
                'placeholder'       => 'https://www.your-link.com',
                'default'           => [
                    'url' => '#',
                ],
                'condition' => [ 'linkedin' => 'true' ],
                'show_label' => false
            ]
        );

        $this->add_control(
            'desc',
            [
                'label'      => __( 'Description', 'masterlayer' ),
                'type'       => Controls_Manager::WYSIWYG,
                'default'    => __( 'We believe architecture and design are critically important to addressing the most pressing challenges of our time.', 'masterlayer' ),
            ]
        );

        $this->end_controls_section();

        // STYLE TAB
        // General
        $this->start_controls_section( 'style_general_section',
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
            'name_color',
            [
                'label' => __( 'Name Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .master-quote .name a' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'role_color',
            [
                'label' => __( 'Role Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .master-quote .role' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'desc_color',
            [
                'label' => __( 'Description Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .master-quote .desc' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'quote_box_hover',
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
            'name_color_hover',
            [
                'label' => __( 'Name Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .master-quote:hover .name' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'role_color_hover',
            [
                'label' => __( 'Role Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .master-quote:hover .role' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'desc_color_hover',
            [
                'label' => __( 'Description Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .master-quote:hover .desc' => 'color: {{VALUE}};',
                ]
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

        $this->add_control(
            'name_margin',
            [
                'label' => __('Name Margin', 'masterlayer'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'default' => [
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .master-quote .headline-2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_control(
            'role_margin',
            [
                'label' => __('Role Margin', 'masterlayer'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'default' => [
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .master-quote .headline-2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_control(
            'desc_margin',
            [
                'label' => __('Description Margin', 'masterlayer'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'default' => [
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .master-quote .desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
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
                'name' => 'name_typography',
                'label' => __('Heading', 'masterlayer'),
                'selector' => '{{WRAPPER}} .name'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'role_typography',
                'label' => __('Heading', 'masterlayer'),
                'selector' => '{{WRAPPER}} .role'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'desc_typography',
                'label' => __('Description', 'masterlayer'),
                'selector' => '{{WRAPPER}} .desc'
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

        
        $html = $name = $role = $desc = $avatar = $icon = $url = $socials = "";
        
        // Name
        if ($settings['name'])
            $name = sprintf('<h3 class="name"><a href="%2$s">%1$s</a></h3>', 
                esc_html( $settings['name'] ),
                esc_url( $settings['url']['url'] ) );

        // Role
        if ($settings['role'])
            $role = sprintf('<span class="role">%1$s</span>', 
                esc_html( $settings['role'] ) );

        // Description
        if ($settings['desc'])
            $desc = sprintf('<div class="desc">%1$s</div>', 
                $settings['desc'] );


        // Avatar URL
        if ($settings['avatar'])
            $avatar = sprintf('<div class="avatar"><a href="%2$s"><img alt="Avatar" src="%1$s" /></a></div>', 
                $settings['avatar']['url'],
                esc_url($settings['url']['url'])
            );

        // Socials
        if ( ($settings['facebook'] == 'true') && $settings['facebook_url'])
            $socials .= sprintf('<a href="%1$s" class="fab fa-facebook-f"></a>', esc_url($settings['facebook_url']['url']));

        if ( ($settings['twitter'] == 'true') && $settings['twitter_url'])
            $socials .= sprintf('<a href="%1$s" class="fab fa-twitter"></a>', esc_url($settings['twitter_url']['url']));

        if ( ($settings['instagram'] == 'true') && $settings['instagram_url'])
            $socials .= sprintf('<a href="%1$s" class="fab fa-instagram"></a>', esc_url($settings['instagram_url']['url']));
        
        if ( ($settings['linkedin'] == 'true') && $settings['linkedin_url'])
            $socials .= sprintf('<a href="%1$s" class="fab fa-linkedin-in"></a>', esc_url($settings['linkedin_url']['url']));

        if ($socials)
            $socials = '<div class="socials-wrap">' . $socials . '</div>';
        // HTML render

        ?>
        <div class="master-quote normal-style">
            <?php echo $avatar; ?>
            <div class="content-wrap">
                <?php
                echo $desc;
                echo $name;
                echo $role;
                echo $socials;
                ?>

            </div>
        </div>

        <?php
    }

    protected function content_template() {}
}

