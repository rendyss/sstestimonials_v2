<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 2/11/2019
 * Time: 3:07 AM
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'SSTestimonialsV2_AdminTable' ) ) {
	//Check if `WP_List_Table` is exist before requiring wp-list-table class
	if ( ! class_exists( 'WP_List_Table' ) ) {
		require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
	}

	class SSTestimonialsV2_AdminTable extends WP_List_Table {

		//Prepare its columns
		function get_columns() {
			$columns = array(
				'cb'    => '<input type = "checkbox" />',
				'name'  => __( 'Name' ),
				'email' => __( 'Email' ),
				'phone' => __( 'Phone' ),
				'text'  => __( 'Testimonial' ),
				'time'  => __( 'Date' ),
			);

			return $columns;
		}

		//Function to prepare the items from database;
		function prepare_items() {
			$ssIO                  = new SSTestimonialsV2_IO();
			$show_testimonials     = $ssIO->display();
			$columns               = $this->get_columns();
			$hidden                = array();
			$sortable              = array();
			$this->_column_headers = array( $columns, $hidden, $sortable );
			$this->items           = $show_testimonials;
			$per_page              = 10;
			$current_page          = $this->get_pagenum();
			$total_items           = count( $this->items );

			//Slice items for paging
			$new_data = array_slice( $this->items, ( ( $current_page - 1 ) * $per_page ), $per_page );

			$this->set_pagination_args( array(
				'total_items' => $total_items,
				'per_page'    => $per_page
			) );
			$this->items = $new_data;
		}

		//Assign item value for each column
		function column_default( $item, $column_name ) {
			switch ( $column_name ) {
				case 'name':
					return "<strong>" . $item[ $column_name ] . "</strong>";
				case 'email':
					return "<a href='mailto:" . $item[ $column_name ] . "'>" . $item[ $column_name ] . "</a>";
				case 'phone':
					return "<a href='tel:" . $item[ $column_name ] . "'>" . $item[ $column_name ] . "</a>";
				case 'text':
					return "<p>" . $item[ $column_name ] . "</p>";
				case 'time':
					return $item[ $column_name ];
				default:
					return $item[ $column_name ];
			}
		}

		function column_name( $item ) {
			$actions = array(
				'delete' => sprintf( "<a href = \"?action=%s&id=%s\"> Delete</a > ", 'destroy', $item['id'] ),
			);

			return sprintf( ' %1$s %2$s', $item['name'], $this->row_actions( $actions ) );
		}

		function column_cb( $item ) {
			return sprintf(
				'<input type = "checkbox" name = "id[]" value = "%s" />', $item['id']
			);
		}

		function get_bulk_actions() {
			$actions = array(
				'delete' => 'Delete'
			);

			return $actions;
		}

	}
}