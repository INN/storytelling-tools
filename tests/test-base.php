<?php
/**
 * Knight_Lab_Storytelling_Tools.
 *
 * @since   1.0.0
 * @package Knight_Lab_Storytelling_Tools
 */
class Knight_Lab_Storytelling_Tools_Test extends WP_UnitTestCase {

	/**
	 * Test if our class exists.
	 *
	 * @since  1.0.0
	 */
	function test_class_exists() {
		$this->assertTrue( class_exists( 'Knight_Lab_Storytelling_Tools') );
	}

	/**
	 * Test that our main helper function is an instance of our class.
	 *
	 * @since  1.0.0
	 */
	function test_get_instance() {
		$this->assertInstanceOf(  'Knight_Lab_Storytelling_Tools', knight_lab_storytelling_tools() );
	}

	/**
	 * Replace this with some actual testing code.
	 *
	 * @since  1.0.0
	 */
	function test_sample() {
		$this->assertTrue( true );
	}
}
