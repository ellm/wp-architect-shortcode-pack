<?php

if ( ! class_exists( 'UtilityClass' ) ) {
	class UtilityClass {
		
		public function __construct() {
			add_shortcode( 'email', array( $this, 'wpcodex_hide_email_shortcode' ) );
		}

		/**
		 * Hide email from Spam Bots using a shortcode.
		 *
		 * @param array  $atts    Shortcode attributes. Not used.
		 * @param string $content The shortcode content. Should be an email address.
		 *
		 * @return string The obfuscated email address. 
		 */
		function wpcodex_hide_email_shortcode( $atts , $content = null ) {
			if ( ! is_email( $content ) ) {
				return;
			}

			return '<a href="mailto:' . antispambot( $content ) . '">' . antispambot( $content ) . '</a>';
		}
	}
	new UtilityClass;
}

