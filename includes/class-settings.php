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

		// Set our title.
		$this->title = esc_attr__( 'Knight Lab Storytelling Tools Settings', 'knight-lab-storytelling-tools' );
	}

	/**
	 * Initiate our hooks.
	 *
	 * @since  1.0.0
	 */
	public function hooks() {

		// Hook in our actions to the admin.
		add_action( 'admin_init', array( $this, 'admin_init' ) );
		add_action( 'admin_menu', array( $this, 'add_options_page' ) );
	}

	/**
	 * Register our setting to WP.
	 *
	 * @since  1.0.0
	 */
	public function admin_init() {
		register_setting( $this->key, $this->key );
	}

	/**
	 * Add menu options page.
	 *
	 * @since  1.0.0
	 */
	public function add_options_page() {
		$this->options_page = add_menu_page(
			$this->title,
			$this->title,
			'manage_options',
			$this->key,
			array( $this, 'admin_page_display' )
		);
	}

	/**
	 * Admin page markup. Mostly handled by CMB2.
	 *
	 * @since  1.0.0
	 */
	public function admin_page_display() {
		?>
		<div class="wrap cmb2-options-page <?php echo esc_attr( $this->key ); ?>">
			<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
		</div>
		<?php
	}

	/**
	 * Add custom fields to the options page.
	 *
	 * @since  1.0.0
	 */
	public function add_options_page_metabox() {
		?>
		<div class="wrap options-page <?php echo esc_attr( $this->key ); ?>">
			<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
		</div>
		<?php
	}
}
