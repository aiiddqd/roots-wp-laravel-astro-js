# Playbook: Trellis Deploy And Build Integration

Use this playbook for Trellis provisioning and deployment changes, especially when Sage assets are involved.

## Workflow

1. Confirm the project is actually Trellis-based before recommending Trellis changes.
2. Inspect `group_vars/<environment>/wordpress_sites.yml`, deploy hooks, and any project-local Trellis config.
3. Verify the target repo and branch are correct for the site.
4. Decide whether the required change belongs in provisioning config, deploy config, or a hook.
5. If the theme requires a production build, prefer a deploy hook over ad hoc manual steps.
6. Keep the asset build recipe explicit, including Node invocation details.
7. If the project uses `nvm`, prefer `$NVM_DIR/nvm-exec` in hook commands.
8. Remember that Bedrock still needs Composer install in the deployment flow.
9. Treat database/schema changes as a separate operational concern from a normal zero-downtime deploy.

## Common Tasks

- set repo or branch for deploys
- add or adjust a build hook
- compile Sage assets during deployment
- run rollback
- inspect Trellis CLI commands for project operations

## Verification

- Confirm the deploy path still points at the correct repo and branch.
- Confirm the asset build runs in the correct theme directory.
- Confirm the deploy logic does not rely on undocumented manual server state.
