<?php
add_action('acf/init', function (){
	$data = [
		'name' => 'homepage-slider',
		'title' => __('Frontpage slider', 'ttfc'),
		'description' => __('Slider for homepage'),
		'category' => 'embed',
		'icon' => 'book-alt',
		'keywords' => ['Slider', 'slider', 'слайдер', 'Слайдер', 'Слайдер', 'слайдер'],
		'post_types' => ['page'],
		'mode' => 'edit',
		'align' => 'full',
		'render_template' => getGbSection('front-page-slider'),
		'enqueue_assets' => function(){
			wp_enqueue_style( 'slider-frontpage', get_stylesheet_directory() .'/inc/acf-gutenberg-blocks/front-page-slider/style.css' );
			wp_enqueue_style( 'slick-frontpage', get_stylesheet_directory() .'/inc/acf-gutenberg-blocks/front-page-slider/slick/slick.css' );
			wp_enqueue_style( 'slick-theme-frontpage', get_stylesheet_directory() .'/inc/acf-gutenberg-blocks/front-page-slider/slick/slick-theme.css' );
			wp_enqueue_script( 'slick-frontpage', get_stylesheet_directory() . '/inc/acf-gutenberg-blocks/front-page-slider/slick/slick.min.js', ['jquery'], '', true );
			wp_enqueue_script( 'slider-frontpage', get_stylesheet_directory() . '/inc/acf-gutenberg-blocks/front-page-slider/scripts.js', ['jquery', 'slick-frontpage'], '', true );
		},
		'supports' => [
			'align' => false,
			'multiple' => true,
			'mode' => true
		]
	];
	acf_register_block_type($data);
});