<?php

namespace AddonsKitElementor\Traits;

defined( 'ABSPATH' ) || die();

trait Utilities{

	public const ALLOWED_HTML_TAGS = [
		'a',
		'article',
		'aside',
		'button',
		'div',
		'footer',
		'h1',
		'h2',
		'h3',
		'h4',
		'h5',
		'h6',
		'header',
		'main',
		'nav',
		'p',
		'section',
		'span',
	];

	/**
	 * Validate an HTML tag against a safe allowed list.
	 *
	 * @param string $tag
	 *
	 * @return string
	 */
	public static function validate_html_tag( $tag ) {
		return ( $tag && in_array( strtolower( $tag ), self::ALLOWED_HTML_TAGS ) ) ? $tag : 'div';
	}

	/**
	 * Safe print a validated HTML tag.
	 *
	 * @param string $tag
	 */
	public static function print_html_tag( $tag ) {
		// PHPCS - the method validate_html_tag is safe.
		echo self::validate_html_tag( $tag ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}



}
