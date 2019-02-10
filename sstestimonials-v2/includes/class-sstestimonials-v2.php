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
			$this->pluginName    = "sstestimonialsv2";
		}
	}
}