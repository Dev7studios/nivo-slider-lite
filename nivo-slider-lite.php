<?php
/**
 * Plugin Name: Nivo Slider Lite
 * Plugin URI: https://themeisle.com/plugins/nivo-slider-lite
 * Description: Nivo Slider is The Most Popular And Easiest to Use WordPress Slider Plugin.
 * Version: 2.1.2
 * Author: ThemeIsle
 * Author URI: https://themeisle.com/
 * Text Domain: nivo-slider
 * Domain Path: languages
 * WordPress Available:  yes
 * Requires License:    no
 * Pro Slug:    nivo-slider
 **/
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-nivo-slider-activator.php
 */
function activate_nivo_slider() {
	Nivo_Slider_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-nivo-slider-deactivator.php
 */
function deactivate_nivo_slider() {
	Nivo_Slider_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_nivo_slider' );
register_deactivation_hook( __FILE__, 'deactivate_nivo_slider' );
/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 *
 * @since    3.0.0
 */
function nivo_slider_autoload( $class ) {
	$namespaces = array( 'Nivo_Slider', 'Nivo_Core', 'Nivo' );
	foreach ( $namespaces as $namespace ) {
		if ( substr( $class, 0, strlen( $namespace ) ) == $namespace ) {
			$filename = plugin_dir_path( __FILE__ ) . 'includes/class-' . str_replace( '_', '-', strtolower( $class ) ) . '.php';
			if ( is_readable( $filename ) ) {
				require_once $filename;

				return true;
			}
			$filename = plugin_dir_path( __FILE__ ) . 'includes/abstract/class-' . str_replace( '_', '-', strtolower( $class ) ) . '.php';
			if ( is_readable( $filename ) ) {
				require_once $filename;

				return true;
			}
			$filename = plugin_dir_path( __FILE__ ) . 'includes/interface/class-' . str_replace( '_', '-', strtolower( $class ) ) . '.php';
			if ( is_readable( $filename ) ) {
				require_once $filename;

				return true;
			}
			$filename = plugin_dir_path( __FILE__ ) . 'includes/admin/class-' . str_replace( '_', '-', strtolower( $class ) ) . '.php';
			if ( is_readable( $filename ) ) {
				require_once $filename;

				return true;
			}
			$filename = plugin_dir_path( __FILE__ ) . 'includes/admin/libs/class-' . str_replace( '_', '-', strtolower( $class ) ) . '.php';
			if ( is_readable( $filename ) ) {
				require_once $filename;

				return true;
			}
		}
	}

	return false;
}

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    3.0.0
 */
function run_nivo_slider() {
	// Plugin Folder Path
	if ( ! defined( 'NIVO_SLIDER_PLUGIN_DIR' ) ) {
		define( 'NIVO_SLIDER_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
	}
	// Plugin Folder URL
	if ( ! defined( 'NIVO_SLIDER_PLUGIN_URL' ) ) {
		define( 'NIVO_SLIDER_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
	}
	// Plugin Root File
	if ( ! defined( 'NIVO_SLIDER_PLUGIN_FILE' ) ) {
		define( 'NIVO_SLIDER_PLUGIN_FILE', __FILE__ );
	}
	// Plugin Basename
	if ( ! defined( 'NIVO_SLIDER_PLUGIN_BASENAME' ) ) {
		define( 'NIVO_SLIDER_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
	}
	if ( ! defined( 'NIVO_PRO_UPSELL' ) ) {
		define( 'NIVO_PRO_UPSELL', 'https://themeisle.com/plugins/nivo-slider' );
	}
	// Developer URL
	$plugin = new Nivo_Slider();
	$plugin->run();
	$vendor_file = NIVO_SLIDER_PLUGIN_DIR . '/vendor/autoload_52.php';
	if ( is_readable( $vendor_file ) ) {
		require_once $vendor_file;
	}
	add_filter(
		'themeisle_sdk_products', function ( $products ) {
			$products[] = NIVO_SLIDER_PLUGIN_FILE;

			return $products;
		}
	);

}

spl_autoload_register( 'nivo_slider_autoload' );
run_nivo_slider();
if ( ! function_exists( 'nivo_slider' ) ) {
	function nivo_slider( $slider, $return = false ) {
		$slug = '';
		$id   = 0;
		if ( is_numeric( $slider ) ) {
			$id = $slider;
		} else {
			$slug = $slider;
		}
		if ( $return ) {
			return do_shortcode( '[nivoslider slug="' . $slug . '" id="' . $id . '" template="1"]' );
		} else {
			echo do_shortcode( '[nivoslider slug="' . $slug . '" id="' . $id . '" template="1"]' );
		}
	}
}
