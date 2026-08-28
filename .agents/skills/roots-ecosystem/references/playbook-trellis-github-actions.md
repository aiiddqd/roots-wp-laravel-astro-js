# Playbook: Trellis GitHub Actions Deploys

Use this playbook when a Trellis-based project needs deployment automation in GitHub Actions.

## Workflow

1. Confirm the project commits its `trellis/` directory and already deploys through Trellis.
2. Add `ANSIBLE_VAULT_PASSWORD` as a GitHub Actions secret.
3. Generate deploy keys and related secrets with Trellis CLI where possible.
4. Use `roots/setup-trellis-cli` in the workflow to install the CLI and initialize the Trellis project context.
5. Decide whether `auto-init`, virtualenv caching, and galaxy installation should stay enabled.
6. Add a deploy workflow under `.github/workflows/`.
7. If the project uses Sage, make sure dependency caching and build paths point at the actual theme directory.
8. Run `trellis deploy <environment>` from the workflow after secrets and SSH setup are in place.

## Heuristics

- Keep vault and SSH materials in secrets, never in repo-tracked workflow files.
- Prefer the official `setup-trellis-cli` action over ad hoc binary installation in workflows.
- Treat GitHub Actions deploy setup as an extension of the Trellis deploy model, not a separate deployment system.

## Verification

- Confirm the workflow references the correct environment and branch behavior.
- Confirm the action inputs match the repo’s Trellis directory layout.
- Confirm any Sage asset build paths align with the actual theme path.
