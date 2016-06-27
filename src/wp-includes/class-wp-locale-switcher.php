<?php
/**
 * Locale switcher object.
 *
 * @package    WordPress
 * @subpackage i18n
 */

/**
 * Class for switching locales.
 *
 * @since 4.6.0
 */
class WP_Locale_Switcher {

	/**
	 * Filter callbacks.
	 *
	 * @since 4.6.0
	 * @var callback[]
	 */
	private $filters = array();

	/**
	 * Locale stack.
	 *
	 * @since 4.6.0
	 * @var string[]
	 */
	private $locales = array();

	/**
	 * Original locale.
	 *
	 * @since 4.6.0
	 * @var string
	 */
	private $original_locale;

	/**
	 * Translation objects.
	 *
	 * @since 4.6.0
	 * @var NOOP_Translations[][]
	 */
	private $translations = array();

	/**
	 * Constructor. Stores the original locale.
	 *
	 * @since 4.6.0
	 */
	public function __construct() {

		$this->original_locale = get_locale();
	}

	public function load( $lang = null ) {
		if ( null !== $lang ) {
		require_once( ABSPATH . 'wp-admin/includes/translation-install.php' );
		global $locale;

		if( ! in_array( $lang, get_available_languages() ) ) {
		if ( array_key_exists( $lang, wp_get_available_translations() ) ) {
		$language = wp_download_language_pack( $lang );
		if ( $language ) {
		load_default_textdomain( $language );
		$locale = $language;
		}
		}
		} else{
			load_default_textdomain( $lang );
			$locale = $lang;
		}
		}

		$this->init();
		$this->register_globals();
		}
	/**
	 * Switches the translations according to the given locale.
	 *
	 * @since 4.6.0
	 *
	 * @param string $locale The locale.
	 *
	 * @return string $locale |false
	 */
	public function switch_to_locale( $locale ) {

		$current_locale = get_locale();
		if ( $current_locale === $locale ) {
			return $locale;
		}

		if ( ! in_array( $locale, get_available_languages() ) ) {
			return false;
		}

		// add here so not to record duplicate switches
		$this->locales[] = $locale;

		/**
		 * @global MO[] $l10n
		 */
		global $l10n;

		// return early if on no language to switch from
		if ( null === $l10n ) {
			return false;
		}

		$textdomains = array_keys( $l10n );

		if ( ! $this->has_translations_for_locale( $current_locale ) ) {
			foreach ( $textdomains as $textdomain ) {
				$this->translations[ $current_locale ][ $textdomain ] = get_translations_for_domain( $textdomain );
			}
		}

		$this->remove_filters();

		$this->add_filter_for_locale( $locale );

		if ( $this->has_translations_for_locale( $locale ) ) {
			foreach ( $textdomains as $textdomain ) {
				if ( isset( $this->translations[ $locale ][ $textdomain ] ) ) {
					$l10n[ $textdomain ] = $this->translations[ $locale ][ $textdomain ];
				}
			}
		} else {
			foreach ( $l10n as $textdomain => $mo ) {
				if ( 'default' === $textdomain ) {
					load_default_textdomain();

					continue;
				}

				unload_textdomain( $textdomain );

				if ( $mofile = $mo->get_filename() ) {
					load_textdomain( $textdomain, $mofile );
				}

				$this->translations[ $locale ][ $textdomain ] = get_translations_for_domain( $textdomain );
			}
		}

		/**
		 * @global WP_Locale $wp_locale
		 */
		$GLOBALS['wp_locale'] = new WP_Locale();

		return $locale;
	}

	/**
	 * Restores the translations according to the previous locale.
	 *
	 * @since 4.6.0
	 *
	 * @param bool $reset false
	 * @return false|string Locale on success, false on error.
	 */
	public function restore_locale( $reset = false ) {

		if ( ! array_pop( $this->locales ) ) {
			// The stack is empty, bail.
			return false;
		}
		$locale = $this->original_locale;
		$this->remove_filters();
		if ( false === $reset ) {
			if ( $locale = end( $this->locales ) ) {
				if ( isset( $this->filters[ $locale ] ) ) {
					add_filter( 'locale', $this->filters[ $locale ] );
				}
			}
		}

		/**
		 * @global MO[] $l10n
		 */
		global $l10n;

		foreach ( array_keys( $l10n ) as $textdomain ) {
			if ( isset( $this->translations[ $locale ][ $textdomain ] ) ) {
				$l10n[ $textdomain ] = $this->translations[ $locale ][ $textdomain ];
			}
		}

		/**
		 * @global WP_Locale $wp_locale
		 */
		$GLOBALS['wp_locale'] = new WP_Locale();

		return $locale;
	}

	/**
	 * Checks if there are cached translations for the given locale.
	 *
	 * @since 4.6.0
	 *
	 * @param string $locale The locale.
	 * @return bool True if there are cached translations for the given locale, false otherwise.
	 */
	private function has_translations_for_locale( $locale ) {

		return ! empty( $this->translations[ $locale ] );
	}

	/**
	 * Removes all filter callbacks added before.
	 *
	 * @since 4.6.0
	 */
	private function remove_filters() {

		foreach ( $this->filters as $filter ) {
			remove_filter( 'locale', $filter );
		}
	}

	/**
	 * Adds a filter callback returning the given locale.
	 *
	 * @since 4.6.0
	 *
	 * @param string $locale The locale.
	 */
	private function add_filter_for_locale( $locale ) {

		if ( ! isset( $this->filters[ $locale ] ) ) {
			require_once dirname( __FILE__ ) . '/class-wp-locale-storage.php';

			// This SHOULD be a closure.
			$this->filters[ $locale ] = array( new WP_Locale_Storage( $locale ), 'get' );
		}

		add_filter( 'locale', $this->filters[ $locale ] );
	}
}
