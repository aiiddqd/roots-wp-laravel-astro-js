# Package Deep Dive: `roots/acorn-ai`

Use this file when the task is specifically about `roots/acorn-ai`.

## What It Is

`acorn-ai` wraps `laravel/ai` for Acorn projects and integrates with the WordPress Abilities API.

## Key Features

- publish WordPress-specific AI config and upstream `laravel/ai` config
- environment-driven provider API keys
- generators for abilities, agents, and tools through `wp acorn`
- automatic ability registration through the WordPress Abilities API when available
- MCP-friendly ability exposure through ability metadata

## Provider Pattern

- merges `ai-wordpress` config
- populates provider environment variables for WordPress AI connectors
- registers console commands for ability scaffolding and listing
- registers configured abilities on `wp_abilities_api_init`

## When To Use It

- Use it when the project needs AI providers or WordPress Abilities API integration inside an Acorn application.

## Watch For

- requires newer platform versions than most other Acorn packages
- depends on WordPress 6.9+ for Abilities API behavior
- `laravel/ai` remains the authority for provider/agent/tool semantics beyond the Roots-specific bridge
