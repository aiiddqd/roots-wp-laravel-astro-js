# Bedrock

Use this file for project structure, configuration, environment loading, Composer-managed WordPress, and mu-plugin behavior.

## Core Structure

The Bedrock root typically contains:

- `composer.json`: WordPress core, plugins, themes, and PHP dependencies
- `config/application.php`: main configuration bootstrap
- `config/environments/*.php`: environment-specific overrides
- `web/`: document root
- `web/app/`: `wp-content` equivalent
- `web/wp/`: WordPress core

## Configuration Model

- Treat `config/application.php` as the main equivalent of traditional `wp-config.php`.
- Keep `web/wp-config.php` as the loader only.
- Use `Config::define(...)` for WordPress constants.
- Put shared defaults in `config/application.php`.
- Put environment overrides in `config/environments/<env>.php`.

## Environment Loading

- Bedrock loads `.env` and optional `.env.local`.
- `WP_ENV` controls environment-specific config loading and often affects other Roots tools.
- `WP_HOME` and `WP_SITEURL` are required.
- If `DATABASE_URL` is absent, `DB_NAME`, `DB_USER`, and `DB_PASSWORD` are required.
- Bedrock infers `WP_ENVIRONMENT_TYPE` from `WP_ENV` when needed.

## Composer Model

- Manage WordPress core as a Composer dependency.
- Manage plugins and optionally parent themes through Composer when practical.
- Keep the main custom theme in the repository unless there is a good packaging reason not to.
- Remember that Bedrock deployment requires `composer install`.

## Mu-Plugin Behavior

- Bedrock ships a mu-plugin autoloader in `web/app/mu-plugins/bedrock-autoloader.php`.
- You can install regular Composer packages into `mu-plugins` by using `wordpress-muplugin` or overriding installer paths.
- Use this only for plugins that must always load early and stay admin-proof.

## Boundaries

- Do not put theme implementation detail in Bedrock config files.
- Do not treat Bedrock as a deployment tool; pair it with Trellis or another deployment system.
- Do not edit `web/wp-config.php` for normal app configuration.
