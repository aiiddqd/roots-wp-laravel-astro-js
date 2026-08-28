---
name: roots-ecosystem
description: Roots ecosystem implementation guide for Bedrock, Sage, Acorn, Trellis, @roots/vite-plugin, roots/wp-config, WP Packages, Trellis CLI, and first-party Acorn extension packages. Use when working on Roots-based WordPress projects, especially for Bedrock configuration and Composer-managed WordPress, Sage Blade templates/components/composers, Acorn booting/providers/routes, Blade rendering in WordPress, Trellis provisioning or deployment, Trellis GitHub Actions setup, WordPress package distribution, or Acorn packages such as acorn-mail, acorn-user-roles, acorn-post-types, acorn-prettify, acorn-fse-helper, acorn-llms-txt, and acorn-ai.
---

# Roots Ecosystem

## Overview

Use this skill to navigate Roots projects without loading the whole stack into context. Start from the smallest relevant reference, then load one task playbook only if the user is implementing or debugging real changes.

## Quick Start

1. Identify the user's layer:
   - Bedrock project setup, `.env`, Composer, `config/application.php`, `web/app/`, mu-plugins -> read [references/bedrock.md](references/bedrock.md)
   - Sage templates, Blade, components, composers, `app/`, `resources/views/`, Vite, editor assets -> read [references/sage.md](references/sage.md)
   - Acorn booting, service providers, routes, WP-CLI, Blade rendering outside theme templates -> read [references/acorn.md](references/acorn.md)
   - Trellis provisioning, deploys, hooks, `trellis` CLI, Sage build steps during deploy -> read [references/trellis.md](references/trellis.md)
   - WordPress package distribution, WP Packages, `roots/wordpress-full`, `roots/wordpress-packager`, `roots/wp-config`, private plugin workflows, or Composer patches -> read [references/packaging-and-distribution.md](references/packaging-and-distribution.md)
   - Trellis CLI, `roots/setup-trellis-cli`, GitHub Actions deploys, or shared Roots support helpers -> read [references/tooling-and-ci.md](references/tooling-and-ci.md)
   - Acorn extension packages such as mail, user roles, post types, prettify, FSE helper, `llms.txt`, or AI -> read [references/acorn-extensions.md](references/acorn-extensions.md)
   - Package-specific deep dive for a non-core Roots package -> start with the matching package index above, then load the linked `package-*.md` deep dive file
   - Cross-stack ownership or architecture -> read [references/integration-patterns.md](references/integration-patterns.md)
   - Reusable provider/config/command/view patterns from Roots packages -> read [references/acorn-package-patterns.md](references/acorn-package-patterns.md)
   - Questions about source coverage, what this skill includes, or how complete it is -> read [references/source-coverage.md](references/source-coverage.md)
   - Conflicting guidance or uncertainty about authority -> read [references/source-priority.md](references/source-priority.md)
   - Broad orientation to the whole ecosystem -> read [references/ecosystem-map.md](references/ecosystem-map.md)

2. If the user is implementing, load exactly one playbook after the subsystem reference:
   - Bedrock install or configuration changes -> [references/playbook-bedrock-setup.md](references/playbook-bedrock-setup.md)
   - Sage component, composer, template, or view work -> [references/playbook-sage-components-and-composers.md](references/playbook-sage-components-and-composers.md)
   - Acorn provider, route, WP-CLI, package-style extension, or custom Blade rendering -> [references/playbook-acorn-service-providers-and-blade.md](references/playbook-acorn-service-providers-and-blade.md)
   - Trellis deploy or build-hook work -> [references/playbook-trellis-deploy-and-build.md](references/playbook-trellis-deploy-and-build.md)
   - Bootstrap or rationalize a full Roots project stack -> [references/playbook-roots-project-bootstrap.md](references/playbook-roots-project-bootstrap.md)
   - Build or extract a reusable Acorn package -> [references/playbook-acorn-package-authoring.md](references/playbook-acorn-package-authoring.md)
   - Deploy Trellis through GitHub Actions -> [references/playbook-trellis-github-actions.md](references/playbook-trellis-github-actions.md)

3. Avoid loading all references by default. This skill is designed for progressive disclosure.

## Workflow

1. Start with Roots-specific sources, not generic WordPress or generic Laravel advice.
2. Load [references/source-coverage.md](references/source-coverage.md) when the user asks about ecosystem completeness or source traceability.
3. Load [references/source-priority.md](references/source-priority.md) if you need to resolve conflicts.
4. Load one subsystem reference based on the user’s primary task.
5. Load one playbook if the task is implementation-oriented.
6. Use Laravel documentation only where Acorn intentionally mirrors Laravel behavior, such as providers, routing, middleware, controllers, package structure, or Blade syntax.
7. Prefer current Roots docs for workflows and current Roots repository code for concrete structure and examples.

## Navigation Map

- [references/source-priority.md](references/source-priority.md): authority order and conflict resolution
- [references/source-coverage.md](references/source-coverage.md): what source material this skill covers and how deeply
- [references/ecosystem-map.md](references/ecosystem-map.md): the whole stack at a glance
- [references/bedrock.md](references/bedrock.md): project structure, config model, Composer, envs, mu-plugins
- [references/sage.md](references/sage.md): theme structure, Blade, components, composers, Vite
- [references/acorn.md](references/acorn.md): booting, providers, routes, WP-CLI, Blade rendering
- [references/trellis.md](references/trellis.md): provisioning, deployment, hooks, CLI
- [references/packaging-and-distribution.md](references/packaging-and-distribution.md): WP Packages, WordPress distributions, `wp-config`, private plugins, patches
- [references/tooling-and-ci.md](references/tooling-and-ci.md): Trellis CLI, GitHub Actions setup, shared Roots helpers
- [references/acorn-extensions.md](references/acorn-extensions.md): first-party Acorn packages and when to use them
- `references/package-*.md`: per-package deep dives for distribution, tooling, and Acorn extension packages
- [references/integration-patterns.md](references/integration-patterns.md): ownership between layers
- [references/acorn-package-patterns.md](references/acorn-package-patterns.md): package implementation patterns from Roots ecosystem examples

## Guardrails

- Do not treat this as a generic WordPress skill.
- Do not assume Laravel behavior applies unless Acorn documentation or code confirms it.
- Do not recommend Trellis for every deployment by default; use it when the project is already Trellis-based or self-hosted Roots infrastructure is part of the stack.
- Do not assume every Roots repo deserves its own deep reference file; keep package-specific detail in shared references unless the package has distinct operational behavior.
- Do not move responsibilities across layers without reason:
  - Bedrock owns project structure and configuration bootstrap.
  - Sage owns theme implementation and theme-facing Blade/Vite conventions.
  - Acorn owns the Laravel-style application container and app abstractions.
  - Trellis owns provisioning and deployment orchestration.

## Example Requests

- “Add a Composer-managed plugin and update Bedrock config for staging.”
- “Build a Sage Blade component and bind view data with a composer.”
- “Boot Acorn in a custom theme and register a service provider.”
- “Render a custom block with Blade in an Acorn-powered project.”
- “Wire a Sage asset build into Trellis deploy hooks.”
- “Set up Trellis deploys through GitHub Actions.”
- “Explain how `roots/wordpress-full`, WP Packages, and Bedrock relate.”
- “Add `acorn-mail` or `acorn-prettify` to an existing Acorn project.”
- “Show which Roots repos this skill actually covers and where.”
- “Explain how Bedrock, Sage, Acorn, and Trellis fit together in one project.”
