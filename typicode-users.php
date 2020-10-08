<?php
declare(strict_types=1);

use Typicode\Users\Includes\Activator as typicodeUsersPluginActivator;
use Typicode\Users\Includes\Deactivator as typicodeUsersPluginDeactivator;
use Typicode\Users\Includes\Users as typicodeUsersPluginTypicodeUsers;

/** Load composer */
$composer = dirname(__FILE__) . '/vendor/autoload.php';
if ( file_exists($composer) ) {
    require_once $composer;
}

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://www.example.com
 * @since             1.0.0
 * @package           Typicode_Users
 *
 * @wordpress-plugin
 * Plugin Name:       typicode-users
 * Plugin URI:        typicode-users
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Himeshkumar Challa
 * Author URI:        http://www.example.com
 * License:           GPL-2.0-or-later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       typicode-users
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'TYPICODE_USERS_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-typicode-users-activator.php
 */
function activateTypicodeUsers() {
	typicodeUsersPluginActivator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-typicode-users-deactivator.php
 */
function deactivateTypicodeUsers() {
	typicodeUsersPluginDeactivator::deactivate();
}

register_activation_hook( __FILE__, 'activateTypicodeUsers' );
register_deactivation_hook( __FILE__, 'deactivateTypicodeUsers' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
// require plugin_dir_path( __FILE__ ) . 'src/includes/class-typicode-users.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function runTypicodeUsers() {

	$plugin = new typicodeUsersPluginTypicodeUsers();
	$plugin->run();

}
runTypicodeUsers();
