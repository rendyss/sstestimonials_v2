<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 2/11/2019
 * Time: 2:52 AM
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'SSTestimonialsV2_Widget' ) ) {
	class SSTestimonialsV2_Widget extends WP_Widget {
		protected $pluginName;
		protected $widgetName;

		public function __construct( $pluginName ) {
			$this->pluginName = $pluginName;
			$this->widgetName = $this->pluginName . "_widget";
			$widget_options   = array(
				'classname'   => $this->widgetName,
				'description' => 'This is a super simple widget to display random testimonials',
			);
			parent::__construct( $this->widgetName, 'Random Testimonial', $widget_options );

			$this->ss_register_widget();
		}

		function ss_register_widget() {
			add_action( 'widgets_init', array( $this, 'ss_widget_callback' ) );
		}

		function ss_widget_callback() {
			register_widget( $this );
		}

		public function widget( $args, $instance ) {
			$title = apply_filters( 'widget_title', $instance['title'] );

			echo $args['before_widget'] . $args['before_title'] . $title . $args['after_title'];
			$ssTestimonialsIO = new SSTestimonialsV2_IO();
			$random_testi     = $ssTestimonialsIO->get_random();
			if ( ! $random_testi->is_error ) {
				echo "<strong>" . $random_testi->items['name'] . "</strong> said:<br/>";
				echo "<blockquote>" . $random_testi->items['textt'] . "</blockquote>";
				echo "<small>On " . $random_testi->items['time'] . "</small>";
			} else {
				echo "<i>" . $random_testi->message . "</i>";
			}
			echo $args['after_widget'];
		}

		public function form( $instance ) {
			$title = ! empty( $instance['title'] ) ? $instance['title'] : ''; ?>
            <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
            <input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>"
                   name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>"/>
            </p><?php
		}

		public function update( $new_instance, $old_instance ) {
			$instance          = $old_instance;
			$instance['title'] = strip_tags( $new_instance['title'] );

			return $instance;
		}
	}
}