# Source Coverage

Use this file when the user asks whether this skill covers a specific Roots source, how complete the coverage is, or which references were used to build the skill.

## Coverage Levels

- **Deep**: a primary subsystem reference exists and the repo/docs were used directly for workflows and structure.
- **Targeted**: the source was read for concrete patterns or operational behavior and is covered inside a broader reference.
- **Structural inspiration only**: influenced skill organization, not technical Roots behavior.

## Covered Roots Sources

| Source | Coverage | Reflected in |
| --- | --- | --- |
| `roots/docs` | Deep | `ecosystem-map`, `bedrock`, `sage`, `acorn`, `trellis`, playbooks |
| `roots/bedrock` | Deep | `bedrock`, `integration-patterns`, Bedrock playbook |
| `roots/sage` | Deep | `sage`, `integration-patterns`, Sage playbook |
| `roots/acorn` | Deep | `acorn`, `acorn-package-patterns`, Acorn playbooks |
| `roots/trellis` | Deep | `trellis`, `integration-patterns`, Trellis playbooks |
| `roots/vite-plugin` | Targeted | `sage`, `ecosystem-map`, `integration-patterns` |
| `roots/wp-config` | Targeted | `bedrock`, `packaging-and-distribution` |
| `roots/wordpress-full` | Targeted | `packaging-and-distribution`, bootstrap playbook |
| `roots/wordpress-packager` | Targeted | `packaging-and-distribution` |
| `roots/trellis-cli` | Targeted | `trellis`, `tooling-and-ci`, CI playbook |
| `roots/setup-trellis-cli` | Targeted | `tooling-and-ci`, CI playbook |
| `roots/support` | Targeted | `tooling-and-ci`, `acorn-package-patterns` |
| `roots/acorn-mail` | Targeted | `acorn-extensions`, `acorn-package-patterns` |
| `roots/acorn-user-roles` | Targeted | `acorn-extensions`, `acorn-package-patterns` |
| `roots/acorn-post-types` | Targeted | `acorn-extensions`, `acorn-package-patterns` |
| `roots/acorn-prettify` | Targeted | `acorn-extensions`, `acorn-package-patterns` |
| `roots/acorn-fse-helper` | Targeted | `acorn-extensions`, `acorn-package-patterns` |
| `roots/acorn-llms-txt` | Targeted | `acorn-extensions`, `acorn-package-patterns` |
| `roots/acorn-ai` | Targeted | `acorn-extensions`, `acorn-package-patterns` |

The current iteration also adds package-specific deep-dive references for the non-core packages above.

## Notes

- This skill is broad, not exhaustive. It should guide implementation and source selection, not replace reading repo code for edge cases.
- The current skill goes deepest on the core stack: Bedrock, Sage, Acorn, Trellis, and Roots docs.
- The package/tooling/extensions layer is intentionally summarized into shared references to keep context efficient.

## Non-Authoritative Influences

- Laravel documentation is authoritative only where Acorn intentionally mirrors Laravel features.
- Laravel-oriented skills from `skills.sh` were used only as structural inspiration for progressive disclosure, not as technical authority for Roots behavior.
