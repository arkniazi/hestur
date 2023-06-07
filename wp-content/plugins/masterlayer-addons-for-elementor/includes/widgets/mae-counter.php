<?php
/*
Widget Name: Counter
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

class MAE_Counter_Widget extends Widget_Base {

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
    }

    public function get_script_depends() {
        return [ 'appear', 'countto' ];
    }

    // The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
    public function get_name() {
        return 'mae-counter';
    }

    // The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
    public function get_title() {
        return __( 'Counter', 'masterlayer' );
    }

    // The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
    public function get_icon() {
        return 'eicon-counter';
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
			'icon_inline',
			[
				'label' => __( 'Icon Inline', 'masterlayer' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'masterlayer' ),
				'label_off' => __( 'No', 'masterlayer' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
            'icon_type',
            [
                'label' => __( 'Icon Type', 'masterlayer' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'none' => [
                        'title' => __( 'None', 'masterlayer' ),
                        'icon' => 'eicon-ban',
                    ],
                    'icon' => [
                        'title' => __( 'Icon', 'masterlayer' ),
                        'icon' => 'eicon-star-o',
                    ],
                    'font' => [
                        'title' => __( 'Font', 'masterlayer' ),
                        'icon' => 'eicon-t-letter',
                    ],
                    'image' => [
                        'title' => __( 'Image', 'masterlayer' ),
                        'icon' => 'eicon-image',
                    ],
                ],
                'default' => 'icon',
            ]
        );

        $this->add_control(
            'box_icon',
            [
                'label' => __( 'Icon', 'masterlayer' ),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'fa-solid',
                ],
                'condition' => [ 'icon_type' => 'icon' ]
            ]
        );

        $this->add_control(
            'icon_font',
            [
                'type'    => Controls_Manager::TEXT,
                'default' => __( '01', 'masterlayer' ),
                'placeholder' => __( 'Enter your text', 'masterlayer' ),
                'label_block' => true,
                'condition' => [ 'icon_type' => 'font' ]
            ]
        );

        $this->add_control(
            'icon_image',
            [
                'label'   => __( 'Image', 'masterlayer' ),
                'type'    => Controls_Manager::MEDIA,
                'default' => [ 'url' => Utils::get_placeholder_image_src(), ],
                'condition' => [ 'icon_type' => 'image' ]
            ]
        );

 		$this->add_control(
			'title',
			[
				'label' => __( 'Title', 'masterlayer' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Projects Done', 'masterlayer' ),
			]
		);

		$this->add_control(
			'desc',
			[
				'label' => __( 'Desc', 'masterlayer' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '3,500 Ratings', 'masterlayer' ),
			]
		);


		$this->add_control(
			'number',
			[
				'label' => 'Number',
				'type' => Controls_Manager::TEXT,
				'default' => __( '7200', 'masterlayer' ),
			]
		);

		$this->add_control(
			'suffix',
			[
				'label' => __( 'Number Suffix', 'masterlayer' ),
				'type' => Controls_Manager::TEXT,
			]
		);

        $this->add_control(
            'decimals',
            [
                'label'     => __( 'Decimals', 'masterlayer'),
                'type'      => Controls_Manager::SELECT,
                'default'   => '0',
                'options'   => [
                    '0'     => __( '0', 'masterlayer'),
                    '1'     => __( '1', 'masterlayer'),
                    '2'     => __( '2', 'masterlayer'),
                    '3'     => __( '3', 'masterlayer')
                ]
            ]
        );

		$this->add_control(
			'duration',
			[
				'label' => __( 'Duration', 'masterlayer' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min'  => 1000,
						'max'  => 10000,
						'step' => 1000,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 2000,
				],
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label' => __( 'Alignment', 'masterlayer' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left'    => [
						'title' => __( 'Left', 'masterlayer' ),
						'desc' => __( 'Left', 'masterlayer' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'masterlayer' ),
						'desc' => __( 'Center', 'masterlayer' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'masterlayer' ),
						'desc' => __( 'Right', 'masterlayer' ),
						'icon' => 'fa fa-align-right',
					],
				],
			]
		);

		$this->end_controls_section();

		// Style
		$this->start_controls_section(
			'section_style_general',
			[
				'label' => __( 'General', 'masterlayer' ),
				'tab'   => Controls_Manager::TAB_STYLE,
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
			'wrap__heading',
			[
				'label' => __( 'Wrap', 'masterlayer' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'after'
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'box_bg_color',
				'label' => __( 'Background', 'masterlayer' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .master-counter',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'box_border',
				'selector' => '{{WRAPPER}} .master-counter',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'accs_box_shadow',
				'selector' => '{{WRAPPER}} .master-counter',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'text__heading',
			[
				'label' => __( 'Icon, Title, Number', 'masterlayer' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'after'
			]
		);
		$this->add_control(
			'icon_color',
			[
				'label' => __( 'Icon Color', 'masterlayer' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .icon-wrap' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'number_color',
			[
				'label' => __( 'Number Color', 'masterlayer' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .number-wrap span' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => __( 'Title Color', 'masterlayer' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .title' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'desc_color',
			[
				'label' => __( 'Desc Color', 'masterlayer' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .desc' => 'color: {{VALUE}};',
				]
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
			'wrap__heading_hover',
			[
				'label' => __( 'Wrap', 'masterlayer' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'after'
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'box_bg_color_hover',
				'label' => __( 'Background', 'masterlayer' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .master-counter:hover',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'box_border_hover',
				'selector' => '{{WRAPPER}} .master-counter:hover',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'accs_box_shadow_hover',
				'selector' => '{{WRAPPER}} .master-counter:hover',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'text__heading_hover',
			[
				'label' => __( 'Icon, Number, Title', 'masterlayer' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'after'
			]
		);
		$this->add_control(
			'icon_color_hover',
			[
				'label' => __( 'Icon Color', 'masterlayer' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .master-counter:hover .icon-wrap' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'number_color_hover',
			[
				'label' => __( 'Number Color', 'masterlayer' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .master-counter:hover .number-wrap span' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'title_color_hover',
			[
				'label' => __( 'Title Color', 'masterlayer' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .master-counter:hover .title' => 'color: {{VALUE}};',
				]
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section__style',
			[
				'label' => __( 'Wrap', 'masterlayer' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		// Wrap
		$this->add_responsive_control(
			'box_radius',
			[
				'label' => __( 'Border Radius', 'masterlayer' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .master-counter' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'box_padding',
			[
				'label' => __( 'Padding Box', 'masterlayer' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .master-counter' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section__style_icon',
			[
				'label' => __( 'Icon', 'masterlayer' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		// Icon
		$this->add_responsive_control(
			'icon_size',
			[
				'label' => __( 'Font Size', 'masterlayer' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 46,
					'unit' => 'px',
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .icon-wrap i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_top_spacing',
			[
				'label' => __( 'Icon: Top Spacing', 'masterlayer' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 8,
					'unit' => 'px',
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .icon-wrap' => 'padding-top: calc({{SIZE}}{{UNIT}});',
				],
			]
		);

		$this->add_responsive_control(
			'icon_left_spacing',
			[
				'label' => __( 'Icon: Left Spacing', 'masterlayer' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0,
					'unit' => 'px',
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .icon-wrap' => 'padding-left: calc({{SIZE}}{{UNIT}});',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section__style_number',
			[
				'label' => __( 'Number', 'masterlayer' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		// Number
		$this->add_control(
			'heading__number',
			[
				'label' => __( 'Number', 'masterlayer' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'number_left_spacing',
			[
				'label' => __( 'Number: Left Spacing', 'masterlayer' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .number-wrap' => 'padding-left: calc({{SIZE}}{{UNIT}});',
				],
			]
		);

		$this->add_responsive_control(
			'number_top_spacing',
			[
				'label' => __( 'Number: Top Spacing', 'masterlayer' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .number-wrap' => 'padding-top: calc({{SIZE}}{{UNIT}});',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'number_typography',
				'selector' => '{{WRAPPER}} .number-wrap span',
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'section__style_title',
			[
				'label' => __( 'Title', 'masterlayer' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		// Title
		$this->add_responsive_control(
			'title_left_spacing',
			[
				'label' => __( 'Title: Left Spacing', 'masterlayer' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .title' => 'padding-left: calc({{SIZE}}{{UNIT}});',
				],
			]
		);

		$this->add_responsive_control(
			'title_top_spacing',
			[
				'label' => __( 'Title: Top Spacing', 'masterlayer' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .title' => 'padding-top: calc({{SIZE}}{{UNIT}});',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .title',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section__style_desc',
			[
				'label' => __( 'Desc', 'masterlayer' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		// Desc
		$this->add_responsive_control(
			'desc_left_spacing',
			[
				'label' => __( 'Desc: Left Spacing', 'masterlayer' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .desc' => 'padding-left: calc({{SIZE}}{{UNIT}});',
				],
			]
		);

		$this->add_responsive_control(
			'desc_top_spacing',
			[
				'label' => __( 'Desc: Top Spacing', 'masterlayer' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .desc' => 'padding-top: calc({{SIZE}}{{UNIT}});',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'desc_typography',
				'selector' => '{{WRAPPER}} .desc',
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$icon;

		if ($settings['icon_type'] != 'none') {
            $icon_html = $this->render_icon();
            $icon = sprintf('<div class="icon-wrap">%1$s</div>',
                $icon_html
            );
        }


		$this->add_render_attribute( 'wrapper', 'class', 'master-counter' );
		if ( $settings['align'] ) {
			$this->add_render_attribute( 'wrapper', 'class', 'align-'. $settings['align'] );
		}
		if ( 'yes' === $settings['icon_inline'] ) {
			$this->add_render_attribute( 'wrapper', 'class', 'icon-inline-'. $settings['icon_inline'] );
		}

		?>
		<div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>
			<div class="inner">

				<div class="number-wrap">
			        <span class="number" data-decimals="<?php echo $settings['decimals']; ?>" data-to="<?php echo $settings['number']; ?>" data-speed= "<?php echo $settings['duration']['size']; ?>"></span><span><?php echo $settings['suffix']; ?></span>
		        </div>
		
		    </div>
		    <h4 class="title"><?php echo $settings['title']; ?></h4>
		    <div class="desc"><?php echo $settings['desc']; ?></div>

		    <?php if (isset($icon)) echo $icon; ?>
	    </div>
	    <?php
	}

	    protected function render_icon() {
        $html = '';
        $icon = $this->get_settings_for_display();
        switch ($icon['icon_type']) {
            case 'font':
                $html = sprintf('<div class="master-icon icon-font"><h1>%1$s</h1></div>',
                    $icon['icon_font']);
                break;

            case 'image':
                $html = sprintf('<div class="master-icon icon-image"><img alt="icon" src="%1$s" /></div>',
                    esc_url($icon['icon_image']['url']));
                break;

            case 'icon':
                ob_start(); 
                echo '<div class="master-icon">';
                Icons_Manager::render_icon( $icon['box_icon'], [ 'aria-hidden' => 'true' ] );
                echo '</div>';
                $html = ob_get_clean();
                break;
            
            default:
                # code...
                break;
        }

        return $html;
    }


    protected function content_template() {}
}

?>

