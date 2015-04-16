<?php

if ( ! class_exists( 'UtilityClass' ) ) {
	class UtilityClass {
		
		public function __construct() {
			add_filter( 'the_content', array( $this, 'wp_arch_add_sc_content_filter' ) );
			add_shortcode( 'email', array( $this, 'wpcodex_hide_email_shortcode' ) );
			add_shortcode( 'lightbox', array( $this, 'wp_arch_lightbox_img_shortcode' ) );
		}

		// Remove empty p tags for within shortcodes
		// https://gist.github.com/bitfade/4555047
		function wp_arch_add_sc_content_filter($content) {
			// array of custom shortcodes requiring the fix
			$block = join("|",array("col","col-wrap","accordions","accordion-title","accordion-block"));
			// opening tag
			$rep = preg_replace("/(<p>)?\[($block)(\s[^\]]+)?\](<\/p>|<br \/>)?/","[$2$3]",$content);
			// closing tag
			$rep = preg_replace("/(<p>)?\[\/($block)](<\/p>|<br \/>)?/","[/$2]",$rep);
			return $rep;
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

