# Acorn Package Patterns

Use this file when implementing reusable package-style functionality or when extracting patterns from the wider Roots Acorn ecosystem.

## Pattern Sources

This file summarizes patterns visible in Roots packages such as:

- `acorn-mail`
- `acorn-user-roles`
- `acorn-post-types`
- `acorn-fse-helper`
- `acorn-llms-txt`
- `acorn-ai`

For package selection and package-specific “what does this add?” questions, read [acorn-extensions.md](acorn-extensions.md) first. This file is about implementation shape, not feature discovery.

## Service Provider Pattern

Typical package providers are small and focused:

- register container bindings or singletons in `register()`
- boot runtime behavior in `boot()`
- attach console commands only when running in console

This split keeps package startup predictable and makes console-only behavior cheap in web requests.

## Config Pattern

Package-style Roots code often:

- ships config files in `config/`
- merges defaults with `mergeConfigFrom(...)`
- publishes config for consumers when running in console

Use this when the package needs stable defaults but also wants project-level override points.

## Commands Pattern

Console-capable packages commonly register commands behind `if ($this->app->runningInConsole())`.

Use this for:

- setup commands
- inspection or maintenance tasks
- code generation or initialization helpers

## Views And Blade Pattern

Packages that expose UI or render helpers may:

- load namespaced views from `resources/views`
- register Blade directives in `boot()`
- render through Blade rather than string-building markup manually

## Feature-Specific Notes

- `acorn-mail`: provider registers commands and an app singleton.
- `acorn-user-roles` and `acorn-post-types`: config-driven packages with focused providers.
- `acorn-fse-helper`: package merges config, loads views, publishes config, registers commands, and adds runtime hooks/directives.
- `acorn-llms-txt` and `acorn-ai`: larger package shapes with multiple service classes and focused providers, useful as examples for more complex Acorn extensions.

## Reuse Guidance

- Favor one provider with one clear purpose over a “god provider.”
- Add config only when consumers need to tune behavior.
- Add commands only when they provide operational value.
- Prefer composable services behind the provider rather than putting full feature logic inside the provider itself.
- Use an Acorn package template and Composer path repositories when turning one-off site logic into a reusable package.
