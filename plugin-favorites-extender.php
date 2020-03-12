<?php
/*
 * Plugin Name: PD101 Extending Classes Example
 * Description: An example of how to extend a class
 * Author: Pippin Williamson
 */


class PD101_Base {

    public function __construct() {

        add_action( 'wp_footer', array( $this, 'footer_text' ) );

    }

    public function footer_text() {
        echo $this->get_footer_text();
    }

    public function get_footer_text() {
        return '<p>Hello! I am in the footer!</p>';
    }

}

class PD101_Extension extends PD101_base {

    public function get_footer_text() {
        return '<p><strong>Oh hey!</strong> This is cool</p>';
    }

}
new PD101_Extension;



class Favorites_Extension extends Favorites {

    /**
    * Add a link to the settings on the plugin page
    */
    public function settingsLink($links)
    { 
        $settings_link = 'GM - <a href="options-general.php?page=simple-favorites">' . __('Settings', 'favorites') . '</a>'; 
        $help_link = '<a href="http://favoriteposts.com">' . __('FAQ', 'favorites') . '</a>'; 
        array_unshift($links, $help_link); 
        array_unshift($links, $settings_link);
        return $links; 
    }

}
new PD101_Extension;

namespace Favorites\Config;

use Favorites\Helpers;

class SettingsRepository_Extension extends SettingsRepository {
    public function presetButton($button = 'all')
    {
        $buttons = [
            'favorite' => [
                'label' => __('Favorite', 'favorites'),
                'icon' => apply_filters('favorites/button/icon', '<i class="sf-icon-favorite"></i>', 'favorite'),
                'icon_class' => apply_filters('favorites/button/icon-class', 'sf-icon-favorite', 'favorite'),
                'state_default' => apply_filters('favorites/button/text/default', __('Favorite', 'favorites'), 'favorite'),
                'state_active' => apply_filters('favorites/button/text/active', __('Favorited', 'favorites'), 'favorite')
            ],
            'like' => [
                'label' => __('Like', 'favorites'),
                'icon' => apply_filters('favorites/button/icon', '<i class="sf-icon-like"></i>', 'like'),
                'icon_class' => apply_filters('favorites/button/icon-class', 'sf-icon-like', 'like'),
                'state_default' => apply_filters('favorites/button/text/default', __('Like', 'favorites'), 'like'),
                'state_active' => apply_filters('favorites/button/text/active', __('Liked', 'favorites'), 'like')
            ],
            'love' => [
                'label' => __('Love', 'favorites'),
                'icon' => apply_filters('favorites/button/icon', '<i class="sf-icon-love"></i>', 'love'),
                'icon_class' => apply_filters('favorites/button/icon-class', 'sf-icon-love', 'love'),
                'state_default' => apply_filters('favorites/button/text/default', __('Love', 'favorites'), 'love'),
                'state_active' => apply_filters('favorites/button/text/active', __('Loved', 'favorites'), 'love')
            ],
            'bookmark' => [
                'label' => __('Bookmark', 'favorites'),
                'icon' => apply_filters('favorites/button/icon', '<i class="sf-icon-bookmark"></i>', 'bookmark'),
                'icon_class' => apply_filters('favorites/button/icon-class', 'sf-icon-bookmark', 'bookmark'),
                'state_default' => apply_filters('favorites/button/text/default', __('Bookmark', 'favorites'), 'bookmark'),
                'state_active' => apply_filters('favorites/button/text/active', __('Bookmarked', 'favorites'), 'bookmark')
            ],
            'wishlist' => [
                'label' => __('Wishlist', 'favorites'),
                'icon' => apply_filters('favorites/button/icon', '<i class="sf-icon-wishlist"></i>', 'wishlist'),
                'icon_class' => apply_filters('favorites/button/icon-class', 'sf-icon-wishlist', 'wishlist'),
                'state_default' => apply_filters('favorites/button/text/default', __('Add to Wishlist', 'favorites'), 'wishlist'),
                'state_active' => apply_filters('favorites/button/text/active', __('Added to Wishlist', 'favorites'), 'wishlist')
            ],
            'actionplan' => [
                'label' => __('Action Plan', 'favorites'),
                'icon' => apply_filters('favorites/button/icon', '<i class="sf-icon-wishlist"></i>', 'wishlist'),
                'icon_class' => apply_filters('favorites/button/icon-class', 'sf-icon-wishlist', 'wishlist'),
                'state_default' => apply_filters('favorites/button/text/default', __('Add to Action Plan', 'favorites'), 'actionplan'),
                'state_active' => apply_filters('favorites/button/text/active', __('Added to Action Plan', 'favorites'), 'actionplan')
            ]
        ];
        if ( $button == 'all' ) return $buttons;
        if ( isset($buttons[$button]) ) return $buttons[$button];
        return $buttons['favorite'];
    }
}