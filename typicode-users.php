<?php
declare(strict_types=1);

defined( 'ABSPATH' ) OR exit;

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

// register_activation_hook( __FILE__, 'activateTypicodeUsers' );
// register_deactivation_hook( __FILE__, 'deactivateTypicodeUsers' );

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





function WCM_Setup_Demo_on_activation()
{
    if ( ! current_user_can( 'activate_plugins' ) )
        return;
    $plugin = isset( $_REQUEST['plugin'] ) ? $_REQUEST['plugin'] : '';
    check_admin_referer( "activate-plugin_{$plugin}" );

    # Uncomment the following line to see the function in action
	// exit( var_dump( $_GET ) );

	// add_action('init', 'typicodeusers_rewrite');
    global $wp_rewrite;

    //set up our query variable %fake_page% which equates to index.php?fake_page=
    add_rewrite_tag( '%typicodeusers%', '([^&]+)');

    //add rewrite rule that matches /blog/page/2, /blog/page/3, /blog/page/4, etc..
    add_rewrite_rule('^typicodeusers/page/?([0-9])?','index.php?typicodeusers=typicodeusers&paged=$matches[1]','top');

    //add rewrite rule that matches /blog
    add_rewrite_rule('^typicodeusers/?','index.php?typicodeusers=typicodeusers','top');

    //add endpoint, in this case 'blog' to satisfy our rewrite rule /blog, /blog/page/ etc..
    add_rewrite_endpoint( 'typicodeusers', EP_PERMALINK | EP_PAGES );

    //flush rules to get this to work properly
    $wp_rewrite->flush_rules();

	add_action('query_vars','foo_set_query_var');
	add_filter('template_include', 'foo_include_template', 1000, 1);
}

function WCM_Setup_Demo_on_deactivation()
{
    if ( ! current_user_can( 'activate_plugins' ) )
        return;
    $plugin = isset( $_REQUEST['plugin'] ) ? $_REQUEST['plugin'] : '';
	check_admin_referer( "deactivate-plugin_{$plugin}" );

	remove_action('init', 'typicodeusers_rewrite');
	remove_action('query_vars','foo_set_query_var');
	remove_filter('template_include', 'foo_include_template', 1000, 1);

	global $wp_rewrite;

    //set up our query variable %fake_page% which equates to index.php?fake_page=
	remove_rewrite_tag('%typicodeusers%');

    //flush rules to get this to work properly
	$wp_rewrite->flush_rules();

    # Uncomment the following line to see the function in action
    // exit( var_dump( $_GET ) );
}

function WCM_Setup_Demo_on_uninstall()
{
    if ( ! current_user_can( 'activate_plugins' ) )
        return;
    check_admin_referer( 'bulk-plugins' );

    // Important: Check if the file is the one
    // that was registered during the uninstall hook.
    if ( __FILE__ != WP_UNINSTALL_PLUGIN )
        return;

    # Uncomment the following line to see the function in action
    exit( var_dump( $_GET ) );
}


function typicodeusers_rewrite(){

    global $wp_rewrite;

    //set up our query variable %fake_page% which equates to index.php?fake_page=
    add_rewrite_tag( '%typicodeusers%', '([^&]+)');

    //add rewrite rule that matches /blog/page/2, /blog/page/3, /blog/page/4, etc..
    add_rewrite_rule('^typicodeusers/page/?([0-9])?','index.php?typicodeusers=typicodeusers&paged=$matches[1]','top');

    //add rewrite rule that matches /blog
    add_rewrite_rule('^typicodeusers/?','index.php?typicodeusers=typicodeusers','top');

    //add endpoint, in this case 'blog' to satisfy our rewrite rule /blog, /blog/page/ etc..
    add_rewrite_endpoint( 'typicodeusers', EP_PERMALINK | EP_PAGES );

    //flush rules to get this to work properly
    $wp_rewrite->flush_rules();
}

function foo_set_query_var($vars) {
    array_push($vars, 'typicodeusers');
    return $vars;
}

function foo_include_template($template){
    if(get_query_var('typicodeusers', 'typicodeusers')){
        $new_template = WP_PLUGIN_DIR.'/typicode-users/src/Users/Frontend/test1.php';
        if(file_exists($new_template))
            $template = $new_template;
    }
    // return "yahooooooooooo tha dha dha thahhhoahohoh yahooo";
    return $template;
}

register_activation_hook(   __FILE__, 'WCM_Setup_Demo_on_activation' );
register_deactivation_hook( __FILE__, 'WCM_Setup_Demo_on_deactivation' );
register_uninstall_hook(    __FILE__, 'WCM_Setup_Demo_on_uninstall' );