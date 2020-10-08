<?php
/**
 * Loader
 *
 * Typicode loader used for operations regarding registering wp actions and filters for the plugin.
 *
 * Maintain a list of all hooks that are registered throughout
 * the plugin, and register them with the WP API. Call the
 * run function to execute the list of actions and filters.
 *
 * @package    Typicode/Users
 * @subpackage Includes/Loader
 * @author     Himeshkumar <abcdefghijklmnopqrstuvwxyz@example.me>
 * @link       http://www.example.com
 * @since      1.0.0
 */

declare(strict_types=1);

namespace Typicode\Users\Includes;

/**
 * Register all actions and filters for the plugin.
 *
 * Maintain a list of all hooks that are registered throughout
 * the plugin, and register them with the WordPress API. Call the
 * run function to execute the list of actions and filters.
 *
 * @package    Typicode/Users
 * @subpackage Includes/Loader
 * @author     Himeshkumar <abcdefghijklmnopqrstuvwxyz@example.me>
 */
class Loader
{

    /**
     * The array of actions registered with WordPress.
     *
     * @since    1.0.0
     * @access   protected
     * @var      array    $actions    The actions registered with WordPress to fire
     *                                when the plugin loads.
     */
    protected $actions;

    /**
     * The array of filters registered with WordPress.
     *
     * @since    1.0.0
     * @access   protected
     * @var      array    $filters    The filters registered with WordPress to fire
     *                                when the plugin loads.
     */
    protected $filters;

    /**
     * Initialize the collections used to maintain the actions and filters.
     *
     * @since    1.0.0
     */
    public function __construct()
    {
        $this->actions = [];
        $this->filters = [];
    }

    /**
     * Add a new action to the collection to be registered with WordPress.
     *
     * @since 1.0.0
     * @param string $hook          The name of the WordPress action that is being registered.
     * @param object $component     A reference to the instance of the object on which the
     *                              action is defined.
     * @param string $callback      The name of the function definition on the $component.
     * @param int    $priority      Optional. The priority at which the function should be
     *                              fired. Default is 10.
     * @param int    $accepted_args Optional. The number of arguments that should be passed
     *                              to the $callback. Default is 1.
     */
    public function addAction(
        string $hook,
        object $component,
        string $callback,
        int $priority = 10,
        int $acceptedArgs = 1
    ) {

        $this->actions = $this->add(
            $this->actions,
            $hook,
            $component,
            $callback,
            $priority,
            $acceptedArgs
        );
    }

    /**
     * Add a new filter to the collection to be registered with WordPress.
     *
     * @since 1.0.0
     * @param string $hook          The name of the WordPress filter that is being registered.
     * @param object $component     A reference to the instance of the object on which the filter
     *                              is defined.
     * @param string $callback      The name of the function definition on the $component.
     * @param int    $priority      Optional. The priority at which the function should be fired.
     *                              Default is 10.
     * @param int    $accepted_args Optional. The number of arguments that should be passed to the
     *                              $callback. Default is 1
     */
    public function addFilter(
        string $hook,
        object $component,
        string $callback,
        int $priority = 10,
        int $acceptedArgs = 1
    ) {

        $this->filters = $this->add(
            $this->filters,
            $hook,
            $component,
            $callback,
            $priority,
            $acceptedArgs
        );
    }

    /**
     * A utility function that is used to register the actions and hooks into a single
     * collection.
     *
     * @since  1.0.0
     * @access private
     * @param  array  $hooks         The collection of hooks that is being registered (that is,
     *                               actions or filters).
     * @param  string $hook          The name of the WordPress filter that is being registered.
     * @param  object $component     A reference to the instance of the object on which the filter
     *                               is defined.
     * @param  string $callback      The name of the function definition on the $component.
     * @param  int    $priority      The priority at which the function should be fired.
     * @param  int    $accepted_args The number of arguments that should be passed to the $callback
     * @return array  $hooks         The collection of actions and filters registered with WordPress.
     */
    private function add(
        array $hooks,
        string $hook,
        object $component,
        string $callback,
        int $priority,
        int $acceptedArgs
    ): array {

        $hooks[] = [
            'hook' => $hook,
            'component' => $component,
            'callback' => $callback,
            'priority' => $priority,
            'accepted_args' => $acceptedArgs,
        ];

        return $hooks;
    }

    /**
     * Register the filters and actions with WordPress.
     *
     * @since    1.0.0
     */
    public function run()
    {
        foreach ($this->filters as $hook) {
            add_filter(
                $hook['hook'],
                [ $hook['component'], $hook['callback'] ],
                $hook['priority'],
                $hook['accepted_args']
            );
        }

        foreach ($this->actions as $hook) {
            add_action(
                $hook['hook'],
                [ $hook['component'], $hook['callback'] ],
                $hook['priority'],
                $hook['accepted_args']
            );
        }
    }
}
