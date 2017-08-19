<?php
/**
 * Storytelling Tools Embeds.
 *
 * @since   1.0.0
 * @package Storytelling_Tools
 */

/**
 * Storytelling Tools Embeds.
 *
 * @since 1.0.0
 */
class KLST_Embeds {
	/**
	 * Parent plugin class.
	 *
	 * @since 1.0.0
	 *
	 * @var   Storytelling_Tools
	 */
	protected $plugin = null;

	/**
	 * Constructor.
	 *
	 * @since  1.0.0
	 *
	 * @param  Storytelling_Tools $plugin Main plugin object.
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
			'knight-lab-timeline3',
			'#https://cdn\.knightlab\.com/libs/timeline3/latest/embed/index.html\?source=[a-zA-Z0-9_-]+#i',
			array( $this, 'wp_embed_knight_lab_timeline3' )
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
	 *
	 * @param  array  $matches	regex matches.
	 * @param  array  $attr		attributes.
	 * @param  string $url 		url.
	 * @param  array  $rawattr	raw matches.
	 * @link https://github.com/NUKnightLab/TimelineJS
	 */
	public function wp_embed_knight_lab_timeline( $matches, $attr, $url, $rawattr ) {

		$parsed_url = wp_parse_url( $url );
		parse_str( $parsed_url['query'], $args );

		$defaults = array(
			'source' => '',
			'font' => '',
			'lang' => '',
			'initial_zoom' => '4',
			'width' => '100%%', # %% because we're passing this through sprintf and need to escape the %
			'height' => '650',
		);

		$args = wp_parse_args( $args, $defaults );

		$embed = sprintf(
			'<iframe src="https://cdn.knightlab.com/libs/timeline/latest/embed/?source=%1$s&font=%2$s&lang=%3$s&initial_zoom=%4$s&width=%5$s&height=%6$s" width="%7$s" height="%8$s" webkitallowfullscreen mozallowfullscreen allowfullscreen frameborder="0"></iframe>',
			rawurlencode( $args['source'] ),
			rawurlencode( $args['font'] ),
			rawurlencode( $args['lang'] ),
			rawurlencode( $args['initial_zoom'] ),
			rawurlencode( $args['width'] ),
			rawurlencode( $args['height'] ),
			esc_attr( $args['width'] ),
			esc_attr( $args['height'] )
		);
		return apply_filters( 'embed_knight_lab_timeline', $embed, $matches, $attr, $url, $rawattr );
	}

	/**
	 * Timeline3 embed.
	 *
	 * @since  1.2.0
	 *
	 * @param  array  $matches	regex matches.
	 * @param  array  $attr		attributes.
	 * @param  string $url 		url.
	 * @param  array  $rawattr	raw matches.
	 * @link https://github.com/NUKnightLab/TimelineJS3
	 */
	public function wp_embed_knight_lab_timeline3( $matches, $attr, $url, $rawattr ) {

		$parsed_url = wp_parse_url( $url );
		parse_str( $parsed_url['query'], $args );

		$defaults = array(
			'source' => '',
			'font' => '',
			'lang' => '',
			'initial_zoom' => '4',
			'width' => '100%%', # %% because we're passing this through sprintf and need to escape the %
			'height' => '650',
		);

		$args = wp_parse_args( $args, $defaults );

		$embed = sprintf(
			'<iframe src="https://cdn.knightlab.com/libs/timeline3/latest/embed/?source=%1$s&font=%2$s&lang=%3$s&initial_zoom=%4$s&width=%5$s&height=%6$s" width="%7$s" height="%8$s" webkitallowfullscreen mozallowfullscreen allowfullscreen frameborder="0"></iframe>',
			rawurlencode( $args['source'] ),
			rawurlencode( $args['font'] ),
			rawurlencode( $args['lang'] ),
			rawurlencode( $args['initial_zoom'] ),
			rawurlencode( $args['width'] ),
			rawurlencode( $args['height'] ),
			esc_attr( $args['width'] ),
			esc_attr( $args['height'] )
		);
		return apply_filters( 'embed_knight_lab_timeline', $embed, $matches, $attr, $url, $rawattr );
	}

	/**
	 * Storymap embed.
	 *
	 * @since  1.0.0
	 *
	 * @param  array  $matches	regex matches.
	 * @param  array  $attr		attributes.
	 * @param  string $url 		url.
	 * @param  array  $rawattr	raw matches.
	 */
	public function wp_embed_knight_lab_storymap( $matches, $attr, $url, $rawattr ) {
		$embed = sprintf(
			# %% because we need to escape it inside sprintf
			'<iframe src="https://uploads.knightlab.com/storymapjs/%1$s/%2$s/index.html" frameborder="0" width="100%%" height="800"></iframe>',
			rawurlencode( $matches[1] ),
			rawurlencode( $matches[2] )
		);
		return apply_filters( 'embed_knight_lab_storymap', $embed, $matches, $attr, $url, $rawattr );
	}

	/**
	 * Juxtapose embed.
	 *
	 * @since  1.0.0
	 *
	 * @param  array  $matches	regex matches.
	 * @param  array  $attr		attributes.
	 * @param  string $url 		url.
	 * @param  array  $rawattr	raw matches.
	 */
	public function wp_embed_knight_lab_juxtapose( $matches, $attr, $url, $rawattr ) {
		$embed = sprintf(
			# %% because we need to escape it inside sprintf
			'<iframe frameborder="0" class="juxtapose" width="100%%" height="360" src="https://cdn.knightlab.com/libs/juxtapose/latest/embed/index.html?uid=%1$s"></iframe>',
			rawurlencode( $matches[1] )
		);
		return apply_filters( 'embed_knight_lab_juxtapose', $embed, $matches, $attr, $url, $rawattr );
	}
}
