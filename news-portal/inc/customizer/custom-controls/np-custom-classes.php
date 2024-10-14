<?php
/**
 * Define customizer custom classes
 *
 * @package Mystery Themes
 * @subpackage News Portal
 * @since 1.0.0
 */

if ( class_exists( 'WP_Customize_Control' ) ) {

/*-----------------------------------------------------------------------------------------------------------------------*/
   
/*-----------------------------------------------------------------------------------------------------------------------*/
    /**
     * Customize controls for repeater field
     *
     * @since 1.0.0
     */
    class News_Portal_Repeater_Controler extends WP_Customize_Control {
        /**
         * The control type.
         *
         * @access public
         * @var string
         */
        public $type = 'repeater';

        public $news_portal_box_label = '';

        public $news_portal_box_add_control = '';

        /**
         * The fields that each container row will contain.
         *
         * @access public
         * @var array
         */
        public $fields = array();

        /**
         * Repeater drag and drop controller
         *
         * @since  1.0.0
         */
        public function __construct( $manager, $id, $args = array(), $fields = array() ) {
            $this->fields = $fields;
            $this->news_portal_box_label = $args['news_portal_box_label'] ;
            $this->news_portal_box_add_control = $args['news_portal_box_add_control'];
            parent::__construct( $manager, $id, $args );
        }

        public function render_content() {

            $values = json_decode( $this->value() );
            $repeater_id = $this->id;
            $field_count = count( $values );
        ?>
            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>

            <?php if ( $this->description ){ ?>
                <span class="description customize-control-description">
                    <?php echo wp_kses_post( $this->description ); ?>
                </span>
            <?php } ?>

            <ul class="np-repeater-field-control-wrap">
                <?php $this->news_portal_get_fields(); ?>
            </ul>

            <input type="hidden" <?php esc_attr( $this->link() ); ?> class="np-repeater-collector" value="<?php echo esc_attr( $this->value() ); ?>" />
            <input type="hidden" name="<?php echo esc_attr( $repeater_id ).'_count'; ?>" class="field-count" value="<?php echo absint( $field_count ); ?>">
            <input type="hidden" name="field_limit" class="field-limit" value="5">
            <button type="button" class="button np-repeater-add-control-field"><?php echo esc_html( $this->news_portal_box_add_control ); ?></button>
    <?php
        }

        private function news_portal_get_fields(){
            $fields = $this->fields;
            $values = json_decode( $this->value() );

            if ( is_array( $values ) ){
            foreach( $values as $value ){
        ?>
            <li class="np-repeater-field-control">
            <h3 class="np-repeater-field-title"><?php echo esc_html( $this->news_portal_box_label ); ?></h3>
            
            <div class="np-repeater-fields">
            <?php
                foreach ( $fields as $key => $field ) {
                $class = isset( $field['class'] ) ? $field['class'] : '';
            ?>
                <div class="np-repeater-field np-repeater-type-<?php echo esc_attr( $field['type'] ).' '. esc_attr( $class ); ?>">

                <?php 
                    $label = isset( $field['label'] ) ? $field['label'] : '';
                    $description = isset( $field['description'] ) ? $field['description'] : '';
                    if ( $field['type'] != 'checkbox' ) { 
                ?>
                        <span class="customize-control-title"><?php echo esc_html( $label ); ?></span>
                        <span class="description customize-control-description"><?php echo esc_html( $description ); ?></span>
                <?php 
                    }

                    $new_value = isset( $value->$key ) ? $value->$key : '';
                    $default = isset( $field['default'] ) ? $field['default'] : '';

                    switch ( $field['type'] ) {
                        case 'text':
                            echo '<input data-default="'.esc_attr( $default ).'" data-name="'.esc_attr( $key ).'" type="text" value="'.esc_attr( $new_value ).'"/>';
                            break;

                        case 'url':
                            echo '<input data-default="'.esc_attr( $default ).'" data-name="'.esc_attr( $key ).'" type="text" value="'.esc_url( $new_value ).'"/>';
                            break;

                        case 'social_icon':
                            echo '<div class="np-repeater-selected-icon">';
                            echo '<i class="'.esc_attr( $new_value ).'"></i>';
                            echo '<span><i class="fa fa-angle-down"></i></span>';
                            echo '</div>';
                            echo '<ul class="np-repeater-icon-list np-clearfix">';
                            $news_portal_font_awesome_social_icon_array = news_portal_font_awesome_social_icon_array();
                            foreach ( $news_portal_font_awesome_social_icon_array as $news_portal_font_awesome_icon ) {
                                $icon_class = $new_value == $news_portal_font_awesome_icon ? 'icon-active' : '';
                                echo '<li class='. esc_attr( $icon_class ) .'><i class="'. esc_attr( $news_portal_font_awesome_icon ) .'"></i></li>';
                            }
                            echo '</ul>';
                            echo '<input data-default="'.esc_attr( $default ).'" type="hidden" value="'.esc_attr( $new_value ).'" data-name="'.esc_attr($key).'"/>';
                            break;

                        default:
                            break;
                    }
                ?>
                </div>
                <?php
                } ?>

                <div class="np-clearfix np-repeater-footer">
                    <div class="alignright">
                    <a class="np-repeater-field-remove" href="#remove"><?php esc_html_e( 'Delete', 'news-portal' ) ?></a> |
                    <a class="np-repeater-field-close" href="#close"><?php esc_html_e( 'Close', 'news-portal' ) ?></a>
                    </div>
                </div>
            </div>
            </li>
            <?php   
            }
            }
        }
    } // end News_Portal_Repeater_Controler

/*---------------------------------------------------------------------------------------------------------------*/
   

} //end WP_Customize_Control

