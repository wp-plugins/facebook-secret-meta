<?php
/*
 * Plugin Name: Facebook Secret Meta
 * Plugin URI: http://wpdeveloper.net/free-plugin/facebook-secret-meta/
 * Description: Only this Secret Meta plugin enables Facebook's brand-new Author By info at News Feed.
 * Version: 1.1.0
 * Author: WPDeveloper.net
 * Author URI: http://wpdeveloper.net
 * License: GPLv2+
 * Text Domain: facebook-secret-meta
 * Min WP Version: 2.5.0
 * Max WP Version: 4.1
 */


define("FBSM_PLUGIN_SLUG",'facebook-secret-meta');
define("FBSM_PLUGIN_URL",plugins_url("",__FILE__ ));#without trailing slash (/)
define("FBSM_PLUGIN_PATH",plugin_dir_path(__FILE__)); #with trailing slash (/)

include_once(FBSM_PLUGIN_PATH.'fbsm-options.php');
include_once(FBSM_PLUGIN_PATH.'wpdev-dashboard-widget.php');

function add_fbsm_menu_pages()

{
add_options_page( "Facebook Secret Meta", "Facebook Secret Meta" ,'manage_options', FBSM_PLUGIN_SLUG, 'fbsm_options_page');
}

add_action('admin_menu', 'add_fbsm_menu_pages'); 


function facebook_secret_meta()
{
$fbsm_options=fbsm_get_options();
$fbsm_author_meta_content=$fbsm_options['author_name_custom'];
if($fbsm_author_meta_content==""){$fbsm_author_meta_content="WPDeveloper";}
?>
<meta name="author" content="<?php echo $fbsm_author_meta_content; ?>"/>
<?php 
}#end function facebook_secret_meta()


add_action('wp_head','facebook_secret_meta');


function fbsm_setting_links($links, $file) {
    static $fbsm_setting;
    if (!$fbsm_setting) {
        $fbsm_setting = plugin_basename(__FILE__);
    }
    if ($file == $fbsm_setting) {
        $fbsm_settings_link = '<a href="options-general.php?page='.FBSM_PLUGIN_SLUG.'">Settings</a>';
        array_unshift($links, $fbsm_settings_link);
    }
    return $links;
}
add_filter('plugin_action_links', 'fbsm_setting_links', 10, 2);

/* Display a notice that can be dismissed */

add_action('admin_notices', 'fbsm_admin_notice');

function fbsm_admin_notice() {
if ( current_user_can( 'install_plugins' ) )
   {
     global $current_user ;
        $user_id = $current_user->ID;
        /* Check that the user hasn't already clicked to ignore the message */
     if ( ! get_user_meta($user_id, 'fbsm_ignore_notice') ) {
        echo '<div class="updated"><p>';
        printf(__('<b>Facebook Secret Meta Pro</b> version is available now, <a href="http://wpdeveloper.net/go/FSMPro" target="_blank"> get Pro</a>. Use Coupon "FSMPro" for 25 percent Discount, Pro version starts at $14.98, only for you! | <a href="%1$s">[Hide Offer]</a>'), '?fbsm_nag_ignore=0');
        echo "</p></div>";
     }
    }
}

add_action('admin_init', 'fbsm_nag_ignore');

function fbsm_nag_ignore() {
     global $current_user;
        $user_id = $current_user->ID;
        /* If user clicks to ignore the notice, add that to their user meta */
        if ( isset($_GET['fbsm_nag_ignore']) && '0' == $_GET['fbsm_nag_ignore'] ) {
             add_user_meta($user_id, 'fbsm_ignore_notice', 'true', true);
     }
}
?>