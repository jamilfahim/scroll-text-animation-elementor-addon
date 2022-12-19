<?php
namespace Jhfahim_Addon;

use Elementor\Widget_Base;
use Elementor\Repeater;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor Hero Section Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Timeline_Widget extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve oEmbed widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'Scroll-Text-Animation';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Hero Section widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Scroll Text Animation', 'jhfahim' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Hero Section widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-animation-text';
	}

	/**
	 * Get custom help URL.
	 *
	 * Retrieve a URL where the user can get more information about the widget.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget help URL.
	 */
	public function get_custom_help_url() {
		return 'https://developers.elementor.com/docs/widgets/';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the oEmbed widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'general' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the oEmbed widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return [ 'Scroll Text Animation', 'url', 'link' ];
	}

	/**
	 * Register oEmbed widget controls.
	 *
	 * Add input fields to allow the user to customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'dazzel-text-section',
			[
				'label' => esc_html__( 'Content', 'jhfahim' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'dazell_title',
			[
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'label' => esc_html__( 'Text', 'textdomain' ),
				'placeholder' => esc_html__( 'Enter your text', 'textdomain' ),
				'default' => esc_html__( 'Enter your text', 'textdomain' ),
			]
		);

      

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'label' => esc_html__( 'Typography', 'textdomain' ),
				'selector' => '{{WRAPPER}} .split-lines',
			]
		);
		
		$this->add_control(
			'alignment',
			[
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'label' => esc_html__( 'Alignment', 'textdomain' ),
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'textdomain' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'textdomain' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'textdomain' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'center',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .dazzel-text .split-lines' => 'text-align: {{VALUE}};',
				],
			]
		);

	
		$this->add_control(
			'content_color',
			[
				'label' => esc_html__( 'Text Color', 'elementor-list-widget' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#000',
				'selectors' => [
					'{{WRAPPER}} .dazzel-text .split-lines' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'opacity_color',
			[
				'label' => esc_html__( 'Overlay color', 'elementor-list-widget' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#000',
				'selectors' => [
					'{{WRAPPER}} .line-mask' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'overley_opacity',
			[
				'label' => esc_html__( 'Opacity', 'elementor-list-widget' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					
						'min' => 0.1,
						'max' => 10,
				
					
				],
				'default' => [
					'size' => 0.65,
				],
				
				'selectors' => [
					// '{{WRAPPER}} .elementor-list-widget' => 'padding-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .line-mask' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_control(
			'fill_speed',
			[
				'label' => esc_html__( 'Fill Speed', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 100,
				'default' => 1,
			]
		);

		$this->end_controls_section();


	}

	/**
	 * Render oEmbed widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();
		$content = $settings['dazell_title'];
		$output='';
	  $output.='  <div class="dazzel-text">
	  <div class="heading_wrap">
			<h1 class="split-lines"> '.$content.'  </h1>
	  </div>
	  </div> ';

	echo $output;

	?>
<script>
  (function($) {
  $(document).ready(function() {
		$(document).ready(function () {
			 'use strict';
  
			 function setFontSize() {
				let maxWidth = 1560;
				let windowWidth = $(window).width();
				if (windowWidth >= maxWidth || windowWidth < 992) {
					 $('body').removeAttr("style");
				} else {
					 let fontSize = (windowWidth / 100) / 16;
					 $('body').css('font-size', fontSize + "rem");
				}
		  }
		  setFontSize();
		  window.addEventListener("resize", function() {
				setFontSize();
		  });


			 let typeSplit;
			 // Split the text up
			 function runSplit() {
				  typeSplit = new SplitType(".split-lines", {
						types: "lines, words"
						
				  });
				  $(".line").append("<div class='line-mask'></div>");
				  createAnimation();
			 }
			 runSplit();
			 // Update on window resize
			 let windowWidth = $(window).innerWidth();
			 window.addEventListener("resize", function() {
				  if (windowWidth !== $(window).innerWidth()) {
						windowWidth = $(window).innerWidth();
						typeSplit.revert();
						runSplit();
				  }
			 });
		  
			 gsap.registerPlugin(ScrollTrigger);
		  
			 function createAnimation() {
				  $(".line").each(function(index) {
						let tl = gsap.timeline({
							 scrollTrigger: {
								  trigger: $(this),
								  // trigger element - viewport
								  start: "top center",
								  end: "bottom center",
								  scrub:<?php echo $settings['fill_speed']?>
							 }
						});
						tl.to($(this).find(".line-mask"), {
							 width: "0%",
							 duration: 1
						});
				  });
			 }

		});
  })
})(jQuery);
</script>
	<?php

	}

}