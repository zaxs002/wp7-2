<?php
/**
 * Single Product title
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! yit_get_option('shop-products-details-nav') ) return;

?>
<div class="product-nav<?php if ( yit_product_layout() == 'layout-2' ) echo ' span12' ?>">
	<?php $same_cat = apply_filters('yit_product_nav_prev_same_cat', false); ?>
	<?php previous_post_link( '%link', ('&lt; ' . __( 'Prev', 'yit' )), $same_cat, '', 'product_cat' ); ?> |
	<?php next_post_link( '%link', (__( 'Next', 'yit' ) . ' &gt;'), $same_cat, '', 'product_cat' ); ?>
</div>