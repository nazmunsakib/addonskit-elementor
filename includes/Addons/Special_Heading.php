<?php
/**
 * Testimonial slider widget class
 *
 * @package AddonsKit
 */
namespace AddonsKitElementor\Addons;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use Elementor\Repeater;
use \Elementor\Core\Schemes\Typography;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Widget_Base;

defined( 'ABSPATH' ) || die();

class Special_heading extends Widget_Base{

	public function get_name(){
		return 'addonskit-special-heading';
	}

	public function get_title(){
		return esc_html__('Addonskit Multi Color Heading', 'addonskit-elementor');
	}

	public function get_icon(){
		return 'eicon-animation-text';
	}

	public function get_categories(){
		return ['addonskit'];
	}

	public function get_keywords(){
		return [
			'title',
			'heading',
            'special title',
            'propuls title',
            'propuls heading'
		];
	}

	public function get_style_depends(){
		return [
			'addonskit-special-heading',
		];
	}

	public function get_script_depends(){
		return [];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'title_tab',
			[
				'label' => esc_html__( 'Content', 'addonskit-elementor' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		
		$this->add_control(
			'title_first', [
				'label'       => esc_html__( 'Title (First part)', 'addonskit-elementor' ),
				'type'        => \Elementor\Controls_Manager::TEXTAREA,
				'label_block' => true,
			]
		);

		$this->add_control(
			'title_middle', [
				'label'       => esc_html__( 'Title (Middle part)', 'addonskit-elementor' ),
				'type'        => \Elementor\Controls_Manager::TEXTAREA,
				'label_block' => true,
			]
		);

		$this->add_control(
			'title_last', [
				'label'       => esc_html__( 'Title (Last part)', 'addonskit-elementor' ),
				'type'        => \Elementor\Controls_Manager::TEXTAREA,
				'label_block' => true,
			]
		);

        $this->add_control(
			'title_tag', [
				'label'   => esc_html__( 'Title tag', 'addonskit-elementor' ),
				'type' 	  => \Elementor\Controls_Manager::SELECT,
				'default' => 'h1',
				'options' => [
					''		=> esc_html__( 'Default', 'addonskit-elementor' ),
					'h1'	=> esc_html__( 'H1', 'addonskit-elementor' ),
					'h2'  	=> esc_html__( 'H2', 'addonskit-elementor' ),
					'h3' 	=> esc_html__( 'H3', 'addonskit-elementor' ),
					'h4' 	=> esc_html__( 'H4', 'addonskit-elementor' ),
					'h5' 	=> esc_html__( 'H5', 'addonskit-elementor' ),
					'h6' 	=> esc_html__( 'H6', 'addonskit-elementor' ),
				],
			]
		);
		
		
		$this->end_controls_section();

		
		$this->start_controls_section(
			'title_style_tab',
			[
				'label' => esc_html__( 'Title Style', 'addonskit-elementor' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'title_style',
			[
				'type'      => \Elementor\Controls_Manager::HEADING,
				'label'     => esc_html__( 'Title', 'addonskit-elementor' ),
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'           => 'title_typography',
				'label'          => esc_html__( 'Typography', 'addonskit-elementor' ),
				'selector'       => '{{WRAPPER}} .addonskit-special-title',
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
				'label'     => esc_html__( 'Title Color', 'addonskit-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .addonskit-special-title' => 'color: {{VALUE}} ',
				],
			]
		);

		$this->add_control(
			'title_first_part_heading',
			[
				'label' => esc_html__('First part style', 'addonskit-elementor'),
				'type' => Controls_Manager::HEADING,
			]
		);

        $this->add_control(
			'first_span_color',
			[
				'label'     => esc_html__( 'Color', 'addonskit-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .addonskit-special-title .special-title-first' => 'color: {{VALUE}} ',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'first_span_border',
				'selector' => '{{WRAPPER}} .addonskit-special-title .special-title-first',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'           => 'first_part_typography',
				'label'          => esc_html__( 'Typography', 'addonskit-elementor' ),
				'selector'       => '{{WRAPPER}} .addonskit-special-title .special-title-first',
				'fields_options' => [
					'typography' => [
						'default' => 'custom',
					],
				],
			]
		);

		$this->add_control(
			'title_middle_part_heading',
			[
				'label' => esc_html__('Middle part style', 'addonskit-elementor'),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'middle_span_color',
			[
				'label'     => esc_html__( 'Title first middle color', 'addonskit-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .addonskit-special-title .special-title-middle' => 'color: {{VALUE}} ',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'middle_span_border',
				'selector' => '{{WRAPPER}} .addonskit-special-title .special-title-middle',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'           => 'middle_part_typography',
				'label'          => esc_html__( 'Typography', 'addonskit-elementor' ),
				'selector'       => '{{WRAPPER}} .addonskit-special-title .special-title-middle',
				'fields_options' => [
					'typography' => [
						'default' => 'custom',
					],
				],
			]
		);

		$this->add_control(
			'title_last_part_heading',
			[
				'label' => esc_html__('Last part style', 'addonskit-elementor'),
				'type' => Controls_Manager::HEADING,
			]
		);

        $this->add_control(
			'last_span_color',
			[
				'label'     => esc_html__( 'Color', 'addonskit-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .addonskit-special-title .special-title-last' => 'color: {{VALUE}} ',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'last_span_border',
				'selector' => '{{WRAPPER}} .addonskit-special-title .special-title-last',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'           => 'last_part_typography',
				'label'          => esc_html__( 'Typography', 'addonskit-elementor' ),
				'selector'       => '{{WRAPPER}} .addonskit-special-title .special-title-last',
				'fields_options' => [
					'typography' => [
						'default' => 'custom',
					],
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render(){
        $settings = $this->get_settings_for_display();
		$title_first = ! empty( $settings['title_first'] ) ? $settings['title_first'] : '';
		$title_middle = ! empty( $settings['title_middle'] ) ? $settings['title_middle'] : '';
		$title_last = ! empty( $settings['title_last'] ) ? $settings['title_last'] : '';
        $title_tag = ! empty( $settings['title_tag'] ) ? $settings['title_tag'] : 'h2';
		?>

        <div class="addonskit-special-title-wrap">
			 <?php
				printf('<%s class="addonskit-special-title">', esc_html( $title_tag ) );

				if( $title_first || $title_middle || $title_middle ){
					printf('<span class="special-title-first">%s</span> <span class="special-title-middle">%s</span> <span class="special-title-last">%s</span>', esc_html( $title_first ), esc_html( $title_middle ), esc_html( $title_last ) );
				}

				printf('</%s>', esc_html( $title_tag ));
			 ?>
        </div>
	<?php
	}
}
