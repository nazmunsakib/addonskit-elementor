<?php
/**
 * Testimonial slider widget class
 *
 * @package ProPulse
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
		return esc_html__('Addonskit Section Title', '');
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
				'label' => esc_html__( 'Content', 'pro' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		
		$this->add_control(
			'title', [
				'label'       => esc_html__( 'Title', 'ropulse-core' ),
				'type'        => \Elementor\Controls_Manager::TEXTAREA,
				'label_block' => true,
			]
		);

        $this->add_control(
			'title_layout', [
				'label'       => esc_html__( 'Title style', 'ropulse-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => [
					'' => esc_html__( 'Default', 'addonskit-kit-elementor' ),
					'style-1' => esc_html__( 'Style 1', 'addonskit-kit-elementor' ),
					'style-2'  => esc_html__( 'Style 2', 'addonskit-kit-elementor' ),
					'style-3' => esc_html__( 'Style 3', 'addonskit-kit-elementor' ),
				],
			]
		);

        $this->add_control(
			'title_tag', [
				'label'       => esc_html__( 'Title tag', 'ropulse-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'h2',
				'options' => [
					''   => esc_html__( 'Default', 'addonskit-kit-elementor' ),
					'h1' => esc_html__( 'H1', 'addonskit-kit-elementor' ),
					'h2' => esc_html__( 'H2', 'addonskit-kit-elementor' ),
					'h3' => esc_html__( 'H3', 'addonskit-kit-elementor' ),
					'h4' => esc_html__( 'H4', 'addonskit-kit-elementor' ),
					'h5' => esc_html__( 'H5', 'addonskit-kit-elementor' ),
					'h6' => esc_html__( 'H6', 'addonskit-kit-elementor' ),
				],
			]
		);
		
		$this->end_controls_section();

		$this->start_controls_section(
			'title_style_tab',
			[
				'label' => esc_html__( 'Title Style', 'ropulse-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'title_style',
			[
				'type'      => \Elementor\Controls_Manager::HEADING,
				'label'     => esc_html__( 'Title', 'ropulse-core' ),
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'           => 'title_typography',
				'label'          => esc_html__( 'Typography', 'ropulse-core' ),
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
				'label'     => esc_html__( 'Title Color', 'ropulse-core' ),
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
				'label'     => esc_html__( 'Separator style', 'ropulse-core' ),
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
		$wave_first_color = ! empty( $settings['separator_background_color'] ) ? $settings['separator_background_color'] : '#47479F';
		$wave_second_color = ! empty( $settings['separator_background_color_b'] ) ? $settings['separator_background_color_b'] : '#9191D7';

		$wave = sprintf('<svg width="21" height="5" viewBox="0 0 21 5" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path d="M8.74504 4.99895C11.9277 5.08795 12.4158 -0.526047 14.6346 3.04432C15.5697 4.69087 17.928 5.59801 19.7203 4.20478C20.3191 3.73238 21.0081 3.01351 20.9999 2.29122C21.0081 1.47993 19.6014 1.16158 19.0928 1.83936C18.8344 2.1988 18.5596 2.59931 18.1987 2.86974C16.6115 3.972 16.4187 -0.0159945 13.2976 0.00112134C12.0261 -0.0365335 10.7875 0.880876 10.1723 1.74009C9.91803 1.95918 9.03213 3.44141 8.57278 3.10594C8.0478 2.69516 7.62126 2.16114 7.19062 1.66478C6.2268 0.607023 4.33196 0.497481 3.20819 1.43201C2.9416 1.64767 2.74063 1.89756 2.51506 2.13033C2.43303 2.21249 2.28948 2.22276 2.19105 2.15772C2.17054 2.14403 2.15414 2.12691 2.14183 2.10979C1.78091 1.62713 1.29695 1.28823 0.554604 1.60659C-0.86857 2.3768 0.755571 4.03019 1.97368 4.17739C2.88008 4.28009 3.63473 3.94119 4.25814 3.26683C4.46731 3.05459 4.62316 2.69858 4.95947 2.64723C5.74694 2.38365 6.36624 4.97841 8.74504 4.99895Z" fill="url(#paint0_linear_3843_2454)"/>
			<defs>
			<linearGradient id="paint0_linear_3843_2454" x1="17.9521" y1="9.1438" x2="1.93811" y2="-2.63498" gradientUnits="userSpaceOnUse">
				<stop stop-color="%s"/>
				<stop offset="1" stop-color="%s"/>
			</linearGradient>
			</defs>
		</svg>', esc_attr( $wave_first_color ), esc_attr( $wave_second_color ) );
		?>
        <div class="addonskit-section-title-wrap addonskit-section-title-<?php echo esc_attr( $layout );?>">
            <?php if( 'style-1' == $layout ) { echo $wave; } ?>

			<?php printf('<%s class="addonskit-section-title">%s</%s>', esc_attr($title_tag), esc_html( $title ), esc_attr( $title_tag ));?>

			<?php if( 'style-1' == $layout || 'style-2' == $layout ) echo $wave; ?>

			<?php if( 'style-3' == $layout ) { echo '<span class="addonskit-section-title-border"></span>'; } ?>
        </div>
		<?php
	}
}
