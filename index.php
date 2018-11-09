<?php
/**
 * Reusable extensions for the WP Starter Plugin site.
 *
 * Plugin Name: WP Starter Plugin Extensions
 * Plugin URI: https://github.com/alleyinteractive/wp-starter-plugin
 * Description: Extensions to the WP Starter Plugin site.
 * Version: 1.0.0
 * Author: Alley
 *
 * @package WP_Starter_Plugin
 */

namespace WP_Starter_Plugin;

// Include functions for working with assets (primarily JavaScript).
require_once __DIR__ . '/inc/assets.php';

// Include functions for working with meta.
require_once __DIR__ . '/inc/meta.php';

// Register custom meta fields.
register_meta_helper( 'post', [ 'page', 'post' ], 'open_graph_description' );
register_meta_helper( 'post', [ 'page', 'post' ], 'open_graph_image', [ 'type' => 'integer' ] );
register_meta_helper( 'post', [ 'page', 'post' ], 'open_graph_title' );
