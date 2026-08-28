# Playbook: Acorn Package Authoring

Use this playbook when building a reusable Acorn package or extracting reusable site logic into package form.

## Workflow

1. Decide whether the feature should remain project-local or become a package.
2. Start from Acorn package-development guidance and an Acorn package template if package reuse is the goal.
3. Define the package boundary clearly:
   - provider(s)
   - config
   - commands
   - views/directives
   - services
4. Keep container registration in `register()` and runtime behavior in `boot()`.
5. Add `mergeConfigFrom(...)` and publishing only when consumers need project-level overrides.
6. Register commands only behind console checks.
7. Test the package locally through a Composer path repository when iterating in a host project.
8. Run `wp acorn package:discover` after wiring the package into the consumer project.

## Pattern Sources

- `acorn-mail`
- `acorn-user-roles`
- `acorn-post-types`
- `acorn-prettify`
- `acorn-fse-helper`
- `acorn-llms-txt`
- `acorn-ai`

## Verification

- Confirm the package is not just a thin wrapper around project-specific code.
- Confirm provider responsibilities are narrow.
- Confirm config, views, and commands are optional only when they add real value.
