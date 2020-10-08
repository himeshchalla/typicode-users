<?php
/**
 * Users
 *
 * Typicode users related operations handled by this class
 *
 * This is used to initiate api operation, admin-specific hooks, and
 * public-facing site hooks.
 *
 * @package    Typicode/Users
 * @subpackage Includes/Users
 * @author     Himeshkumar <abcdefghijklmnopqrstuvwxyz@example.me>
 * @link       http://www.example.com
 * @since      1.0.0
 */

declare(strict_types=1);

namespace Typicode\Users\Includes;

use Typicode\Users\Backend\Admin;
use Typicode\Users\Frontend\Frontend;

/**
 * Users class
 *
 * Typicode users related operations handled by this class
 *
 * This is used to admin-specific hooks, initiate api operation, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Typicode/Users
 * @subpackage Includes/Users
 * @author     Himeshkumar Challa <abcdefghijklmnopqrstuvwxyz@example.me>
 */
class Users
{

    /**
     * The loader that's responsible for maintaining and registering all hooks that power
     * the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      Typicode_Users_Loader    $loader    Maintains and registers all hooks for the plugin.
     */
    protected $loader;

    /**
     * The unique identifier of this plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string    $plugin_name    The string used to uniquely identify this plugin.
     */
    protected $pluginName;

    /**
     * The current version of the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string    $version    The current version of the plugin.
     */
    protected $version;

    /**
     * Define the core functionality of the plugin.
     *
     * Set the plugin name and the plugin version that can be used throughout the plugin.
     * Load the dependencies, define the locale, and set the hooks for the admin area and
     * the public-facing side of the site.
     *
     * @since 1.0.0
     * @access public
     * @param string $pluginName The name of the plugin being registered.
     * @param string $version    The version of the plugin being registered.
     */
    public function __construct(string $pluginName = 'typicode-users', string $version = '1.0.0')
    {
        $this->version = defined('TYPICODE_USERS_VERSION') ? TYPICODE_USERS_VERSION : $version;
        $this->pluginName = $pluginName;
        $this->loadDependencies();
        $this->setLocale();
        $this->defineAdminHooks();
        $this->defineFrontendHooks();
    }

    /**
     * Load the required dependencies for this plugin.
     *
     * Include the following files that make up the plugin:
     *
     * - Typicode_Users_Loader. Orchestrates the hooks of the plugin.
     * - Typicode_Users_i18n. Defines internationalization functionality.
     * - Typicode_Users_Admin. Defines all hooks for the admin area.
     * - Typicode_Users_Public. Defines all hooks for the public side of the site.
     *
     * Create an instance of the loader which will be used to register the hooks
     * with WordPress.
     *
     * @since    1.0.0
     * @access   private
     */
    private function loadDependencies()
    {
        $this->loader = new Loader();
    }

    /**
     * Define the locale for this plugin for internationalization.
     *
     * Uses the Typicode_Users_i18n class in order to set the domain and to register the hook
     * with WordPress.
     *
     * @since    1.0.0
     * @access   private
     */
    private function setLocale()
    {
        $pluginI18n = new I18n();

        $this->loader->addAction('plugins_loaded', $pluginI18n, 'loadPluginTextDomain');
    }

    /**
     * Register all of the hooks related to the admin area functionality
     * of the plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function defineAdminHooks()
    {
        $pluginAdmin = new Admin($this->pluginName, $this->version);

        $this->loader->addAction('admin_enqueue_scripts', $pluginAdmin, 'enqueueStyles');
        $this->loader->addAction('admin_enqueue_scripts', $pluginAdmin, 'enqueueScripts');
    }

    /**
     * Register all of the hooks related to the public-facing functionality
     * of the plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function defineFrontendHooks()
    {
        $pluginFrontend = new Frontend($this->pluginName, $this->version);

        $this->loader->addAction('wp_enqueue_scripts', $pluginFrontend, 'enqueueStyles');
        $this->loader->addAction('wp_enqueue_scripts', $pluginFrontend, 'enqueueScripts');
    }

    /**
     * Run the loader to execute all of the hooks with WordPress.
     *
     * @since    1.0.0
     */
    public function run()
    {
        $this->loader->run();
    }

    // /**
    //  * The name of the plugin used to uniquely identify it within the context of
    //  * WordPress and to define internationalization functionality.
    //  *
    //  * @since     1.0.0
    //  * @return    string    The name of the plugin.
    //  */
    // public function getPluginName()
    // {
    //     return $this->pluginName;
    // }

    // /**
    //  * The reference to the class that orchestrates the hooks with the plugin.
    //  *
    //  * @since     1.0.0
    //  * @return    Typicode_Users_Loader    Orchestrates the hooks of the plugin.
    //  */
    // public function getLoader()
    // {
    //     return $this->loader;
    // }

    // /**
    //  * Retrieve the version number of the plugin.
    //  *
    //  * @since     1.0.0
    //  * @return    string    The version number of the plugin.
    //  */
    // public function getVersion()
    // {
    //     return $this->version;
    // }
}
