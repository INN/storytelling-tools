<?php
/**
 * Storytelling Tools Shortcodes Tests.
 *
 * @since   1.0.0
 * @package Storytelling_Tools
 */

/**
 * Storytelling Tools Shortcodes Tests.
 *
 * @since   1.0.0
 * @package Storytelling_Tools
 */
class KLST_Shortcodes_Test extends WP_UnitTestCase {

	/**
	 * Test if our class exists.
	 *
	 * @since  1.0.0
	 */
	function test_class_exists() {
		$this->assertTrue( class_exists( 'KLST_Shortcodes' ) );
	}

	/**
	 * Test that we can access our class through our helper function.
	 *
	 * @since  1.0.0
	 */
	function test_class_access() {
		$this->assertInstanceOf( 'KLST_Shortcodes', storytelling_tools()->shortcodes );
	}

	/**
	 * Test the shortcode with no parameters
	 *
	 * @since 1.0
	 */
	function test_no_params() {
		$this->assertEquals( '', do_shortcode('[soundcite /]') );
		$this->assertEquals( '', do_shortcode('[soundcite start="0" end="5" text="test" /]') );
	}

	/**
	 * Test that start and end values accept integers only.
	 *
	 * @since 1.0
	 */
	function test_non_integer_params() {
		$this->assertEquals( '<span data-start="0" data-end="0" data-url="sample-mp3.mp3" class="soundcite soundcite-loaded soundcite-play">es</span>', do_shortcode('[soundcite start="start" end="end" text="test" url="sample-mp3.mp3" /]') );
	}

	/**
	 * Test the start and end atts convert properly.
	 *
	 * @since 1.0
	 */
	function test_start_end_conversion() {
		$this->assertEquals( '<span data-start="25000" data-end="30000" data-url="sample-mp3.mp3" class="soundcite soundcite-loaded soundcite-play">es</span>', do_shortcode('[soundcite start="25" end="30" text="test" url="sample-mp3.mp3" /]') );
	}
}
