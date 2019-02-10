<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 2/11/2019
 * Time: 2:10 AM
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'SSTestimonialsV2_Helper' ) ) {
	class SSTestimonialsV2_Helper {
		public $is_error;
		public $message;
		public $items;
		public $callback;
		public $other;

		function __construct() {
			$this->is_error = true;
			$this->message  = '';
			$this->items    = array();
			$this->callback = '';
			$this->other    = array();
		}

		function get_serialized_val( $objs, $key ) {
			$result = false;
			$temres = array();
			foreach ( $objs as $obj ) {
				if ( $obj['name'] == $key ) {
					$temres[] = $obj['value'];
				}
			}
			$countarr = count( $temres );
			if ( $countarr > 0 ) {
				$result = count( $temres ) > 1 ? $temres : $temres[0];
			}

			return $result;
		}
	}
}
