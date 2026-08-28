# Sage

Use this file for theme structure, Blade templates, components, composers, view-facing PHP, and Vite/editor integration.

## Theme Structure

Current Sage starters center on:

- `app/Providers/`: service providers
- `app/View/`: components, composers, and other view logic
- `app/setup.php`: theme setup and integration hooks
- `app/filters.php`: theme filters
- `resources/views/`: Blade templates
- `public/`: built assets
- `vite.config.js`: Vite config

## Template Model

- Blade templates live in `resources/views/`.
- WordPress template hierarchy still applies; Sage maps it into Blade views.
- Layouts live under `resources/views/layouts/`.
- Reusable snippets normally live under `partials/`, `components/`, or another clear subfolder.

## Components And Composers

- Blade components are a good fit for reusable UI with explicit inputs.
- Traditional Sage component pairs:
  - `resources/views/components/<name>.blade.php`
  - `app/View/Components/<ClassName>.php`
- Use kebab-case in Blade tags and camelCase constructor parameters.
- Use composers when you need scoped data binding for one or more views.
- Generate common scaffolds with `wp acorn make:component` and `wp acorn make:composer`.

## Theme PHP Conventions

- Keep theme setup in `app/setup.php`.
- Register menus, sidebars, theme supports, and asset hooks there.
- Keep cross-cutting filters in `app/filters.php`.
- Use `app/Providers/ThemeServiceProvider.php` for provider-based bootstrapping when theme logic grows past simple setup hooks.

## Vite And Editor Assets

- Sage uses Vite for frontend and editor assets.
- Editor CSS and JS are typically injected via `Vite::asset(...)` and `Vite::withEntryPoints(...)` in `app/setup.php`.
- Sage can route the theme’s `theme.json` to the generated build output.
- `@roots/vite-plugin` handles WordPress-specific dependency manifests and editor/HMR support.

## Boundaries

- Keep theme rendering concerns in Sage, not in Bedrock config.
- Use Acorn features through Sage rather than re-creating a parallel boot process.
- Do not use Blade components where a simple partial is clearer and cheaper.
