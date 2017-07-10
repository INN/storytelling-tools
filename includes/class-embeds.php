<?php
/**
 * Knight Lab Storytelling Tools Embeds.
 *
 * @since   1.0.0
 * @package Knight_Lab_Storytelling_Tools
 */

/**
 * Knight Lab Storytelling Tools Embeds.
 *
 * @since 1.0.0
 */
class KLST_Embeds {
	/**
	 * Parent plugin class.
	 *
	 * @since 1.0.0
	 *
	 * @var   Knight_Lab_Storytelling_Tools
	 */
	protected $plugin = null;

	/**
	 * Constructor.
	 *
	 * @since  1.0.0
	 *
	 * @param  Knight_Lab_Storytelling_Tools $plugin Main plugin object.
	 */
	public function __construct( $plugin ) {
		$this->plugin = $plugin;
		$this->hooks();
	}

	/**
	 * Initiate our hooks.
	 *
	 * @since  1.0.0
	 */
	public function hooks() {
		wp_embed_register_handler(
			'knight-lab-timeline',
			'#https://cdn\.knightlab\.com/libs/timeline/latest/embed/\?source=[a-zA-Z0-9_-]+#i',
			array( $this, 'wp_embed_knight_lab_timeline' )
		);
		wp_embed_register_handler(
			'knight-lab-juxtapose',
			'#https://cdn\.knightlab\.com/libs/juxtapose/latest/embed/index\.html\?uid=([a-zA-Z0-9_-]+)#i',
			array( $this, 'wp_embed_knight_lab_juxtapose' )
		);
		wp_embed_register_handler(
			'knight-lab-storymap',
			'#https://uploads\.knightlab\.com/storymapjs/([a-zA-Z0-9_-]+)/([a-zA-Z0-9_-]+)/index.html#i',
			array( $this, 'wp_embed_knight_lab_storymap' )
		);
		wp_oembed_add_provider(
			'#https://uploads\.knightlab\.com/storymapjs/([a-zA-Z0-9_-]+)/([a-zA-Z0-9_-]+)/index.html#i',
			'https://knightlab.northwestern.edu/',
			true
		);
	}

	/**
	 * Timeline embed.
	 *
	 * @since  1.0.0
	 */
	public function wp_embed_knight_lab_timeline( $matches, $attr, $url, $rawattr ) {
		$parsed_url = wp_parse_url( $url );
		parse_str( $parsed_url['query'], $args );

		$defaults = array(
			'source' => '',
			'font' => '',
			'lang' => '',
			'initial_zoom' => '4',
			'height' => '650',
			'width' => '100%%'
		);

		$args = wp_parse_args( $args, $defaults );

		$embed = vsprintf(
			'<iframe src="https://cdn.knightlab.com/libs/timeline3/latest/embed/index.html?source=%1$s&font=%2$s&lang=%3$s&initial_zoom=%4$s&height=%5$s" width="100%%" height="650" webkitallowfullscreen mozallowfullscreen allowfullscreen frameborder="0"></iframe>',
			$args
		);
		return apply_filters( 'embed_knight_lab_timeline', $embed, $matches, $attr, $url, $rawattr );
	}

	/**
	 * Storymap embed.
	 *
	 * @since  1.0.0
	 */
	public function wp_embed_knight_lab_storymap( $matches, $attr, $url, $rawattr ) {
		$embed = sprintf(
			'<iframe src="https://uploads.knightlab.com/storymapjs/%1$s/%2$s/index.html" frameborder="0" width="100%%" height="800"></iframe>',
			esc_attr( $matches[1] ),
			esc_attr( $matches[2] )
		);
		return apply_filters( 'embed_knight_lab_storymap', $embed, $matches, $attr, $url, $rawattr );
	}

	/**
	 * Juxtapose embed.
	 *
	 * @since  1.0.0
	 */
	public function wp_embed_knight_lab_juxtapose( $matches, $attr, $url, $rawattr ) {
		$embed = sprintf(
			'<iframe frameborder="0" class="juxtapose" width="100%%" height="360" src="https://cdn.knightlab.com/libs/juxtapose/latest/embed/index.html?uid=%1$s"></iframe>',
			esc_attr( $matches[1] )
		);
		return apply_filters( 'embed_knight_lab_juxtapose', $embed, $matches, $attr, $url, $rawattr );
	}
}
