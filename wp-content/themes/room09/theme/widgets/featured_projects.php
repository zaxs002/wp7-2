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

if( !class_exists( 'featured_projects' ) ) :
class featured_projects extends WP_Widget 
{

    function featured_projects() 
    {

        $widget_ops = array( 
            'classname' => 'featured-projects', 
            'description' => __('Show a slider with featured project, added into portfolio Post Type.', 'yit') 
        );

        $control_ops = array( 'id_base' => 'featured-projects' );

        $this->WP_Widget( 'featured-projects', 'Featured Project', $widget_ops, $control_ops );
    }

    

    function widget( $args, $instance ) 
    {
        extract( $args );
        $yit_portfolio = yit_portfolios();

        /* User-selected settings. */
        $title = apply_filters('widget_title', $instance['title'] );

        $project_fx = isset( $instance['project_fx']) ? $instance['project_fx'] : false;
        $project_easing_fx = isset( $instance['project_easing_fx']) ? $instance['project_easing_fx'] : false;
        $project_speed_fx = isset( $instance['project_speed_fx']) ? $instance['project_speed_fx'] : false;
        $project_timeout_fx = isset( $instance['project_timeout_fx']) ? $instance['project_timeout_fx'] : false;
        $project_n_items = isset( $instance['project_n_items']) ? $instance['project_n_items'] : 5;
        $project_post_types = isset( $instance['project_post_type']) ? $instance['project_post_type'] : 'portfolio';


        global $more;
        $more = 0;

		$post_type = $project_post_types;
		
		
		if( $project_post_types ) {
	        foreach( $yit_portfolio as $portfolio ) {
				if($portfolio->ID == $project_post_types) {
					echo $before_widget;
					if ( $title ) echo $before_title . $title . $after_title;
					
					echo '<div class="featured-projects-widget flexslider">';
                		echo '<ul class="slides">';
						
							yit_set_portfolio_loop( $portfolio->ID ); $i = 0;
							$categories = yit_portfolio_get_setting( 'categories', $portfolio->ID );
								
							$portfolios = yit_portfolio_get_setting( 'items', $portfolio->ID );
							foreach( $portfolios as $item_id => $item ) {
								$post_permalink = yit_work_permalink( $item_id );
								list( $thumbnail_url, $thumbnail_width, $thumbnail_height ) = wp_get_attachment_image_src( $item_id, 'featured_project_thumb' );

			                    echo '<li>';
			                        echo '<div class="thumb-project">';
			                        echo "<a href='". $post_permalink ."'>";
			                        echo wp_get_attachment_image( $item_id, 'featured_project_thumb' );
			                        echo '</a></div>';

			                        echo '<h4>' . $item['title'] . '</h4>';
			                    echo '</li>';
								
								if( ++$i == $project_n_items ) break;
							}

		                echo '</ul>';
		            echo '</div>';

		            $script = "<script type=\"text/javascript\">
		                jQuery(document).ready(function($){
		                	var animation = $.browser.msie || $.browser.opera ? 'fade' : '$project_fx';
		                    $('.featured-projects-widget').flexslider({
		                        animation: animation,
		                        slideshowSpeed: $project_timeout_fx,
		                        animationSpeed: $project_speed_fx,
		                        selectors: 'ul > li',
		                        directionNav: true,
		                        slideshow: true,

						        pauseOnAction: false,
						        controlNav: false,
						        touch: true
		                    });
		                });
		            </script>";

		            echo $script;
		            echo $after_widget;
				}
			}
		}
		
    }



    function update( $new_instance, $old_instance ) 
    {

        $instance = $old_instance;
        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance['project_n_items'] = $new_instance['project_n_items'];
        $instance['project_fx'] = $new_instance['project_fx'];   
        $instance['project_timeout_fx'] = $new_instance['project_timeout_fx'];
        $instance['project_speed_fx'] = $new_instance['project_speed_fx'];    
        $instance['project_post_type'] = $new_instance['project_post_type'];

        return $instance;

    }



    function form( $instance ) 
    {
       
        /* Impostazioni di default del widget */
        $defaults = array( 
            'title' => 'Featured Projects', 
            'icon' => 'comment',       
            'project_n_items' => 5,
            'project_fx' => 'slide', 
            'project_timeout_fx' => 8000,  
            'project_speed_fx' => 300,
            'project_post_type' => 'portfolio' 
        );
		
		$config = YIT_Config::load();
		$yit_easings = $config['easings'];
		$yit_cycle_fxs = $config['cycle_fx'];

        $instance = wp_parse_args( (array) $instance, $defaults ); ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:
                 <input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" />
            </label>
        </p>

        <p>

            <label for="<?php echo $this->get_field_id( 'project_post_type' ); ?>">Portfolio:

                 <select id="<?php echo $this->get_field_id( 'project_post_type' ); ?>" name="<?php echo $this->get_field_name( 'project_post_type' ); ?>">
					 <?php $portfolios = yit_portfolios(); ?>
					 <?php foreach( $portfolios as $portfolio ): ?>
					 	 <option value="<?php echo $portfolio->ID ?>"<?php if($portfolio->ID == $instance['project_post_type']): ?> selected="selected"<?php endif ?>><?php echo $portfolio->post_title ? $portfolio->post_title : 'Portfolio ID: ' . $portfolio->ID ?></option>
					 <?php endforeach ?>
                 </select>

            </label>

        </p>                            

        <p>
            <label for="<?php echo $this->get_field_id( 'project_n_items' ); ?>">Items:
                 <select id="<?php echo $this->get_field_id( 'project_n_items' ); ?>" name="<?php echo $this->get_field_name( 'project_n_items' ); ?>">
                    <?php 

                    for($i=1;$i<=20;$i++)

                    {

                        $select = '';

                        if($instance['project_n_items'] == $i) $select = ' selected="selected"';

                        echo "<option value=\"$i\"$select>$i</option>\n";

                    }

                    ?>
                 </select>
            </label>
        </p>

        

        <p>
            <label for="<?php echo $this->get_field_id( 'project_fx' ); ?>"><?php _e( 'Slider effect', 'yit' ) ?>:
                 <select id="<?php echo $this->get_field_id( 'project_fx' ); ?>" name="<?php echo $this->get_field_name( 'project_fx' ); ?>">
                    <?php

                    foreach(array( 'slide', 'fade' ) as $fx)

                    {

                        $select = '';

                        if($instance['project_fx'] == $fx) $select = ' selected="selected"';

                        echo "<option value=\"$fx\"$select>$fx</option>\n";

                    }

                    ?>
                 </select>
            </label>
        </p>          

        
        <p>
            <label for="<?php echo $this->get_field_id( 'project_timeout_fx' ); ?>"><?php _e( 'Timeout (ms)', 'yit' ) ?>:
                 <input type="text" id="<?php echo $this->get_field_id( 'project_timeout_fx' ); ?>" name="<?php echo $this->get_field_name( 'project_timeout_fx' ); ?>" value="<?php echo $instance['project_timeout_fx']; ?>" size="4" />
            </label>
        </p>          


        <p>
            <label for="<?php echo $this->get_field_id( 'project_speed_fx' ); ?>"><?php _e( 'Animation speed (ms)', 'yit' ) ?>:
                 <input type="text" id="<?php echo $this->get_field_id( 'project_speed_fx' ); ?>" name="<?php echo $this->get_field_name( 'project_speed_fx' ); ?>" value="<?php echo $instance['project_speed_fx']; ?>" size="4" />
            </label>
        </p>
    <?php

    }

}
endif;