# Trellis

Use this file for server provisioning, deployment flow, build hooks, and Trellis CLI usage.

## What Trellis Owns

Trellis is the infrastructure and deployment layer for Roots projects. It handles:

- local and remote environment provisioning
- server configuration
- zero-downtime deploy orchestration
- Bedrock project deployment from Git

## Deployment Model

- Trellis deploys a Git repository, usually a Bedrock-based project.
- `wordpress_sites.yml` defines at least the repo and branch for each site.
- The high-level command is `trellis deploy <environment>`.
- Rollbacks are first-class with `trellis rollback`.

## Hook Model

Trellis deploys run through ordered stages such as:

- initialize
- update
- prepare
- build
- share
- finalize

Each stage supports `before` and `after` hooks. Use hooks for:

- local or remote build steps
- custom file preparation
- post-deploy maintenance

## Sage Integration

- Sage production assets usually need a build step during deployment.
- Trellis ships an example `build-before` hook for this pattern.
- A common setup is to compile assets locally, then include the built output in the release.
- If the team uses `nvm`, prefer `$NVM_DIR/nvm-exec` inside hook commands.

## Trellis CLI

`trellis-cli` wraps common Trellis operations behind the `trellis` command and adds conveniences like:

- dependency checks
- project info
- provision/deploy helpers
- VM/server helpers
- shell and virtualenv integration

## Boundaries

- Trellis does not replace Bedrock project configuration.
- Trellis does not automatically solve application-level schema changes.
- Do not move theme build logic into ad hoc server scripts when a Trellis hook is the natural place.
