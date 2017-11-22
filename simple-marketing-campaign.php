<?php
/**
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * and registers the activation and deactivation functions.
 *
 * @link              https://www.github.com/harrymt
 * @author            Harry Mumford-Turner
 * @version           1.0.0
 * @package           hmt_smc
 *
 * @wordpress-plugin
 * Plugin Name:       Simple Marketing Campaign
 * Plugin URI:        https://github.com/harrymt/simple-marketing-campaign
 * Description:       Choose certain JS scripts to run on certain pages.
 * Version:           0.0.1
 * Author:            Harry Mumford-Turner
 * Author URI:        https://www.harrymt.com
 * License:           MIT
 * License URI:       https://opensource.org/licenses/MIT
 * Text Domain:       hmt_smc
*/


/**
 * If we're not being loaded by WordPress, abort now
 */
if ( !defined( 'WPINC' ) ) { die; }


/**
 * Load the relevant scripts dependant on if the plugin is being loaded on the
 * frontend or the backend
 *
 * @since 1.0.0
 */
if( !is_admin() ) {
    add_action('wp_enqueue_scripts', 'load_marketing_scripts');
}

function inline_scripts() {
    ?>
        <script>
            console.log('I am running on everypage!');
        </script>
    <?php
}

// 
// JavaScript URLs to run only on specific pages.
// 
function load_marketing_scripts() {
    global $post;

    if( is_page() || is_single() || is_category() )
    {
        add_action( 'wp_head', 'inline_scripts' );

        wp_enqueue_script('main-1','https://example.com/example.js', array(), null, true);


        // Load scripts for specific pages
        switch($post->post_name)
        {
            case 'home':
                wp_enqueue_script('home-script','https://example.com/example.js', array(), null, true);
                break;
            case 'about-us':
                wp_enqueue_script('about-us-script','https://example.com/example.js', array(), null, true);
                break;
        }

    }

    // Specific category pages
    if (is_category( 'news' )) {
        wp_enqueue_script('news-script','https://example.com/example.js', array(), null, true);
    }
}
