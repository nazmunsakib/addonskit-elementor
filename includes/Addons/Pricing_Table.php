<?php

/**
 * Testimonial slider widget class
 *
 * @package AddonsKit
 */
namespace AddonsKitElementor\Addons;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Repeater;
use \Elementor\Widget_Base;

defined( 'ABSPATH' ) || die();

class Pricing_Table extends Widget_Base {

    public function get_name(){
        return 'addonskit-pricing-table';
    }

    public function get_title()
    {
        return esc_html__('Pricing Table', 'addonskit-elementor');
    }

    public function get_icon(){
        return 'eaicon-pricing-table';
    }

    public function get_categories(){
        return ['addonskit'];
    }

    public function get_style_depends(){
		return [
			'addonskit-pricing-table',
		];
	}


    public function get_keywords(){
        return [
            'price menu',
            'pricing',
            'price',
            'price table',
            'table',
            'pricing plan',
            'addonskit pricing',
        ];
    }

    /**
     * Pricing Table Settings
     */
    protected function addonskit_table_pricing_settings() {
        $this->start_controls_section(
            'addonskit_section_pricing_table_settings',
            [
                'label' => esc_html__('Settings', 'addonskit-elementor'),
            ]
        );

        $pricing_style = apply_filters(
            'addonskit_pricing_table_styles',
            [
                'styles'     => [
                    'style-1' => esc_html__('Default', 'addonskit-elementor'),
                    'style-2' => esc_html__('Pricing Style 2', 'addonskit-elementor'),
                    'style-3' => esc_html__('Pricing Style 3 ', 'addonskit-elementor'),
                ]
            ]
        );

        $this->add_control(
            'addonskit_pricing_table_style',
            [
                'label'       => esc_html__('Pricing Style', 'addonskit-elementor'),
                'type'        => Controls_Manager::SELECT,
                'default'     => 'style-1',
                'label_block' => false,
                'options'     => $pricing_style['styles'],
            ]
        );

        $this->add_control(
            'addonskit_pricing_table_icon_enabled',
            [
                'label'        => esc_html__('List Icon', 'addonskit-elementor'),
                'type'         => Controls_Manager::SWITCHER,
                'return_value' => 'show',
                'default'      => 'show',
            ]
        );

        $this->add_control(
            'addonskit_pricing_table_icon_placement',
            [
                'label'       => esc_html__('List Icon Placement', 'addonskit-elementor'),
                'type'        => Controls_Manager::SELECT,
                'default'     => 'left',
                'label_block' => false,
                'options'     => [
                    'left'  => esc_html__('Left', 'addonskit-elementor'),
                    'right' => esc_html__('Right', 'addonskit-elementor'),
                ],
                'condition'   => [
                    'addonskit_pricing_table_icon_enabled' => 'show',
                ],
            ]
        );

        $this->add_control(
            'addonskit_pricing_table_title',
            [
                'label'       => esc_html__('Title', 'addonskit-elementor'),
                'type'        => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'label_block' => false,
                'default'     => esc_html__('Startup', 'addonskit-elementor'),
                'ai' => [
					'active' => false,
				],
            ]
        );

        /**
         * Condition: 'addonskit_pricing_table_style' => 'style-2'
         */
        $subtitles_fields = apply_filters('pricing_table_subtitle_field_for', ['style-1']);
        $this->add_control(
            'addonskit_pricing_table_sub_title',
            [
                'label'       => esc_html__('Sub Title', 'addonskit-elementor'),
                'type'        => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'label_block' => false,
                'default'     => esc_html__('A tagline here.', 'addonskit-elementor'),
                'condition'   => [
                    'addonskit_pricing_table_style' => $subtitles_fields,
                ],
                'ai' => [
					'active' => false,
				],
            ]
        );

        $this->add_control(
            'addonskit_pricing_table_icon',
            [
                'label'            => esc_html__('Icon', 'addonskit-elementor'),
                'type'             => Controls_Manager::ICONS,
                'default'          => [
                    'value'   => 'fas fa-home',
                    'library' => 'fa-solid',
                ],
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Pricing Table Price
     */
    protected function addonskit_pricing_table_price() {
        $this->start_controls_section(
            'addonskit_section_pricing_table_price',
            [
                'label' => esc_html__('Price', 'addonskit-elementor'),
            ]
        );

        $this->add_control(
            'addonskit_pricing_table_price',
            [
                'label'       => esc_html__('Price', 'addonskit-elementor'),
                'type'        => Controls_Manager::TEXT,
                'dynamic'               => [
                    'active'       => true,
                ],
                'label_block' => false,
                'default'     => esc_html__('99', 'addonskit-elementor'),
                'ai' => [
					'active' => false,
				],
            ]
        );

        $this->add_control(
            'addonskit_pricing_table_price_cur',
            [
                'label'       => esc_html__('Price Currency', 'addonskit-elementor'),
                'type'        => Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'label_block' => false,
                'default'     => esc_html__('$', 'addonskit-elementor'),
                'ai' => [
					'active' => false,
				],
            ]
        );

        $this->add_control(
            'addonskit_pricing_table_price_period',
            [
                'label'       => esc_html__('Price Period (per)', 'addonskit-elementor'),
                'type'        => Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'label_block' => false,
                'default'     => esc_html__('month', 'addonskit-elementor'),
                'ai' => [
					'active' => false,
				],
            ]
        );

        $this->add_control(
            'addonskit_pricing_table_period_separator',
            [
                'label'       => esc_html__('Period Separator', 'addonskit-elementor'),
                'type'        => Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'label_block' => false,
                'default'     => esc_html__('/', 'addonskit-elementor'),
                'ai' => [
					'active' => false,
				],
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Pricing Table Feature
     */
    protected function addonskit_pricing_table_feature() {
        $this->start_controls_section(
            'addonskit_section_pricing_table_feature',
            [
                'label' => esc_html__('Feature', 'addonskit-elementor'),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'addonskit_pricing_table_item',
            [
                'label'       => esc_html__( 'List Item', 'addonskit-elementor' ),
                'type'        => Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'label_block' => true,
                'default'     => esc_html__( 'Pricing table list item', 'addonskit-elementor' ),
                'ai' => [
					'active' => false,
				],
            ]
        );

        $repeater->add_control(
            'addonskit_pricing_table_list_icon',
            [
                'label'            => esc_html__( 'List Icon', 'addonskit-elementor' ),
                'type'             => Controls_Manager::ICONS,
                'default'          => [
                    'value'   => 'fas fa-check',
                    'library' => 'fa-solid',
                ],
            ]
        );

        $this->add_control(
            'addonskit_pricing_table_items',
            [
                'type'        => Controls_Manager::REPEATER,
                'seperator'   => 'before',
                'default'     => [
                    ['addonskit_pricing_table_item' => 'Unlimited calls'],
                    ['addonskit_pricing_table_item' => 'Free hosting'],
                    ['addonskit_pricing_table_item' => '500 MB of storage space'],
                    ['addonskit_pricing_table_item' => '500 MB Bandwidth'],
                    ['addonskit_pricing_table_item' => '24/7 support'],
                ],
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{addonskit_pricing_table_item}}',
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Pricing Table Footer
     */
    protected function addonskit_pricing_table_footerr() {
        $this->start_controls_section(
            'addonskit_section_pricing_table_footerr',
            [
                'label' => esc_html__('Button', 'addonskit-elementor'),
            ]
        );

        $this->add_control(
            'addonskit_pricing_table_button_show',
            [
                'label'        => __('Display Button', 'addonskit-elementor'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __('Show', 'addonskit-elementor'),
                'label_off'    => __('Hide', 'addonskit-elementor'),
                'return_value' => 'yes',
                'default'      => 'yes',
                'selectors'    => [
                    '{{WRAPPER}} .addonskit-pricing-button' => 'display: inline-block;',
                ],
            ]
        );

        $this->add_control(
            'addonskit_pricing_table_button_icon',
            [
                'label'            => esc_html__('Button Icon', 'addonskit-elementor'),
                'type'             => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-chevron-right',
					'library' => 'fa-solid',
				],
                'condition'        => [
                    'addonskit_pricing_table_button_show' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'addonskit_pricing_table_button_icon_alignment',
            [
                'label'     => esc_html__('Icon Position', 'addonskit-elementor'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'left',
                'options'   => [
                    'left'  => esc_html__('Before', 'addonskit-elementor'),
                    'right' => esc_html__('After', 'addonskit-elementor'),
                ],
                'condition' => [
                    'addonskit_pricing_table_button_show'      => 'yes',
                ],
            ]
        );

        $this->add_control(
            'addonskit_pricing_table_btn',
            [
                'label'       => esc_html__('Button Text', 'addonskit-elementor'),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'dynamic' => ['active' => true],
                'default'     => esc_html__('Choose Plan', 'addonskit-elementor'),
                'condition'   => [
                    'addonskit_pricing_table_button_show' => 'yes',
                ],
                'ai' => [
					'active' => false,
				],
            ]
        );

        $this->add_control(
            'addonskit_pricing_table_btn_link',
            [
                'label'         => esc_html__('Button Link', 'addonskit-elementor'),
                'type'          => Controls_Manager::URL,
                'dynamic'   => ['active' => true],
                'label_block'   => true,
                'default'       => [
                    'url'         => '#',
                    'is_external' => '',
                ],
                'show_external' => true,
                'condition'     => [
                    'addonskit_pricing_table_button_show' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Tab Style (Pricing Table Style)
     */
    protected function addonskit_pricing_table_style_settings() {
        $this->start_controls_section(
            'addonskit_section_pricing_table_style_settings',
            [
                'label' => esc_html__('Pricing Table Style', 'addonskit-elementor'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'addonskit_pricing_table_bg_color',
            [
                'label'     => esc_html__('Background Color', 'addonskit-elementor'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .addonskit-pricing .addonskit-pricing-item' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'addonskit_pricing_table_container_padding',
            [
                'label'      => esc_html__('Padding', 'addonskit-elementor'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .addonskit-pricing .addonskit-pricing-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'addonskit_pricing_table_container_margin',
            [
                'label'      => esc_html__('Margin', 'addonskit-elementor'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .addonskit-pricing .addonskit-pricing-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'addonskit_pricing_table_border',
                'label'    => esc_html__('Border Type', 'addonskit-elementor'),
                'selector' => '{{WRAPPER}} .addonskit-pricing .addonskit-pricing-item',
            ]
        );

        $this->add_control(
            'addonskit_pricing_table_border_radius',
            [
                'label'     => esc_html__('Border Radius', 'addonskit-elementor'),
                'type'      => Controls_Manager::SLIDER,
                'default'   => [
                    'size' => 4,
                ],
                'range'     => [
                    'px' => [
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}' => 'border-radius: {{SIZE}}px;',
                    '{{WRAPPER}} .addonskit-pricing' => 'border-radius: {{SIZE}}px;',
                    '{{WRAPPER}} .addonskit-pricing .addonskit-pricing-item' => 'border-radius: {{SIZE}}px;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'      => 'addonskit_pricing_table_shadow',
                'selectors' => [
                    '{{WRAPPER}} .addonskit-pricing .addonskit-pricing-item',
                ],
            ]
        );

        $this->add_responsive_control(
            'addonskit_pricing_table_content_alignment',
            [
                'label'        => esc_html__('Content Alignment', 'addonskit-elementor'),
                'type'         => Controls_Manager::CHOOSE,
                'label_block'  => true,
                'options'      => [
                    'left'   => [
                        'title' => esc_html__('Left', 'addonskit-elementor'),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'addonskit-elementor'),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right'  => [
                        'title' => esc_html__('Right', 'addonskit-elementor'),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'default'      => 'center',
            ]
        );

        $this->add_responsive_control(
            'addonskit_pricing_table_content_button_alignment',
            [
                'label'        => esc_html__('Button Alignment', 'addonskit-elementor'),
                'type'         => Controls_Manager::CHOOSE,
                'label_block'  => true,
                'options'      => [
                    'left'   => [
                        'title' => esc_html__('Left', 'addonskit-elementor'),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'addonskit-elementor'),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right'  => [
                        'title' => esc_html__('Right', 'addonskit-elementor'),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'default'      => 'center',
            ]
        );

        $this->end_controls_section();
    }


    protected function register_controls(){
        $this->addonskit_table_pricing_settings();
        $this->addonskit_pricing_table_price();
        $this->addonskit_pricing_table_feature();
        $this->addonskit_pricing_table_footerr();

        $this->addonskit_pricing_table_style_settings();
    }

    protected function render(){
        $settings = $this->get_settings_for_display();
        $prising_style = $settings['addonskit_pricing_table_style'];
        $title = $settings['addonskit_pricing_table_title'] ?? '';
        $sub_title = $settings['addonskit_pricing_table_sub_title'] ?? '';
        $pric = $settings['addonskit_pricing_table_price'];
        $currency = $settings['addonskit_pricing_table_price_cur'] ?? '';
        $period = $settings['addonskit_pricing_table_price_period'] ?? '';
        $separator = $settings['addonskit_pricing_table_period_separator'];
        $list_icon_placement = !empty( $settings['addonskit_pricing_table_icon_placement'] ) ? $settings['addonskit_pricing_table_icon_placement'] : 'left';
        $table_icon = $settings['addonskit_pricing_table_icon'];
        $pricing_featured = $settings['addonskit_pricing_table_items'];
        $button_icon_position = $settings['addonskit_pricing_table_button_icon_alignment'];
        $button_text = $settings['addonskit_pricing_table_btn'];
        $button_icon = $settings['addonskit_pricing_table_button_icon'];
        $button_link = $settings['addonskit_pricing_table_btn_link'];
        ?>
        <div class="addonskit-pricing <?php echo esc_attr( $prising_style ); ?>">
                <div class="addonskit-pricing-item">
                    <div class="addonskit-pricing-header">
                        <?php if( 'style-2' ==  $prising_style ) : ?>
                            <div class="addonskit-icon-price">
                                <h3 class="addonskit-pricing-tag">
                                    <span class="addonskit-pricing-currency"><?php echo esc_html( $currency ); ?></span>
                                    <span class="addonskit-pricing-price"><?php echo esc_html( $pric ); ?></span>
                                    <span class="addonskit-pricing-separator"><?php echo esc_html( $separator ); ?></span>
                                    <span class="addonskit-pricing-period"><?php echo esc_html( $period ); ?></span>
                                </h3>
                                <h2 class="addonskit-pricing-title"><?php echo esc_html( $title ); ?></h2>
                            </div>
                            <div class="addonskit-pricing-icon">
                                <?php Icons_Manager::render_icon( $table_icon, [ 'aria-hidden' => 'true' ] ); ?>
                            </div>
                            
                        <?php elseif( 'style-3' ==  $prising_style ) : ?>
                            <h2 class="addonskit-pricing-title"><?php echo esc_html( $title ); ?></h2>
                            <h3 class="addonskit-pricing-tag">
                                <span class="addonskit-pricing-currency"><?php echo esc_html( $currency ); ?></span>
                                <span class="addonskit-pricing-price"><?php echo esc_html( $pric); ?></span>
                                <span class="addonskit-pricing-separator"><?php echo esc_html( $separator ); ?></span>
                                <span class="addonskit-pricing-period"><?php echo esc_html( $period ); ?></span>
                            </h3>
                            <div class="addonskit-pricing-icon">
                                <?php Icons_Manager::render_icon( $table_icon, [ 'aria-hidden' => 'true' ] ); ?>
                            </div>
                        <?php else: ?>
                            <h2 class="addonskit-pricing-title"><?php echo esc_html( $title ); ?></h2>
                            <div class="addonskit-icon-price">
                                <div class="addonskit-pricing-icon">
                                    <?php Icons_Manager::render_icon( $table_icon, [ 'aria-hidden' => 'true' ] ); ?>
                                </div>
                                <h3 class="addonskit-pricing-tag">
                                    <span class="addonskit-pricing-currency"><?php echo esc_html( $currency ); ?></span>
                                    <span class="addonskit-pricing-price"><?php echo esc_html( $pric); ?></span>
                                    <span class="addonskit-pricing-separator"><?php echo esc_html( $separator ); ?></span>
                                    <span class="addonskit-pricing-period"><?php echo esc_html( $period ); ?></span>
                                </h3>
                            </div>
                            <span class="addonskit-pricing-sub-title"><?php echo esc_html( $sub_title ); ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="addonskit-pricing-info">
                        <ul class="addonskit-icon-placement-<?php echo esc_attr( $list_icon_placement ); ?>">
                            <?php
                           $counter = 0;
                            foreach ( $pricing_featured as $item ) :
                                ?>
                                <li class="pricing-feature-item item_<?php  echo esc_attr( $counter ); ?>">
                                    <?php if( 'show' === $settings['addonskit_pricing_table_icon_enabled'] && 'left' === $list_icon_placement  ) : ?>
                                        <?php Icons_Manager::render_icon( $item['addonskit_pricing_table_list_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                    <?php endif; ?>
                                    
                                    <span><?php echo esc_html( $item['addonskit_pricing_table_item'] ); ?></span>

                                    <?php if( 'show' === $settings['addonskit_pricing_table_icon_enabled'] && 'right' === $list_icon_placement  ) : ?>
                                        <?php Icons_Manager::render_icon( $item['addonskit_pricing_table_list_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                    <?php endif; ?>
                                </li>
                                <?php
                            $counter++;
                            endforeach;
                            ?>
                        </ul>
                    </div>

                    <?php if( 'yes' === $settings['addonskit_pricing_table_button_show'] ) :?>
                        <div class="addonskit-pricing-footer">
                            <a href="<?php echo esc_url( $button_link['url'] ); ?>" class="addonskit-pricing-link link-icon-align-<?php echo esc_attr( $button_icon_position );?>">
                                <?php if( 'left' === $button_icon_position ) : ?>
                                    <?php Icons_Manager::render_icon( $button_icon, [ 'aria-hidden' => 'true' ] ); ?>
                                <?php endif; ?>
                                
                                <span><?php echo esc_html( $button_text  ); ?></span>

                                <?php if('right' === $button_icon_position ) : ?>
                                    <?php Icons_Manager::render_icon( $button_icon, [ 'aria-hidden' => 'true' ] ); ?>
                                <?php endif; ?>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php
    }
}

