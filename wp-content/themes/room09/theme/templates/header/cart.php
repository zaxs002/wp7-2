<?php
/**
 * Your Inspiration Themes
 *
 * @package WordPress
 * @subpackage Your Inspiration Themes
 * @author Your Inspiration Themes Team <info@yithemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

if( ! is_shop_installed() || ! is_shop_enabled() || ! yit_get_option('show-header-woocommerce-cart') ) return;
?>
<div class="border" <?php if ( yit_get_option('nav-cart-min-height-onoff') ) { echo 'style="min-height: ' . (yit_get_option('nav-cart-min-height') - 5) . 'px;"'; } ?>>
    <div class="innerborder">
        <span class="cart-label"><?php _e('Cart','yit') ?></span>
        <?php if ( yit_get_option('responsive-show-lang-switcher') ) : ?><div class="hidden-phone"><?php endif; ?>
        <?php do_action('icl_language_selector'); ?>
        <?php if ( yit_get_option('responsive-show-lang-switcher') ) : ?></div><?php endif; ?>
        <div class="topbar-border"></div>
        <?php the_widget('YIT_Widget_Cart') ?>
    </div>
</div>
