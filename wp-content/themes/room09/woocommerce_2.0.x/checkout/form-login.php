<?php
/**
 * Checkout login form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( is_user_logged_in() ) return;
if ( get_option('woocommerce_enable_signup_and_login_from_checkout') == "no" ) return;

$info_message = apply_filters('woocommerce_checkout_login_message', __('Already registered?', 'yit'));
?>

<?php if( !yit_get_option('shop-checkout-multistep') ): ?>
<p class="woocommerce_info"><?php echo $info_message; ?> <a href="#" class="showlogin"><?php _e('Click here to login', 'yit'); ?></a></p>

<?php woocommerce_login_form( array( 'message' => __('If you have shopped with us before, please enter your details in the boxes below. If you are a new customer please proceed to the Billing &amp; Shipping section.', 'yit'), 'redirect' => get_permalink(woocommerce_get_page_id('checkout')) ) ); ?>

<?php else: ?>
<div class="step1_login_form span6">
		<h3><?php _e('Login', 'yit'); ?></h3>

		<form method="post" class="login_checkout">
			<p class="form-row form-row-first">
				<label for="username"><?php _e('Username or email', 'yit'); ?> <span class="required">*</span></label>
				<input type="text" class="input-text" name="username" id="username" />
			</p>
			<p class="form-row form-row-last">
				<label for="password"><?php _e('Password', 'yit'); ?> <span class="required">*</span></label>
				<input class="input-text" type="password" name="password" id="password" />
			</p>
			<div class="clear"></div>

			<p class="form-row">
				<?php $woocommerce->nonce_field('login', 'login') ?>
				<input type="hidden" name="redirect" value="<?php echo get_permalink(woocommerce_get_page_id('checkout')) ?>" />
				<input type="submit" class="button" name="login" value="<?php _e('Login', 'yit'); ?>" />
				<a class="lost_password" href="<?php echo esc_url( wp_lostpassword_url( home_url() ) ); ?>"><?php _e('Lost Password?', 'yit'); ?></a>
			</p>
		</form>
</div>

<div class="step1_create_account span6">
		
		<h3><?php printf( __('<span>First time on %s?</span> Create an account.', 'yit'), yit_decode_title(get_bloginfo())); ?></h3>
		<form method="post" class="register">

			<?php if ( get_option( 'woocommerce_registration_email_for_username' ) == 'no' ) : ?>

				<p class="form-row form-row-first">
					<label for="reg_username"><?php _e('Username', 'yit'); ?> <span class="required">*</span></label>
					<input type="text" class="input-text" name="username" id="reg_username" value="<?php if (isset($_POST['username'])) echo esc_attr($_POST['username']); ?>" />
				</p>

				<p class="form-row form-row-last">

			<?php else : ?>

				<p class="form-row form-row-wide">

			<?php endif; ?>

				<label for="reg_email"><?php _e('Email', 'yit'); ?> <span class="required">*</span></label>
				<input type="email" class="input-text" name="email" id="reg_email" value="<?php if (isset($_POST['email'])) echo esc_attr($_POST['email']); ?>" />
			</p>

			<div class="clear"></div>

			<p class="form-row form-row-first">
				<label for="reg_password"><?php _e('Password', 'yit'); ?> <span class="required">*</span></label>
				<input type="password" class="input-text" name="password" id="reg_password" value="<?php if (isset($_POST['password'])) echo esc_attr($_POST['password']); ?>" />
			</p>
			<p class="form-row form-row-last">
				<label for="reg_password2"><?php _e('Re-enter password', 'yit'); ?> <span class="required">*</span></label>
				<input type="password" class="input-text" name="password2" id="reg_password2" value="<?php if (isset($_POST['password2'])) echo esc_attr($_POST['password2']); ?>" />
			</p>
			<div class="clear"></div>

			<!-- Spam Trap -->
			<div style="left:-999em; position:absolute;"><label for="trap">Anti-spam</label><input type="text" name="email_2" id="trap" /></div>

			<?php do_action( 'register_form' ); ?>

			<p class="form-row">
				<?php $woocommerce->nonce_field('register', 'register') ?>
				
				<input type="hidden" name="yit_checkout" value="true" />
				<input type="submit" class="button" name="register" value="<?php _e('Register', 'yit'); ?>" />
			</p>

		</form>

	
	
	
</div>



















<?php endif ?>