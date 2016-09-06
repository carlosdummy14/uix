<?php
/**
 * UIX Post Type
 *
 * @package   uix2
 * @author    David Cramer
 * @license   GPL-2.0+
 * @link
 * @copyright 2016 David Cramer
 */
namespace uix2\ui;

/**
 * UIX Post Type class
 * @package uix2\ui
 * @author  David Cramer
 */
class post_type extends uix{

    /**
     * The type of object
     *
     * @since 2.0.0
     * @access public
     * @var      string
     */
    public $type = 'post';


    /**
     * setup actions and hooks to register post types
     *
     * @since 2.0.0
     * @access protected
     */
    protected function actions() {

        // run parent actions ( keep 'admin_head' hook )
        parent::actions();
        // add settings page
        add_action( 'init', array( $this, 'render' ) );

    }


    /**
     * Render the custom header styles
     *
     * @since 2.0.0
     * @access protected
     */
    protected function enqueue_active_assets(){
        // output the styles
        if( !empty( $this->struct['base_color'] ) ){
        ?><style type="text/css">
            .contextual-help-tabs .active {
                border-left: 6px solid <?php echo $this->struct['base_color']; ?> !important;
            }
            #wpbody-content .wrap > h1 {
                box-shadow: 0 0 2px rgba(0, 2, 0, 0.1),11px 0 0 <?php echo $this->struct['base_color']; ?> inset;
            }
            #wpbody-content .wrap > h1 a.page-title-action:hover{
                background: <?php echo $this->struct['base_color']; ?>;
                border-color: <?php echo $this->struct['base_color']; ?>;
            }
            #wpbody-content .wrap > h1 a.page-title-action:focus{
                box-shadow: 0 0 2px <?php echo $this->struct['base_color']; ?>;
                border-color: <?php echo $this->struct['base_color']; ?>;
            }
        </style>
        <?php
        }
    }

    /**
     * Define core UIX styling to identify UIX post types
     *
     * @since 2.0.0
     * @access public
     */
    public function uix_styles() {
        $pages_styles = array(
            'post'    =>  $this->url . 'assets/css/uix-post' . $this->debug_styles . '.css',           
        );
        $this->styles( $pages_styles );
    }

    /**
     * Render (register) the post type
     *
     * @since 2.0.0
     * @access public
     */
    public function render() {

        if( !empty( $this->struct['settings'] ) ){
            register_post_type( $this->slug, $this->struct['settings'] );
        }

    }

    /**
     * Determin which post types are active and set them active and render some styling
     * Intended to be ovveridden
     * @since 2.0.0
     * @access public
     */
    public function is_active(){
        
        if( !is_admin() ){ return false; }

        $screen = get_current_screen();

        // check the screen is valid and is a uix post type page
        if( !is_object( $screen ) || empty( $screen->post_type ) || $screen->post_type !== $this->slug ){
            return parent::is_active();
        }
        return true;
    }

}