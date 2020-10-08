<?php
/**
 * Admin
 *
 * The admin-specific functionality of the plugin.
 *
 * @link       http://www.example.com
 * @since      1.0.0
 * @package    Typicode/Users
 * @subpackage Backend/Admin
 * @author     Himeshkumar <abcdefghijklmnopqrstuvwxyz@example.me>
 * @link       http://www.example.com
 * @since      1.0.0
 */
declare(strict_types=1);

namespace Typicode\Users\Backend;

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Typicode/Users
 * @subpackage Backend/Admin
 * @author     Himeshkumar <abcdefghijklmnopqrstuvwxyz@example.me>
 */
class Admin
{

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $pluginName    The ID of this plugin.
     */
    private $pluginName;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since 1.0.0
     * @param string $pluginName The name of this plugin.
     * @param string $version    The version of this plugin.
     */
    public function __construct(string $pluginName, string $version)
    {
        $this->pluginName = $pluginName;
        $this->version = $version;
    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueueStyles()
    {
        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Typicode_Users_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Typicode_Users_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_style(
            $this->pluginName,
            plugin_dir_url(__FILE__) . 'css/typicode-users-admin.css',
            [],
            $this->version,
            'all'
        );
    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueueScripts()
    {
        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Typicode_Users_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Typicode_Users_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_script(
            $this->pluginName,
            plugin_dir_url(__FILE__) . 'js/typicode-users-admin.js',
            [ 'jquery' ],
            $this->version,
            false
        );
    }
}
