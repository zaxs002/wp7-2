<?php      
// other attrs
$extra_atts = array();
unset( $var['other_atts'], $var['content'] );  
foreach ( $var as $att => $v ) $extra_atts[] = "$att=\"$v\"";

echo do_shortcode('[accordion ' . implode(' ', $extra_atts) . ']');

?>