<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 2/11/2019
 * Time: 2:44 AM
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'SSTestimonialsV2_Shortcode' ) ) {
	class SSTestimonialsV2_Shortcode {
		protected $pluginName;

		function __construct( $pluginName ) {
			$this->pluginName = $pluginName;
			$this->ss_register_shortcode();
		}

		function ss_register_shortcode() {
			add_shortcode( 'sstestimonials', array( $this, 'ss_shortcode_callback' ) );
		}

		function ss_shortcode_callback() {
			$ssTestimonialsTemplate = new SSTestimonialsV2_Template( plugin_dir_path( dirname( __FILE__ ) ) . 'templates' );

			return $ssTestimonialsTemplate->render( 'sstestimonials-v2-front-form', array(
				'prefix' => $this->pluginName
			) );
		}
	}
}