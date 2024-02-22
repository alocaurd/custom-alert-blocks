<?php
/**
 * Plugin Name: Custom Alert Blocks
 * Description: Adds a custom style to WordPress blocks.
 * Version: 2.0.1
 * Author: Clayton Mannerow
 * Author URI: https://support.smartpbx.io
 */

function custom_alert_block_styles_enqueue_assets() {
    // Enqueue the stylesheet for both the editor and the front end.
    wp_enqueue_style( 'custom-alert-block-styles', plugins_url( 'custom-block-styles.css', __FILE__ ) );
}

add_action( 'enqueue_block_editor_assets', 'custom_alert_block_styles_enqueue_assets' );
add_action( 'wp_enqueue_scripts', 'custom_alert_block_styles_enqueue_assets' );

function custom_alert_block_styles_register() {
    $block_name = 'core/paragraph'; // Change this to the block you want to target.

    $style_variants = array(
        'warning',
        'error',
        'info',
        'success'
    );

    foreach ($style_variants as $variant) {
        register_block_style(
            $block_name,
            array(
                'name'  => "with-icon-{$variant}",
                'label' => __( ucfirst($variant) . ' Alert', 'text-domain' ),
                'inline_style' => '.is-style-with-icon-' . $variant . ' { background-color: #fff3cd; /* ... other styles ... */ }' // This should contain all the custom CSS for the style
            )
        );
    }
}

add_action( 'init', 'custom_alert_block_styles_register' );

