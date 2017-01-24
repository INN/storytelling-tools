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
	}
}
