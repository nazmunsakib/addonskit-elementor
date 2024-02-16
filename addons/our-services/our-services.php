<?php
/**
 * Testimonial slider widget class
 *
 * @package ProPulse
 */
namespace AddonsKit\Elementor\Widget;

use \Elementor\Controls_Manager;
use \Elementor\Core\Schemes\Typography;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Widget_Base;
use \WP_Query;

defined( 'ABSPATH' ) || die();

class Our_Services extends Widget_Base{

	public function get_name(){
		return 'addonskit-our-services';
	}

	public function get_title(){
		return esc_html__('Our Services', 'propuls-core');
	}

	public function get_icon(){
		return 'eicon-apps';
	}

	public function get_categories(){
		return ['addonskit'];
	}

	public function get_keywords(){
		return [
			'Services',
			'Our service',
            'Propulse service',
		];
	}

	public function get_style_depends(){
		return [
			'addonskit-service',
		];
	}

	public function get_script_depends(){
		return [];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'service_tab',
			[
				'label' => esc_html__( 'Content', 'pro' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		
		$this->add_control(
			'service_per_page', [
				'label'   => esc_html__( 'Service per page', 'addonskit-kit-elementor' ),
				'type'    => \Elementor\Controls_Manager::NUMBER,
				'default' => 6,
			]
		);

		$this->add_control(
			'icon_position', [
				'label'   => esc_html__( 'Icon position', 'addonskit-kit-elementor' ),
				'type' 	  => \Elementor\Controls_Manager::SELECT,
				'default' => 'top-left',
				'options' => [
					''          => esc_html__( 'Default', 'paddonskit-kit-elementor' ),
					'top-left'  => esc_html__( 'Top left', 'paddonskit-kit-elementor' ),
					'top-right' => esc_html__( 'Top right', 'paddonskit-kit-elementor' ),
					'left'      => esc_html__( 'Left', 'paddonskit-kit-elementor' ),
				],
			]
		);

		$this->add_control(
			'link_text', [
				'label'       => esc_html__( 'Link text', 'addonskit-kit-elementor' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__( 'Read More', 'addonskit-kit-elementor' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'link_icon',
			[
				'label' => esc_html__( 'Link Icon', 'addonskit-kit-elementor' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-chevron-right',
					'library' => 'fa-solid',
				],
			]
		);
		
		$this->end_controls_section();



		$this->start_controls_section(
			'service_box',
			[
				'label' => esc_html__( 'Service box style', 'addonskit-kit-elementor' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'box_bg',
			[
				'label'     => esc_html__( 'Box background', 'addonskit-kit-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .addonskit-service-list-item' => 'background-color: {{VALUE}} ',
				],
			]
		);

		$this->add_control(
			'box_padding',
			[
				'label' => esc_html__( 'Padding', 'addonskit-kit-elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'default' => [
					'top' => 0,
					'right' => 0,
					'bottom' => 0,
					'left' => 0,
					'unit' => 'px',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .addonskit-service-list-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'box_border',
				'selector' => '{{WRAPPER}} .addonskit-service-list-item',
			]
		);

		$this->end_controls_section();

		
		$this->start_controls_section(
			'content_style_tab',
			[
				'label' => esc_html__( 'Content Style', 'addonskit-kit-elementor' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_style',
			[
				'type'      => \Elementor\Controls_Manager::HEADING,
				'label'     => esc_html__( 'Title', 'addonskit-kit-elementor' ),
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'           => 'title_typography',
				'label'          => esc_html__( 'Typography', 'addonskit-kit-elementor' ),
				'selector'       => '{{WRAPPER}} .addonskit-service-content h2',
				'fields_options' => [
					'typography' => [
						'default' => 'custom',
					],
				],
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__( 'Title Color', 'addonskit-kit-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .addonskit-service-content h2 a' => 'color: {{VALUE}} ',
				],
			]
		);

		$this->add_control(
			'content_style',
			[
				'type'      => \Elementor\Controls_Manager::HEADING,
				'label'     => esc_html__( 'Content', 'addonskit-kit-elementor' ),
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'           => 'content_typography',
				'label'          => esc_html__( 'Typography', 'addonskit-kit-elementor' ),
				'selector'       => '{{WRAPPER}} .addonskit-service-content p',
				'fields_options' => [
					'typography' => [
						'default' => 'custom',
					],
				],
			]
		);

		$this->add_control(
			'content_color',
			[
				'label'     => esc_html__( 'Content Color', 'addonskit-kit-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .addonskit-service-content p' => 'color: {{VALUE}} ',
				],
			]
		);

		$this->add_control(
			'link_style',
			[
				'type'      => \Elementor\Controls_Manager::HEADING,
				'label'     => esc_html__( 'Link style', 'addonskit-kit-elementor' ),
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'           => 'link_typography',
				'label'          => esc_html__( 'Typography', 'addonskit-kit-elementor' ),
				'selector'       => '{{WRAPPER}} a.addonskit-service-read-more',
				'fields_options' => [
					'typography' => [
						'default' => 'custom',
					],
				],
			]
		);

		$this->add_control(
			'link_color',
			[
				'label'     => esc_html__( 'Content Color', 'addonskit-kit-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} a.addonskit-service-read-more' => 'color: {{VALUE}} ',
				],
			]
		);
		
		$this->end_controls_section();
	}

	protected function render(){
        $settings = $this->get_settings_for_display();
		$service_to_show = ! empty( $settings['service_per_page'] ) ? $settings['service_per_page'] : 6;
		$icon_position = ! empty( $settings['icon_position'] ) ? $settings['icon_position'] : 'top-left';
		$link_text = ! empty( $settings['link_text'] ) ? $settings['link_text'] : '';
		$link_icon = ! empty( $settings['link_icon'] ) ? $settings['link_icon'] : '';

		$args = array(
			'post_type' => 'services',
			'posts_per_page' => $service_to_show
		);

		$services = new WP_Query( $args );

		if( $services->have_posts() ) :
			?>
			<div class="addonskit-service-list-wrap">
				<div class="row">
					<?php
					while( $services->have_posts() ) :
						$services->the_post();
						$icon_id = '';
						$short_desc = '';
						?>
						<div <?php post_class('addonskit-service-list-item col-lg-4 col-md-6 service-icon-'.esc_attr( $icon_position ));?>>
							<div class="addonskit-servce-list-inner">
								<div class="addonskit-service-icon">
									<?php
										if( $icon_id ){
											echo wp_get_attachment_image( $icon_id, 'thumbnail', true );
										}
									?>
								</div>
								<div class="addonskit-service-content">
									<h2 class="addonskit-service-title">
										<a href="<?php the_permalink();?>"><?php the_title();?></a>
									</h2>
									<?php
										if( ! empty( $short_desc ) ){
											printf('<p>%s</p>', esc_html( $short_desc ));
										}
									?>

									<?php if( ! empty( $link_text ) ) : ?>
										<div class="addonskit-service-link-area">
											<a href="<?php the_permalink(); ?>" class="addonskit-service-read-more">
												<?php 
													echo esc_html( $link_text );

													if( !empty( $link_icon ) ){
														\Elementor\Icons_Manager::render_icon( $link_icon, [ 'aria-hidden' => 'true' ] );
													}
												?>
												<?php   ?>
											</a>
										</div>
									<?php endif; ?>
								</div>
							</div>
						</div>
						<?php 
					endwhile; 
					wp_reset_postdata();
					?>
				</div>
			</div>
		<?php
		else :
			printf('<p class="addonskit-not-found-text">%s</p>', esc_html__( 'Services not found. Please add services from Services post type', 'addonskit-kit-elementor' ) );
		endif;
	}
}
