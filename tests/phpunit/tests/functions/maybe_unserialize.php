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

class Tests_Functions_maybe_unserialize extends WP_UnitTestCase {

	public function test_maybe_unserialize_array() {
		$expected = array(
			'start' => 'here',
			'end'   => 'here',
		);

		$this->assertEquals( $expected, maybe_unserialize( $expected ) );
	}

	public function test_maybe_unserialize_string() {
		$this->assertEquals( 'string', maybe_unserialize( 'string' ) );

		$this->assertEquals( '[string]', maybe_unserialize( '[string]' ) );
	}

	public function test_maybe_unserialize_int() {

		$this->assertEquals( 100, maybe_unserialize( 100 ) );
	}

	public function test_maybe_unserialize_to_array() {
		$expected = array(
			'start' => 'here',
			'end'   => 'here',
		);

		$this->assertEquals( $expected, maybe_unserialize( 'a:2:{s:5:"start";s:4:"here";s:3:"end";s:4:"here";}' ) );

	}

	public function test_maybe_unserialize_to_array_bad_string() {

		$this->assertEquals( '{s:5:"start";s:4:"here";s:3:"end";s:4:"here";}', maybe_unserialize( '{s:5:"start";s:4:"here";s:3:"end";s:4:"here";}' ) );

		$this->assertEquals( false, maybe_unserialize( 'a:3:{s:5:"start";s:4:"here";s:3:"end";s:4:"here";}' ) );

	}
}