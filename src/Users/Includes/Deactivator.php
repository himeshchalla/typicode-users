<?php
declare(strict_types=1);
namespace Typicode\Users\Includes;

/**
 * Fired during plugin deactivation
 *
 * @link       http://www.example.com
 * @since      1.0.0
 *
 * @package    Typicode_Users
 * @subpackage Typicode_Users/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Typicode_Users
 * @subpackage Typicode_Users/includes
 * @author     Himeshkumar Challa <himeshchalla@gmail.com>
 */
class Deactivator
{

    /**
     * Short Description. (use period)
     *
     * Long Description.
     *
     * @since    1.0.0
     */
    public static function deactivate() {
        remove_action('init', [ __NAMESPACE__.'Activator', 'typicodeusers_rewrite']);
        remove_action('query_vars', [ __NAMESPACE__.'Activator', 'foo_set_query_var']);
        remove_filter('template_include', [ __NAMESPACE__.'Activator', 'foo_include_template'], 1000, 1);
    }
}
