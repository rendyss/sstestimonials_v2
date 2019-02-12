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
		}

		public function widget( $args, $instance ) {
			$title = apply_filters( 'widget_title', $instance['title'] );

			echo $args['before_widget'] . $args['before_title'] . $title . $args['after_title'];
			$ssTestimonialsIO       = new SSTestimonialsV2_IO();
			$ssTestimonialsTemplate = new SSTestimonialsV2_Template( plugin_dir_path( dirname( __FILE__ ) ) . 'templates' );
			$random_testi           = $ssTestimonialsIO->get_random();
			if ( $random_testi ) {
				echo $ssTestimonialsTemplate->render( 'sstestimonials-v2-front-layout', array(
					'name' => $random_testi['name'],
					'text' => $random_testi['text'],
					'time' => $random_testi['time']
				) );
			} else {
				echo "<i>Data not found</i>";
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