<?php

if ( ! class_exists( 'UtilityClass' ) ) {
	class UtilityClass {
		
		public function __construct() {
			add_shortcode( 'email', array( $this, 'wpcodex_hide_email_shortcode' ) );
			add_shortcode( 'lightbox', array( $this, 'wp_arch_lightbox_img_shortcode' ) );
		}

		/**
		 * Hide email from Spam Bots using a shortcode.
		 */
		function wpcodex_hide_email_shortcode( $atts , $content = null ) {
			if ( ! is_email( $content ) ) {
				return;
			}

			return '<a href="mailto:' . antispambot( $content ) . '">' . antispambot( $content ) . '</a>';
		}

		/**
		 * Open image in a lightbox
		 */
		
		function wp_arch_lightbox_img_shortcode( $atts, $content = null ) {
			extract( shortcode_atts(
				array(
					'url' => ''
				), $atts )
			);
			return '<a href="#" data-featherlight="' . $url .'">' . do_shortcode( $content ) . '</a>';
		}
	}
	new UtilityClass;
}

