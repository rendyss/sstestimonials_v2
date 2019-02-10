<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 2/11/2019
 * Time: 3:19 AM
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'SSTestimonialsV2_Admin' ) ) {
	class SSTestimonialsV2_Admin {
		protected $pluginName;

		function __construct( $pluginName ) {
			$this->pluginName = $pluginName;
			$this->ss_register_admin_page();
		}

		function ss_register_admin_page() {
			add_action( 'admin_menu', array( $this, 'ss_admin_page_callback' ) );
		}

		function ss_admin_page_callback() {
			add_menu_page(
				'Testimonials',
				'Testimonials',
				'edit_posts',
				$this->pluginName,
				array( $this, 'ss_admin_page_render' ),
				'dashicons-format-chat',
				6 );
		}

		function ss_admin_page_render() {
			$myListTable = new SSTestimonialsV2_AdminTable();
			?>
            <div class="wrap">
                <h2>Testimonials</h2>
				<?php
				$myListTable->prepare_items();
				$myListTable->display();
				?>
            </div>
			<?php
		}
	}
}