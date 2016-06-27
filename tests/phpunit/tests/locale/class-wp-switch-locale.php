<?php

/**
 * @group l10n
 * @group i18n
 */
class Tests_class_wp_switch_locale extends WP_UnitTestCase {

	function test_switches_to_when_no_I18N() {

		$this->assertFalse( switch_to_locale( 'es_ES' ) );
	}

	function test_switches_to_es() {
		// We need to something in order to set the Global $l10n
		$file = DIR_TESTDATA . '/pomo/simple.mo';
		 load_textdomain( 'wp-tests-domain', $file );


		$this->assertEquals( 'es_ES', switch_to_locale( 'es_ES' ) );

		$this->assertEquals( 'es_ES', get_locale() );

		$this->assertEquals( 'en_GB', switch_to_locale( 'en_GB' ) );

		$this->assertEquals( 'en_GB', get_locale() );

		// return early if you try to switch to the same locale
		$this->assertEquals( 'en_GB', switch_to_locale( 'en_GB' ) );

		$this->assertEquals( 'en_GB', get_locale() );

		$this->assertEquals( 'es_ES', restore_locale() );

		$this->assertEquals( 'es_ES', get_locale() );

		$this->assertEquals( 'en_US', restore_locale( true ) );

		$this->assertEquals( 'en_US', get_locale() );

		$this->assertEquals( 'xx_XX', switch_to_locale( 'xx_XX' ) );

		$this->assertEquals( 'xx_XX', get_locale() );

		// tidy up
		unload_textdomain( 'wp-tests-domain' );
		global $l10n;
		$l10n = null;
	}


	function test_switches_to_when_no_I18N_after() {

		$this->assertFalse( switch_to_locale( 'es_ES' ) );
		$this->assertFalse( switch_to_locale( 'en_GB' ) );
	}
}
