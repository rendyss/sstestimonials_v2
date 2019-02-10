<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 2/8/2019
 * Time: 9:41 AM
 * Credit: https://www.daggerhart.com/simple-php-template-class/
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'SSTestimonialsV2_Template' ) ) {
	class SSTestimonialsV2_Template {
		/**
		 * Location of expected template
		 *
		 * @var string
		 */
		public $folder;

		/**
		 * Template constructor.
		 *
		 * @param $folder
		 */
		function __construct( $folder = null ) {
			if ( $folder ) {
				$this->set_folder( $folder );
			}
		}

		/**
		 * Simple method for updating the base folder where templates are located.
		 *
		 * @param $folder
		 */
		function set_folder( $folder ) {
			// normalize the internal folder value by removing any final slashes
			$this->folder = $this->folder = rtrim( $folder, '/' );
		}

		/**
		 * Find and attempt to render a template with variables
		 *
		 * @param $suggestions
		 * @param $variables
		 *
		 * @return string
		 */
		function render( $suggestions, $variables = array() ) {
			$template = $this->find_template( $suggestions );
			$output   = '';
			if ( $template ) {
				$output = $this->render_template( $template, $variables );
			}

			return $output;
		}

		/**
		 * Look for the first template suggestion
		 *
		 * @param $suggestions
		 *
		 * @return bool|string
		 */
		function find_template( $suggestions ) {
			if ( ! is_array( $suggestions ) ) {
				$suggestions = array( $suggestions );
			}
			$suggestions = array_reverse( $suggestions );
			$found       = false;
			foreach ( $suggestions as $suggestion ) {
				$file = "{$this->folder}/{$suggestion}.php";
				if ( file_exists( $file ) ) {
					$found = $file;
					break;
				}
			}

			return $found;
		}

		/**
		 * Execute the template by extracting the variables into scope, and including
		 * the template file.
		 *
		 * @internal param $template
		 * @internal param $variables
		 *
		 * @return string
		 */
		function render_template( /*$template, $variables*/ ) {
			ob_start();
			foreach ( func_get_args()[1] as $key => $value ) {
				${$key} = $value;
			}
			include func_get_args()[0];

			return ob_get_clean();
		}
	}
}