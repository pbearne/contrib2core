<?php

/**
 * @group functions.php
 * @group 28559
 */
/**
 * Convert given date string into a different format.
 *
 * $format should be either a PHP date format string, e.g. 'U' for a Unix
 * timestamp, or 'G' for a Unix timestamp assuming that $date is GMT.
 *
 * If $translate is true then the given date and format string will
 * be passed to date_i18n() for translation.
 *
 * @since 0.71
 *
 * @param string $format Format of the date to return.
 * @param string $date Date string to convert.
 * @param bool $translate Whether the return date should be translated. Default true.
 *
 * @return string|int Formatted date string, or Unix timestamp.
 */


class Tests_Functions_mysql2date extends WP_UnitTestCase {



	/**
	 *
	 */
	function test_mysql2date_pass_empty_date() {
		$this->setExpectedIncorrectUsage( 'mysql2date' );
		$this->assertFalse( mysql2date( '', '' ) , 'Pass empty strings' );
		$this->assertFalse( mysql2date( 'Y-m-d', '' ) , 'Pass Y-m-d and empty string' );
	}
	/**
	 *
	 */
	function test_mysql2date_pass_bad_date() {
		$current_date = date( 'Y-m-d' );

		$this->setExpectedIncorrectUsage( 'mysql2date' );
		// invalid date return current date
		$this->assertEquals( $current_date, mysql2date( 'Y-m-d', '42351234523541345143534534535314' ), 'passed Y-m-d, 42351234523541345143534534535314' );
		$this->assertEquals( $current_date, mysql2date( 'Y-m-d', '1' ) );
		$this->assertEquals( $current_date, mysql2date( 'Y-m-d', '1355270400' ) ); // unix date does work
		$this->assertEquals( $current_date, mysql2date( 'Y-m-d', 'i am not a date' ) );

		$this->assertFalse( mysql2date( 'U', '42351234523541345143534534535314' ), 'passed Y-m-d, 42351234523541345143534534535314' );
		$this->assertFalse( mysql2date( 'U', '1' ) );
		$this->assertFalse( mysql2date( 'U', '1355270400' ) ); // unix date does work
		$this->assertFalse( mysql2date( 'U', 'i am not a date' ) );

		$this->assertFalse( mysql2date( 'G', '42351234523541345143534534535314' ), 'passed Y-m-d, 42351234523541345143534534535314' );
		$this->assertFalse( mysql2date( 'G', '1' ) );
		$this->assertFalse( mysql2date( 'G', '1355270400' ) ); // unix date does work
		$this->assertFalse( mysql2date( 'G', 'i am not a date' ) );

	}

	/**
	 * moved from posts.php tests
	 * @ticket 28310
	 */
	function test_mysql2date_returns_false_with_no_date() {
		$this->setExpectedIncorrectUsage( 'mysql2date' );
		$this->assertFalse( mysql2date( 'F j, Y H:i:s', '' ) );
	}

	/**
	 * moved from posts.php tests
	 * @ticket 28310
	 */
	function test_mysql2date_returns_gmt_or_unix_timestamp() {
		$this->assertEquals( '441013392', mysql2date( 'G', '1983-12-23 07:43:12' ) );
		$this->assertEquals( '441013392', mysql2date( 'U', '1983-12-23 07:43:12' ) );
	}


	/**
	*
	*/
	function test_mysql2date() {

		$this->assertEquals( '2012-12-30', mysql2date( 'Y-m-d', '2012-12-30' ) );
		$this->assertEquals( '12-12-30', mysql2date( 'y-m-d', '2012-12-30' ) );
		$this->assertEquals( '1356825600', mysql2date( 'G', '2012-12-30' ) );
		$this->assertEquals( '1356825600', mysql2date( 'U', '2012-12-30' ) );

		// false is th default
		$this->assertEquals( '2012-12-30', mysql2date( 'Y-m-d', '2012-12-30', false ) );

		$this->assertEquals( '2012-12-30', mysql2date( 'Y-m-d', 'December 30, 2012, 12:00 am' ) );

		$this->assertEquals( 'December 30, 2012, 12:00 am', mysql2date( 'F j, Y, g:i a', '2012-12-30' ) );
		// no change on the phpunit as testing in english
		$this->assertEquals( 'December 30, 2012, 12:00 am', mysql2date( 'F j, Y, g:i a', '2012-12-30' ), true );

	}

	/**
	 *
	*/
	function test_mysql2date_format_matches() {
		$formated_now = date( 'Y-m-d' );
		$this->assertNotEquals( $formated_now, mysql2date( 'Y-m-d', 'tomorrow' ) );
		$this->assertEquals( $formated_now, mysql2date( 'Y-m-d', 'today' ) );

	}

	/**
	 *
	 */
	function test_mysql2date_transulation() {

		add_filter( 'date_i18n', array( __class__, 'retrurn_date_i18n_ran' ), 1, 99999 );

		$this->assertEquals( 'date_i18n_ran', mysql2date( 'F j, Y, g:i a', '2012-12-30', true ) );
		$this->assertEquals( 'date_i18n_ran', mysql2date( 'Y-m-d', '2012-12-30', true ) );

		remove_filter( 'date_i18n', array( __class__, 'retrurn_date_i18n_ran' ), 1 );

	}

	public static function retrurn_date_i18n_ran( $date ) {
		return 'date_i18n_ran';
	}

}
