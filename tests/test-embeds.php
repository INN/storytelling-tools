<?php
/**
 * Storytelling Tools Shortcodes.
 *
 * @since   1.0.0
 * @package Storytelling_Tools
 */

/**
 * Storytelling Tools Embed Tests.
 *
 * @since 1.0.0
 */
class KLST_Embeds_Test extends WP_UnitTestCase {

	/**
	 * Test if our class exists.
	 *
	 * @since  1.0.0
	 */
	function test_class_exists() {
		$this->assertTrue( class_exists( 'KLST_Embeds' ) );
	}

	/**
	 * Test that we can access our class through our helper function.
	 *
	 * @since  1.0.0
	 */
	function test_class_access() {
		$this->assertInstanceOf( 'KLST_Embeds', storytelling_tools()->embeds );
	}

	/**
	 * Setup data for conversion function
	 *
	 * @since 1.0
	 */
	function get_conversion_data() {
		return array(
			'no_embed' => array(
				'<p>Hello world.</p>',
				'<p>Hello world.</p>' . PHP_EOL,
			),
			'timeline' => array(
				'https://cdn.knightlab.com/libs/timeline/latest/embed/?source=1cWqQBZCkX9GpzFtxCWHoqFXCHg-ylTVUWlnrdYMzKUI&font=Bevan-PotanoSans&width=600&height=600' . PHP_EOL,
				str_replace( '&', '&#038;', '<p><iframe src="https://cdn.knightlab.com/libs/timeline/latest/embed/?source=1cWqQBZCkX9GpzFtxCWHoqFXCHg-ylTVUWlnrdYMzKUI&font=Bevan-PotanoSans&lang=&initial_zoom=4&width=600&height=600" width="600" height="600" webkitallowfullscreen mozallowfullscreen allowfullscreen frameborder="0"></iframe></p>' ) . PHP_EOL,
			),
			'storymap' => array(
				'https://uploads.knightlab.com/storymapjs/2f1291f5f21d432d5bffc2d6b02e4533/test-storymap/index.html' . PHP_EOL,
				str_replace( '&', '&#038;', '<p><iframe src="https://uploads.knightlab.com/storymapjs/2f1291f5f21d432d5bffc2d6b02e4533/test-storymap/index.html" frameborder="0" width="100%" height="800"></iframe></p>' ) . PHP_EOL,
			),
			'juxtapose' => array(
				'https://cdn.knightlab.com/libs/juxtapose/latest/embed/index.html?uid=ec2d5230-6b23-11e7-821e-0edaf8f81e27' . PHP_EOL,
				str_replace( '&', '&#038;', '<p><iframe frameborder="0" class="juxtapose" width="100%" height="360" src="https://cdn.knightlab.com/libs/juxtapose/latest/embed/index.html?uid=ec2d5230-6b23-11e7-821e-0edaf8f81e27"></iframe></p>' ) . PHP_EOL,
			),
		);
	}

	/**
	 * Test embeds for timeline, storymap, and juxtapose.
	 *
	 * @since 1.0
	 *
	 * @param str $source original string from get_conversion_data.
	 * @param str $expected compare string from get_conversion_data.
	 * @dataProvider get_conversion_data
	 */
	function test__conversion( $source, $expected ) {
		$filtered_content = apply_filters( 'the_content', $source );
		$this->assertEquals( $expected, $filtered_content );
	}
}
