<?php
/**
 * wordpress-develop.
 * User: Paul
 * Date: 2016-05-16
 *
 */

if ( !defined( 'WPINC' ) ) {
	die;
}

class test_Locale extends WP_UnitTestCase {

//	static $fr_lanf_files = array(
//		'admin-fr_FR.mo',
//		'admin-fr_FR.po',
//		'admin-network-fr_FR.mo',
//		'admin-network-fr_FR.po',
//		'continents-cities-fr_FR.mo',
//		'continents-cities-fr_FR.po',
//		'fr_FR.mo',
//		'fr_FR.po',
//	);
//
//
//	/**
//	 * pass a new locale into WP_locale and reset current locale
//	 */
//	function test_WP_locale(){
//
//		global $GLOBALS;
//
//		$GLOBALS['wp_locale'] = new WP_Locale( 'fr_FR' );
//
//		$this->assertEquals( 'fr_FR', get_locale() );
//
//		$this->assertEquals( 'dimanche', $GLOBALS['wp_locale']->weekday[0] );
//
//		foreach ( self::$fr_lanf_files as $file ) {
//			$this->assertEquals( true, file_exists( WP_LANG_DIR . '/' . $file ) );
//		}
//
//		// remove any fr lang files
//		$this->remove_lang_files();
//	}
//
//	function remove_lang_files() {
//		foreach ( self::$fr_lanf_files as $file ) {
//			$this->unlink( WP_LANG_DIR . '/' . $file );
//		}
//	}
}
