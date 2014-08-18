<?php
/**
 * Login Form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce; ?>

<?php wc_print_notices(); ?>

<?php do_action('woocommerce_before_customer_login_form'); ?>

<?php if (get_option('woocommerce_enable_myaccount_registration')=='yes') : ?>

<div class="col2-set" id="customer_login">

	<div class="col-1">

<?php endif; ?>

		<h2><?php _e( 'Login', 'yit' ); ?></h2>
		<form method="post" class="login">
			<p class="form-row form-row-first">
				<label for="username"><?php _e( 'Username or email', 'yit' ); ?> <span class="required">*</span></label>
				<input type="text" class="input-text" name="username" id="username" />
			</p>
			<p class="form-row form-row-last">
				<label for="password"><?php _e( 'Password', 'yit' ); ?> <span class="required">*</span></label>
				<input class="input-text" type="password" name="password" id="password" />
			</p>
			<div class="clear"></div>

			<p class="form-row">
				<?php wp_nonce_field('woocommerce-login') ?>
				<input type="submit" class="button" name="login" value="<?php _e( 'Login', 'yit' ); ?>" />
				<a class="lost_password" href="<?php

                $lost_password_url = wc_lostpassword_url();
				if ( $lost_password_url )
					echo esc_url( $lost_password_url );
				else
					echo esc_url( wp_lostpassword_url( home_url() ) );

				?>"><?php _e( 'Lost Password?', 'yit' ); ?></a>
			</p>
		</form>

<?php if (get_option('woocommerce_enable_myaccount_registration')=='yes') : ?>

	</div>

	<div class="col-2">

		<h2><?php _e( 'Register', 'yit' ); ?></h2>
		<form method="post" class="register">

			<?php if ( get_option( 'woocommerce_registration_email_for_username' ) == 'no' ) : ?>

				<p class="form-row form-row-first">
					<label for="reg_username"><?php _e( 'Username', 'yit' ); ?> <span class="required">*</span></label>
					<input type="text" class="input-text" name="username" id="reg_username" value="<?php if (isset($_POST['username'])) echo esc_attr($_POST['username']); ?>" />
				</p>

				<p class="form-row form-row-last">

			<?php else : ?>

				<p class="form-row form-row-wide">

			<?php endif; ?>

				<label for="reg_email"><?php _e( 'Email', 'yit' ); ?> <span class="required">*</span></label>
				<input type="email" class="input-text" name="email" id="reg_email" value="<?php if (isset($_POST['email'])) echo esc_attr($_POST['email']); ?>" />
			</p>

			<div class="clear"></div>

			<p class="form-row form-row-wide">
				<label for="reg_password"><?php _e( 'Password', 'yit' ); ?> <span class="required">*</span></label>
				<input type="password" class="input-text" name="password" id="reg_password" value="<?php if (isset($_POST['password'])) echo esc_attr($_POST['password']); ?>" />
			</p>

			<!-- Spam Trap -->
			<div style="left:-999em; position:absolute;"><label for="trap">Anti-spam</label><input type="text" name="email_2" id="trap" tabindex="-1" /></div>

			<?php do_action( 'register_form' ); ?>

			<p class="form-row">
				<?php wp_nonce_field('woocommerce-register', 'register') ?>
				<input type="submit" class="button" name="register" value="<?php _e( 'Register', 'yit' ); ?>" />
			</p>

		</form>

	</div>

</div>


<?php if( defined('NEW_FB_LOGIN') && NEW_FB_LOGIN == 1 && function_exists('new_fb_sign_button') ): ?>
    <div class="fb-connect">
        <h3> <?php _e('or login with facebook', 'yit') ?></h3>
        <div class="btn-fb-login">
            <a href="<?php echo new_fb_login_url() ?>&redirect=<?php echo site_url() ?>/" onclick="window.location = '<?php bloginfo('url') ?>/wp-login.php?loginFacebook=1&redirect=<?php echo site_url() ?>/'; return false;">Connect  with  Facebook</a>
        </div>
    </div>
<?php endif; ?>

<?php endif; ?>
<?php do_action('woocommerce_after_customer_login_form'); ?>