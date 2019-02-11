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
		protected $pluginVersion;

		public static function Instance() {
			static $instance = null;
			if ( $instance === null ) {
				$instance = new SSTestimonialsV2();
			}

			return $instance;
		}

		private function __construct() {
			$this->pluginName    = "sstestimonialsv2";
			$this->pluginVersion = "1.0.0";
			$this->load_helper();
			$this->load_admin_page();
			$this->load_shortcode();
			$this->load_widget();
			$this->load_ajax();
			$this->load_front_end_assets();
		}

		function front_end_assets_callback() {
			if ( ! is_admin() ) {
				wp_enqueue_style( $this->pluginName . ".css", plugin_dir_url( __DIR__ ) . 'assets/css/' . $this->pluginName . '.css', array(), $this->pluginVersion );
				wp_enqueue_script( $this->pluginName . ".js", plugin_dir_url( __DIR__ ) . 'assets/js/' . $this->pluginName . '.js', array( 'jquery' ), $this->pluginVersion, true );
				wp_localize_script( $this->pluginName . ".js", 'my_ajax_object', array(
					'ajax_url'    => admin_url( 'admin-ajax.php' ),
					'plugin_name' => $this->pluginName
				) );
			}
		}

		function load_front_end_assets() {
			add_action( 'wp_enqueue_scripts', array( $this, 'front_end_assets_callback' ) );
		}

		function load_ajax() {
			require plugin_dir_path( __FILE__ ) . 'class-sstestimonials-v2-ajax.php';
			new SSTestimonialsV2_Ajax( $this->pluginName );
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
			require plugin_dir_path( __FILE__ ) . 'class-sstestimonials-v2-template.php';
		}
	}
}