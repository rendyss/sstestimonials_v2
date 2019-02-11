<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 2/11/2019
 * Time: 2:10 AM
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function get_serialized_val( $objs, $key ) {
	$result = false;
	$temres = array();
	foreach ( $objs as $obj ) {
		if ( $obj['name'] == $key ) {
			$temres[] = $obj['value'];
		}
	}
	$countarr = count( $temres );
	if ( $countarr > 0 ) {
		$result = count( $temres ) > 1 ? $temres : $temres[0];
	}

	return $result;
}
