<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 2/11/2019
 * Time: 3:50 AM
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'SSTestimonialsV2_Ajax' ) ) {
	class SSTestimonialsV2_Ajax {
		protected $pluginName;

		public $success = false;
		public $message;

		function __construct( $pluginName ) {
			$this->pluginName = $pluginName;
			$this->ss_register_ajax();
		}

		function ss_register_ajax() {
			add_action( 'wp_ajax_' . $this->pluginName . '_save', array( $this, 'ss_save_callback' ) );
			add_action( 'wp_ajax_nopriv_' . $this->pluginName . '_save', array( $this, 'ss_save_callback' ) );
		}

		//function to save testimonial through ajax
		function ss_save_callback() {
			//Assign posted data into variables
			$data   = $_POST['data'];
			$sdata  = maybe_unserialize( $data );
			$vnonce = get_serialized_val( $sdata, $this->pluginName . '_nonce' );
			$vname  = sanitize_text_field( get_serialized_val( $sdata, $this->pluginName . '_name' ) );
			$vphone = sanitize_text_field( get_serialized_val( $sdata, $this->pluginName . '_phone' ) );
			$vemail = sanitize_email( get_serialized_val( $sdata, $this->pluginName . '_email' ) );
			$vtesti = sanitize_textarea_field( get_serialized_val( $sdata, $this->pluginName . '_testi' ) );

			//Validate nonce
			if ( wp_verify_nonce( $vnonce, 'ss_val_nonce' ) ) {
				if ( $vname && $vphone && $vemail && $vtesti ) {
					$ssIO          = new SSTestimonialsV2_IO();
					$insert        = $ssIO->insert( array(
						'name'  => $vname,
						'email' => $vemail,
						'phone' => $vphone,
						'text'  => $vtesti
					) );
					$this->success = $insert;
				} else {
					$this->message = "All fields are required";
				}
			} else {
				$this->message = "Failed to submit testimonial";
			}
			wp_send_json( $this );
		}

	}
}