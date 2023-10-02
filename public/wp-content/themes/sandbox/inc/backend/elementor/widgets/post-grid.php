<?php 
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Sandbox_Post_Grid
 */
class Sandbox_Post_Grid extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'ot-post-grid';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'OT Post Grid', 'sandbox' );
	}

	// The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
	public function get_icon() {
		return 'eicon-posts-grid';
	}

	// The get_categories method, lets you set the category of the widget, return the category name as a string.
	public function get_categories() {
		return [ 'category_sandbox' ];
	}

	protected function register_controls() {

		//Content Service box
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Post Grid', 'sandbox' ),
			]
		);

		$this->add_control(
			'post_cat',
			[
				'label' => __( 'Select Categories', 'sandbox' ),
				'type' => Controls_Manager::SELECT2,
				'options' => $this->select_param_cate_post(),
				'multiple' => true,
				'label_block' => true,
				'placeholder' => __( 'All Categories', 'sandbox' ),
			]
		);
		$this->add_control(
			'column',
			[
				'label' => __( 'Columns', 'sandbox' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'pf_3_cols',
				'options' => [
					'pf_1_cols' => __( '1 Column', 'sandbox' ),
					'pf_2_cols' => __( '2 Column', 'sandbox' ),
					'pf_3_cols'	=> __( '3 Column', 'sandbox' ),
					'pf_4_cols' => __( '4 Column', 'sandbox' ),
				],
			]
		);	
		$this->add_control(
			'number_show',
			[
				'label' => __( 'Show Number Posts', 'sandbox' ),
				'type' => Controls_Manager::NUMBER,
				'default' => '3',
			]
		);

        $this->add_control(
            'show_pagination',
            [
                'label' => __('Show Pagination', 'sandbox'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'sandbox'),
                'label_off' => __('No', 'sandbox'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

		$this->end_controls_section();

		/*Style*/
		$this->start_controls_section(
			'style_section',
			[
				'label' => __( 'General', 'sandbox' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'post_padd',
			[
				'label' => __( 'Padding', 'sandbox' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .post-box .inner-post' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'post_spacing',
			[
				'label' => __( 'Spacing', 'sandbox' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .blog-grid .post-box' => 'padding: 0 calc({{SIZE}}{{UNIT}}/2);',
					'{{WRAPPER}} .blog-grid' => 'margin: 0 calc(-{{SIZE}}{{UNIT}}/2);',
					'{{WRAPPER}} .post-box .post-inner' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'post_bgcolor',
			[
				'label' => __( 'Background', 'sandbox' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .post-box .post-inner' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'post_box_shadow',
				'selector' => '{{WRAPPER}} .post-box .post-inner',
			]
		);

		$this->end_controls_section();

		//Content Style
		$this->start_controls_section(
			'content_style',
			[
				'label' => __( 'Content', 'sandbox' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);
		$this->add_control(
			'heading_meta',
			[
				'label' => __( 'Entry Meta', 'sandbox' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'meta_padd',
			[
				'label' => __( 'Padding', 'sandbox' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .post-box .entry-meta' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'meta_color',
			[
				'label' => __( 'Color', 'sandbox' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .post-box .entry-meta, {{WRAPPER}} .post-box .entry-meta a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'meta_hcolor',
			[
				'label' => __( 'Hover Color', 'sandbox' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .post-box .entry-meta a:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'meta_typography',
				'selector' => '{{WRAPPER}} .post-box .post-meta',
			]
		);
		$this->add_control(
            'show_date',
            [
                'label' => __('Show Date', 'sandbox'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'sandbox'),
                'label_off' => __('No', 'sandbox'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'show_author',
            [
                'label' => __('Show Author', 'sandbox'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'sandbox'),
                'label_off' => __('No', 'sandbox'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'show_comment',
            [
                'label' => __('Show Comment', 'sandbox'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'sandbox'),
                'label_off' => __('No', 'sandbox'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

		$this->add_control(
			'heading_title',
			[
				'label' => __( 'Title', 'sandbox' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'title_spacing',
			[
				'label' => __( 'Spacing', 'sandbox' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .post-box .entry-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'sandbox' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .entry-title a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'title_hcolor',
			[
				'label' => __( 'Hover Color', 'sandbox' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .entry-title a:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .entry-title',
			]
		);
		$this->add_control(
			'heading_cate',
			[
				'label' => __( 'Category', 'sandbox' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'cate_spacing',
			[
				'label' => __( 'Spacing', 'sandbox' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .post-cates' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'cate_color',
			[
				'label' => __( 'Color', 'sandbox' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .post-cates a' => 'color: {{VALUE}};',
					'{{WRAPPER}} .text-line:before' => 'background: {{VALUE}};',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'cate_typography',
				'selector' => '{{WRAPPER}} .post-cates',
			]
		);
		$this->add_control(
			'heading_exc',
			[
				'label' => __( 'Excerpt', 'sandbox' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'exc_color',
			[
				'label' => __( 'Color', 'sandbox' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .the-excerpt' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'exc_typography',
				'selector' => '{{WRAPPER}} .the-excerpt',
			]
		);

		$this->end_controls_section();

		// Arrow.
		$this->start_controls_section(
			'style_pagination',
			[
				'label' => __( 'Pagination', 'sandbox' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_pagination' => 'yes',
				]
			]
		);
		
		$this->add_control(
			'pagi_color',
			[
				'label' => __( 'Color', 'sandbox' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .page-pagination li a, {{WRAPPER}} .page-pagination li span' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'pagi_hcolor',
			[
				'label' => __( 'Hover', 'sandbox' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .page-pagination li span, {{WRAPPER}} .page-pagination li a:hover' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'pagi_bgcolor',
			[
				'label' => __( 'Background Color', 'sandbox' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .page-pagination li a, {{WRAPPER}} .page-pagination li span' => 'background: {{VALUE}};',
				]
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$number_show = (!empty($settings['number_show']) ? $settings['number_show'] : 9);
    	$exc = (!empty($settings['exc']) ? $settings['exc'] : 15);

    	if ( get_query_var('paged') ) {
		    $paged = get_query_var('paged');
		} elseif ( get_query_var('page') ) { // 'page' is used instead of 'paged' on Static Front Page
		    $paged = get_query_var('page');
		} else {
		    $paged = 1;
		}

    	if( $settings['post_cat'] ){
            $args = array(
            	'paged' => $paged,
	            'post_type' => 'post',
	            'post_status' => 'publish',
	            'posts_per_page' => $number_show,
	            'tax_query' => array(
			        array(
			            'taxonomy' => 'category',
			            'field'    => 'slug',
			            'terms'    => $settings['post_cat']
			        ),
			    ),
			    // 'author__in' => $settings['list_authors']
	        );
        }else{
            $args = array(
            	'paged' => $paged,
                'post_type' => 'post',
	            'post_status' => 'publish',
	            'posts_per_page' => $number_show,
	            // 'author__in' => $settings['list_authors']
            );
        }
        $class_meta = '';
        'yes' !== $settings['show_date'] ? $class_meta .= 'hidden-date ' : '';
        'yes' !== $settings['show_author'] ? $class_meta .= 'hidden-author ' : '';
        'yes' !== $settings['show_comment'] ? $class_meta .= 'hidden-comment ' : '';

        $this->add_render_attribute( 'blog_grid', 'class', ['blog-grid', $class_meta, $settings['column']] );

        $the_query = new \WP_Query($args);

        if( $the_query->have_posts() ) : ?>
			<div <?php echo $this->get_render_attribute_string( 'blog_grid' ); ?>>
	        	<?php
		        	while( $the_query->have_posts() ) : $the_query->the_post();

			            /*
						 * Include the Post-Type-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
						 */
						get_template_part( 'template-parts/content', get_post_type() );
						
			        endwhile; wp_reset_postdata(); 
		        ?>
		    </div>
		    <?php if ( 'yes' === $settings['show_pagination'] ) { 
			    $prev = '<i class="uil uil-arrow-left"></i>'; 
		        $next = '<i class="uil uil-arrow-right"></i>';
		        $pagination = array(
		            'base'      => str_replace( 999999999, '%#%', get_pagenum_link( 999999999 ) ),
		            'format' 	=> '?paged=%#%',
		            'current' 	=> max( 1, $paged ),
		            'total' 	=> $the_query->max_num_pages,
		            'prev_text' => $prev,
		            'next_text' => $next,
		            'type'      => 'list',
		            'end_size'  => 3,
		            'mid_size'  => 3
		        );
		        $return =  paginate_links( $pagination );
		        echo str_replace( "<ul class='page-numbers'>", '<ul class="page-pagination none-style">', $return );
		    }

		endif; 
	}

	protected function select_param_cate_post() {
		$args = array( 'orderby=name&order=ASC&hide_empty=0' );
		$terms = get_terms( 'category', $args );
		$cat = array();
		if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){		    
		    foreach ( $terms as $term ) {
		        $cat[$term->slug] = $term->name;
		    }
		}
	  	return $cat;
	}

	
}
// After the Sandbox_Post_Grid class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Sandbox_Post_Grid() );