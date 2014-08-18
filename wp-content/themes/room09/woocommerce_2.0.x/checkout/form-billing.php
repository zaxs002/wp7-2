<?php
/**
 * Checkout billing information form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

global $woocommerce;
?>

<?php if ( $woocommerce->cart->ship_to_billing_address_only() && $woocommerce->cart->needs_shipping() ) : ?>

	<h3><?php _e('Billing &amp; Shipping', 'yit'); ?></h3>

<?php else : ?>

	<h3><?php _e('Billing Address', 'yit'); ?></h3>

<?php endif; ?>

<?php do_action('woocommerce_before_checkout_billing_form', $checkout); ?>

<?php foreach ($checkout->checkout_fields['billing'] as $key => $field) : ?>

	<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>

<?php endforeach; ?>

<?php do_action('woocommerce_after_checkout_billing_form', $checkout); ?>

<?php if( !yit_get_option('shop-checkout-multistep') ): ?>
	<?php if (!is_user_logged_in() && get_option('woocommerce_enable_signup_and_login_from_checkout')=="yes") : ?>
	
		<?php if (get_option('woocommerce_enable_guest_checkout')=='yes') : ?>
	
			<p class="form-row">
				<input class="input-checkbox" id="createaccount" <?php checked($checkout->get_value('createaccount'), true) ?> type="checkbox" name="createaccount" value="1" /> <label for="createaccount" class="checkbox"><?php _e('Create an account?', 'yit'); ?></label>
			</p>
	
		<?php endif; ?>
	
		<?php do_action( 'woocommerce_before_checkout_registration_form', $checkout ); ?>
	
		<div class="create-account">
	
			<p><?php _e('Create an account by entering the information below. If you are a returning customer please login at the top of the page.', 'yit'); ?></p>
	
			<?php foreach ($checkout->checkout_fields['account'] as $key => $field) : ?>
	
				<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>
	
			<?php endforeach; ?>
	
		</div>
	
		<?php do_action( 'woocommerce_after_checkout_registration_form', $checkout ); ?>
	
	<?php endif; ?>
<?php else: ?>
	<?php if ( ( $woocommerce->cart->needs_shipping() || get_option('woocommerce_require_shipping_address') == 'yes' ) && ! $woocommerce->cart->ship_to_billing_address_only() ) : ?>
	
		<?php
			if ( empty( $_POST ) ) :
	
				$shiptobilling = (get_option('woocommerce_ship_to_same_address')=='yes') ? 1 : 0;
				$shiptobilling = apply_filters('woocommerce_shiptobilling_default', $shiptobilling);
	
			else :
	
				$shiptobilling = $checkout->get_value('shiptobilling');
	
			endif;
		?>
	
		<p class="form-row" id="shiptobilling_bill">
			<input id="shiptobilling_bill-checkbox" class="input-checkbox" <?php checked($shiptobilling, 1); ?> type="checkbox" name="shiptobilling" value="1" />
			<label for="shiptobilling_bill-checkbox" class="checkbox"><?php _e('Ship to billing address?', 'yit'); ?></label>
		</p>
	<?php endif ?>
<?php endif; ?>