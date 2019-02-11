<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 2/11/2019
 * Time: 2:06 AM
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'SSTestimonialsV2_IO' ) ) {
	class SSTestimonialsV2_IO {
		protected $tableName;

		function __construct() {
			global $wpdb;
			$this->tableName = $wpdb->base_prefix . 'sstestimonials';
		}

		function create_table() {
			global $wpdb;
			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
			$charset_collate = $wpdb->get_charset_collate();
			$sql             = "CREATE TABLE " . $this->tableName . " (id mediumint(9) NOT NULL AUTO_INCREMENT, blog_id mediumint(9) NOT NULL, time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,name tinytext NOT NULL,text text NOT NULL,phone tinytext NOT NULL,email tinytext NOT NULL,PRIMARY KEY  (id)) $charset_collate;";
			$create_table    = dbDelta( $sql );

			return is_wp_error( $create_table ) ? false : true;
		}

		//function to insert a new testimonial
		function insert( $args ) {
			global $wpdb;
			global $blog_id;

			$defaults   = array(
				'time'    => current_time( 'mysql', true ),
				'blog_id' => $blog_id
			);
			$valid_args = wp_parse_args( $args, $defaults );

			return $wpdb->insert( $this->tableName, $valid_args );
		}

		//function to display random testimonial
		function get_random() {
			global $wpdb;
			global $blog_id;
			$result = array();

			$random = $wpdb->get_row( 'SELECT * from ' . $this->tableName . ' WHERE blog_id = ' . $blog_id . ' ORDER BY RAND() LIMIT 1', ARRAY_A );
			if ( $random ) {
				$result = array(
					'id'      => $random['id'],
					'blog_id' => $random['blog_id'],
					'time'    => $random['time'],
					'name'    => $random['name'],
					'text'    => $random['text'],
					'phone'   => $random['phone'],
					'email'   => $random['email']
				);
			}

			return $result;
		}

		//function to delete testimonial
		function delete( $testimonial_id ) {
			global $wpdb;
			global $blog_id;

			return $wpdb->delete( $this->tableName, array( 'id' => $testimonial_id, 'blog_id' => $blog_id ) );
		}

		//function to display testimonials
		function display() {
			global $wpdb;
			global $blog_id;

			return $wpdb->get_results( 'SELECT * from ' . $this->tableName . ' WHERE blog_id = ' . $blog_id, ARRAY_A );
		}
	}
}