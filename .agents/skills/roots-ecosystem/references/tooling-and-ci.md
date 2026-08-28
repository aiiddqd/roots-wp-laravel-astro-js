# Tooling And CI

Use this file for operational tooling around Roots projects: Trellis CLI, GitHub Actions automation, and shared support helpers.

## Package Deep Dives

- [package-trellis-cli.md](package-trellis-cli.md)
- [package-setup-trellis-cli.md](package-setup-trellis-cli.md)
- [package-support.md](package-support.md)

## Trellis CLI

`roots/trellis-cli` is the command-line layer around Trellis projects.

- install and manage the `trellis` command
- simplify project init, provision, deploy, rollback, logs, and key management
- integrate shell completion and virtualenv behavior

Use it when the user wants an operational workflow around Trellis rather than editing raw Trellis files only.

## GitHub Actions Setup

`roots/setup-trellis-cli` is the GitHub Action for CI/CD workflows around Trellis.

- installs a chosen Trellis CLI version
- can auto-run `trellis init`
- can cache the managed virtualenv
- can run `trellis galaxy install`
- writes `.vault_pass` from a secret input

This is the normal reference point for Trellis deploy automation in GitHub Actions.

## Shared Roots Helpers

`roots/support` provides shared helper functions used across Roots projects, such as:

- environment lookup helpers
- mass hook registration helpers like `add_filters()` and `add_actions()`
- small Roots-flavored wrappers around WordPress behavior

Use it as a support library reference, not as a user-facing subsystem comparable to Bedrock or Sage.

## CI Guidance

- Use Trellis CLI locally or in automation when the project is already Trellis-based.
- Use `setup-trellis-cli` when the deploy target is GitHub Actions.
- Keep vault and SSH material in secrets, not in repo-tracked files.
- For Sage-based themes, remember CI may need the theme `package-lock.json` path for caching or builds.
- If the user names one tooling package directly, load its package deep dive after this file.
