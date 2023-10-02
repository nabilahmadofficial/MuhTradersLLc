<?php 
 
/**
 * OT Widgets being translated:
 */

class WPML_OT_Elements_Compatibility {

  private static $_instance = null;

  public static function instance() {

    if ( is_null( self::$_instance ) ) {
      self::$_instance = new self();
    }
    return self::$_instance;
  }

  private function __construct() {
    
    if ( ! self::is_wpml_active() ) {
      return;
    }

    // Load Elementor files.
    add_action( 'elementor/init', array( $this, 'wpml_compatible_init' ) );

  }

  public function wpml_compatible_init() {

    $this->includes();

    add_filter( 'wpml_elementor_widgets_to_translate', [ $this, 'wpml_ot_widgets' ] );
  }

  /**
   * Is WPML Active
   *
   * Check if WPML Multilingual CMS and WPML String Translation active
   *
   * @access private
   *
   * @return boolean is WPML String Translation
   */
  public static function is_wpml_active() {

    include_once ABSPATH . 'wp-admin/includes/plugin.php';

    $wpml = is_plugin_active( 'sitepress-multilingual-cms/sitepress.php' );

    $wpml_trans = is_plugin_active( 'wpml-string-translation/plugin.php' );

    return $wpml && $wpml_trans;

  }

  /**
   *
   * Includes
   *
   * Integrations class for widgets with complex controls.
   */
  public function includes() {

    include_once 'modules/class-wpml-ot-accordion.php';
    include_once 'modules/class-wpml-ot-accordion-with-icon.php';
    include_once 'modules/class-wpml-ot-big-tabs.php';
    include_once 'modules/class-wpml-ot-tabs.php';
    include_once 'modules/class-wpml-ot-client-carousel.php';
    include_once 'modules/class-wpml-ot-image-carousel.php';
    include_once 'modules/class-wpml-ot-icon-list.php';
    include_once 'modules/class-wpml-ot-photo-collection-slider.php';
    include_once 'modules/class-wpml-ot-progress-bars.php';
    include_once 'modules/class-wpml-ot-team-carousel.php';
    include_once 'modules/class-wpml-ot-testimonial-carousel.php';

  }
  
  public function wpml_ot_widgets($widgets){

    $widgets = $this->ot_heading($widgets);
    $widgets = $this->ot_accordions($widgets);
    $widgets = $this->ot_accordions_with_icon($widgets);
    $widgets = $this->ot_big_tabs($widgets);
    $widgets = $this->ot_tabs($widgets);
    $widgets = $this->ot_button_expand($widgets);
    $widgets = $this->ot_button_play($widgets);
    $widgets = $this->ot_button($widgets);
    $widgets = $this->ot_client_carousel($widgets);
    $widgets = $this->ot_icon_list($widgets);
    $widgets = $this->ot_image_carousel($widgets);
    $widgets = $this->ot_photo_collection_carousel($widgets);
    $widgets = $this->ot_counter($widgets);
    $widgets = $this->ot_features_box($widgets);
    $widgets = $this->ot_icon_box($widgets);
    $widgets = $this->latest_post_slider($widgets);
    $widgets = $this->latest_post_slider2($widgets);
    $widgets = $this->ot_portfolio_slider($widgets);
    $widgets = $this->ot_portfolio_filter($widgets);
    $widgets = $this->ot_portfolio_filter2($widgets);
    $widgets = $this->ot_pricing_table($widgets);
    $widgets = $this->ot_process_box($widgets);
    $widgets = $this->ot_progress($widgets);
    $widgets = $this->ot_signin_signup_form($widgets);
    $widgets = $this->ot_switchs($widgets);
    $widgets = $this->ot_team_carousel($widgets);
    $widgets = $this->ot_team($widgets);
    $widgets = $this->ot_team2($widgets);
    $widgets = $this->ot_testimonial($widgets);
    $widgets = $this->ot_testimonial_carousel($widgets);
    $widgets = $this->ot_text_animation($widgets);
    return $widgets;
  }

  /**
   * Widgets to translate.
   *
   * @access public
   *
   * @param array $widgets Widget array.
   *
   */

  private function ot_accordions_with_icon($widgets){
    $widgets[ 'ot-accordions-wicon' ] = [
      'conditions'    => ['widgetType' => 'ot-accordions-wicon'],
      'fields'            => array(),
      'integration-class' => 'WPML_OT_Accordion_With_Icon',
    ];
    return $widgets;
  }

  private function ot_accordions($widgets){
    $widgets[ 'ot-accordions' ] = [
      'conditions'    => ['widgetType' => 'ot-accordions'],
      'fields'            => array(),
      'integration-class' => 'WPML_OT_Accordion',
    ];
    return $widgets;
  }

  private function ot_button_expand($widgets){
    $widgets[ 'ot-btn-expand' ] = [
      'conditions'    => ['widgetType' => 'ot-btn-expand'],
      'fields'        => [
        [
          'field' => 'text',
          'type'  => __( 'Click here', 'sandbox' ),
          'editor_type'   => 'LINE'
        ],
        'link' => array(
          'field'       => 'url',
          'type'        => __( 'Button: Link URL', 'sandbox' ),
          'editor_type' => 'LINK'
        ),
      ]
    ];
    return $widgets;
  }

  private function ot_button_play($widgets){
    $widgets[ 'ot-btn-play' ] = [
      'conditions'    => ['widgetType' => 'ot-btn-play'],
      'fields'        => [
        [
          'field' => 'text',
          'type'  => __( 'Link Video Here', 'sandbox' ),
          'editor_type'   => 'LINE'
        ],
      ]
    ];
    return $widgets;
  }

  private function ot_button($widgets){
    $widgets[ 'ot-btn' ] = [
      'conditions'    => ['widgetType' => 'ot-btn'],
      'fields'        => [
        [
          'field' => 'text',
          'type'  => __( 'Click here', 'sandbox' ),
          'editor_type'   => 'LINE'
        ],
        'link' => array(
          'field'       => 'url',
          'type'        => __( 'Button: Link URL', 'sandbox' ),
          'editor_type' => 'LINK'
        ),
      ]
    ];
    return $widgets;
  }

  private function ot_client_carousel($widgets){
    $widgets[ 'ot-clients-slider' ] = [
      'conditions'    => ['widgetType' => 'ot-clients-slider'],
      'fields'            => array(),
      'integration-class' => 'WPML_OT_Client_Carousel',
    ];
    return $widgets;
  }

  private function ot_image_carousel($widgets){
    $widgets[ 'ot-images-slider' ] = [
      'conditions'    => ['widgetType' => 'ot-images-slider'],
      'fields'            => array(),
      'integration-class' => 'WPML_OT_Image_Carousel',
    ];
    return $widgets;
  }

  private function ot_icon_list($widgets){
    $widgets[ 'ot-icon-list' ] = [
      'conditions'    => ['widgetType' => 'ot-icon-list'],
      'fields'            => array(),
      'integration-class' => 'WPML_OT_Icon_List',
    ];
    return $widgets;
  }

  private function ot_photo_collection_carousel($widgets){
    $widgets[ 'ot-photo-collection-carousel' ] = [
      'conditions'    => ['widgetType' => 'ot-photo-collection-carousel'],
      'fields'            => array(
        array(
          'field'       => 'caption_hover',
          'type'        => __( 'Caption Image Hover', 'sandbox' ),
          'editor_type' => 'LINE',
        ),
      ),
      'integration-class' => 'WPML_OT_Photo_Collection_Carousel',
    ];
    return $widgets;
  }

  private function ot_counter($widgets){
    $widgets[ 'ot-counter' ] = [
      'conditions'    => ['widgetType' => 'ot-counter'],
      'fields'        => [
        [
          'field' => 'title',
          'type'  => __( 'Title', 'sandbox' ),
          'editor_type'   => 'LINE'
        ],
      ]
    ];
    return $widgets;
  }

  private function ot_features_box($widgets){
    $widgets[ 'ot-features-box' ] = [
      'conditions'    => ['widgetType' => 'ot-features-box'],
      'fields'        => [
        [
          'field' => 'title',
          'type'  => __( 'Title', 'sandbox' ),
          'editor_type'   => 'LINE'
        ],
        [
          'field' => 'caption_hover',
          'type'  => __( 'View Detail', 'sandbox' ),
          'editor_type'   => 'LINE'
        ],
        'link' => array(
          'field'       => 'url',
          'type'        => __( 'Features Box: Link URL', 'sandbox' ),
          'editor_type' => 'LINK'
        ),
      ]
    ];
    return $widgets;
  }

  private function ot_heading($widgets){
    $widgets[ 'ot-heading' ] = [
      'conditions'    => ['widgetType' => 'ot-heading'],
      'fields'        => [
        [
          'field' => 'sub_title',
          'type'  => __( 'Sub heading', 'sandbox' ),
          'editor_type'   => 'LINE'
        ],
        [
          'field' => 'title',
          'type'  => __( 'Heading', 'sandbox' ),
          'editor_type'   => 'LINE'
        ],
      ]
    ];
    return $widgets;
  }

  private function ot_icon_box($widgets){
    $widgets[ 'ot-iconbox' ] = [
      'conditions'    => ['widgetType' => 'ot-iconbox'],
      'fields'        => [
        [
          'field' => 'title',
          'type'  => __( 'Title', 'sandbox' ),
          'editor_type'   => 'LINE'
        ],
        [
          'field'       => 'content',
          'type'        => __( 'Content', 'sandbox' ),
          'editor_type' => 'AREA'
        ],
        'link' => array(
          'field'       => 'url',
          'type'        => __( 'Icon Box Link', 'sandbox' ),
          'editor_type' => 'LINK'
        ),
        [
          'field'       => 'btn_text',
          'type'        => __( 'Button Text', 'sandbox' ),
          'editor_type' => 'LINE'
        ],
      ]
    ];
    return $widgets;
  }

  private function latest_post_slider($widgets){
    $widgets[ 'ot-latest-posts-carousel' ] = [
      'conditions'    => ['widgetType' => 'ot-latest-posts-carousel'],
      'fields'        => [
        [
          'field' => 'caption_hover',
          'type'  => __( 'Read More', 'sandbox' ),
          'editor_type'   => 'LINE'
        ],
      ]
    ];
    return $widgets;
  }

  private function latest_post_slider2($widgets){
    $widgets[ 'ot-latest-posts-carousel_2' ] = [
      'conditions'    => ['widgetType' => 'ot-latest-posts-carousel_2'],
      'fields'        => [
        [
          'field' => 'caption_hover',
          'type'  => __( 'Read More', 'sandbox' ),
          'editor_type'   => 'LINE'
        ],
      ]
    ];
    return $widgets;
  }

  private function ot_portfolio_slider($widgets){
    $widgets[ 'ot-portfolio-carousel' ] = [
      'conditions'    => ['widgetType' => 'ot-portfolio-carousel'],
      'fields'        => [
        [
          'field' => 'caption_hover',
          'type'  => __( 'Read More', 'sandbox' ),
          'editor_type'   => 'LINE'
        ],
      ]
    ];
    return $widgets;
  }

  private function ot_portfolio_filter($widgets){
    $widgets[ 'ot-portfolio-filter' ] = [
      'conditions'    => ['widgetType' => 'ot-portfolio-filter'],
      'fields'        => [
        [
          'field' => 'all_text',
          'type'  => __( 'All', 'sandbox' ),
          'editor_type'   => 'LINE'
        ],
        [
          'field'       => 'load_more',
          'type'        => __( 'Load More', 'sandbox' ),
          'editor_type' => 'LINE'
        ],
      ]
    ];
    return $widgets;
  }

  private function ot_portfolio_filter2($widgets){
    $widgets[ 'ot-portfolio-filter_2' ] = [
      'conditions'    => ['widgetType' => 'ot-portfolio-filter_2'],
      'fields'        => [
        [
          'field' => 'all_text',
          'type'  => __( 'All', 'sandbox' ),
          'editor_type'   => 'LINE'
        ],
        [
          'field'       => 'load_more',
          'type'        => __( 'Load More', 'sandbox' ),
          'editor_type' => 'LINE'
        ],
      ]
    ];
    return $widgets;
  }

  private function ot_pricing_table($widgets){
    $widgets[ 'ot-pricing-table' ] = [
      'conditions'    => ['widgetType' => 'ot-pricing-table'],
      'fields'        => [
        [
          'field' => 'title',
          'type'  => __( 'Title', 'sandbox' ),
          'editor_type'   => 'LINE'
        ],
        [
          'field' => 'price_period_1',
          'type'  => __( 'Price 1', 'sandbox' ),
          'editor_type'   => 'LINE'
        ],
        [
          'field' => 'period_1',
          'type'  => __( 'Period 1', 'sandbox' ),
          'editor_type'   => 'LINE'
        ],
        [
          'field' => 'price_period_2',
          'type'  => __( 'Price 2', 'sandbox' ),
          'editor_type'   => 'LINE'
        ],
        [
          'field' => 'period_2',
          'type'  => __( 'Period 2', 'sandbox' ),
          'editor_type'   => 'LINE'
        ],
        [
          'field'       => 'button_text',
          'type'        => __( 'Button', 'sandbox' ),
          'editor_type' => 'LINE'
        ],
        'btn_link'          => array(
          'field'       => 'url',
          'type'        => __( 'Link Pricing Table:', 'sandbox' ),
          'editor_type' => 'LINE'
        )
      ]
    ];
    return $widgets;
  }

  private function ot_process_box($widgets){
    $widgets[ 'ot-process-box' ] = [
      'conditions'    => ['widgetType' => 'ot-process-box'],
      'fields'        => [
        [
          'field' => 'number_process',
          'type'  => __( 'Number/Text', 'sandbox' ),
          'editor_type'   => 'LINE'
        ],
        [
          'field' => 'title',
          'type'  => __( 'Title', 'sandbox' ),
          'editor_type'   => 'LINE'
        ],
        [
          'field'       => 'content',
          'type'        => __( 'Description', 'sandbox' ),
          'editor_type' => 'AREA'
        ],
      ]
    ];
    return $widgets;
  }

  private function ot_progress($widgets){
    $widgets[ 'ot-progress-bars' ] = [
      'conditions'    => ['widgetType' => 'ot-progress-bars'],
      'fields'            => array(),
      'integration-class' => 'WPML_OT_Progress_Bars',
    ];
    return $widgets;
  }

  private function ot_signin_signup_form($widgets){
    $widgets[ 'ot-userform' ] = [
      'conditions'    => ['widgetType' => 'iprogress'],
      'fields'        => [
        [
          'link_user' => array(
            'field'       => 'url',
            'type'        => __( 'Link to Login/Resgister Page', 'sandbox' ),
            'editor_type' => 'LINK'
          ),
        ],
      ]
    ];
    return $widgets;
  }

  private function ot_switchs($widgets){
    $widgets[ 'ot-switchs' ] = [
      'conditions'    => ['widgetType' => 'ot-switchs'],
      'fields'        => [
        [
          'field' => 'before_text',
          'type'  => __( 'Before', 'sandbox' ),
          'editor_type'   => 'LINE'
        ],
        [
          'field' => 'after_text',
          'type'  => __( 'After', 'sandbox' ),
          'editor_type'   => 'LINE'
        ],
        [
          'field' => 'section_id',
          'type'  => __( 'ID Link', 'sandbox' ),
          'editor_type'   => 'LINE'
        ],
      ]
    ];
    return $widgets;
  }

  private function ot_big_tabs($widgets){
    $widgets[ 'ot-big-tabs' ] = [
      'conditions'    => ['widgetType' => 'ot-big-tabs'],
      'fields'            => array(),
      'integration-class' => 'WPML_OT_Big_Tabs',
    ];
    return $widgets;
  }

  private function ot_tabs($widgets){
    $widgets[ 'ot-tabs' ] = [
      'conditions'    => ['widgetType' => 'ot-tabs'],
      'fields'            => array(),
      'integration-class' => 'WPML_OT_Tabs',
    ];
    return $widgets;
  }

  private function ot_team_carousel($widgets){
    $widgets[ 'ot-team-slider' ] = [
      'conditions'    => ['widgetType' => 'ot-team-slider'],
      'fields'            => array(),
      'integration-class' => 'WPML_OT_Team_Carousel',
    ];
    return $widgets;
  }

  private function ot_team($widgets){
    $widgets[ 'ot-team' ] = [
      'conditions'    => ['widgetType' => 'ot-team'],
      'fields'        => [
        [
          'field' => 'member_name',
          'type'  => __( 'Name', 'sandbox' ),
          'editor_type'   => 'LINE'
        ],
        [
          'field'       => 'member_extra',
          'type'        => __( 'Extra/Job', 'sandbox' ),
          'editor_type' => 'AREA'
        ],
        'link'          => array(
          'field'       => 'url',
          'type'        => __( 'Link', 'sandbox' ),
          'editor_type' => 'LINE'
        )
      ]
    ];
    return $widgets;
  }

  private function ot_team2($widgets){
    $widgets[ 'ot-team2' ] = [
      'conditions'    => ['widgetType' => 'ot-team2'],
      'fields'        => [
        [
          'field' => 'member_name',
          'type'  => __( 'Name', 'sandbox' ),
          'editor_type'   => 'LINE'
        ],
        [
          'field'       => 'member_extra',
          'type'        => __( 'Extra/Job', 'sandbox' ),
          'editor_type' => 'AREA'
        ],
        [
          'field'       => 'member_desc',
          'type'        => __( 'Extra/Job', 'sandbox' ),
          'editor_type' => 'AREA'
        ],
        'link'          => array(
          'field'       => 'url',
          'type'        => __( 'Link', 'sandbox' ),
          'editor_type' => 'LINE'
        )
      ]
    ];
    return $widgets;
  }

  private function ot_testimonial($widgets){
    $widgets[ 'ot-testimonials' ] = [
      'conditions'    => ['widgetType' => 'ot-testimonials'],
      'fields'        => [
        [
          'field' => 'tcontent',
          'type'  => __( 'Content', 'sandbox' ),
          'editor_type'   => 'AREA'
        ],
        [
          'field'       => 'tname',
          'type'        => __( 'Name', 'sandbox' ),
          'editor_type' => 'LINE'
        ],
        [
          'field'       => 'tjob',
          'type'        => __( 'Job', 'sandbox' ),
          'editor_type' => 'LINE'
        ],
      ]
    ];
    return $widgets;
  }

  private function ot_testimonial_carousel($widgets){
    $widgets[ 'ot-testimonials-carousel' ] = [
      'conditions'    => ['widgetType' => 'ot-testimonials-carousel'],
      'fields'            => array(),
      'integration-class' => 'WPML_OT_Testimonial_Carousel',
    ];
    return $widgets;
  }

  private function ot_text_animation($widgets){
    $widgets[ 'ot-text-animation' ] = [
      'conditions'    => ['widgetType' => 'ot-text-animation'],
      'fields'        => [
        [
          'field' => 'text',
          'type'  => __( 'Text', 'sandbox' ),
          'editor_type'   => 'LINE'
        ],
        [
          'field'       => 'text_typer',
          'type'        => __( 'Text Animation', 'sandbox' ),
          'editor_type' => 'LINE'
        ],
      ]
    ];
    return $widgets;
  }
}

WPML_OT_Elements_Compatibility::instance();
