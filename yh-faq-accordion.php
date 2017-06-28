<?php
/*
Plugin Name: YH FAQ ACCORDION
Plugin URI: http://yhaccordion.ml/
Description: YH FAQ ACCORDION - Premium responsive FAQ Accordion Plugin For Wordpress
Author: YH Shanto
Version: 1.0.0
Author URI: http://yhshanto.com
*/
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'YF_PLUGIN_PATH', plugin_dir_path(__FILE__) );
define( 'YF_PLUGIN_FILE_PATH', __FILE__ );
define( 'YF_PLUGIN_URL', str_replace('index.php','',plugins_url( 'index.php', __FILE__ )));
	
include_once YF_PLUGIN_PATH . 'include/loader.yh-faq-accordion.php' ;
?>
