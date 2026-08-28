# Package Deep Dive: `roots/setup-trellis-cli`

Use this file when the task is specifically about the GitHub Action `roots/setup-trellis-cli`.

## What It Is

`roots/setup-trellis-cli` is the official GitHub Action for preparing Trellis CLI inside GitHub Actions workflows.

## Key Inputs

- `ansible-vault-password` required
- `auto-init` defaults to `true`
- `cache-virtualenv` defaults to `true`
- `galaxy-install` defaults to `true`
- `trellis-directory` defaults to `trellis`
- `version` defaults to `latest`
- `repo-token` helps avoid API rate limits

## When To Use It

- Use it when the deploy target is GitHub Actions and the project already uses Trellis.
- Do not use it for non-Trellis deployments.

## Operational Notes

- installs a chosen Trellis CLI version
- can initialize the Trellis project and install galaxy dependencies
- expects secrets management for vault and SSH-related material

## Boundaries

- This action is a CI bridge into Trellis, not a separate deploy system.
- For workflow sequencing and secrets, also read `playbook-trellis-github-actions.md`.
