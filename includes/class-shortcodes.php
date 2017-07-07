<?php
/**
 * Knight Lab Storytelling Tools Shortcodes.
 *
 * @since   1.0.0
 * @package Knight_Lab_Storytelling_Tools
 */

/**
 * Knight Lab Storytelling Tools Shortcodes.
 *
 * @since 1.0.0
 */
class KLST_Shortcodes {
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
		add_shortcode( 'soundcite', array( $this, 'shortcode_output' ) );
		add_action( 'media_buttons', array( $this, 'soundcite_editor_button' ), 11 );
		add_action( 'admin_head', array( $this, 'soundcite_editor_button_js' ) );
		wp_enqueue_style( 'soundcite-styles', '//cdn.knightlab.com/libs/soundcite/latest/css/player.css', array(), '1.0.0' );
		wp_enqueue_script( 'soundcite-script', '//cdn.knightlab.com/libs/soundcite/latest/js/soundcite.min.js', array(), '1.0.0', true );
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
	 */
	public function shortcode_output( $atts ) {
		$start = isset( $atts['start'] ) ? ' data-start="' . $atts['start'] * 1000 . '"' : '';
		$end = isset( $atts['end'] ) ? ' data-end="' . $atts['end'] * 1000 . '"' : '';

		$atts = shortcode_atts( array(
			'text' => '',
			'url' => '',
		), $atts, 'soundcite' );

		return '<span' . $start . $end . ' data-url="' . $atts['url'] . '" class="soundcite soundcite-loaded soundcite-play">' . $atts['text'] . '</span>';
	}
}
