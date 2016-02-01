<?php
/**
 * @group functions.php
 * @group current_time
 */

/**
 * Retrieve the current time based on specified type.
 *
 * The 'mysql' type will return the time in the format for MySQL DATETIME field.
 * The 'timestamp' type will return the current timestamp.
 * Other strings will be interpreted as PHP date formats (e.g. 'Y-m-d').
 *
 * If $gmt is set to either '1' or 'true', then both types will use GMT time.
 * if $gmt is false, the output is adjusted with the GMT offset in the WordPress option.
 *
 * @since 1.0.0
 *
 * @param string $type Type of time to retrieve. Accepts 'mysql', 'timestamp', or PHP date
 *                       format string (e.g. 'Y-m-d').
 * @param int|bool $gmt Optional. Whether to use GMT timezone. Default false.
 *
 * @return int|string Integer if $type is 'timestamp', string otherwise.
 */
class Tests_Functions_current_time extends WP_UnitTestCase {

	function test_current_time_null_parms() {
		$this->assertEquals( '', current_time( null ), 'Null passed' );
	}

	function test_current_time_pass_random_String() {
		$this->assertEquals( date( 'Random_String_passed' ), current_time( 'Random_String_passed' ), 'Random_String passed' );
	}

	function test_current_time_pass_year() {
		$this->assertEquals( date( 'Y-m-d' ), current_time( 'Y-m-d' ), 'Y-m-d passed' );
	}

	function test_current_time_pass_full_format() {
		$this->assertEquals( date( 'F j, Y, g:i a' ), current_time( 'F j, Y, g:i a' ), 'F j, Y, g:i a passed' );
	}

	function test_current_time_pass_year_gmt() {
		$this->assertEquals( date( 'Y-m-d' ), current_time( 'Y-m-d', true ), 'Y-m-d, true passed' );
	}

	function test_current_time_pass_year_1() {
		$this->assertEquals( date( 'Y-m-d' ), current_time( 'Y-m-d', 1 ), 'Y-m-d, true passed' );
	}

	function test_current_time_pass_year_not_gmt() {
		$this->assertEquals( date( 'Y-m-d' ), current_time( 'Y-m-d', false ), 'Y-m-d, false passed' );
	}

	function test_current_time_pass_year_not_gmt_offset() {
		update_option( 'gmt_offset', 6 );
		$this->assertEquals( date( 'F j, Y, g:i a', time() + ( 6 * HOUR_IN_SECONDS ) ), current_time( 'F j, Y, g:i a', false ), 'Y-m-d, false passed' );
	}

	function test_current_time_pass_timestamp_not_gmt_offset() {
		update_option( 'gmt_offset', 6 );
		$this->assertEquals( time() + ( 6 * HOUR_IN_SECONDS ), current_time( 'timestamp', false ), 'timestamp, false passed' );
	}

	function test_current_time_pass_timestamp_gmt_offset() {
		update_option( 'gmt_offset', 6 );
		$this->assertEquals( time(), current_time( 'timestamp', true ), 'timestamp, true passed' );
	}

	function test_current_time_pass_timestamp_not_gmt() {
		update_option( 'gmt_offset', 6 );
		$this->assertEquals( time() + ( 6 * HOUR_IN_SECONDS ), current_time( 'timestamp', false ), 'timestamp, false passed' );
	}

	function test_current_time_pass_timestamp_gmt() {
		update_option( 'gmt_offset', 6 );
		$this->assertEquals( time(), current_time( 'timestamp', true ), 'timestamp, true passed' );
	}

	function test_current_time_pass_mysql_not_gmt_offset() {
		update_option( 'gmt_offset', 6 );
		$this->assertEquals( gmdate( 'Y-m-d H:i:s', ( time() + ( 6 * HOUR_IN_SECONDS ) ) ), current_time( 'mysql', false ), 'mysql, false passed' );
	}

	function test_current_time_pass_mysql_gmt_offset() {
		update_option( 'gmt_offset', 6 );
		$this->assertEquals( gmdate( 'Y-m-d H:i:s', ( time() ) ), current_time( 'mysql', true ), 'mysql, true passed' );
	}

	function test_current_time_pass_mysql_not_gmt() {
		update_option( 'gmt_offset', 6 );
		$this->assertEquals( gmdate( 'Y-m-d H:i:s', ( time() + ( 6 * HOUR_IN_SECONDS ) ) ), current_time( 'mysql', false ), 'mysql, false passed' );
	}

	function test_current_time_pass_mysql_gmt() {
		update_option( 'gmt_offset', 6 );
		$this->assertEquals( gmdate( 'Y-m-d H:i:s' ), current_time( 'mysql', true ), 'mysql, true passed' );
	}
}
