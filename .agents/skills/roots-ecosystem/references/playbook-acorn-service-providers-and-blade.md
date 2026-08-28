# Playbook: Acorn Providers, Routes, And Blade Rendering

Use this playbook when the task involves Acorn-specific application behavior.

## Workflow

1. Confirm whether Acorn is already booted by the project. If it is Sage-based, it usually is.
2. Inspect the current boot chain before adding providers, routing, or middleware.
3. For new provider logic, decide what belongs in `register()` versus `boot()`.
4. Keep bindings, singletons, and container registration in `register()`.
5. Keep hooks, directives, view loading, runtime behavior, and command registration in `boot()`.
6. If the task is package-style, add config merge/publish only when consumers need overrides.
7. If the task is custom rendering outside normal templates, use `view()` and pass explicit data.
8. If the task is route-based, confirm routing is enabled during `Application::configure(...)`.
9. Use `wp acorn` generators when they match the task and local conventions.

## Common Tasks

- add a service provider
- render a block or email with Blade
- add a route/controller pair
- register commands
- build a small package-style feature inside a theme or plugin

## Verification

- Confirm Acorn is not booted twice.
- Confirm Laravel guidance used is actually supported by Acorn in this context.
- Confirm provider responsibilities are still narrow and readable.
