<?php
/**
 * Testimonial slider widget class
 *
 * @package AddonsKit
 */
namespace AddonsKit\Elementor\Widget;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use Elementor\Repeater;
use \Elementor\Core\Schemes\Typography;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Widget_Base;

defined( 'ABSPATH' ) || die();

class Section_title extends Widget_Base{

	public function get_name(){
		return 'addonskit-section-title';
	}

	public function get_title(){
		return esc_html__('Addonskit Section Title', 'addonskit-elementor');
	}

	public function get_icon(){
		return 'eicon-t-letter';
	}

	public function get_categories(){
		return ['addonskit'];
	}

	public function get_keywords(){
		return [
			'title',
            'section title',
            'propuls title'
		];
	}

	public function get_style_depends(){
		return [
			'addonskit-section-title'
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
			'title', [
				'label'       => esc_html__( 'Title', 'addonskit-elementor' ),
				'type'        => \Elementor\Controls_Manager::TEXTAREA,
				'label_block' => true,
			]
		);

        $this->add_control(
			'title_layout', [
				'label'       => esc_html__( 'Title style', 'addonskit-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => [
					'' => esc_html__( 'Default', 'addonskit-elementor' ),
					'style-1' => esc_html__( 'Style 1', 'addonskit-elementor' ),
					'style-2'  => esc_html__( 'Style 2', 'addonskit-elementor' ),
					'style-3' => esc_html__( 'Style 3', 'addonskit-elementor' ),
				],
			]
		);

        $this->add_control(
			'title_tag', [
				'label'       => esc_html__( 'Title tag', 'addonskit-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'h2',
				'options' => [
					''   => esc_html__( 'Default', 'addonskit-elementor' ),
					'h1' => esc_html__( 'H1', 'addonskit-elementor' ),
					'h2' => esc_html__( 'H2', 'addonskit-elementor' ),
					'h3' => esc_html__( 'H3', 'addonskit-elementor' ),
					'h4' => esc_html__( 'H4', 'addonskit-elementor' ),
					'h5' => esc_html__( 'H5', 'addonskit-elementor' ),
					'h6' => esc_html__( 'H6', 'addonskit-elementor' ),
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
				'selector'       => '{{WRAPPER}} .addonskit-section-title',
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
					'{{WRAPPER}} .addonskit-section-title' => 'color: {{VALUE}} ',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'title-background',
				'types' => ['gradient'],
				'selector' => '{{WRAPPER}} .addonskit-section-title',
			]
		);

		$this->add_control(
			'separator_style',
			[
				'type'      => \Elementor\Controls_Manager::HEADING,
				'label'     => esc_html__( 'Separator style', 'addonskit-elementor' ),
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'separator_background',
				'types' => ['gradient'],
				'selector' => '{{WRAPPER}} .addonskit-section-title-border',
			]
		);

		$this->end_controls_section();
	}

	protected function render(){
        $settings = $this->get_settings_for_display();

        $title_tag  = ! empty( $settings['title_tag'] ) ? $settings['title_tag'] : 'h2';
        $title      = ! empty( $settings['title'] ) ? $settings['title'] : '';
        $layout     = ! empty( $settings['title_layout'] ) ? $settings['title_layout'] : 'style-1';
		?>
        <div class="addonskit-section-title-wrap addonskit-section-title-<?php echo esc_attr( $layout );?>">
			<?php printf('<%s class="addonskit-section-title">%s</%s>', esc_attr($title_tag), esc_html( $title ), esc_attr( $title_tag ));?>
        </div>
		<?php
	}
}
