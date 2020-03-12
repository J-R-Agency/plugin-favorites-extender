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