<?php
/**
 * Contains functions for working with meta.
 *
 * @package WP_Starter_Plugin
 */

namespace WP_Starter_Plugin;

/**
 * Register meta for posts or terms with sensible defaults and sanitization.
 *
 * @throws \InvalidArgumentException For unmet requirements.
 *
 * @see \register_post_meta
 * @see \register_term_meta
 *
 * @param string $object_type  The type of meta to register, which must be one of 'post' or 'term'.
 * @param array  $object_slugs The post type or taxonomy slugs to register with.
 * @param string $meta_key     The meta key to register.
 * @param array  $args         Optional. Additional arguments for register_post_meta or register_term_meta. Defaults to an empty array.
 * @return bool True if the meta key was successfully registered in the global array, false if not.
 */
function register_meta_helper(
	string $object_type,
	array $object_slugs,
	string $meta_key,
	array $args = []
) : bool {

	// Object type must be either post or term.
	if ( ! in_array( $object_type, [ 'post', 'term' ], true ) ) {
		throw new \InvalidArgumentException( __( 'Object type must be one of "post", "term".', 'wp-starter-plugin' ) );
	}

	// Merge provided arguments with defaults.
	$args = wp_parse_args(
		$args,
		[
			'sanitize_callback' => __NAMESPACE__ . '\sanitize_meta_by_type',
			'show_in_rest'      => true,
			'single'            => true,
			'type'              => 'string',
		]
	);

	// Perform additional checks and set default values based on type.
	switch ( $args['type'] ) {
		case 'boolean':
			if ( isset( $args['show_in_rest']['schema']['default'] )
				&& ! is_bool( $args['show_in_rest']['schema']['default'] )
			) {
				throw new \InvalidArgumentException( __( 'Default value of boolean meta must be boolean.', 'wp-starter-plugin' ) );
			} elseif ( ! isset( $args['show_in_rest']['schema']['default'] ) ) {
				$args['show_in_rest']['schema']['default'] = false;
			}
			break;
		case 'integer':
			if ( ! isset( $args['show_in_rest']['schema']['default'] ) ) {
				$args['show_in_rest']['schema']['default'] = 0;
			}
			break;
		case 'string':
			if ( ! isset( $args['show_in_rest']['schema']['default'] ) ) {
				$args['show_in_rest']['schema']['default'] = '';
			}
			if ( isset( $args['show_in_rest']['schema']['format'] ) ) {
				switch ( $args['show_in_rest']['schema']['format'] ) {
					case 'uri':
						$args['sanitize_callback'] = 'esc_url_raw';
						break;
				}
			}
			break;
	}

	// Fork for object type.
	switch ( $object_type ) {
		case 'post':
			foreach ( $object_slugs as $object_slug ) {
				if ( ! register_post_meta( $object_slug, $meta_key, $args ) ) {
					return false;
				}
			}
			break;
		case 'term':
			foreach ( $object_slugs as $object_slug ) {
				if ( ! register_term_meta( $object_slug, $meta_key, $args ) ) {
					return false;
				}
			}
			break;
		default:
			return false;
	}

	return true;
}

/**
 * A 'sanitize_callback' for a registered meta key that sanitizes based on type.
 *
 * @param mixed  $meta_value Meta value to sanitize.
 * @param string $meta_key   Meta key.
 * @param string $meta_type  Object type.
 * @return mixed Sanitized meta value.
 */
function sanitize_meta_by_type( $meta_value, $meta_key, $meta_type ) {
	$registered = get_registered_meta_keys( $meta_type );

	// Ensure the meta key is registered.
	if ( empty( $registered[ $meta_key ] ) ) {
		return $meta_value;
	}

	// Ensure a type is set.
	$args = $registered[ $meta_key ];
	if ( empty( $args['type'] ) ) {
		return $meta_value;
	}

	// Sanitize by type.
	switch ( $args['type'] ) {
		case 'boolean':
			return rest_sanitize_boolean( $meta_value );
		case 'integer':
			return (int) $meta_value;
		case 'number':
			return (float) $meta_value;
		case 'string':
			return sanitize_text_field( trim( $meta_value ) );
	}

	return $meta_value;
}
