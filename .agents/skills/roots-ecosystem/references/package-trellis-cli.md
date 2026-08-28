# Package Deep Dive: `roots/trellis-cli`

Use this file when the task is specifically about `roots/trellis-cli`.

## What It Is

`roots/trellis-cli` is the operational CLI layer around Trellis projects.

## Key Capabilities

- installable `trellis` command
- autocompletion
- virtualenv-managed dependencies
- deploy/provision/key/log/rollback workflows
- binary distribution with artifact attestation support

## When To Use It

- Use it when the user wants command-line workflows around Trellis, especially install, shell integration, key generation, or automation support.
- Do not use it as a substitute for understanding Trellis deploy hooks and config files.

## Operational Notes

- supports Homebrew, script, and manual install paths
- can install shell completion and manage virtualenv behavior
- artifacts can be verified with `gh attestation verify`

## Boundaries

- The CLI wraps Trellis workflows; it does not redefine Trellis architecture.
- For CI usage, pair this with [package-setup-trellis-cli.md](package-setup-trellis-cli.md).
