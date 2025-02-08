<?php

namespace AddonsKitElementor\Classes;

defined( 'ABSPATH' ) || die();

class Helper{

	/**
	 * Sanitize a 'relation' operator.
	 *
	 * @param string $relation Raw relation key from the query argument.
	 *
	 * @return string Sanitized relation ('AND' or 'OR').
	 * @since 5.3.2
	 *
	 */
	public static function addonskit_sanitize_relation( $relation ) {
		if ( 'OR' === strtoupper( $relation ) ) {
			return 'OR';
		} else {
			return 'AND';
		}
	}
}
