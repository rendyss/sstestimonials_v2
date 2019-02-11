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
			$this->ss_register_destroy_action();
		}

		function ss_register_destroy_action() {
			add_action( 'admin_action_destroy', array( $this, 'ss_destroy_action_callback' ) );
		}

		function ss_destroy_action_callback() {
			if ( ! ( isset( $_GET['id'] ) || isset( $_POST['id'] ) || ( isset( $_REQUEST['action'] ) && 'destroy' == $_REQUEST['action'] ) ) ) {
				wp_die( 'No testimonial to delete has been supplied!' );
			}
			$id = ( isset( $_GET['id'] ) ? absint( $_GET['id'] ) : absint( $_POST['id'] ) );

			//If `$id` is provided, then delete it
			if ( isset( $id ) && $id != null ) {
				$ssIO   = new SSTestimonialsV2_IO();
				$delete = $ssIO->delete( $id );
				if ( $delete ) {
					wp_redirect( admin_url( 'admin.php?page=' . $this->pluginName ) );
					exit;
				} else {
					wp_die( "Failed to delete testimonial" );
				}
			} else {
				wp_die( 'Failed to delete testimonial' );
			}
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