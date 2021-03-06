<?php
/**
 * Plugin Name: tutorial
 * Plugin URI: https://github.com/tutorial
 * Description: Getting started with Gutenberg block development.
 * Author: weDevs
 * Version: 1.0.0
 * Text Domain: tutorial
 * Domain Path: /languages
 * License: GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

if (!class_exists('Tutorial')):
    /**
     * Main Tutorial Class.
     *
     * @since 1.0.0
     */
    final class Tutorial
{
        /**
         * This plugin's instance.
         *
         * @var Tutorial
         * @since 1.0.0
         */
        private static $instance;

        /**
         * Main Tutorial Instance.
         *
         * Insures that only one instance of Tutorial exists in memory at any one
         * time. Also prevents needing to define globals all over the place.
         *
         * @since 1.0.0
         * @static
         * @return object|Tutorial The one true Tutorial
         */
        public static function instance()
    {
            if (!isset(self::$instance) && !(self::$instance instanceof Tutorial)) {
                self::$instance = new Tutorial();
                self::$instance->define_constants();
                self::$instance->includes();
                self::$instance->dependency_class_instance();
            }
            return self::$instance;
        }

        /**
         * Define woogool Constants
         *
         * @return type
         */
        private function define_constants()
    {
            $this->define('TUTORIAL_PATH', dirname(__FILE__));
            $this->define('TUTORIAL_INCLUDES_PATH', dirname(__FILE__) . '/includes');
            $this->define('TUTORIAL_DIST_PATH', dirname(__FILE__) . '/dist');
            $this->define('TUTORIAL_DIST_URL', plugin_dir_url(__FILE__) . 'dist');
            $this->define('TUTORIAL_SRC_URL', plugin_dir_url(__FILE__) . 'src');
            // echo TUTORIAL_SRC_URL;
            //$this->define( 'TUTORIAL_ASSET', plugin_dir_url( __FILE__ ) . 'assets' );
        }

        /**
         * Define constant if not already set
         *
         * @param  string $name
         * @param  string|bool $value
         * @return type
         */
        private function define($name, $value)
    {
            if (!defined($name)) {
                define($name, $value);
            }
        }

        /**
         * Load actions
         *
         * @return void
         */
        private function includes()
    {

            // include TUTORIAL_PATH . '/includes/actions.php';
            // include TUTORIAL_PATH . '/includes/scripts.php';
            // //include TUTORIAL_PATH . '/includes/register-blocks.php';
            include TUTORIAL_PATH . '/vendor/autoload.php';
        }

        /**
         * Load actions
         *
         * @return void
         */
        private function dependency_class_instance()
    {
            \Tutorial\Includes\Actions::instance();
            \Tutorial\Includes\Scripts::instance();
            //\Tutorial\Includes\Register_Blocks::register();
        }

    }
endif;

/**
 * The main function for that returns Tutorial
 *
 */
function tutorial()
{
    return Tutorial::instance();
}

// Get the plugin running. Load on plugins_loaded action to avoid issue on multisite.
if (function_exists('is_multisite') && is_multisite()) {
    add_action('plugins_loaded', 'tutorial', 90);
} else {
    tutorial();
}
