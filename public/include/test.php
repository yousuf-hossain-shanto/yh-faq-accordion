<?php
class My_Color_Picker extends WP_Widget {
    var $textdomain;
    function __construct() {
        $this->textdomain = 'yf_textdomain';
        // This is where we add the style and script
        add_action( 'load-widgets.php', array(&$this, 'my_custom_load') );
        $this->WP_Widget(             'mycolorpicker',             'My Color Picker',             array( 'classname' => 'mycolorpicker', 'description' => 'Color picker widget' ),
            array( 'width' => 460, 'height' => 350, 'id_base' => 'mycolorpicker' )
        );
    }
    function my_custom_load() {         wp_enqueue_style( 'wp-color-picker' );         wp_enqueue_script( 'wp-color-picker' );     }
    function widget($args, $instance) {
        extract( $args, EXTR_SKIP );
        echo $before_widget;
        // Your custom code for front-end here
        echo $after_widget;
    }
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance = $new_instance;
        $instance['background_color'] = $new_instance['background_color'];
        return $instance;
    }
    function form($instance) {
        $defaults = array(
            'background_color' => '#e3e3e3'
        );
        // Merge the user-selected arguments with the defaults
        $instance = wp_parse_args( (array) $instance, $defaults ); ?>
        <script type='text/javascript'>
            jQuery(document).ready(function($) {
                $('.my-color-picker').wpColorPicker();
            });
        </script>
        <p>
            <label for="<?php echo $this->get_field_id( 'background_color' ); ?>"><?php _e( 'Border Color', $this->textdomain ); ?></label>
            <span><?php _e( 'The image border color', $this->textdomain ); ?></span>
            <input class="my-color-picker" type="text" id="<?php echo $this->get_field_id( 'background_color' ); ?>" name="<?php echo $this->get_field_name( 'background_color' ); ?>" value="<?php echo esc_attr( $instance['background_color'] ); ?>" />         </p><?php
    }
}
?>