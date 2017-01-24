<?php

class KLST_Embeds_Test extends WP_UnitTestCase {

	function test_sample() {
		// replace this with some actual testing code
		$this->assertTrue( true );
	}

	function test_class_exists() {
		$this->assertTrue( class_exists( 'KLST_Embeds') );
	}

	function test_class_access() {
		$this->assertTrue( knight_lab_storytelling_tools()->embeds instanceof KLST_Embeds );
	}
}
