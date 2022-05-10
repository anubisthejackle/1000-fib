<?php
/**
 * Reusable extensions for the Thousand Fib site.
 *
 * Plugin Name: Thousand Fib Extensions
 * Plugin URI: https://github.com/alleyinteractive/thousand-fib
 * Description: Extensions to the Thousand Fib site.
 * Version: 1.0.0
 * Author: Alley
 *
 * @package Thousand_Fib
 */

namespace Thousand_Fib;

// Include functions for working with assets (primarily JavaScript).
require_once __DIR__ . '/inc/assets.php';
require_once __DIR__ . '/inc/asset-loader-bridge.php';

// Include functions for working with meta.
require_once __DIR__ . '/inc/meta.php';

// Include functions.php for registering custom post types, etc.
require_once __DIR__ . '/functions.php';
