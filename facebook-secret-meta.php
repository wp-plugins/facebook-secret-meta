<?php
/*
 * Plugin Name: Facebook Secret Meta
 * Plugin URI: http://wpdeveloper.net/free-plugin/facebook-secret-meta/
 * Description: Only this Secret Meta plugin enables Facebook's brand-new Author By info at News Feed.
 * Version: 1.0.1
 * Author: WPDeveloper.net
 * Author URI: http://wpdeveloper.net
 * License: GPLv2+
 * Text Domain: facebook-secret-meta
 * Min WP Version: 2.5.0
 * Max WP Version: 4.0.1
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
?>