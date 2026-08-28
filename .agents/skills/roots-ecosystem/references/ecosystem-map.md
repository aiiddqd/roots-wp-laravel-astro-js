# Ecosystem Map

Use this file when the user needs orientation across the full Roots stack.

## Core Roles

- Bedrock: Composer-managed WordPress project structure, environment bootstrap, and configuration model.
- Sage: WordPress starter theme with Blade templates, view components/composers, and Vite-based asset workflow.
- Acorn: Laravel-style application container and features inside WordPress.
- Trellis: Provisioning and deployment automation for Bedrock-based sites.
- `@roots/vite-plugin`: WordPress-aware Vite integration used heavily by Sage.
- `roots/wp-config`: the configuration layer Bedrock uses behind `Config::define(...)`.
- WP Packages and related distribution tooling: Composer-delivered WordPress packages such as `roots/wordpress-full`, generated with `roots/wordpress-packager`.
- Trellis operational tooling: `roots/trellis-cli` and `roots/setup-trellis-cli`.
- Shared support utilities and extension packages: `roots/support` and first-party Acorn add-ons.

## Common Stack Shape

1. Bedrock provides the project root and puts WordPress under `web/`.
2. The site theme lives in `web/app/themes/<theme>`, often a Sage theme.
3. Sage boots Acorn and uses Acorn features for Blade, providers, components, composers, and optional routing.
4. Trellis provisions servers and deploys the Bedrock project, including Composer install and optional theme asset builds.

## Responsibility Boundaries

- Put WordPress and environment bootstrap concerns in Bedrock.
- Put theme rendering, theme assets, and theme-specific app code in Sage.
- Put Laravel-style application features in Acorn-aware code.
- Put server provisioning and release orchestration in Trellis.

## Mental Model

- Bedrock answers: “How is the WordPress project structured and configured?”
- Sage answers: “How is the theme built and rendered?”
- Acorn answers: “How do I use Laravel-style application patterns in WordPress?”
- Trellis answers: “How do I provision and deploy this stack safely?”
- WP Packages answer: “How is WordPress itself distributed through Composer?”
- Trellis tooling and extension packages answer: “How do I operate or extend the stack without reinventing package patterns?”

## Typical User Requests

- “Configure a new Bedrock site.” -> Bedrock
- “Create a Blade partial/component in a theme.” -> Sage
- “Add a provider, route, or Blade-rendered block.” -> Acorn
- “Deploy the Bedrock project and compile Sage assets.” -> Trellis
- “Explain how the whole stack fits together.” -> this file, then `integration-patterns.md`
