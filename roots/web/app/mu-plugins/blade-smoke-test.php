<?php
/**
 * Plugin Name: Acorn Blade Smoke Test
 * Description: Registers a shortcode that renders a Blade view, to confirm Acorn's Blade engine works end-to-end.
 */

add_shortcode('acorn_blade_test', function () {
    return (string) \Roots\view('greeting', [
        'renderedAt' => current_time('mysql'),
        'items' => ['Bedrock', 'Acorn', 'Blade', 'lerd'],
    ]);
});
