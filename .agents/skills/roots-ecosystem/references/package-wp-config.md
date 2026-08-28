# Package Deep Dive: `roots/wp-config`

Use this file when the task is specifically about `roots/wp-config`.

## What It Is

`roots/wp-config` is a fluent WordPress configuration library used by Bedrock.

## Key Capabilities

- chainable config API
- `.env` and `.env.local` bootstrap support
- conditional configuration with `when()`
- instance-scoped hooks and automatic `before_apply` behavior

## When To Use It

- Use it when the user asks about the configuration library itself or needs fluent config patterns outside standard Bedrock examples.
- In a Bedrock app, treat it as the underlying config engine rather than a separate framework layer.

## Operational Notes

- typical entrypoint: `Config::make($rootDir)->bootstrapEnv()`
- final application happens through `apply()`
- environment-driven configuration and hook-based config extension are first-class features

## Boundaries

- For project-level Bedrock config patterns, read `bedrock.md` first.
- For WP package distribution, this package is not the right starting point.
