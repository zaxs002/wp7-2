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
 
/**
 * Class to print fields in the tab Shop -> General settings
 * 
 * @since 1.0.0
 */
class YIT_Submenu_Tabs_Theme_option_Shop_General_settings extends YIT_Submenu_Tabs_Abstract {
    /**
     * Default fields
     * 
     * @var array
     * @since 1.0.0
     */
    public $fields;
    
    /**
     * Merge default fields with theme specific fields using the filter yit_submenu_tabs_theme_option_shop_general_settings
     * 
     * @param array $fields
     * @since 1.0.0
     */
    public function __construct() {
        $fields = $this->init();
        $this->fields = apply_filters( strtolower( __CLASS__ ), $fields );
    }
    
    /**
     * Set default values
     * 
     * @return array
     * @since 1.0.0
     */
    public function init() {  
        return array(   
        	5 => array(
                'id'   => 'shop-enabled',
                'type' => 'onoff',
                'name' => __( 'Enable shop features', 'yit' ),
                'desc' => __( 'Say if you want to enable the shop features. If the option is disabled, products cannot be added to cart.', 'yit' ),
                'std'  => true,
            ),       
        	10 => array(
                'id'   => 'shop-show-breadcrumb',
                'type' => 'onoff',
                'name' => __( 'Show breadcrumb', 'yit' ),
                'desc' => __( 'Say if you want the breadcrumb in the shop pages.', 'yit' ),
                'std'  => true,
            ),        
        	20 => array(
                'id'   => 'show-header-woocommerce-cart',
                'type' => 'onoff',
                'name' => __( 'Show Woocommerce Cart', 'yit' ),
                'desc' => __( 'Say if you want to display the number of items in cart and the current subtotal.', 'yit' ),
                'std'  => true,
            ),
            /*
            25 => array(
                'id'   => 'shop-sidebar-width',
                'type' => 'select',
                'name' => __( 'Sidebar width', 'yit' ),
                'desc' => __( 'Select the width of the sidebar.', 'yit' ),
                'options' => apply_filters( 'yit_shop-sidebar-width_options', array(
                    '2' => __( 'Small', 'yit' ),
                    '3' => __( 'Big', 'yit' )
                ) ),
                'std'  => apply_filters( 'yit_shop-sidebar-width_std', '3' )
            ), 
			*/
        	80 => array(
                'id'   => 'shop-products-per-page',
                'type' => 'number',
                'name' => __( 'Products per page', 'yit' ),
                'desc' => __( 'Say how many products to show per page, in the shop pages.', 'yit' ),
                'std'  => 12,
            ),       
        	90 => array(
                'id'   => 'shop-checkout-multistep',
                'type' => 'onoff',
                'name' => __( 'Enable checkout multistep', 'yit' ),
                'desc' => __( 'Choose if you want to enable multistep checkout or use classic checkout.', 'yit' ),
                'std'  => 1,
            ),    
        	100 => array(
                'id'   => 'shop-customer-vat',
                'type' => 'onoff',
                'name' => __( 'Enable VAT field', 'yit' ),
                'desc' => __( 'Choose if you want to enable VAT field for Customer.', 'yit' ),
                'std'  => 1,
            ),
            102 => array(
                'id'   => 'shop-customer-ssn',
                'type' => 'onoff',
                'name' => __( 'Enable SSN field', 'yit' ),
                'desc' => __( 'Choose if you want to enable SSN field for Customer.', 'yit' ),
                'std'  => 0,
            ),  
        	110 => array(
                'id'   => 'shop-fields-order',
                'type' => 'onoff',
                'name' => __( 'Restore fields order', 'yit' ),
                'desc' => __( 'Restore the order of fields as in previous Woocommerce version.', 'yit' ),
                'std'  => 1,
            ),
            130 => array(
                'id'    => 'minicart-total-items',
                'type'  => 'onoff',
                'name'  => __( 'Count all items in the cart', 'yit' ),
                'desc'  => __( 'It changes the way like the cart in the header count items. If ON, everytime you add an item to the cart (also if the item already is in the cart) the quantity will be increased. If OFF, multiple items of the same type will be counted only one time.', 'yit' ),
                'std'   => 0
            ),
            140 => array(
                'id'    => 'minicart-icon',
                'type'  => 'upload',
                'name'  => __( 'Set your icon in the cart in header', 'yit' ),
                'desc'  => __( 'Choose your icon for the cart in header', 'yit' ),
                'std'   => get_template_directory_uri() . '/woocommerce/images/header-cart.png'
            ),
            150 => array(
                'id'    => 'add-to-cart-text',
                'type'  => 'text',
                'name'  => __( 'Set "Add to Cart" text', 'yit' ),
                'desc'  => __( 'Choose the text to display within the add to cart button', 'yit' ),
                'std'   => __('Add to cart', 'yit')
            ),
            160 => array(
                'id'    => 'display-category-image-description',
                'type'  => 'onoff',
                'name'  => __( 'Display image and description in Category page', 'yit' ),
                'desc'  => __( 'Select if you want to display the category image and the category description in category pages.', 'yit' ),
                'std'   => 1
            )
        );
    }
}