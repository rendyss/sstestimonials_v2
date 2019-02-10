<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 2/11/2019
 * Time: 6:44 AM
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>

<div class="parentform">
    <div class="ntf"></div>
    <form action="#" method="post">
		<?php wp_nonce_field( 'ss_val_nonce', $prefix . '_nonce', true, false ); ?>
        <p>Name<br/>
            <input type="text" name="<?php echo $prefix; ?>_name" pattern="[a-zA-Z0-9 ]+" value="" required/>
        </p>
        <p>Email<br/>
            <input type="email" name="<?php echo $prefix; ?>_email" value="" required/></p>
        <p>Phone Number<br/>
            <input type="text" name="<?php echo $prefix; ?>_phone" pattern="[0-9]+" value="" required/></p>
        <p>Testimonial<br/>
            <textarea rows="10" name="<?php echo $prefix; ?>_testi" required></textarea></p>
        <p>
            <button type="button" class="btnsend" name="<?php echo $prefix; ?>_submit">Submit</button>
        </p>
    </form>
</div>
