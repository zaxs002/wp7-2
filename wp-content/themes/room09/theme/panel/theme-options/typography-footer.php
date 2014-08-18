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

function yit_footer_font_std( $array ) {
    $array['size'] = 12;
    $array['family'] = 'Monda';
    $array['color'] = '#ffffff';
    
    return $array;
}
add_filter( 'yit_footer-font_std', 'yit_footer_font_std' );

function yit_footer_font_style( $array ) {
    $array['selectors'] .= ', #footer a, #footer .widget.contact-info ul li, #footer .widget.contact-info ul li p, #footer .recent-comments .the-post .author, #footer .text-image';
    
    return $array;
}
add_filter( 'yit_footer-font_style', 'yit_footer_font_style' );

function yit_footer_title_font_std( $array ) {
    $array['size'] = 13;
    $array['family'] = 'Monda';
    $array['color'] = '#fee1bb';
    $array['style'] = 'regular';
    
    return $array;
}
add_filter( 'yit_footer-title-font_std', 'yit_footer_title_font_std' );

function yit_footer_links_font_style( $array ) {
    $array['selectors'] = '#footer .container a, #footer .widget.contact-info ul li strong';
    return $array;
}
add_filter( 'yit_footer-links-font_style', 'yit_footer_links_font_style' );

function yit_footer_links_hover_font_style( $array ) {
    $array['selectors'] = '#footer .container a:hover';
    return $array;
}
add_filter( 'yit_footer-links-hover-font_style', 'yit_footer_links_hover_font_style' );

function yit_copyright_font_std( $array ) {
    $array['size'] = 10;
    $array['family'] = 'Monda';
    $array['color'] = '#ffffff';
    
    return $array;
}
add_filter( 'yit_copyright-font_std', 'yit_copyright_font_std' );

function yit_copyright_font_style( $array ) {
    $array['selectors'] = '#copyright, #copyright div p, #copyright p, #copyright a, #copyright p a, #copyright div p a';
    return $array;
}
add_filter( 'yit_copyright-font_style', 'yit_copyright_font_style' );

function yit_copyright_links_font_style( $array ) {
    $array['selectors'] = '#copyright a, #copyright div a, #copyright div p a';
    return $array;
}
add_filter( 'yit_copyright-links-font_style', 'yit_copyright_links_font_style' );

function yit_copyright_links_hover_font_style( $array ) {
    $array['selectors'] = '#copyright a:hover, #copyright div a:hover, #copyright div p a:hover';
    return $array;
}
add_filter( 'yit_copyright-links-hover-font_style', 'yit_copyright_links_hover_font_style' );

add_filter( 'yit_footer-links-font_std', create_function( '', 'return "#ffffff";' ) );
add_filter( 'yit_footer-links-hover-font_std', create_function( '', 'return "#e3910f";' ) );
add_filter( 'yit_copyright-links-font_std', create_function( '', 'return "#fdc992";' ) );
add_filter( 'yit_copyright-links-hover-font_std', create_function( '', 'return "#e3910f";' ) );