<?php
declare(strict_types=1);
namespace Typicode\Users\Includes;

/**
 * Fired during plugin activation
 *
 * @link       http://www.example.com
 * @since      1.0.0
 *
 * @package    Typicode_Users
 * @subpackage Typicode_Users/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Typicode_Users
 * @subpackage Typicode_Users/includes
 * @author     Himeshkumar Challa <himeshchalla@gmail.com>
 */
class Activator
{

    /**
     * Short Description. (use period)
     *
     * Long Description.
     *
     * @since    1.0.0
     */
    public static function activate() {
        add_action('init', [ __NAMESPACE__.'\\Activator', 'typicodeusers_rewrite']);
        add_action('query_vars', [ __NAMESPACE__.'\\Activator', 'foo_set_query_var']);
        add_filter('template_include', [ __NAMESPACE__.'\\Activator', 'foo_include_template'], 1000, 1);
    }

    public static function typicodeusers_rewrite(){

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

    public static function foo_set_query_var($vars) {
        array_push($vars, 'typicodeusers');
        return $vars;
    }

    public static function foo_include_template($template){
        if(get_query_var('typicodeusers', 'typicodeusers')){
            $new_template = WP_CONTENT_DIR.'/plugins/recipe/test_template.php';
            if(file_exists($new_template))
                $template = $new_template;
        }
        // return "yahooooooooooo tha dha dha thahhhoahohoh yahooo";
        return $template;
    }

}
