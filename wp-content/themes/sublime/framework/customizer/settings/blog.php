<?php
/**
 * Blog setting for Customizer
 *
 * @package sublime
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Blog Posts General
$this->sections['sublime_blog_post'] = array(
	'title' => esc_html__( 'General', 'sublime' ),
	'panel' => 'sublime_blog',
	'settings' => array(
		array(
			'id' => 'blog_featured_title',
			'default' => esc_html__( 'Our Blog', 'sublime' ),
			'control' => array(
				'label' => esc_html__( 'Blog Featured Title', 'sublime' ),
				'type' => 'text',
			),
		),
		array(
			'id' => 'blog_entry_content_background',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Entry Content Background Color', 'sublime' ),
			),
			'inline_css' => array(
				'target' => '.post-content-wrap',
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'blog_entry_content_padding',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Entry Content Padding', 'sublime' ),
				'description' => esc_html__( 'Top Right Bottom Left.', 'sublime' ),
			),
			'inline_css' => array(
				'target' => '.post.hentry',
				'alter' => 'padding',
			),
		),
		array(
			'id' => 'blog_entry_bottom_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Entry Bottom Margin', 'sublime' ),
				'description' => esc_html__( 'Example: 30px.', 'sublime' ),
			),
			'inline_css' => array(
				'target' => '.post.hentry',
				'alter' => 'margin-top',
			),
		),
		array(
			'id' => 'blog_entry_border_width',
			'transport' => 'postMessage',
			'control' => array (
				'type' => 'text',
				'label' => esc_html__( 'Entry Border Width', 'sublime' ),
				'description' => esc_html__( 'Top Right Bottom Left. Example: 0px 2px 0px 0px', 'sublime' ),
			),
			'inline_css' => array(
				'target' => '.post.hentry',
				'alter' => 'border-width',
			),
		),
		array(
			'id' => 'blog_entry_border_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Entry Border Color', 'sublime' ),
			),
			'inline_css' => array(
				'target' => '.post.hentry',
				'alter' => 'border-color',
			),
		),
		array(
			'id' => 'blog_entry_composer',
			'default' => 'title,meta,excerpt_content,readmore',
			'control' => array(
				'label' => esc_html__( 'Entry Content Elements', 'sublime' ),
				'type' => 'sublime-sortable',
				'object' => 'Sublime_Customize_Control_Sorter',
				'choices' => array(	
					'title'           => esc_html__( 'Title', 'sublime' ),
					'meta'            => esc_html__( 'Meta', 'sublime' ),
					'excerpt_content' => esc_html__( 'Excerpt', 'sublime' ),
					'readmore'        => esc_html__( 'Read More', 'sublime' ),

				),
				'desc' => esc_html__( 'Drag and drop elements to re-order.', 'sublime' ),
			),
		),
	),
);

// Blog Posts Media
$this->sections['sublime_blog_post_media'] = array(
	'title' => esc_html__( 'Blog Post - Media', 'sublime' ),
	'panel' => 'sublime_blog',
	'settings' => array(
		array(
			'id' => 'blog_media_margin_bottom',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Bottom Margin', 'sublime' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-media',
				'alter' => 'margin-bottom',
			),
		),
		array(
			'id' => 'blog_custom_date',
			'default' => false,
			'control' => array(
				'label' => esc_html__( 'Custom Date?', 'sublime' ),
				'type' => 'checkbox',
			),
		),
	),
);

// Blog Posts Title
$this->sections['sublime_blog_post_title'] = array(
	'title' => esc_html__( 'Blog Post - Title', 'sublime' ),
	'panel' => 'sublime_blog',
	'settings' => array(
		array(
			'id' => 'blog_title_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Margin', 'sublime' ),
				'description' => esc_html__( 'Top Right Bottom Left.', 'sublime' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-title',
				'alter' => 'margin',
			),
		),
		array(
			'id' => 'blog_title_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Color', 'sublime' ),
			),
			'inline_css' => array(
				'target' => array(
					'.hentry .post-title a',
				),
				'alter' => 'color',
			),
		),
		array(
			'id' => 'blog_title_color_hover',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Color Hover', 'sublime' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-title a:hover',
				'alter' => 'color',
			),
		),
	),
);

// Blog Posts Meta
$this->sections['sublime_blog_post_meta'] = array(
	'title' => esc_html__( 'Blog Post - Meta', 'sublime' ),
	'panel' => 'sublime_blog',
	'settings' => array(
		// Blog Custom Meta
		array(
			'id' => 'blog_custom_meta',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Meta Style', 'sublime' ),
				'type' => 'select',
				'choices' => array(
					'style-1' => esc_html__( 'Basic', 'sublime' ),
					'style-2' => esc_html__( 'Modern', 'sublime' ),
				),
			),
		),
		array(
			'id' => 'blog_before_author',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Text Before Author', 'sublime' ),
				'type' => 'text',
			),
		),
		array(
			'id' => 'blog_entry_meta_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Meta Margin', 'sublime' ),
				'description' => esc_html__( 'Top Right Bottom Left. Example: 0 0 20px 0.', 'sublime' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-meta',
				'alter' => 'margin',
			),
		),
		array(
			'id'  => 'blog_entry_meta_items',
			'default' => array( 'date', 'comments' ),
			'control' => array(
				'label' => esc_html__( 'Meta Items', 'sublime' ),
				'desc' => esc_html__( 'Click and drag and drop elements to re-order them.', 'sublime' ),
				'type' => 'sublime-sortable',
				'object' => 'Sublime_Customize_Control_Sorter',
				'choices' => array(
					'date'       => esc_html__( 'Date', 'sublime' ),
					'comments' => esc_html__( 'Comments', 'sublime' ),
					'author'     => esc_html__( 'Author', 'sublime' ),
					'categories' => esc_html__( 'Categories', 'sublime' ),
				),
			),
		),
		array(
			'id' => 'heading_blog_entry_meta_item',
			'control' => array(
				'type' => 'sublime-heading',
				'label' => esc_html__( 'Item Meta', 'sublime' ),
			),
		),
		array(
			'id' => 'blog_entry_meta_item_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Text Color', 'sublime' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-meta .item',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'blog_entry_meta_item_link_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Link Color', 'sublime' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-meta .item a',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'blog_entry_meta_item_link_color_hover',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Link Color Hover', 'sublime' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-meta .item a:hover',
				'alter' => 'color',
			),
		),
	),
);

// Blog Posts Excerpt
$this->sections['sublime_blog_post_excerpt'] = array(
	'title' => esc_html__( 'Blog Post - Excerpt', 'sublime' ),
	'panel' => 'sublime_blog',
	'settings' => array(
		array(
			'id' => 'blog_content_style',
			'default' => 'style-1',
			'control' => array(
				'label' => esc_html__( 'Content Style', 'sublime' ),
				'type' => 'select',
				'choices' => array(
					'style-1' => esc_html__( 'Normal', 'sublime' ),
					'style-2' => esc_html__( 'Excerpt', 'sublime' ),
				),
			),
		),
		array(
			'id' => 'blog_excerpt_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Margin', 'sublime' ),
				'description' => esc_html__( 'Top Right Bottom Left. Example: 0 0 30px 0.', 'sublime' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-excerpt',
				'alter' => 'margin',
			),
		),
		array(
			'id' => 'blog_excerpt_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Color', 'sublime' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-excerpt',
				'alter' => 'color',
			),
		),
	),
);

// Blog Posts Read More
$this->sections['sublime_blog_post_read_more'] = array(
	'title' => esc_html__( 'Blog Post - Read More', 'sublime' ),
	'panel' => 'sublime_blog',
	'settings' => array(
		array(
			'id' => 'blog_entry_button_read_more_text',
			'default' => esc_html__( 'Read More', 'sublime' ),
			'control' => array(
				'label' => esc_html__( 'Button Text', 'sublime' ),
				'type' => 'text',
			),
		),
	),
);

