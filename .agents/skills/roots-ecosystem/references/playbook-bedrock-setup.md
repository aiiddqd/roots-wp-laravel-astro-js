# Playbook: Bedrock Setup And Configuration

Use this playbook when creating a Bedrock project or changing Bedrock configuration.

## Workflow

1. Confirm the task is actually Bedrock-level, not theme-level.
2. Inspect `composer.json`, `config/application.php`, `config/environments/`, `.env.example`, and any existing `web/app/` conventions.
3. For new projects, start from `composer create-project roots/bedrock`.
4. Model environment data in `.env` and `.env.local`, not hard-coded config.
5. Put shared defaults in `config/application.php`.
6. Put environment-specific overrides in `config/environments/<env>.php`.
7. Use Composer for WordPress core and plugin management whenever possible.
8. If a plugin must behave as a mu-plugin, decide whether installer-path override is justified.
9. Re-check document-root assumptions: Bedrock serves from `web/`.

## Common Changes

- Add a plugin with `composer require`.
- Add environment constants with `Config::define(...)`.
- Adjust installer paths for plugins or mu-plugins.
- Add a new environment override file matched to `WP_ENV`.

## Verification

- Confirm required env vars still exist.
- Confirm no config was added to `web/wp-config.php`.
- Confirm deployment instructions still include `composer install`.
