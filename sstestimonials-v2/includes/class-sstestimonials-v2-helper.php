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
	}
}
