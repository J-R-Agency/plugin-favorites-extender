<?php
/**
 * Plugin Name: Action Plan for Favorites (plugin extension)
 * Description: Plugin Extension for Favorites plugin
 * Version: 1.0.1
 * Author: Liam Bailey + Greg Macoy
 * Author URI: http://webbyscots.com/
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 */


/*
Refer to Liam's post on 
https://codeable.io/how-to-extend-a-wordpress-plugin-my-plugin-boilerplate/
*/

global $jr_wl_ap;
$jr_wl_ap = new jr_wl_ap;

class jr_wl_ap {

    private $textdomain = "jr_wl_ap";
    private $required_plugins = array('favorites');

    function have_required_plugins() {
        if (empty($this->required_plugins))
            return true;
        $active_plugins = (array) get_option('active_plugins', array());
        if (is_multisite()) {
            $active_plugins = array_merge($active_plugins, get_site_option('active_sitewide_plugins', array()));
        }
        foreach ($this->required_plugins as $key => $required) {
            $required = (!is_numeric($key)) ? "{$key}/{$required}.php" : "{$required}/{$required}.php";
            if (!in_array($required, $active_plugins) && !array_key_exists($required, $active_plugins))
                return false;
        }
        return true;
    }

    function __construct() {
        if (!$this->have_required_plugins())
            return;
        load_plugin_textdomain($this->textdomain, false, dirname(plugin_basename(__FILE__)) . '/languages');
        add_filter('presetButton', array($this,'add_action_plan') );
    }

    function add_action_plan($buttons){
        array_push($buttons,            'actionplan' => [
                'label' => __('Action Plan', 'favorites'),
                'icon' => apply_filters('favorites/button/icon', '<i class="sf-icon-actionplan"></i>', 'actionplan'),
                'icon_class' => apply_filters('favorites/button/icon-class', 'sf-icon-actionplan', 'actionplan'),
                'state_default' => apply_filters('favorites/button/text/default', __('Add to action plan', 'favorites'), 'actionplan'),
                'state_active' => apply_filters('favorites/button/text/active', __('Added to action plan', 'favorites'), 'actionplan')
            ]
        )
    }
}