<?php
/*
 * Test absint().
 *
 * @group functions.php
 *
*/

/**
 * Converts value to nonnegative integer.
 *
 * @since 2.5.0
 *
 * @param mixed $maybeint Data you wish to have converted to a nonnegative integer
 * @return int An nonnegative integer
 */
// function absint( $maybeint ) {
// 	return abs( intval( $maybeint ) );
// }





class Tests_Absint extends WP_UnitTestCase {
	function setUp() {
		parent::setUp();
	}
	/*
	* helper funtion to switch tests for 64 bit systems
	*/
	private function is_64_bit(){
		if ( 8 === PHP_INT_SIZE ){
			return true;
		}
		return false;
	}

	/**
	 * testing numbers
	 * note the 4.9999999999999999 becomes 5 not 4
	 */
	function test_absint() {
		$this->assertEquals( absint( 1 ), 1, '1' );
		$this->assertEquals( absint( -1 ), 1, '-1' );
		$this->assertEquals( absint( 999 ), 999, '999' );
		$this->assertEquals( absint( -999 ), 999, '-999');
		$this->assertEquals( absint( 0 ), 0, '0');
		$this->assertEquals( absint( 4.0000000000000000001 ), 4, '4.0000000000000000001' );
		$this->assertEquals( absint( 4.4999999999999999999 ), 4, '4.4999999999999999999' );
		$this->assertEquals( absint( 4.5 ), 4, '4.5' );
		$this->assertEquals( absint( 4.5000000000000000001 ), 4, '4.5000000000000000001' );
		$this->assertEquals( absint( 4.51 ), 4, '4.51' );
		$this->assertEquals( absint( 4.6 ), 4, '4.6' );
		$this->assertEquals( absint( 4.7 ), 4, '4.7' );
		$this->assertEquals( absint( 4.8 ), 4, '4.8' );
		$this->assertEquals( absint( 4.9 ), 4, '4.9' );	// double(4.9)
		$this->assertEquals( absint( 4.99 ), 4, '4.99' );
		$this->assertEquals( absint( 4.999 ), 4, '4.999' );
		$this->assertEquals( absint( 4.9999 ), 4, '4.9999' );
		$this->assertEquals( absint( 4.99999 ), 4, '4.99999' );
		$this->assertEquals( absint( 4.999999 ), 4, '4.999999' );
		$this->assertEquals( absint( 4.9999999 ), 4, '4.9999999' );
		$this->assertEquals( absint( 4.99999999 ), 4, '4.99999999' );
		$this->assertEquals( absint( 4.999999999 ), 4, '4.999999999' );
		$this->assertEquals( absint( 4.9999999999 ), 4, '4.9999999999' );
		$this->assertEquals( absint( 4.99999999999 ), 4, '4.99999999999' );
		$this->assertEquals( absint( 4.999999999999 ), 4, '4.999999999999' );
		$this->assertEquals( absint( 4.9999999999999 ), 4, '4.999999999999' );// double(4.999999999999)
		$this->assertEquals( absint( 4.99999999999999 ), 4, '4.99999999999999' ); // double(5)
		$this->assertEquals( absint( 4.999999999999999 ), 4, '4.999999999999999' );

		 // why does it swap to 4 where does the round up not round down come from
		$this->assertEquals( absint( 4.9999999999999999 ), 5, '4.9999999999999999' );
		$this->assertEquals( absint( 4.99999999999999999 ), 5, '4.99999999999999999' );
		$this->assertEquals( absint( 4.999999999999999999 ), 5, '4.999999999999999999' );
		$this->assertEquals( absint( 4.9999999999999999999 ), 5, '4.9999999999999999999' );

		$this->assertEquals( absint( 4.11111111111111111111 ), 4, '4.11111111111111111111' );
		$this->assertEquals( absint( 4.555555555555555555555 ), 4, '4.555555555555555555555' );


		$this->assertEquals( absint( 4.99999999999999 ), 4, 		'4.99999999999999' );
		$this->assertEquals( absint( 49.9999999999999 ), 49, 		'49.9999999999999' );
		$this->assertEquals( absint( 499.999999999999 ), 499, 		'499.999999999999' );
		$this->assertEquals( absint( 4999.99999999999 ), 4999, 		'4999.99999999999' );
		$this->assertEquals( absint( 49999.9999999999 ), 49999, 	'49999.9999999999' );
		$this->assertEquals( absint( 499999.999999999 ), 499999, 	'499999.999999999' );
		$this->assertEquals( absint( 4999999.99999999 ), 4999999, 	'4999999.99999999' );
		$this->assertEquals( absint( 49999999.9999999 ), 49999999, 	'49999999.9999999' );
		$this->assertEquals( absint( 499999999.999999 ), 499999999, 	'499999999.999999' );

		$this->assertEquals( absint( 4.9999999999999999999 ), 5, 		'4.9999999999999999999' );
		$this->assertEquals( absint( 49.999999999999999999 ), 50, 		'49.999999999999999999' );
		$this->assertEquals( absint( 499.99999999999999999 ), 500, 		'499.99999999999999999' );
		$this->assertEquals( absint( 4999.9999999999999999 ), 5000, 		'4999.9999999999999999' );
		$this->assertEquals( absint( 49999.999999999999999 ), 50000, 	'49999.999999999999999' );
		$this->assertEquals( absint( 499999.99999999999999 ), 500000, 	'499999.99999999999999' );
		$this->assertEquals( absint( 4999999.9999999999999 ), 5000000, 	'4999999.9999999999999' );
		$this->assertEquals( absint( 49999999.999999999999 ), 50000000, 	'49999999.999999999999' );
		$this->assertEquals( absint( 499999999.99999999999 ), 500000000, 	'499999999.99999999999' );


		if ( $this->is_64_bit() ){
			$this->assertEquals( absint( 4999999999.9999999999 ), 5000000000, 			'4999999999.9999999999' );
			$this->assertEquals( absint( 49999999999.999999999 ), 50000000000, 		'49999999999.999999999' );
			$this->assertEquals( absint( 499999999999.99999999 ), 500000000000, 		'499999999999.99999999' );
			$this->assertEquals( absint( 4999999999999.9999999 ), 5000000000000, 		'4999999999999.9999999' );
			$this->assertEquals( absint( 49999999999999.999999 ), 50000000000000, 		'49999999999999.999999' );
			$this->assertEquals( absint( 499999999999999.99999 ), 500000000000000, 		'499999999999999.99999' );
			$this->assertEquals( absint( 4999999999999999.9999 ), 5000000000000000, 		'4999999999999999.9999' );
			$this->assertEquals( absint( 49999999999999999.999 ), 50000000000000000, 	'49999999999999999.999' );
			$this->assertEquals( absint( 499999999999999999.99 ), 500000000000000000, 	'499999999999999999.99' );
			$this->assertEquals( absint( 4999999999999999999.9 ), 5000000000000000000, 	'4999999999999999999.9' );
			$this->assertEquals( absint( 49999999999999999999 ),  5340232221128654848, 	'49999999999999999999' );
		} else {
			$this->assertEquals( absint( 4999999999.9999999999 ), 705032704, 	'4999999999.9999999999' );
			$this->assertEquals( absint( 49999999999.999999999 ), 1539607552, 	'49999999999.999999999' );
			$this->assertEquals( absint( 499999999999.99999999 ), 1783793664, 	'499999999999.99999999' );
			$this->assertEquals( absint( 4999999999999.9999999 ), 658067456, 	'4999999999999.9999999' );
			$this->assertEquals( absint( 49999999999999.999999 ), 2009260032, 	'49999999999999.999999' );
			$this->assertEquals( absint( 499999999999999.99999 ), 1382236160, 	'499999999999999.99999' );
			$this->assertEquals( absint( 4999999999999999.9999 ), 937459712, 	'4999999999999999.9999' );
			$this->assertEquals( absint( 49999999999999999.999 ), 784662528, 	'49999999999999999.999' );
			$this->assertEquals( absint( 499999999999999999.99 ), 743309312, 	'499999999999999999.99' );
		}


		$this->assertEquals( absint( 5 ), 5, '5' );
		$this->assertEquals( absint( 5.0000000000000000001 ), 5, '5.0000000000000000001' );
		$this->assertEquals( absint( -4.0000000000000000001 ), 4, '-4.0000000000000000001' );
		$this->assertEquals( absint( -4.4999999999999999999 ), 4, '-4.4999999999999999999' );
		$this->assertEquals( absint( -4.5 ), 4, '-4.5' );
		$this->assertEquals( absint( -4.5000000000000000001 ), 4, '-4.5000000000000000001' );
		$this->assertEquals( absint( -4.51 ), 4, '-4.51' );
		$this->assertEquals( absint( -4.9999999999999999999 ), 5, '-4.9999999999999999999' );
		$this->assertEquals( absint( -5 ), 5, '-5' );
		$this->assertEquals( absint( -5.0000000000000000001 ), 5, '-5.0000000000000000001' );

	}

	/**
	 *  test passing in strings
	 */
	function test_absint_strings() {

		$this->assertEquals( absint( '1' ), 1, '1' );
		$this->assertEquals( absint( '-1' ), 1, '-1');
		$this->assertEquals( absint( '1_string' ), 1, '1_string' );
		$this->assertEquals( absint( '-1_string' ), 1, '1_string' );
		$this->assertEquals( absint( '1_this_a_very_extra_long_string_that_so_long_that_might_brack_or_might_not_but_we_need_to_test' ), 1, '1_very_long_string' );
		$this->assertEquals( absint( '1 string with spaces' ), 1, '1 string with spaces' );
		$this->assertEquals( absint( '1_1' ), 1, '1_1' );
		$this->assertEquals( absint( '1 1 1 ' ), 1, '1 1 1 ' );
		$this->assertEquals( absint( '1 . 1 1 ' ), 1, '1 . 1 1 ' );

		$number = '1';
		$this->assertEquals( absint( $number ), 1, '1$number' );
		$this->assertEquals( absint( "1$number" ), 11, '1$number' );
		$this->assertEquals( absint( "1".$number ), 11, '"1".$number' );
		$this->assertEquals( absint( '1'.$number ), 11, "'1'.$number" );

		$number = 1;
		$this->assertEquals( absint( $number ), 1, '1$number' );
		$this->assertEquals( absint( "1$number" ), 11, '1$number' );
		$this->assertEquals( absint( "1".$number ), 11, '"1".$number' );
		$this->assertEquals( absint( '1'.$number ), 11, "'1'.$number" );



		$this->assertEquals( absint( '999_string' ), 999, '999_string' );
		$this->assertEquals( absint( '0' ), 0, '0' );
		$this->assertEquals( absint( 'zero' ), 0, 'zero' );
		$this->assertEquals( absint( 'string_1' ), 0, 'string_1' );
		$this->assertEquals( absint( 'one' ), 0 ,'one' );
		$this->assertEquals( absint( 'two' ), 0 ,'two' );
		$this->assertEquals( absint( '-one' ), 0 ,'-one' );
		$this->assertEquals( absint( '-two' ), 0 ,'-two' );
		$this->assertEquals( absint( 'misus one' ), 0 ,'misus one' );
		$this->assertEquals( absint( 'misus two' ), 0 ,'misus two' );

		// 1 to the power of 10
		$this->assertEquals( absint( '1e10' ), 1 ,'(string)1e10' );
		if ( $this->is_64_bit() ){
			$this->assertEquals( absint( 1e10 ), 10000000000 ,'1e10 - 64' );
			$this->assertEquals( absint( 1e20 ), 7766279631452241920,'1e20 - 64' );

		} else{
			$this->assertEquals( absint( 1e10 ), 1410065408 ,'1e10 - 32' );
		}

		$this->assertEquals( absint( 0x1A ), 26 ,'0x1A' );
		$this->assertEquals( absint( '0x1A' ), 0 ,'(string)0x1A' );


	}
	/*
	*  PHP_INT_MAX
	*/
	function test_absint_PHP_INT_MAX() {

		$this->assertEquals( absint( PHP_INT_MAX ), PHP_INT_MAX, ' PHP_INT_MAX ');
		$this->assertEquals( absint( -PHP_INT_MAX ), PHP_INT_MAX, ' -PHP_INT_MAX ' );

		$this->assertEquals( absint( PHP_INT_MAX-1 ), PHP_INT_MAX-1, ' PHP_INT_MAX-1 ');

	}


	/**
	 * this fails in strange way as we have hit MAX Init
	 */
	function test_absint_over_max_int() {
		if ( $this->is_64_bit() ){
			$this->assertEquals( absint( PHP_INT_MAX +1 ),     9.2233720368547758E+18, 'PHP_INT_MAX+1-64bit' );
			$this->assertEquals( absint( PHP_INT_MAX +11 ),   9.2233720368547758E+18, 'PHP_INT_MAX+11-64bit' );
			$this->assertEquals( absint( PHP_INT_MAX +99 ),   9.2233720368547758E+18, 'PHP_INT_MAX+99-64bit' );
			$this->assertEquals( absint( PHP_INT_MAX +999 ), 9.2233720368547758E+18, 'PHP_INT_MAX+999-64bit' );
		}else{
			$this->assertEquals( absint( PHP_INT_MAX +1 ),     2147483648, 'PHP_INT_MAX+1-32bit' );
			$this->assertEquals( absint( PHP_INT_MAX +11 ),   2147483638, 'PHP_INT_MAX+11-32bit' );
			$this->assertEquals( absint( PHP_INT_MAX +99 ),   2147483550, 'PHP_INT_MAX+99-32bit' );
			$this->assertEquals( absint( PHP_INT_MAX +999 ), 2147482650, 'PHP_INT_MAX+999-32bit' );
		}

	}

	/**
	*  this is what you should get but we have hit max int
	* @ticket 28559
	*/
	function test_absint_that_fail_max_int(){

		if ( $this->is_64_bit() ){
			$this->assertEquals( absint( PHP_INT_MAX +1 ), 0, 'PHP_INT_MAX+1-64bit' );// Failed asserting that false matches expected 2147483648.
			$this->assertEquals( absint( PHP_INT_MAX +11 ), 0, 'PHP_INT_MAX+11-64bit' );// Failed asserting that false matches expected 2147483638.
			$this->assertEquals( absint( PHP_INT_MAX +99 ), 0, 'PHP_INT_MAX+99-64bit' );// Failed asserting that false matches expected 2147483550.
			$this->assertEquals( absint( PHP_INT_MAX +999 ), 0, 'PHP_INT_MAX+999-64bit' );// Failed asserting that false matches expected 2147482650.
		}else{
			$this->assertEquals( absint( PHP_INT_MAX +1 ), 0, 'PHP_INT_MAX+1-32bit' ); // Failed asserting that false matches expected 2147483648.
			$this->assertEquals( absint( PHP_INT_MAX +11 ), 0, 'PHP_INT_MAX+11-32bit' );  // Failed asserting that false matches expected 2147483638.
			$this->assertEquals( absint( PHP_INT_MAX +99 ), 0, 'PHP_INT_MAX+99-32bit' );  // Failed asserting that false matches expected 2147483550.
			$this->assertEquals( absint( PHP_INT_MAX +999 ), 0, 'PHP_INT_MAX+999-32bit' );  // Failed asserting that false matches expected 2147482650.
		}
	}


	/**
	 *  this is what you should get but we have hit max int
	 * @ticket 28559
	 */
	function test_absint_to_the_power_that_fails(){

		if ( $this->is_64_bit() ){
			$this->assertEquals( absint( 1e20 ), 100000000000000000000 ,'1e20' );
		} else{
			$this->assertEquals( absint( 1e10 ), 10000000000 ,'1e10' );  //Failed asserting that 10000000000 matches expected 1410065408.

		}

	}
	/**
	 * this is what you should get but we have hit max int
	 * @ticket 28559
	 */
	function test_absint_49999999999999999999(){
		if ( $this->is_64_bit() ){
			$this->assertEquals( absint( 49999999999999999999 ),  50000000000000000000, 	'49999999999999999999' );
		} else {
			$this->assertEquals( absint( 4999999999.9999999999 ), 5000000000, 			'4999999999.9999999999' );
		}
	}

	/**
	 *  at .9e16 absint returns 5 not 4
	 *  @ticket 28559
	 */
	public function  test_absint_dot_16()
	{
		$this->assertEquals( absint( 4.999999999999999 ), 4, '4.999999999999999' );

		 // why does it swap to 4 where does the round up not round down come from
		$this->assertEquals( absint( 4.9999999999999999 ), 4, '4.9999999999999999' );
	}


}

