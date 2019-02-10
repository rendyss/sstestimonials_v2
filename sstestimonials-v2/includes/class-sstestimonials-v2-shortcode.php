<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 2/11/2019
 * Time: 2:44 AM
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'SSTestimonialsV2_Shortcode' ) ) {
	class SSTestimonialsV2_Shortcode {
		protected $pluginName;

		function __construct( $pluginName ) {
			$this->pluginName = $pluginName;
			$this->ss_register_shortcode();
		}

		function ss_register_shortcode() {
			add_shortcode( 'sstestimonials', array( $this, 'ss_shortcode_callback' ) );
		}

		function ss_shortcode_callback() {
			$htmlresult = '<div class="parentform">';
			$htmlresult .= '<div class="ntf"></div>';
			$htmlresult .= '<form action="' . esc_url( admin_url( 'admin-post.php' ) ) . '" method="post">';
			$htmlresult .= wp_nonce_field( 'ss_val_nonce', $this->pluginName . '_nonce', true, false );
			$htmlresult .= '<p>Name<br/><input type="text" name="' . $this->pluginName . '_name" pattern="[a-zA-Z0-9 ]+" value="" required/></p>';
			$htmlresult .= '<p>Email<br/>';
			$htmlresult .= '<input type="email" name="' . $this->pluginName . '_email" value="" required/></p>';
			$htmlresult .= '<p>Phone Number<br/>';
			$htmlresult .= '<input type="text" name="' . $this->pluginName . '_phone" pattern="[0-9]+" value="" required/></p>';
			$htmlresult .= '<p>Testimonial<br/><textarea rows="10" name="' . $this->pluginName . '_testi" required></textarea></p>';
			$htmlresult .= '<p><button type="button" class="btnsend" name="' . $this->pluginName . '_submit">Submit</button></p>';
			$htmlresult .= '</form>';
			$htmlresult .= '</div>';

			return $htmlresult;
		}
	}
}