<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;
?>

<?php do_action( 'woocommerce_before_mini_cart' ); ?>

<ul class="cart_list product_list_widget <?php echo $args['list_class']; ?>">

    <?php if ( sizeof( WC()->cart->get_cart() ) > 0 ) : ?>

        <?php foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) :

            $_product = $cart_item['data'];

            // Only display if allowed
            if ( ! apply_filters('woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) || ! $_product->exists() || $cart_item['quantity'] == 0 )
                continue;

            // Get price
            $product_price = get_option( 'woocommerce_tax_display_cart' ) == 'excl' ? $_product->get_price_excluding_tax() : $_product->get_price_including_tax();

            $product_price = apply_filters( 'woocommerce_cart_item_price_html', wc_price( $product_price ), $cart_item, $cart_item_key );
            ?>

            <li>
                <?php
                echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf( '<a href="%s" class="remove_item" title="%s">%s</a>', esc_url( $woocommerce->cart->get_remove_url( $cart_item_key ) ), __('Remove this item', 'yit'), __( 'remove', 'yit' ) ), $cart_item_key );
                ?>
                <a href="<?php echo get_permalink( $cart_item['product_id'] ); ?>">

                    <?php echo $_product->get_image(); ?>

                    <?php echo apply_filters('woocommerce_widget_cart_product_title', $_product->get_title(), $_product ); ?>

                </a>



                <?php echo WC()->cart->get_item_data( $cart_item ); ?>

                <?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) . '</span>', $cart_item, $cart_item_key ); ?>
            </li>

        <?php endforeach; ?>

    <?php else : ?>

        <li class="empty"><?php _e( 'No products in the cart.', 'yit' ); ?></li>

    <?php endif; ?>

</ul><!-- end product list -->

<?php if ( sizeof( WC()->cart->get_cart() ) > 0 ) : ?>

    <p class="total"><strong><?php _e( 'Subtotal', 'yit' ); ?>:</strong> <?php echo WC()->cart->get_cart_subtotal(); ?></p>

    <?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>

    <p class="buttons">
        <a href="<?php echo WC()->cart->get_cart_url(); ?>" class="button"><?php _e( 'View Cart &rarr;', 'yit' ); ?></a>
        <a href="<?php echo WC()->cart->get_checkout_url(); ?>" class="button checkout"><?php _e( 'Checkout &rarr;', 'yit' ); ?></a>
    </p>

<?php endif; ?>

<?php do_action( 'woocommerce_after_mini_cart' ); ?>
