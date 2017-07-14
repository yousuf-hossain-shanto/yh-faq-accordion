<?php
	function yf_register_script(){
		wp_register_script( 'yf-js', YF_PLUGIN_URL . 'public/js/yf-accordion.js', array( 'jquery' ), null, true );
		wp_register_style( 'yf-fa', YF_PLUGIN_URL . 'public/css/font-awesome.min.css' );
		wp_register_style( 'yf-css', YF_PLUGIN_URL . 'public/css/yf-accordion.css' );
		wp_enqueue_style( 'yf-fa' );
		wp_enqueue_style( 'yf-css' );
		wp_enqueue_script( 'yf-js' );
	}
	function yf_register_color_picker(){
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'wp-color-picker' );
	}
?>