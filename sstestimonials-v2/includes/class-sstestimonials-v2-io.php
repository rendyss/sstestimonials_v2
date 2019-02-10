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

		public $tId;
		public $blogId;
		public $tName;
		public $tEmail;
		public $tPhone;
		public $tContent;
		public $tTime;

		function __construct() {
			global $wpdb;
			$this->tableName = $wpdb->prefix . 'sstestimonials';
		}

		function create_table() {
			$result = new SSTestimonialsV2_Helper();
			global $wpdb;
			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
			$charset_collate = $wpdb->get_charset_collate();
			$sql             = "CREATE TABLE " . $this->tableName . " (id mediumint(9) NOT NULL AUTO_INCREMENT, blog_id mediumint(9) NOT NULL, time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,name tinytext NOT NULL,text text NOT NULL,phone tinytext NOT NULL,email tinytext NOT NULL,PRIMARY KEY  (id)) $charset_collate;";
			dbDelta( $sql );

			return $result;
		}

		//function to insert a new testimonial
		function insert( $name, $email, $phone, $content ) {
			global $wpdb;
			global $blog_id;

			$result = new SSTestimonialsV2_Helper();
			$insert = $wpdb->insert( $this->tableName, array(
				'name'    => $name,
				'blog_id' => $blog_id,
				'time'    => current_time( 'mysql' ),
				'email'   => $email,
				'phone'   => $phone,
				'text'    => $content
			) );
			if ( ! $insert ) {
				$result->message = "Failed to submit testimonial";
			} else {
				$result->message  = "Testimonial submitted successfully";
				$result->is_error = false;
			}

			return $result;
		}

		//function to display random testimonial
		function get_random() {
			global $wpdb;
			global $blog_id;

			$random = $wpdb->get_row( 'SELECT * from ' . $this->tableName . ' WHERE blog_id = ' . $blog_id . ' ORDER BY RAND()', ARRAY_A );
			if ( $random ) {
				$this->tId      = $random['id'];
				$this->blogId   = $random['blog_id'];
				$this->tName    = $random['name'];
				$this->tEmail   = $random['email'];
				$this->tPhone   = $random['phone'];
				$this->tContent = $random['text'];
				$this->tTime    = $random['time'];
			}

			return $this;
		}

		//function to delete testimonial
		function delete( $testimonial_id ) {
			global $wpdb;

			//instance new helper class
			$result = new SSTestimonialsV2_Helper();
			//check if `$testimonial_id` is provided
			if ( $testimonial_id ) {
				//check if `$testimonial_id` belong to current blog_id
				$is_belong_to_me = $this->is_mine( $testimonial_id );
				if ( $is_belong_to_me ) {
					//it's belong to the current blog_id, let's delete it
					$delete = $wpdb->delete( $this->tableName, array( 'id' => $testimonial_id ) );
					//check if deletion is success
					if ( $delete ) {
						$result->is_error = false;
					}
				} else {
					$result->message = "Invalid id";
				}
			} else {
				$result->message = "Please provide valid id";
			}

			return $result;
		}

		//function to display testimonials
		function display() {
			$result = new SSTestimonialsV2_Helper();
			global $wpdb;

			$allTestimonials = $wpdb->get_results( 'SELECT * from ' . $this->tableName, ARRAY_A );
			if ( $allTestimonials ) {
				$result->items    = $allTestimonials;
				$result->is_error = false;
			}

			return $result;
		}

		//function to check wheter the testimonial belongs to current blog_id or not
		function is_mine( $testimonial_id ) {
			$result = false;
			global $blog_id;
			global $wpdb;

			$row = $wpdb->get_row( 'select * from' . $this->tableName . ' where id = ' . $testimonial_id );
			if ( $row ) {
				if ( $row['blog_id'] == $blog_id ) {
					$result = true;
				}
			}

			return $result;
		}
	}
}