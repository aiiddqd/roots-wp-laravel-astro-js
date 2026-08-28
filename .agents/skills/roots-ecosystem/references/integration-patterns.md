# Integration Patterns

Use this file when the task crosses Bedrock, Sage, Acorn, and Trellis boundaries.

## Standard Roots Stack

- Bedrock at the project root
- Sage as the active custom theme inside `web/app/themes/`
- Acorn booted by Sage
- Trellis managing provisioning and deployment

This is the default mental model for most full-stack Roots projects.

## Ownership Rules

- Project config, envs, and Composer-managed WordPress layout -> Bedrock
- Theme templates, assets, and theme-specific presentation code -> Sage
- Application container, providers, routing, and framework abstractions -> Acorn
- Servers, releases, deploy hooks, and rollback process -> Trellis
- WordPress distribution packages and Composer delivery mechanics -> WP Packages / packaging layer
- CI automation for Trellis deploys -> Trellis CLI and `setup-trellis-cli`

## Common Cross-Layer Flows

### Bedrock + Sage

- Bedrock provides the site structure.
- Sage lives as a normal theme under `web/app/themes/`.
- Keep theme build files inside the theme; keep environment/bootstrap logic in Bedrock.

### Sage + Acorn

- Sage uses Acorn for Blade, providers, components, composers, and optional advanced app features.
- Prefer Sage’s existing boot process instead of manually wiring Acorn again.

### Bedrock + Trellis

- Trellis expects a Git-deployable Bedrock project.
- Composer install is part of the deploy lifecycle.
- Production environment variables must align with Bedrock config expectations.

### Bedrock + WP Packages

- Bedrock consumes Composer-managed WordPress dependencies.
- WP Packages provides the packaging/distribution side of that model.
- Keep package-distribution questions separate from project-configuration questions.

### Sage + Trellis

- Use Trellis hooks when the theme needs a production asset build.
- Keep the build recipe explicit and reproducible.

### Trellis + GitHub Actions

- `setup-trellis-cli` is the normal automation bridge into GitHub Actions.
- The workflow should preserve the same Trellis mental model as local CLI usage rather than inventing a parallel deploy path.

## Decision Heuristics

- If the change affects `config/application.php` or `.env`, start with Bedrock.
- If the change affects `resources/views/`, `app/View/`, or `vite.config.js`, start with Sage.
- If the change affects providers, routes, middleware, or `wp acorn`, start with Acorn.
- If the change affects release steps, servers, hooks, or the `trellis` command, start with Trellis.
- If the change affects WordPress package delivery, private Composer sources, or patches, start with `packaging-and-distribution.md`.
- If the change affects Acorn add-on packages, start with `acorn-extensions.md`.
