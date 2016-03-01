<?php


/**
 * @group functions.php
 */
class Tests_Functions_Get_WeekStartEnd extends WP_UnitTestCase {

// monday is thew default
	function test_get_weekstartend() {

		$expected = array(
			'start' => 1454889600,
            'end' => 1455494399,
		);

		$this->assertEquals( $expected, get_weekstartend( '2016-02-12' ) );

	}

	function test_get_weekstartend_start_of_week_set_to_0() {

		$expected = array(
			'start' => 1454803200,
			'end' => 1455407999,
		);

		$this->assertEquals( $expected, get_weekstartend( '2016-02-12', 0 ) );

	}

	function test_get_weekstartend_bad_option() {
		$current_option = get_option( 'start_of_week' );
		delete_option( 'start_of_week' );

		$expected = array(
			'start' => 1454803200,
			'end' => 1455407999,
		);

		$this->assertEquals( $expected, get_weekstartend( '2016-02-12' ) );


		update_option( 'start_of_week',$current_option );
	}

	function test_get_weekstartend_start_of_week_set_strtotime() {

		$expected = array(
			'start' => 1454889600,
			'end' => 1455494399,
		);

		$this->assertEquals( $expected, get_weekstartend( date( 'Y-m-d', strtotime( '2016-02-12' ) ) ) );

	}


	// start of is set to monday as default
	function test_get_weekstartend_start_of_week_set_to_sunday() {
		$expected = array(
			'start' => strtotime( '2016-02-08 00:00:00' ), // monday for week before
			'end' => strtotime( '2016-02-14 23:59:59' ),
		);

		$this->assertEquals( $expected, get_weekstartend( '2016-02-14' )  );

	}
}