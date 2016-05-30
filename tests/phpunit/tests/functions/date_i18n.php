<?php


/**
 * Test functions against date_i18n.
 * Tested scenarios:
 *  1)
 *  2)
 *  3)
 *  4)
 *  5)
 * @group functions.php
 */
class Tests_Functions_date_i18n extends WP_UnitTestCase {

	function test_date_i18n() {

		$this->assertEquals( '    16-Apr-30', date_i18n( '    y-M-t' ) );
	}

	function test_date_i18n_back_slash() {


		$this->assertEquals( '16Mt', date_i18n( 'y\M\t' ) );
	}

	function test_date_i18n_bdate_DATE_ATOM() {

		$now = date( 'Y-m-d\TH:i:sP' );
		$this->assertEquals( $now, date_i18n( 'Y-m-d\TH:i:sP' ) );
	}

	function test_date_i18n_foward_slash() {

		$this->assertEquals( '16/Apr/30', date_i18n( 'y/M/t' ) );
	}


	function test_date_i18n_no_space() {

		$this->assertEquals( 'Apr-30', date_i18n( 'M-t' ) );
	}

	function test_date_i18n_space() {

		$this->assertEquals( ' Apr-30', date_i18n( ' M-t' ) );
	}

	function test_date_i18n_DATE_W3C() {
		$now = date( DATE_W3C );
		$this->assertEquals( $now , date_i18n( DATE_W3C, get_the_date( 'U' ) ) );
	}

	function test_date_i18n_DATE_W3C_no_option() {
		$now = date( DATE_W3C );
		$timezone_string = get_option( 'timezone_string' );
		delete_option( 'timezone_string' );
		$this->assertEquals( $now, date_i18n( DATE_W3C, get_the_date( 'U' ) ) );

		update_option( 'timezone_string', $timezone_string );
	}

	function test_date_i18n_all_the_leters() {

		$this->assertEquals( 'Tue-April-Tuesday-Apr-am-AM-+00:00-0-+0000-GMT-0-UTC' , date_i18n( 'D-F-l-M-a-A-P-I-O-T-Z-e' ), strtotime( '2016-04-18' ) );
	}


	function test_tran(){
		require_once( ABSPATH . 'wp-admin/includes/translation-install.php' );
		print_r( wp_get_available_translations() );
		print_r( get_available_languages() );
	}


	


}