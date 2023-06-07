<?php
/*
Widget Name: Time Line
Description: 
Author: Masterlayer
Author URI: http://masterlayer.edu.vn
Plugin URI: https://masterlayer.edu.vn/masterlayer-addons-for-elementor/
*/

namespace MasterlayerAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use \Elementor\Plugin;
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

class MAE_Timeline_Widget extends Widget_Base{

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
    }

    // The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
    public function get_name() {
        return 'mae-timeline';
    }

    // The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
    public function get_title() {
        return __( 'Time Line', 'masterlayer' );
    }

    // The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
    public function get_icon() {
        return 'eicon-time-line';
    }

    // The get_categories method, lets you set the category of the widget, return the category name as a string.
    public function get_categories() {
        return [ 'masterlayer-addons' ];
    }

	protected function register_controls() {
      
		//Content Service box
		$this->start_controls_section(
			'section__content',
			[
				'label' => __( 'Timeline', 'masterlayer' ),
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
            'number_heading',
            [
                'label' => __( 'Number', 'masterlayer' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after'
            ]
        );

        $repeater->add_control(
			'number',
			[
				'label' => __( 'Number', 'masterlayer' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Your Number', 'masterlayer' ),
			]
		);

		$repeater->add_control(
            'image_heading',
            [
                'label' => __( 'Image', 'masterlayer' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after'
            ]
        );

        $repeater->add_control(
            'image_position',
            [
                'label' => __( 'Image Position', 'masterlayer' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'masterlayer' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'masterlayer' ),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'default' => 'left',
            ]
        );

        $repeater->add_control(
            'image',
            [	
            	'label' => __( 'Image', 'masterlayer' ),
                'type'    => Controls_Manager::MEDIA,
                'default' => [ 'url' => Utils::get_placeholder_image_src(), ]
            ]
        );

		$repeater->add_control(
            'content_heading',
            [
                'label' => __( 'Content', 'masterlayer' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after'
            ]
        );

        $repeater->add_control(
            'content_type',
            [
                'label'     => __( 'Content Type', 'masterlayer'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'content',
                'options'   => [
                    'content'         => __( 'Content', 'masterlayer'),
                    'template'        => __( 'Template', 'masterlayer'),
                ]
            ]
        );

		$repeater->add_control(
			'content',
			[
				'label' => __( 'Content', 'masterlayer' ),
				'default' => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'masterlayer' ),
				'placeholder' => __( 'Enter your text...', 'masterlayer' ),
				'type' => Controls_Manager::WYSIWYG,
				'show_label' => true,
				'condition' => [ 'content_type' => 'content' ]
			]
		);

		$repeater->add_control(
            'template',
            [
                'label'     => __( 'Choose Templates', 'masterlayer'),
                'type'      => Controls_Manager::SELECT,
                'options'   => mae_get_templates(),
                'condition' => [ 'content_type' => 'template' ]
            ]
        );

		$this->add_control(
			'timeline',
			[
				'label' => __( 'Timeline Items', 'masterlayer' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'tab_title' => __( '01', 'masterlayer' ),
						'tab_content' => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'masterlayer' ),
					],
					[
						'tab_title' => __( '02', 'masterlayer' ),
						'tab_content' => __( 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'masterlayer' ),
					],
					[
						'tab_title' => __( '03', 'masterlayer' ),
						'tab_content' => __( 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'masterlayer' ),
					],
				],
				'title_field' => '{{{ number }}}',
			]
		);


		$this->end_controls_section();

		$this->start_controls_section( 'setting_service_section',
            [
                'label' => __( 'Image', 'masterlayer' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'border_radius',
            [
                'label' => __('Rounded', 'masterlayer'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .master-timeline .timeline-image .image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow',
                'selector' => '{{WRAPPER}} .master-timeline .timeline-image .image',
            ]
        );

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$timeline = $this->get_settings_for_display( 'timeline' );
		?>

		<div class="master-timeline">
			<?php foreach ( $timeline as $item ) { 
				$cls = 'elementor-repeater-item-' . $item['_id'] . ' image-' . $item['image_position'];
				?>
				<div class="timeline-item <?php echo $cls; ?>">
					<div class="inner">
						<?php 
						// Image
						if ( $item['image']['url'] )
							echo '<div class="timeline-image"><div class="image"><img alt="Image" src="' . esc_url( $item['image']['url'] )  . '" /></div></div>';
						?>

						<div class="timeline-content">
							<?php
							if ($item['content_type'] == 'content') {
								echo $item['content']; 
							} else {
								if ( !empty($item['template']) ) {
				                    echo Plugin::$instance->frontend->get_builder_content($item['template'], true);
				                }
							} ?>
						</div>
					</div>

					<div class="timeline-number">
						<?php 
						if ( $item['number'] )
							echo '<div class="number">' . $item['number'] . '</div>';
						?>
					</div>
				</div>
			<?php } ?>
	    </div>

	    <?php
	}

	protected function content_template() {} 
}

