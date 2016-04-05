<?php
/**
 * Test functions against maybe_unserialize.
 * Tested scenarios:
 *     1)
 * @group functions.php
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}


class Tests_Functions_maybe_unserialize extends WP_UnitTestCase {

	//Passing an array should return the same array back
	public function test_maybe_unserialize_array() {
		$expected = array(
			'start' => 'here',
			'end'   => 'here',
		);

		$this->assertEquals( $expected, maybe_unserialize( $expected ) );
	}

	//Tests normal string unserialization
	public function test_maybe_unserialize_string() {
		$this->assertEquals( 'string', maybe_unserialize( 'string' ) );

		$this->assertEquals( '[string]', maybe_unserialize( '[string]' ) );

		$this->assertEquals( '{s:5:"start";s:4:"here";s:3:"end";s:4:"here";}', maybe_unserialize( '{s:5:"start";s:4:"here";s:3:"end";s:4:"here";}' ) );

	}

	//Passing an int should return the same int
	public function test_maybe_unserialize_int() {

		$this->assertEquals( 100, maybe_unserialize( 100 ) );
	}

	//Passing null should return null
	public function test_maybe_unserialize_null() {

		$this->assertEquals( null, maybe_unserialize( null ) );
	}

	//Passing null should return null
	public function test_maybe_unserialize_object() {
		$object = new stdClass();

		$this->assertEquals( $object, maybe_unserialize( $object ) );
	}

	public function test_maybe_unserialize_to_array() {
		$expected = array(
			'start' => 'here',
			'end'   => 'here',
		);

		$this->assertEquals( $expected, maybe_unserialize( 'a:2:{s:5:"start";s:4:"here";s:3:"end";s:4:"here";}' ) );
	}

	public function test_maybe_unserialize_bad_serialized_string() {

		// a:3 not a:2 as it should be
		$this->assertFalse( maybe_unserialize( 'a:3:{s:5:"start";s:4:"here";s:3:"end";s:4:"here";}' ) );
	}

	public function test_maybe_unserialize_to_array_un_trimed() {
		$expected = array(
			'start' => 'here',
			'end'   => 'here',
		);

		$this->assertEquals( $expected, maybe_unserialize( '    a:2:{s:5:"start";s:4:"here";s:3:"end";s:4:"here";}     ' ) );
	}
}