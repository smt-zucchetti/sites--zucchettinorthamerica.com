<?php
/**
 * Prevent Gravity Forms from jumping on submit.
 */
add_filter( 'gform_confirmation_anchor', '__return_false' );
