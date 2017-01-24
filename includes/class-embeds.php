<?php
/**
 * Knight Lab Storytelling Tools Embeds
 *
 * @since NEXT
 * @package Knight Lab Storytelling Tools
 */

/**
 * Knight Lab Storytelling Tools Embeds.
 *
 * @since NEXT
 */
class KLST_Embeds {
	/**
	 * Parent plugin class
	 *
	 * @var   Knight_Lab_Storytelling_Tools
	 * @since NEXT
	 */
	protected $plugin = null;

	/**
	 * Constructor
	 *
	 * @since  NEXT
	 * @param  Knight_Lab_Storytelling_Tools $plugin Main plugin object.
	 * @return void
	 */
	public function __construct( $plugin ) {
		$this->plugin = $plugin;
		$this->hooks();
	}

	/**
	 * Initiate our hooks
	 *
	 * @since  NEXT
	 * @return void
	 */
	public function hooks() {
		wp_embed_register_handler(
			'knight-lab-timeline',
			'#https://cdn\.knightlab\.com/libs/timeline3/latest/embed/index\.html\?source=([a-zA-Z0-9_-]+)&font=([a-zA-Z0-9_-]+)&lang=([a-zA-Z0-9-]+)&initial_zoom=([\d]+)&height=([\d]+)#i',
			array( $this, 'wp_embed_knight_lab_timeline' )
		);
	}

	public function wp_embed_knight_lab_timeline( $matches, $attr, $url, $rawattr ) {
		$embed = sprintf(
			'<iframe src="https://cdn.knightlab.com/libs/timeline3/latest/embed/index.html?source=%1$s&font=%2$s&lang=%3$s&initial_zoom=%4$s&height=%5$s" width="100%%" height="650" webkitallowfullscreen mozallowfullscreen allowfullscreen frameborder="0"></iframe>',
			esc_attr( $matches[1] ),
			esc_attr( $matches[2] ),
			esc_attr( $matches[3] ),
			esc_attr( $matches[4] ),
			esc_attr( $matches[5] )
		);

		return apply_filters( 'embed_forbes', $embed, $matches, $attr, $url, $rawattr );
	}
}
