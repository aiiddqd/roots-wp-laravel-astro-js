# Acorn Extensions

Use this file for first-party Acorn packages beyond the base framework.

## Package Deep Dives

- [package-acorn-mail.md](package-acorn-mail.md)
- [package-acorn-user-roles.md](package-acorn-user-roles.md)
- [package-acorn-post-types.md](package-acorn-post-types.md)
- [package-acorn-prettify.md](package-acorn-prettify.md)
- [package-acorn-fse-helper.md](package-acorn-fse-helper.md)
- [package-acorn-llms-txt.md](package-acorn-llms-txt.md)
- [package-acorn-ai.md](package-acorn-ai.md)

## Config-Driven Extensions

- `acorn-user-roles`: manage roles/capabilities from config.
- `acorn-post-types`: manage post types and taxonomies from config.
- `acorn-prettify`: enable front-end cleanup, nice-search, and optional relative URL behavior from config.

These packages follow a common Roots pattern: publish config, keep providers focused, and let consumers control behavior through project config.

## Operational Extensions

- `acorn-mail`: WordPress SMTP through Acorn mail configuration and CLI support.
- `acorn-fse-helper`: bootstrap FSE/block-template support in Acorn themes, with directives and Vite-aware integration.
- `acorn-llms-txt`: expose `/llms.txt`-style endpoints with caching, filtering, and SEO-aware output.
- `acorn-ai`: add WordPress Abilities API and `laravel/ai` integration, including provider config and environment-driven API keys.

## How To Use These Packages

1. Install with Composer.
2. Publish package config when needed.
3. Keep configuration in the project, not inside vendor code.
4. Inspect the provider/config/command pattern before extending or wrapping the package.

## Decision Rules

- If the user needs mail transport, start with `acorn-mail`.
- If the user needs config-managed roles or content types, start with `acorn-user-roles` or `acorn-post-types`.
- If the user needs theme-agnostic cleanup or “nice search,” start with `acorn-prettify`.
- If the user needs FSE bridge behavior in an Acorn-powered theme, start with `acorn-fse-helper`.
- If the user needs LLM-readable site output, start with `acorn-llms-txt`.
- If the user needs AI providers, agents, or Abilities API integration, start with `acorn-ai`.

## Boundaries

- These are package-level features, not replacements for Acorn itself.
- Prefer shared references here unless the task requires package-specific code inspection.
- If the user names one package directly or needs operational detail, load the corresponding package deep dive after this file.
