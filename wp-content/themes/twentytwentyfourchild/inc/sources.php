<?php
// правильный способ подключить стили и скрипты
add_action( 'wp_enqueue_scripts', 'sourcesLoader' );
// add_action('wp_print_styles', 'theme_name_scripts'); // можно использовать этот хук он более поздний
function sourcesLoader() {
	wp_enqueue_style( 'main', get_stylesheet_directory_uri().'/main.css' );
}