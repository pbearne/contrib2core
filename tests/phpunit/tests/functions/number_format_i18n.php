<?php
/**
 *	Test the number_format_i18n function by providing a string, wrong format,
 *	custom separators, and agains the values from en_US (, for thousands - . for decimal)
 *	and pt_BR (. for thousands - , for decimal).
 *
 * @group functions
 */
class Tests_Functions_number_format_i18n_old extends WP_UnitTestCase {

	/**
	 *
	 */
	function test_number_format_i18n_number_is_not_number() {

		$this->assertEquals( 0, number_format_i18n( 'seven' ) );

	}
	/**
	 *
	 */
	function test_number_format_i18n_number_in_a_string() {

		$this->assertEquals( 7, number_format_i18n( '7' ) );
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
	function test_number_format_i18n_decimal_is_not_number_no_in_string() {

		$this->assertEquals( number_format_i18n( 10, '7' ) , 10.0000000 );
	}
	/**
	 *
	 *
	 */
	function test_number_format_i18n_custom_separator() {
		global $wp_locale;
		$wp_locale->number_format['decimal_point'] = '@';
		$wp_locale->number_format['thousands_sep'] = '^';

		$this->assertEquals( '1^000@00', number_format_i18n( 1000.00, 2 ) );
		$this->assertEquals( '1^000@00', number_format_i18n( (int)1000, 2 ) );
		$this->assertEquals( '1^234^567^890@00000', number_format_i18n( 1234567890.00, 5 ) );
		$this->assertEquals( '1^234^567^890@99999', number_format_i18n( 1234567890.99999, 5 ) );
		$this->assertEquals( '1^234^567^890@50000', number_format_i18n( 1234567890.5, 5 ) );
		// clear $wp_locale
		$wp_locale = null;
	}
	/**
	 *
	 */
	function test_number_format_i18n_no_global_and_us() {

		$this->assertEquals( '1,000.00', number_format_i18n( 1000.00, 2 ) );
		$this->assertEquals( '1,000.00', number_format_i18n( (int)1000, 2 ) );
		$this->assertEquals( '1,234,567,890.00000', number_format_i18n( 1234567890.00, 5 ) );
		$this->assertEquals( '1,234,567,890.99999', number_format_i18n( 1234567890.99999, 5 ) );
		$this->assertEquals( '1,234,567,890.50000', number_format_i18n( 1234567890.5, 5 ) );
	}

	/**
	 *
	 */
	function test_number_format_i18n_brazil() {
		global $wp_locale;
		$wp_locale->number_format['decimal_point'] = ',';
		$wp_locale->number_format['thousands_sep'] = '.';

		$this->assertEquals( '1.000,00', number_format_i18n( 1000.00, 2 ) );
		$this->assertEquals( '1.000,00', number_format_i18n( (int)1000, 2 ) );
		$this->assertEquals( '1.234.567.890,00000', number_format_i18n( 1234567890.00, 5 ) );
		$this->assertEquals( '1.234.567.890,99999', number_format_i18n( 1234567890.99999, 5 ) );
		$this->assertEquals( '1.234.567.890,50000', number_format_i18n( 1234567890.5, 5 ) );
		// clear $wp_locale
		$wp_locale = null;
	}
}