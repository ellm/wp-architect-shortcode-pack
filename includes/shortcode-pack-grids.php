<?php 

/**
* Grid Short Code
*/
if ( ! class_exists( 'GridClass' ) ) {
	class GridClass {
		
		public function __construct() {
			add_filter( 'the_content', array( $this, 'wp_arch_add_sc_content_filter' ) );
			add_shortcode( 'col-wrap', array( $this, 'wp_arch_add_sc_gridcolwrap' ) );
			add_shortcode( 'col', array( $this, 'wp_arch_add_sc_gridcol' ) );
		}

		// Remove empty p tags for within shortcodes
		// https://gist.github.com/bitfade/4555047
		function wp_arch_add_sc_content_filter($content) {
			// array of custom shortcodes requiring the fix
			$block = join("|",array("col","col-wrap"));
			// opening tag
			$rep = preg_replace("/(<p>)?\[($block)(\s[^\]]+)?\](<\/p>|<br \/>)?/","[$2$3]",$content);
			// closing tag
			$rep = preg_replace("/(<p>)?\[\/($block)](<\/p>|<br \/>)?/","[/$2]",$rep);
			return $rep;
		}

		// Col Wrap
		function wp_arch_add_sc_gridcolwrap ( $args, $content = null ) {
			// Attributes
				extract( shortcode_atts(
					array(
						'class' => '',
						'width' => ''
					), $args )
				);
			return '<div class="col-wrap ' . $class . '" style="max-width:' . $width . '" >' . do_shortcode($content) . '</div>';
		}

		// Col
		function wp_arch_add_sc_gridcol ( $args, $content = null ) {
			return '<div class="col">' . do_shortcode($content) . '</div>';
		}
	}
	new GridClass;
}