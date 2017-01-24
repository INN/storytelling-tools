<?php

class BaseTest extends WP_UnitTestCase {

	function test_sample() {
		// replace this with some actual testing code
		$this->assertTrue( true );
	}

	function test_class_exists() {
		$this->assertTrue( class_exists( 'Knight_Lab_Storytelling_Tools') );
	}
	
	function test_get_instance() {
		$this->assertTrue( knight_lab_storytelling_tools() instanceof Knight_Lab_Storytelling_Tools );
	}
}
