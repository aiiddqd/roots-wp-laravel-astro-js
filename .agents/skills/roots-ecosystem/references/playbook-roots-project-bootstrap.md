# Playbook: Roots Project Bootstrap

Use this playbook when creating a new Roots project or upgrading a vague “Roots stack” request into a concrete implementation plan.

## Workflow

1. Decide whether the project actually needs the full Roots stack or only Bedrock/Sage/Acorn.
2. Choose the WordPress distribution and dependency model first:
   - Composer-managed WordPress
   - WP Packages for plugins/themes
   - `wordpress-full` only when the full distribution package is the right fit
3. Establish Bedrock-level configuration and environment strategy.
4. Add Sage only if a custom theme with Blade/Vite conventions is part of the project.
5. Rely on Sage to boot Acorn where appropriate.
6. Add Trellis only if the infrastructure and deployment path are Trellis-based.
7. Choose local development strategy explicitly: Trellis, DDEV, Lando, Local, Valet, or another compatible setup.
8. If CI/CD is required for a Trellis project, plan for `setup-trellis-cli` and secrets management early.

## Heuristics

- Start small. Do not force Trellis or extra packages into every Roots project.
- Keep configuration and packaging decisions at the project layer before theme or package implementation.
- Prefer one clear deployment path instead of mixing Trellis with unrelated manual server workflows.

## Verification

- Confirm the chosen stack answers the actual project needs.
- Confirm the WordPress/package strategy and deploy strategy are compatible.
- Confirm the skill references you loaded match the chosen stack rather than the entire ecosystem.
