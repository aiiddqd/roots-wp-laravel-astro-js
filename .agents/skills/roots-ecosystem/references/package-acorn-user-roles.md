# Package Deep Dive: `roots/acorn-user-roles`

Use this file when the task is specifically about `roots/acorn-user-roles`.

## What It Is

`acorn-user-roles` manages WordPress roles and capabilities from project config.

## Config Model

- roles are defined in `config/user-roles.php`
- set a role to `false` to remove it
- define capabilities as a list or associative map
- `strict: true` makes config authoritative and removes unlisted capabilities

## Provider Pattern

- merges config in `register()`
- publishes config in `boot()`
- instantiates the manager on `init` with late priority

## When To Use It

- Use it when roles/capabilities should be version-controlled and synchronized through config.

## Watch For

- removing a role from config does not restore it later
- setting a role to `false` removes it from the database and restoration is manual via WP-CLI
