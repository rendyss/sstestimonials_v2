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

			global $wpdb;
			global $blog_id;
			$table_name      = $wpdb->prefix . 'testimonials';
			$charset_collate = $wpdb->get_charset_collate();
			$sql             = "CREATE TABLE $table_name (id mediumint(9) NOT NULL AUTO_INCREMENT, blog_id mediumint(9) NOT NULL, time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,name tinytext NOT NULL,text text NOT NULL,phone tinytext NOT NULL,email tinytext NOT NULL,PRIMARY KEY  (id)) $charset_collate;";
			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
			dbDelta( $sql );
			$wpdb->insert(
				$table_name,
				array(
					'name'    => 'Rendy',
					'blog_id' => $blog_id,
					'time'    => current_time( 'mysql' ),
					'text'    => 'Hi there, this is just a dummy text, thank you',
					'phone'   => '082219186349',
					'email'   => 'rendy.de.p@gmail.com',
				)
			);

		}
	}
}