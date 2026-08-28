# Packaging And Distribution

Use this file for WordPress distribution packages, WP Packages, `roots/wp-config`, private Composer dependencies, and patch-based maintenance workflows.

## Package Deep Dives

- [package-wordpress-full.md](package-wordpress-full.md)
- [package-wordpress-packager.md](package-wordpress-packager.md)
- [package-wp-config.md](package-wp-config.md)

## WP Packages Layer

Roots maintains Composer-friendly WordPress distribution packages through WP Packages.

- `roots/wordpress-full`: an automatically updated WordPress core package that includes the “full” distribution with bundled themes and plugins.
- `roots/wordpress-packager`: the tool Roots uses to generate WordPress Composer packages from release sources.

Use this layer when the task is about how WordPress itself is packaged and consumed through Composer, not just how a Bedrock app is configured.

## Bedrock Relationship

- Bedrock is the application/project structure around Composer-managed WordPress.
- WP Packages provides Composer-distributed WordPress artifacts that Bedrock-style projects can consume.
- Do not confuse “how WordPress is packaged” with “how a Bedrock project is configured.”

## `roots/wp-config`

`roots/wp-config` is the fluent configuration library Bedrock builds on.

- Bedrock commonly uses `Config::define(...)` through this layer.
- Treat it as the configuration mechanism behind the Bedrock bootstrap, not a separate app framework.
- Use it when the user is asking about configuration semantics, fluent config behavior, or the underlying config package itself.

## Common Dependency Workflows

- Install core/plugins/themes through Composer where possible.
- Use WP Packages for public WordPress.org packages.
- For private or commercial plugins, use private VCS repositories or another Composer-accessible distribution method.
- For third-party fixes, prefer Composer patches over manual vendor edits or long-lived forks.

## Maintenance Patterns

- Private plugin repos should expose a valid `composer.json` and tagged releases.
- Patches belong in the project root and should be declared in `composer.json`.
- Re-run normal Composer install/update flows to apply patches predictably.

## Decision Rules

- If the user is asking “how do I install/manage WordPress or plugins with Composer?” start here.
- If the user is asking “how do I configure a Bedrock site?” start with `bedrock.md`.
- If the user is asking “how does Roots generate or distribute WordPress packages?” start here, then inspect `wordpress-packager` code if needed.
- If the user names one package directly, load its `package-*.md` deep dive after this file.
