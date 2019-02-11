<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 2/11/2019
 * Time: 8:49 AM
 */

if(!defined('ABSPATH')){
	exit;
}; ?>

<strong><?php echo $name; ?></strong> said:<br/>
<blockquote><?php echo $text; ?></blockquote>
<small>On <?php echo $time; ?></small>