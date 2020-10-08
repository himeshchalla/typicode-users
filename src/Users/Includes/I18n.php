<?php
declare(strict_types=1);

namespace Typicode\Users\Includes;

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://www.example.com
 * @since      1.0.0
 *
 * @package    Typicode_Users
 * @subpackage Typicode_Users/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Typicode_Users
 * @subpackage Typicode_Users/includes
 * @author     Himeshkumar Challa <himeshchalla@gmail.com>
 */
class I18n
{

    /**
     * Load the plugin text domain for translation.
     *
     * @since    1.0.0
     */
    public function loadPluginTextDomain()
    {
        load_plugin_textdomain(
            'typicode-users',
            false,
            dirname(dirname(plugin_basename(__FILE__))) . '/languages/'
        );
    }
}
