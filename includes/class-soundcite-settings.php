<?php
/**
 * Knight Lab Storytelling Tools SoundCite Settings
 *
 * @since NEXT
 * @package Knight Lab Storytelling Tools
 */

/**
 * Knight Lab Storytelling Tools SoundCite Settings class.
 *
 * @since NEXT
 */
class KLST_SoundCite_Settings {
	/**
	 * Parent plugin class
	 *
	 * @var    Knight_Lab_Storytelling_Tools
	 * @since  NEXT
	 */
	protected $plugin = null;

	/**
	 * Option key, and option page slug
	 *
	 * @var    string
	 * @since  NEXT
	 */
	protected $key = 'knight_lab_storytelling_tools_soundcite_settings';

	/**
	 * Options page metabox id
	 *
	 * @var    string
	 * @since  NEXT
	 */
	protected $metabox_id = 'knight_lab_storytelling_tools_soundcite_settings_metabox';

	/**
	 * Options Page title
	 *
	 * @var    string
	 * @since  NEXT
	 */
	protected $title = '';

	/**
	 * Options Page hook
	 * @var string
	 */
	protected $options_page = '';

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

		$this->title = __( 'Knight Lab SoundCite', 'knight-lab-storytelling-tools' );
	}

	/**
	 * Initiate our hooks
	 *
	 * @since  NEXT
	 * @return void
	 */
	public function hooks() {
		add_action( 'admin_init', array( $this, 'admin_init' ) );
		add_action( 'admin_menu', array( $this, 'add_options_page' ) );
		add_action( 'media_buttons', array( $this, 'soundcite_editor_button' ), 11 );
		add_action( 'admin_head', array( $this, 'soundcite_editor_button_js' ) );

	}

	/**
	 * Register our setting to WP
	 *
	 * @since  NEXT
	 * @return void
	 */
	public function admin_init() {
		register_setting( $this->key, $this->key );
	}

	/**
	 * Add menu options page
	 *
	 * @since  NEXT
	 * @return void
	 */
	public function add_options_page() {
		$this->options_page = add_options_page(
			$this->title,
			$this->title,
			'manage_options',
			$this->key,
			array( $this, 'admin_page_display' )
		);
	}

	/**
	 * Admin page markup.
	 *
	 * @since  NEXT
	 * @return void
	 */
	public function admin_page_display() {
		?>
		<div class="wrap options-page <?php echo esc_attr( $this->key ); ?>">
			<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
		</div>
		<?php
	}

	/**
	 * Add SoundCite button above TinyMCE editor
	 *
	 * @since  NEXT
	 * @return void
	 */
	public function soundcite_editor_button() {
	    echo '<button type="button" id="insert-soundcite-button" class="button insert-soundcite-shortcode" value="test"><span class="wp-media-buttons-icon dashicons dashicons-format-audio"></span> Add SoundCite</button>';
	}

	/**
	 * Insert blank shortcode for SoundCite on button press
	 *
	 * @since  NEXT
	 * @return void
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
}
