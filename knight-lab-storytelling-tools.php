<?php
/**
 * Plugin Name: Knight Lab Storytelling Tools
 * Plugin URI:  http://knightlab.northwestern.edu/projects/#storytelling
 * Description: Implement the Knight Lab storytelling tools into your WordPress site!
 * Version:     1.0.0
 * Author:      inn_nerds
 * Author URI:  http://nerds.inn.org
 * Donate link: http://knightlab.northwestern.edu/projects/#storytelling
 * License:     GPLv2
 * Text Domain: knight-lab-storytelling-tools
 * Domain Path: /languages
 *
 * @link http://knightlab.northwestern.edu/projects/#storytelling
 *
 * @package Knight Lab Storytelling Tools
 * @version 1.0.0
 */

/**
 * Copyright (c) 2017 inn_nerds (email : nerds@inn.org)
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 2 or, at
 * your discretion, any later version, as published by the Free
 * Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

// Include additional php files here.
require 'includes/class-soundcite-settings.php';
require 'includes/class-embeds.php';
require 'includes/class-shortcodes.php';

/**
 * Main initiation class
 *
 * @since  NEXT
 */
final class Knight_Lab_Storytelling_Tools {

	/**
	 * Current version
	 *
	 * @var  string
	 * @since  NEXT
	 */
	const VERSION = '1.0.0';

	/**
	 * URL of plugin directory
	 *
	 * @var string
	 * @since  NEXT
	 */
	protected $url = '';

	/**
	 * Path of plugin directory
	 *
	 * @var string
	 * @since  NEXT
	 */
	protected $path = '';

	/**
	 * Plugin basename
	 *
	 * @var string
	 * @since  NEXT
	 */
	protected $basename = '';

	/**
	 * Detailed activation error messages
	 *
	 * @var array
	 * @since  NEXT
	 */
	protected $activation_errors = array();

	/**
	 * Singleton instance of plugin
	 *
	 * @var Knight_Lab_Storytelling_Tools
	 * @since  NEXT
	 */
	protected static $single_instance = null;

	/**
	 * Instance of KLST_SoundCite_Settings
	 *
	 * @since NEXT
	 * @var KLST_SoundCite_Settings
	 */
	protected $soundcite_settings;

	/**
	 * Instance of KLST_Embeds
	 *
	 * @since NEXT
	 * @var KLST_Embeds
	 */
	protected $embeds;

	/**
	 * Instance of KLST_Shortcodes
	 *
	 * @since1.0.0
	 * @var KLST_Shortcodes
	 */
	protected $shortcodes;

	/**
	 * Creates or returns an instance of this class.
	 *
	 * @since  NEXT
	 * @return Knight_Lab_Storytelling_Tools A single instance of this class.
	 */
	public static function get_instance() {
		if ( null === self::$single_instance ) {
			self::$single_instance = new self();
		}

		return self::$single_instance;
	}

	/**
	 * Sets up our plugin
	 *
	 * @since  NEXT
	 */
	protected function __construct() {
		$this->basename = plugin_basename( __FILE__ );
		$this->url      = plugin_dir_url( __FILE__ );
		$this->path     = plugin_dir_path( __FILE__ );
	}

	/**
	 * Attach other plugin classes to the base plugin class.
	 *
	 * @since  NEXT
	 * @return void
	 */
	public function plugin_classes() {
		// Attach other plugin classes to the base plugin class.
		$this->soundcite_settings = new KLST_SoundCite_Settings( $this );
		$this->embeds = new KLST_Embeds( $this );
		$this->shortcodes = new KLST_Shortcodes( $this );
	} // END OF PLUGIN CLASSES FUNCTION

	/**
	 * Add hooks and filters
	 *
	 * @since  NEXT
	 * @return void
	 */
	public function hooks() {
		// Priority needs to be:
		// < 10 for CPT_Core,
		// < 5 for Taxonomy_Core,
		// 0 Widgets because widgets_init runs at init priority 1.
		add_action( 'init', array( $this, 'init' ), 0 );
	}

	/**
	 * Activate the plugin
	 *
	 * @since  NEXT
	 * @return void
	 */
	public function _activate() {
		// Make sure any rewrite functionality has been loaded.
		flush_rewrite_rules();
	}

	/**
	 * Deactivate the plugin
	 * Uninstall routines should be in uninstall.php
	 *
	 * @since  NEXT
	 * @return void
	 */
	public function _deactivate() {}

	/**
	 * Init hooks
	 *
	 * @since  NEXT
	 * @return void
	 */
	public function init() {
		// bail early if requirements aren't met
		if ( ! $this->check_requirements() ) {
			return;
		}

		// load translated strings for plugin
		load_plugin_textdomain( 'knight-lab-storytelling-tools', false, dirname( $this->basename ) . '/languages/' );

		// initialize plugin classes
		$this->plugin_classes();
	}

	/**
	 * Check if the plugin meets requirements and
	 * disable it if they are not present.
	 *
	 * @since  NEXT
	 * @return boolean result of meets_requirements
	 */
	public function check_requirements() {
		// bail early if pluginmeets requirements
		if ( $this->meets_requirements() ) {
			return true;
		}

		// Add a dashboard notice.
		add_action( 'all_admin_notices', array( $this, 'requirements_not_met_notice' ) );

		// Deactivate our plugin.
		add_action( 'admin_init', array( $this, 'deactivate_me' ) );

		return false;
	}

	/**
	 * Deactivates this plugin, hook this function on admin_init.
	 *
	 * @since  NEXT
	 * @return void
	 */
	public function deactivate_me() {
		// We do a check for deactivate_plugins before calling it, to protect
		// any developers from accidentally calling it too early and breaking things.
		if ( function_exists( 'deactivate_plugins' ) ) {
			deactivate_plugins( $this->basename );
		}
	}

	/**
	 * Check that all plugin requirements are met
	 *
	 * @since  NEXT
	 * @return boolean True if requirements are met.
	 */
	public function meets_requirements() {
		// Do checks for required classes / functions
		// function_exists('') & class_exists('').
		// We have met all requirements.
		// Add detailed messages to $this->activation_errors array
		return true;
	}

	/**
	 * Adds a notice to the dashboard if the plugin requirements are not met
	 *
	 * @since  NEXT
	 * @return void
	 */
	public function requirements_not_met_notice() {
		// compile default message
		$default_message = sprintf(
			__( 'Knight Lab Storytelling Tools is missing requirements and has been <a href="%s">deactivated</a>. Please make sure all requirements are available.', 'knight-lab-storytelling-tools' ),
			admin_url( 'plugins.php' )
		);

		// default details to null
		$details = null;

		// add details if any exist
		if ( ! empty( $this->activation_errors ) && is_array( $this->activation_errors ) ) {
			$details = '<small>' . implode( '</small><br /><small>', $this->activation_errors ) . '</small>';
		}

		// output errors
		?>
		<div id="message" class="error">
			<p><?php echo $default_message; ?></p>
			<?php echo $details; ?>
		</div>
		<?php
	}

	/**
	 * Magic getter for our object.
	 *
	 * @since  NEXT
	 * @param string $field Field to get.
	 * @throws Exception Throws an exception if the field is invalid.
	 * @return mixed
	 */
	public function __get( $field ) {
		switch ( $field ) {
			case 'version':
				return self::VERSION;
			case 'basename':
			case 'url':
			case 'path':
			case 'soundcite_settings':
			case 'embeds':
			case 'shortcodes':
				return $this->$field;
			default:
				throw new Exception( 'Invalid ' . __CLASS__ . ' property: ' . $field );
		}
	}
}

/**
 * Grab the Knight_Lab_Storytelling_Tools object and return it.
 * Wrapper for Knight_Lab_Storytelling_Tools::get_instance()
 *
 * @since  NEXT
 * @return Knight_Lab_Storytelling_Tools  Singleton instance of plugin class.
 */
function knight_lab_storytelling_tools() {
	return Knight_Lab_Storytelling_Tools::get_instance();
}

// Kick it off.
add_action( 'plugins_loaded', array( knight_lab_storytelling_tools(), 'hooks' ) );

register_activation_hook( __FILE__, array( knight_lab_storytelling_tools(), '_activate' ) );
register_deactivation_hook( __FILE__, array( knight_lab_storytelling_tools(), '_deactivate' ) );
