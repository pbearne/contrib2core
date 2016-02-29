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


/**
 * Convert integer number to format based on the locale.
 *
 * @since 2.3.0
 *
 * @global WP_Locale $wp_locale
 *
 * @param int $number   The number to convert based on locale.
 * @param int $decimals Optional. Precision of the number of decimal places. Default 0.
 * @return string Converted number in string format.
 */
function XXnumber_format_i18n( $number, $decimals = 0 ) {
	global $wp_locale;

	if ( isset( $wp_locale ) ) {
		$formatted = number_format( $number, absint( $decimals ), $wp_locale->number_format['decimal_point'], $wp_locale->number_format['thousands_sep'] );
	} else {
		$formatted = number_format( $number, absint( $decimals ) );
	}

	/**
	 * Filter the number formatted based on the locale.
	 *
	 * @since  2.8.0
	 *
	 * @param string $formatted Converted number in string format.
	 */
	return apply_filters( 'number_format_i18n', $formatted );
}



class Tests_Functions_number_format_i18n extends WP_UnitTestCase {

	/**
	 *
	 */
	function test_number_format_i18n_number_is_not_number() {

		$this->assertEquals( '0', number_format_i18n( 'seven' ) );
	}

	/**
	 *
	 */
	function test_number_format_i18n_decimal_is_not_number() {

		$this->assertEquals( number_format_i18n( 10, 'seven' ) , '10' );
	}

	/**
	 *
	 */
	function test_number_format_i18n_large() {
		global $wp_locale;
		$wp_locale->number_format['decimal_point'] = '@';
		$wp_locale->number_format['thousands_sep'] = '^';

		$this->assertEquals( '1^000@00', number_format_i18n( 1000.00, 2 ) );
		$this->assertEquals( '1^234^567^890@00000', number_format_i18n( 1234567890.00, 5 ) );
		// clear $wp_locale
		$wp_locale = null;
	}
	/**
	 *
	 */
	function test_number_format_i18n_no_global_and_us() {

		$this->assertEquals( '1,000.00', number_format_i18n( 1000.00, 2 ) );
		$this->assertEquals( '1,234,567,890.00000', number_format_i18n( 1234567890.00, 5 ) );
	}

	/**
	 *
	 */
	function test_number_format_i18n_brazil() {
		global $wp_locale;
		$wp_locale->number_format['decimal_point'] = ',';
		$wp_locale->number_format['thousands_sep'] = '.';

		$this->assertEquals( '1.000,00', number_format_i18n( 1000.00, 2 ) );
		$this->assertEquals( '1.234.567.890,00000', number_format_i18n( 1234567890.00, 5 ) );
		// clear $wp_locale
		$wp_locale = null;
	}
}