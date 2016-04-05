<?php
/**
 * wordpress-develop.
 * User: Paul
 * Date: 2016-02-01
 *
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}

class Tests_Functions_is_serialized extends WP_UnitTestCase {

	public function test_is_serialized_array() {
		$expected = array(
			'start' => 'here',
			'end'   => 'here',
		);

		$this->assertFalse( is_serialized( $expected ) );
	}

	public function test_is_serialized_string() {
		$this->assertFalse(  is_serialized( 'string' ) );

		$this->assertFalse( is_serialized( '[string]' ) );

		$this->assertFalse( is_serialized( '{s:5:"start";s:4:"here";s:3:"end";s:4:"here";}' ) );

	}

	public function test_maybe_is_serialized_int() {

		$this->assertFalse( is_serialized( 100 ) );
	}

	public function test_maybe_is_serialized_null() {

		$this->assertFalse( is_serialized( null ) );
	}

	public function test_maybe_unserialize_object() {
		$object = new stdClass();

		$this->assertFalse( is_serialized( $object ) );
	}

	public function test_maybe_unserialize_to_array() {
		$expected = array(
			'start' => 'here',
			'end'   => 'here',
		);

		$this->assertTrue( is_serialized( 'a:2:{s:5:"start";s:4:"here";s:3:"end";s:4:"here";}' ) );
	}

	public function test_maybe_unserialize_bad_serialized_string() {

		// a:3 not a:2 as it should be
		$this->assertTrue( is_serialized( 'a:3:{s:5:"start";s:4:"here";s:3:"end";s:4:"here";}' ) );
	}
}