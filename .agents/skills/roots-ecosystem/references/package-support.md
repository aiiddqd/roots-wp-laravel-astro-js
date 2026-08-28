# Package Deep Dive: `roots/support`

Use this file when the task is specifically about `roots/support`.

## What It Is

`roots/support` is a shared helper library used across Roots WordPress projects.

## Notable Helpers

- `Roots\\env()` for environment lookup, with delegation to `Illuminate\\Support\\Env` when available
- `Roots\\value()` for closure-or-value normalization
- `Roots\\add_filters()` and `Roots\\add_actions()` for mass hook registration
- `Roots\\remove_filters()` and `Roots\\remove_actions()` for hook cleanup
- `Roots\\wp_die()` as a Roots-flavored wrapper

## When To Use It

- Use it when the task is about shared helper semantics or when reading Roots code that relies on these helper functions.
- Do not treat it as a top-level subsystem like Bedrock or Sage.

## Boundaries

- This package exists to reduce repeated low-level utility code.
- For high-level package architecture, `roots/support` is usually a dependency detail rather than the primary feature.
