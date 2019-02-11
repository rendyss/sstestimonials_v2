<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 2/11/2019
 * Time: 1:45 AM
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'SSTestimonialsV2_Activator' ) ) {
	class SSTestimonialsV2_Activator {

		static function activate() {

			//instance class IO
			$ssTestimonialsIO = new SSTestimonialsV2_IO();
			$create_table     = $ssTestimonialsIO->create_table();
			//insert dummy testimonials for initial installation
			$insert = $ssTestimonialsIO->insert( array(
					'name'  => 'Rendy',
					'email' => 'rendi@softwareseni.com',
					'phone' => '082219186349',
					'text'  => 'Hi there, this is just a dummy testimonial, have fun :)'
				)
			);
		}
	}
}