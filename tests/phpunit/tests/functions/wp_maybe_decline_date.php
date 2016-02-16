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

class Tests_Functions_wp_maybe_decline_date extends WP_UnitTestCase {

	/**
	 *
	 */
	function test_wp_maybe_decline_date_pass_empty_date() {

		$this->assertEquals( wp_maybe_decline_date( '2016-July-12' ), '2016-July-12' );
	}

	/**
	 *
	 */
	function test_wp_maybe_decline_date_pass_date_to_ca_locle() {
		$posable_months = array(
			"gener",
			"febrer",
			"març",
			"abril",
			"maig",
			"juny",
			"juliol",
			"agost",
			"setembre",
			"octubre",
			"novembre",
			"desembre"
		);

		foreach ( $posable_months as $month ) {
			$this->wp_maybe_decline_date_pass_date_to_ca_locle( '2012 de' . $month . '12', "2012 d'" . $month . '12' );
		}

	}


	function wp_maybe_decline_date_pass_date_to_ca_locle( $expanded, $compact ) {
		add_filter( 'locale', array( __CLASS__, 'set_locale_to_ca' ) );
		$this->assertEquals( "2016 d'agost 12", wp_maybe_decline_date( '2016 de agost 12' ) );
	}

	public static function set_locale_to_ca( $locale ) {
		return 'ca';
	}

	public static function set_locale_to_pl( $locale ) {
		return 'pl';
	}


	function test_wp_maybe_decline_date_pass_date() {
		global $wp_locale;
		add_filter( 'locale', array( __CLASS__, 'set_locale_to_pl' ) );
		add_filter( 'gettext_with_context', array( __CLASS__, 'set_gettext_to_on' ), 10, 3 );

		$month_names = array( 'Siječanj', 'Veljača', 'Ožujak', 'Travanj', 'Svibanj', 'Lipanj', 'Srpanj', 'Kolovoz', 'Rujan', 'Listopad', 'Studeni', 'Prosinac' );
		$wp_locale->month = $month_names;
		$month_names_genitive = array( 'siječnja', 'veljače', 'ožujka', 'travnja', 'svibnja', 'lipnja', 'srpnja', 'kolovoza', 'rujna', 'listopada', 'studenoga', 'prosinca' );
		$wp_locale->month_genitive = $month_names_genitive;

		foreach ( $month_names as $index => $month ) {
			$this->assertEquals( wp_maybe_decline_date( '16 ' . $month . ' 2012' ), '16 ' . $month_names_genitive[ $index ] . ' 2012' );
		}


		$this->assertEquals( '16 siječnja 2012', wp_maybe_decline_date( '16 Siječanj 2012' ) );
	}

	public static function set_gettext_to_on( $translated, $text, $context ) {
		if ( 'decline months names: on or off' === $context ) {
			return 'on';
		}
	}

}