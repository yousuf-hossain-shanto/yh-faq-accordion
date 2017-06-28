<?php
	global $pagenow;
	add_action( 'plugins_loaded', 'yf_load_textdomain' );
	add_action( 'wp_enqueue_scripts', 'yf_register_script' );
	if (is_customize_preview()) {
		add_action( 'admin_enqueue_scripts', 'yf_register_color_picker' );
	}
	if ($pagenow == 'widgets.php') {
		add_action( 'admin_enqueue_scripts', 'yf_register_color_picker' );
	}
	add_action( 'init', 'yf_register_post' );
	add_action( 'init', 'yf_register_category' );
	add_action( 'add_meta_boxes', 'yf_meta_box' );
	add_action( 'save_post', 'yf_update_meta' );
	add_shortcode( 'yf_accordion', 'yf_shortcode' );
	add_action( 'widgets_init', 'reg_yfwidget' );
?>