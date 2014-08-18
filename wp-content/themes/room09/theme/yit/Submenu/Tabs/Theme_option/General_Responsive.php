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
class YIT_Submenu_Tabs_Theme_option_General_Responsive extends YIT_Submenu_Tabs_Abstract {
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
            90 => array(
                'id'   => 'responsive-enabled',
                'type' => 'onoff',
                'name' => __( 'Activate responsive', 'yit' ),
                'desc' => __( 'Choose if you want to enable or not the responsive behavior.', 'yit' ),
                'std'  => 1,
            ),
            100 => array(
                'id'   => 'responsive-menu',
                'type' => 'select',
                'name' => __( 'Responsive menu type', 'yit' ),
                'desc' => __( 'Choose if you want to show menu .', 'yit' ),
                'options' => array(
                	'arrow'   => __( 'Arrow Menu', 'yit' ),
                    'select' => __( 'Select Menu', 'yit' ),
                ),
                'std'  => 'arrow',
                'deps' => array(
                	'ids' => 'responsive-enabled',
                	'values' => 1
        		)
            ),
            105 => array(
                'id'   => 'responsive-show-logo-tagline',
                'type' => 'onoff',
                'name' => __( 'Show logo tagline in mobile', 'yit' ),
                'desc' => __( 'Choose if you want to show the tagline of logo.', 'yit' ),
                'std'  => 1,
            ),
            110 => array(
                'id'   => 'responsive-show-header-login',
                'type' => 'onoff',
                'name' => __( 'Show header login/register link', 'yit' ),
                'desc' => __( 'Choose if you want to show the login/register link.', 'yit' ),
                'std'  => 1,
            ),
            115 => array(
                'id'   => 'responsive-show-topbar-menu',
                'type' => 'onoff',
                'name' => __( 'Show topbar menu', 'yit' ),
                'desc' => __( 'Choose if you want to show the menu in topbar.', 'yit' ),
                'std'  => 1,
            ),
            120 => array(
                'id'   => 'responsive-show-header-search',
                'type' => 'onoff',
                'name' => __( 'Show header search in mobile', 'yit' ),
                'desc' => __( 'Choose if you want to show the search form of header.', 'yit' ),
                'std'  => 1,
            ),
            130 => array(
                'id'   => 'responsive-show-header-cart',
                'type' => 'onoff',
                'name' => __( 'Show cart in header in mobile', 'yit' ),
                'desc' => __( 'Choose if you want to show the cart widget of header.', 'yit' ),
                'std'  => 1,
            ),
            140 => array(
                'id'   => 'responsive-show-lang-switcher',
                'type' => 'onoff',
                'name' => __( 'Show the language switcher', 'yit' ),
                'desc' => __( 'Choose if you want to show the language switcher on mobile.', 'yit' ),
                'std'  => 1,
            ),
            150 => array(
                'id'   => 'responsive-open-hover',
                'type' => 'onoff',
                'name' => __( 'Hover opened, in product with "Popup" style (on mobile)', 'yit' ),
                'desc' => __( 'Take opened the hover in products with the stile "Wist Hover", when you are in mobile screens.', 'yit' ),
                'std'  => 1,
            ),
            160 => array(
                'id'   => 'responsive-force-classic',
                'type' => 'onoff',
                'name' => __( 'Force "Classic" style in the products list, on mobile.', 'yit' ),
                'desc' => __( 'Force the "Classic" style in the products list, when you are in mobile.', 'yit' ),
                'std'  => 0,
            )
        );
    }
}
