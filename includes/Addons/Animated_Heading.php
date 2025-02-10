<?php

/**
 * Testimonial slider widget class
 *
 * @package AddonsKit
 */
namespace AddonsKitElementor\Addons;

use \Elementor\Group_Control_Typography;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Controls_Manager;
use \AddonsKitElementor\Traits\Utilities;
use \Elementor\Widget_Base;

defined( 'ABSPATH' ) || die();

class Animated_Heading extends Widget_Base {

    use Utilities;

    public function get_name() {
        return 'addonskit-animated-heading';
    }

    public function get_title() {
        return esc_html__( 'Animated Heading', 'addonskit-elementor' );
    }

    public function get_icon() {
        return 'eicon-t-letter';
    }

    public function get_categories() {
        return [ 'addonskit' ];
    }

    public function get_keywords() {
        return [
            'title',
            'animated title',
            'animated heading',
        ];
    }

    public function get_style_depends() {
        return ['addonskit-animation'];
    }

    public function get_script_depends() {
        return ['gsap', 'anime', 'addonskit-animation'];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'heading_tab',
            [
                'label' => esc_html__( 'Heading', 'addonskit-elementor' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title', [
                'label'       => esc_html__( 'Title', 'addonskit-elementor' ),
                'type'        => Controls_Manager::TEXTAREA,
                'default'     => esc_html__( 'Default Heading', 'addonskit-elementor' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'animation_type', [
                'label'   => esc_html__( 'Animation Type', 'addonskit-elementor' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    ''         => esc_html__( 'none', 'addonskit-elementor' ),
                    'ake-simple-fade'  => esc_html__( 'Simple Fade', 'addonskit-elementor' ),
                    'ake-lbl-fade'  => esc_html__( 'Letter By Letter Fade', 'addonskit-elementor' ),
                    'ake-glow-reveal'  => esc_html__( 'Glow Reveal', 'addonskit-elementor' ),
                    'ake-lift-fade'  => esc_html__( 'Lift Fade', 'addonskit-elementor' ),
                    'ake-slide-fade'  => esc_html__( 'Slide Fade', 'addonskit-elementor' ),
                ],
            ]
        );

        $this->add_control(
            'title_tag', [
                'label'   => esc_html__( 'Title tag', 'addonskit-elementor' ),
                'type'    => Controls_Manager::SELECT,
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

        $this->add_control(
			'heading_link',
			[
				'label'       => esc_html__( 'Link', 'addonskit-elementor' ),
				'type'        => Controls_Manager::URL,
				'options'     => [ 'url', 'is_external', 'nofollow' ],
				'default'     => [
					'url'         => '',
					'is_external' => true,
					'nofollow'    => true,
				],
				'label_block' => false,
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label'     => esc_html__( 'Alignment', 'addonskit-elementor' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'left'   => [
						'title' => esc_html__( 'Left', 'addonskit-elementor' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'addonskit-elementor' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right'  => [
						'title' => esc_html__( 'Right', 'addonskit-elementor' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'default'   => '',
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
				],
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
            'heading_style_tab',
            [
                'label' => esc_html__( 'Heading Style', 'addonskit-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_style',
            [
                'type'      => Controls_Manager::HEADING,
                'label'     => esc_html__( 'Title', 'addonskit-elementor' ),
                'separator' => 'before',
            ]
        );

		$this->add_control(
			'heading_color',
			[
				'label'     => esc_html__( 'Color', 'addonskit-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'render_type' => 'template',
				'selectors' => [
					'{{WRAPPER}} .ake-animated-heading, .ake-animated-heading a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'heading_typo',
				'selector' => '{{WRAPPER}} .ake-animated-heading, .ake-animated-heading a ',
			]
		);

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        $title_tag          = !empty( $settings['title_tag'] ) ? $settings['title_tag'] : 'h2';
        $title              = !empty( $settings['title'] ) ? $settings['title'] : '';
        $animation_type     = !empty( $settings['animation_type'] ) ? $settings['animation_type'] : '';

		$this->add_render_attribute( 'wrapper', array(
			'class' => 'ake-animated-heading ' . $animation_type,
		) );
        ?>
        <<?php $this->print_html_tag( $title_tag ); ?> <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
        <?php if( 'ake-lift-fade' == $animation_type): ?>
            <span class="ake-text-wrapper">
        <?php endif; ?>
		<?php
            if ( ! empty( $settings['heading_link']['url'] ) ) {
                $this->add_link_attributes( 'heading_link', $settings['heading_link'] );
                ?>
                <a <?php $this->print_render_attribute_string( 'heading_link' ); ?>>
                    <?php echo esc_html( $title ); ?>
                </a>
                <?php
            } else {
                echo esc_html( $title );
            }
		?>
        <?php if( 'ake-lift-fade' == $animation_type): ?>
            </span>
        <?php endif; ?>
        </<?php $this->print_html_tag( $title_tag ); ?>>
        <?php
    }
}