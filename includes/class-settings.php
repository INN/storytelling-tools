<?php
/**
 * Knight Lab Storytelling Tools Settings.
 *
 * @since   1.0.0
 * @package Knight_Lab_Storytelling_Tools
 */

/**
 * Knight Lab Storytelling Tools Settings class.
 *
 * @since 1.0.0
 */
class KLST_Settings {
	/**
	 * Parent plugin class.
	 *
	 * @var    Knight_Lab_Storytelling_Tools
	 * @since  1.0.0
	 */
	protected $plugin = null;

	/**
	 * Option key, and option page slug.
	 *
	 * @var    string
	 * @since  1.0.0
	 */
	protected $key = 'knight_lab_storytelling_tools_settings';

	/**
	 * Options page metabox ID.
	 *
	 * @var    string
	 * @since  1.0.0
	 */
	protected $metabox_id = 'knight_lab_storytelling_tools_settings_metabox';

	/**
	 * Options Page title.
	 *
	 * @var    string
	 * @since  1.0.0
	 */
	protected $title = '';

	/**
	 * Options Page hook.
	 *
	 * @var string
	 */
	protected $options_page = '';

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
		add_action( 'admin_init', array( $this, 'settings_init' ) );
	}

	/**
	 * Register and add settings
	 *
	 * @since  1.0.0
	 *
	 */
	public function settings_init() {
		register_setting(
			'writing', // Option group
			'knight_lab_storytelling_tools', // Option name
			array( $this, 'sanitize' ) // Sanitize
		);

		add_settings_section(
			'knight_lab_storytelling_tools',
			'Knight Lab Storytelling Tools',
			array( $this, 'print_section_info' ),
			'writing'
		);

		add_settings_field(
			'soundcite',
			'Soundcite',
			array( $this, 'soundcite_callback' ),
			'writing',
			'knight_lab_storytelling_tools'
		);
	}

	/**
	* Sanitize each setting field as needed
	*
	* @param array $input Contains all settings fields as array keys
	*
	* @since  1.0.0
	*/
	public function sanitize( $input ) {
		$new_input = array();
		if ( isset( $input['soundcite'] ) ) {
			$new_input['soundcite'] = absint( $input['soundcite'] );
		}

		return $new_input;
	}

	/**
	* Print the Section text
	*
	* @since  1.0.0
	*/
	public function print_section_info() {
		print '<em>If you don\'t want to load Soundcite on every page, you can disable it below.</em>';
	}

	/**
	* Get the settings option array and print one of its values
	*
	* @since  1.0.0
	*/
	public function soundcite_callback() {
		$setting = get_option( 'knight_lab_storytelling_tools' );
		$soundcite = isset( $setting['soundcite'] ) ? intval( $setting['soundcite'] ) : '';
		echo '<input type="checkbox" id="knight_lab_storytelling_tools" name="knight_lab_storytelling_tools[soundcite]" value="1"' . checked( 1, $soundcite, false ) . '/> Enabled';
	}
}
