<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 2/11/2019
 * Time: 1:44 AM
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'SSTestimonialsV2' ) ) {
	class SSTestimonialsV2 {
		protected $pluginName;

		function __construct() {
			$this->pluginName = "sstestimonialsv2";
			$this->load_helper();
			$this->load_admin_page();
			$this->load_shortcode();
			$this->load_widget();
		}

		function load_admin_page() {
			require plugin_dir_path( __FILE__ ) . 'class-sstestimonials-v2-admin.php';
			require plugin_dir_path( __FILE__ ) . 'class-sstestimonials-v2-admin-table.php';
			new SSTestimonialsV2_Admin( $this->pluginName );
		}

		function load_shortcode() {
			require plugin_dir_path( __FILE__ ) . 'class-sstestimonials-v2-shortcode.php';
			new SSTestimonialsV2_Shortcode( $this->pluginName );
		}

		function load_widget() {
			require plugin_dir_path( __FILE__ ) . 'class-sstestimonials-v2-widget.php';
			new SSTestimonialsV2_Widget( $this->pluginName );
		}

		function load_helper() {
			require plugin_dir_path( __FILE__ ) . 'class-sstestimonials-v2-helper.php';
			require plugin_dir_path( __FILE__ ) . 'class-sstestimonials-v2-io.php';
		}
	}
}