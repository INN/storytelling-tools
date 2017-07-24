<?php
/**
 * Storytelling Tools Shortcodes.
 *
 * @since   1.0.0
 * @package Storytelling_Tools
 */

/**
 * Storytelling Tools Shortcodes.
 *
 * @since 1.0.0
 */
class KLST_Shortcodes {
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
		add_shortcode( 'soundcite', array( $this, 'shortcode_output' ) );
		add_action( 'media_buttons', array( $this, 'soundcite_editor_button' ), 11 );
		add_action( 'admin_head', array( $this, 'soundcite_editor_button_js' ) );
		wp_register_style( 'soundcite-styles', '//cdn.knightlab.com/libs/soundcite/latest/css/player.css', array(), '1.0.0' );
		wp_register_script( 'soundcite-script', '//cdn.knightlab.com/libs/soundcite/latest/js/soundcite.min.js', array(), '1.0.0', true );
	}

	/**
	 * Add SoundCite button above TinyMCE editor
	 *
	 * @since  1.0.0
	 */
	public function soundcite_editor_button() {
	    echo '<button type="button" id="insert-soundcite-button" class="button insert-soundcite-shortcode" value="test"><span class="wp-media-buttons-icon dashicons dashicons-format-audio"></span> Add SoundCite</button>';
	}

	/**
	 * Insert blank shortcode for SoundCite on button press
	 *
	 * @since  1.0.0
	 */
	public function soundcite_editor_button_js() {
	  echo '<script type="text/javascript">
	    jQuery(document).ready(function($){
	       $("#insert-soundcite-button").click(function() {
					 send_to_editor("[soundcite url=\"\" start=\"\" end=\"\"]");
				 })
	    });
	  </script>';
	}

	/**
	 * Process shortcode
	 *
	 * @since  1.0.0
	 *
	 * @param array $atts attributes.
	 */
	public function shortcode_output( $atts ) {
		wp_enqueue_style( 'soundcite-styles' );
		wp_enqueue_script( 'soundcite-script' );

		// If no mp3 file, don't output anything.
		if ( ! isset( $atts['url'] ) || '' === $atts['url'] ) {
			return;
		}

		$start = isset( $atts['start'] ) ? ' data-start=' . intval( trim( $atts['start'], '&quot;' ) ) * 1000 : '';
		$end = isset( $atts['end'] ) ? ' data-end=' . intval( trim( $atts['end'], '&quot;' ) ) * 1000 : '';

		$atts = shortcode_atts( array(
			'text' => '',
			'url' => '',
		), $atts, 'soundcite' );

		return '<span' . esc_attr( $start ) . esc_attr( $end ) . ' data-url="' . esc_attr( trim( $atts['url'], '&quot;' ) ) . '" class="soundcite soundcite-loaded soundcite-play">' . esc_attr( trim( $atts['text'], '&quot;' ) ) . '</span>';
	}
}
