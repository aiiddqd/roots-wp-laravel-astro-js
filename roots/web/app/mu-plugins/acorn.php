<?php
/**
 * Plugin Name: Acorn
 * Description: Boots the Acorn (Laravel-in-WordPress) application container.
 */

if (! class_exists(\Roots\Acorn\Application::class)) {
    if (! is_file($composer = __DIR__.'/../../../vendor/autoload.php')) {
        wp_die('You must run <code>composer install</code> from the Bedrock root.');
    }

    require_once $composer;
}

$builder = Roots\Acorn\Application::configure();

// Acorn's config loader scans every *.php file under the config path and
// expects each to `return` a config array. Bedrock's own config/*.php files
// (application.php, environments/*) are side-effecting `Config::define()`
// calls, not Laravel config arrays, so Acorn needs its own config directory
// to avoid re-executing (and redefining constants from) Bedrock's config.
$builder->create()->useConfigPath(
    $builder->create()->basePath('config/acorn')
);

$builder->boot();
