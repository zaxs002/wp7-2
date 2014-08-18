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

if( !class_exists( 'text_image' ) ) :
class text_image extends WP_Widget
{
    function text_image() {
        $widget_ops = array( 
            'classname' => 'text-image', 
            'description' => __( 'Arbitrary text or HTML, with a simple image above text.', 'yit' )
        );

        $control_ops = array( 'id_base' => 'text-image', 'width' => 430 );

        $this->WP_Widget( 'text-image', __( 'Text With Image', 'yit' ), $widget_ops, $control_ops );      
        
        //wp_enqueue_style( 'thickbox' );
        //wp_enqueue_script( 'thickbox' );
        //wp_enqueue_script( 'media-upload' );
    }
    
    function form( $instance ) {
        global $icons_name;
        
        /* Impostazioni di default del widget */
        $defaults = array( 
            'title' => '',
            'image' => '',
            'link' => '',
            'align' => '',
            'text' => '',
            'autop' => false
        );
        
        $instance = wp_parse_args( (array) $instance, $defaults ); ?>
        
        <p>
            <label>
                <strong><?php _e( 'Title', 'yit' ) ?>:</strong><br />
                <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
            </label>
        </p>                  
        
        <p>
            <label><?php _e( 'Image', 'yit' ) ?>:
                <input type="text" id="<?php echo $this->get_field_id( 'image' ); ?>" name="<?php echo $this->get_field_name( 'image' ); ?>" value="<?php echo $instance['image']; ?>" />
                <a href="media-upload.php?type=image&TB_iframe=true" id="<?php echo $this->id ?>-upload-button" class="upload-image button-secondary">Upload</a>
            </label>
        </p>

        <p>
            <label><?php _e( 'Image Alignment', 'yit' ) ?>:
                <select id="<?php echo $this->get_field_id( 'align' ); ?>" name="<?php echo $this->get_field_name( 'align' ); ?>">
                    <option value="left"<?php if($instance['align']=='left'): ?>selected="selected"<?php endif ?>>Left</option>
                    <option value="center"<?php if($instance['align']=='center'): ?>selected="selected"<?php endif ?>>Center</option>
                    <option value="right"<?php if($instance['align']=='right'): ?>selected="selected"<?php endif ?>>Right</option>
                </select>
            </label>
        </p>     
        
        <p>
            <label><?php _e( 'Widget Link', 'yit' ) ?>:
                <input type="text" id="<?php echo $this->get_field_id( 'link' ); ?>" name="<?php echo $this->get_field_name( 'link' ); ?>" value="<?php echo $instance['link']; ?>" />
            </label>
        </p>


        <p>
            <label>
                <textarea class="widefat" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>" cols="20" rows="16"><?php echo $instance['text']; ?></textarea>
            </label>
        </p>
        
        <p>
            <label>
                <input type="checkbox" id="<?php echo $this->get_field_id( 'autop' ); ?>" name="<?php echo $this->get_field_name( 'autop' ); ?>" value="1"<?php if( $instance['autop'] ) echo ' checked="checked"' ?> />
                <?php _e( 'Automatically add paragraphs', 'yit' ) ?>
            </label>
        </p>         
        <?php
    }
    
    function widget( $args, $instance ) {
        extract( $args );

        $title = apply_filters('widget_title', $instance['title'] ); 
                   
        if ( strpos( $before_widget, 'widget-wrap' ) === false ) {
            $before_widget .= '<div class="widget-wrap">';
            $after_widget  .= '</div>';
        }
        
        echo $before_widget;                   

        if ( $title ) echo $before_title . $title . $after_title;
        
        if( $instance['autop'] )
            $instance['text'] = wpautop( $instance['text'] );
        
        $text = '<div class="text-image" style="text-align:'. $instance['align'] .'">';
        if (isset($instance['image']) && $instance['image'] != '') :
            $size = yit_getimagesize($instance['image']);
            $size = ( !empty($size) && isset($size[3] ) ) ? $size[3] : '';
        	$text .= '<img src="' . preg_replace( '/http(s)?:/', '', $instance['image'] ) . '" alt="' . $instance['title'] . '" '. $size . ' />';
		endif;
		
		$text .= '</div>' . $instance['text'];
        echo apply_filters( 'widget_text', $text );       
		
		if ( ! empty( $instance['link'] ) ) {
            echo '<a href="'.$instance['link'].'" class="widget-link"></a>';
        }
        
        echo $after_widget;
    }                     

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;

        $instance['title'] = strip_tags( $new_instance['title'] );

        $instance['image'] = $new_instance['image'];
        
        $instance['link'] = esc_url( $new_instance['link'] );
        
        $instance['align'] = $new_instance['align'];

        $instance['text'] = $new_instance['text'];

        $instance['autop'] = $new_instance['autop'];

        return $instance;
    }
    
}     
endif;