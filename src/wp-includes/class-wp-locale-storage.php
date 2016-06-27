<?php
/**
 * Simple single (locale) value storage.
 *
 * @package    WordPress
 * @subpackage i18n
 */

/**
 * Class for locale storage objects with a getter.
 *
 * @since 4.6.0
 */
class WP_Locale_Storage {

	/**
	 * The stored locale.
	 *
	 * @since 4.6.0
	 * @var string
	 */
	private $locale;

	/**
	 * Constructor. Stores the given locale.
	 *
	 * @since 4.6.0
	 *
	 * @param string $locale The locale.
	 */
	public function __construct( $locale ) {

		$this->locale = (string) $locale;
	}

	/**
	 * Returns the stored locale.
	 *
	 * @since 4.6.0
	 *
	 * @return string The stored locale.
	 */
	public function get() {

		return $this->locale;
	}
}
