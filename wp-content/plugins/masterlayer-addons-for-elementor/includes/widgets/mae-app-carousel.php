<?php
/*
Widget Name: App Carousel
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

class MAE_App_Carousel_Widget extends Widget_Base {

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
    }

    public function get_script_depends() {
        return [ 'owl-carousel' ];
    }

    public function get_style_depends() {
        return [ 'owl-carousel' ];
    }

    // The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
    public function get_name() {
        return 'mae-app-carousel';
    }

    // The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
    public function get_title() {
        return __( 'App Carousel', 'masterlayer' );
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

        // Content Section

        $this->start_controls_section( 'section_images', ['label' => __( 'Images', 'masterlayer' )] );

            $repeater = new Repeater();

            $repeater->add_control(
                'pimage',
                [
                    'label' => __( 'Image', 'masterlayer' ),
                    'type' => Controls_Manager::MEDIA,
                    'default' => [
                        'url' => Utils::get_placeholder_image_src(),
                    ],
                ]
            );

            $this->add_control(
                'pls',
                [
                    'label'       => '',
                    'type'        => Controls_Manager::REPEATER,
                    'show_label'  => false,
                    'default'     => [
                        [
                            'pimage'  => [
                                'url' => Utils::get_placeholder_image_src(),
                            ],
                        ],
                        [
                            'pimage'  => [
                                'url' => Utils::get_placeholder_image_src(),
                            ],
                        ]
                    ],
                    'fields'      => $repeater->get_controls(),
                    'title_field' => false,
                ]
            );

        $this->end_controls_section();


        // Carousel settings
        $this->start_controls_section( 'setting_carousel_section',['label' => __( 'Carousel', 'masterlayer' ), 'tab' => Controls_Manager::TAB_SETTINGS,]);

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

        $this->end_controls_section();
    }

    protected function render() {
        $config = array();
        $settings = $this->get_settings_for_display();
        $data = $settings['autoPlay'] == 'true' ? "true" : "false";
        ?>

        <div class="carousel-outer">
            <div class="master-app-carousel owl-carousel owl-theme" data-auto="<?php echo $data; ?>">

                <?php if ( ! empty( $settings['pls'] ) ) : foreach ( $settings['pls'] as $pl ) : ?>
                    <?php
                    $cls = $img = "";
                    if ( $pl['pimage']['url'] ) $img = '<img src="'. $pl['pimage']['url'] .'" alt="">';
                    
                    $cls = 'elementor-repeater-item-' . $pl['_id'];
                    printf(
                        '<div class="%2$s">%1$s</div>',
                        $img,
                        $cls
                    );
                    ?>
                <?php endforeach; endif; ?>

            </div>
            <div class="mockup-layer"><span class="m1"></span><span class="m2"></span></div>
        </div>
    <?php }

    protected function content_template() {}
}

