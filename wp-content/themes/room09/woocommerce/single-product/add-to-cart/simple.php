<?php
/**
 * Simple product add to cart
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce, $product;

if ( ! $product->is_purchasable() ) return;
?>

<?php
	// Availability
	$availability = $product->get_availability();

	if ($availability['availability']) :
		echo apply_filters( 'woocommerce_stock_html', '<p class="stock ' . esc_attr( $availability['class'] ) . '">' . esc_html( $availability['availability'] ) . '</p>', $availability['availability'] );
    endif;
?>

<?php if ( $product->is_in_stock() ) : ?>

	<?php do_action('woocommerce_before_add_to_cart_form'); ?>

    <?php if( yit_get_option( 'shop-detail-add-to-cart' ) ) : ?>

	<form action="<?php echo esc_url( $product->add_to_cart_url() ); ?>" class="cart" method="post" enctype='multipart/form-data'>

        <?php do_action( 'woocommerce_simple_product_before_quantity_selector' ) ?>

        <?php if ( ! $product->is_sold_individually() ) : ?>
        <table cellspacing="0" class="variations">
		    <tbody>
                <tr>
		            <td class="label"><label><?php _e( 'Quantity', 'yit' ) ?></label></td>
		            <td class="value"><?php 
                        woocommerce_quantity_input( array(
    	 				  'min_value' => apply_filters( 'woocommerce_quantity_input_min', 1, $product ),
    	 				  'max_value' => apply_filters( 'woocommerce_quantity_input_max', $product->backorders_allowed() ? '' : $product->get_stock_quantity(), $product )
    	 			    ) ); ?>
                    </td>
		        </tr>
            </tbody>
        </table>
        <?php endif; ?>                        
		
        <?php do_action('woocommerce_before_add_to_cart_button'); ?>

        <input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->id ); ?>" />

	 	<button type="submit" class="single_add_to_cart_button button alt"><?php echo apply_filters('single_add_to_cart_text', __( 'Add to cart', 'yit' ), $product->product_type); ?></button>

	 	<?php do_action('woocommerce_after_add_to_cart_button'); ?>

	</form>

    <?php endif ?>

	<?php do_action('woocommerce_after_add_to_cart_form'); ?>

<?php endif; ?>