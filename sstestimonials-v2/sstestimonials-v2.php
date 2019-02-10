<?php
/*
Plugin Name: SS-WT3 (Testimonials)
Description: Super simple plugins to display testimonials
Version: 1.0.0
Author: Rendi Dwi Pristianto
*/

//Trigger when the plugins is being activated
function activate_sstestimonialsv2() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-sstestimonials-v2-activator.php';
	SSTestimonialsV2_Activator::activate();
}

//Trigger when the plugins is being deactivated
function deactivate_sstestimonialsv2() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-sstestimonials-v2-deactivator.php';
	SSTestimonialsV2_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_sstestimonialsv2' );
register_deactivation_hook( __FILE__, 'deactivate_sstestimonialsv2' );

//Include the main functions
require plugin_dir_path( __FILE__ ) . 'includes/class-sstestimonials-v2.php';

//Instance the main class
$ssTestimonialsV2 = SSTestimonialsV2::Instance();