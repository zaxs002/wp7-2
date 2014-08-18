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
 * Class to print fields in the tab Colors -> General
 * 
 * @since 1.0.0
 */
class YIT_Submenu_Tabs_Theme_option_Colors_Home_row extends YIT_Submenu_Tabs_Abstract {
    /**
     * Default fields
     * 
     * @var array
     * @since 1.0.0
     */
    public $fields;
    
    /**
     * Merge default fields with theme specific fields using the filter yit_submenu_tabs_theme_option_colors_general
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
            10 => array(
                'id' => 'home-row-widget-bg',
                'type' => 'colorpicker',
                'name' => __( 'Widget background', 'yit' ),
                'desc' => __( 'Select the background of the widgets box.', 'yit' ),
                'opacity' => 0.80,
                'std' => '#ffffff',
                'style' => array(
                	'selectors' => '.home-row .home-widget',
                	'properties' => 'background-color'
				)
            ),
              	                   	
            20 => array(
                'id' => 'home-row-widget-border',
                'type' => 'colorpicker',
                'name' => __( 'Widget border', 'yit' ),
                'desc' => __( 'Select the border color of the widgets box.', 'yit' ),
                'std' => '#c5c1be',
                'style' => array(
                	'selectors' => '.home-row .home-widget .widget-wrap, .home-row .home-widget .widget-wrap.widget-last',
                	'properties' => 'border-color'
				)
            )
        );
    }
}