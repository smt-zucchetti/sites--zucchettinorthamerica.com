<?php
/**
 * Basic custom styles for WP login page
 */
function ih_login_logo() {


	$nectar_options = get_nectar_theme_options();

	// display options for debugging
	// echo '<pre>';
	// print_r($nectar_options);
	// echo '</pre>';
	// die();
	
?>
	<style type="text/css">
		body.login {
			background: linear-gradient(45deg,<?php echo $nectar_options['extra-color-gradient']['from'];?> 0%,<?php echo $nectar_options['extra-color-gradient']['to'];?> 100%);
		}
		body.login h1 a {
			width: 100%;
			background-image: url('<?php echo nectar_options_img( $nectar_options['header-starting-logo'] );?>');
			background-size: contain;
			background-position: center center;
			outline: none;
			box-shadow: none !important;
			-webkit-box-shadow: none !important;
		}
		body.login #backtoblog a, body.login #nav a {
			color: #fff !important;
			outline: none !important;
			box-shadow: none !important;
			-webkit-box-shadow: none !important;
			font-size: 15px;
		}
		body.login input[type=text] {
			font-size: 16px;
			padding: 10px;
		}
		body.login .button-primary {
			outline: none !important;
			box-shadow: none !important;
			-webkit-box-shadow: none !important;
			background-color: <?php echo $nectar_options['extra-color-2'];?>!important;
			text-shadow: none;
			border: none;
			font-size: 15px !important;
			padding: 0 14px !important;
		    font-weight: 500;
		    display: block;
		    width: 100%;
		    margin-top: 20px;
		    height: 50px !important;
		    line-height: 48px !important;
		    border-radius: 50px;
		    text-transform: uppercase;
			letter-spacing: 1px;
		}
		body.login.login-action-lostpassword .button-primary {
			margin-top: 10px;
		}
	</style>
<?php }
add_action( 'login_enqueue_scripts', 'ih_login_logo' );