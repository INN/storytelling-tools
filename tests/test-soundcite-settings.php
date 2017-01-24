<?php

class KLST_Soundcite_Settings_Test extends WP_UnitTestCase {

	function test_sample() {
		// replace this with some actual testing code
		$this->assertTrue( true );
	}

	function test_class_exists() {
		$this->assertTrue( class_exists( 'KLST_Soundcite_Settings') );
	}

	function test_class_access() {
		$this->assertTrue( knight_lab_storytelling_tools()->soundcite-settings instanceof KLST_Soundcite_Settings );
	}
}
