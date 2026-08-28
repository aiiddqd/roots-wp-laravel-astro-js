# Package Deep Dive: `roots/wordpress-full`

Use this file when the task is specifically about the `roots/wordpress-full` Composer package.

## What It Is

`roots/wordpress-full` is the Composer-distributed WordPress core package for the `full` distribution.

- automatically updated package
- includes bundled themes and bundled plugins from the standard full build
- intended to be consumed by Composer-managed projects

## When To Choose It

- Use it when the project explicitly wants the full WordPress core distribution through Composer.
- Do not use it just because the project uses Bedrock; choose it when the bundled-content behavior is wanted.

## Operational Notes

- install with `composer require roots/wordpress-full`
- depends on `roots/wordpress-core-installer` to control install paths
- sits in the WP Packages distribution layer, not the application-config layer

## Boundaries

- This package is about distributing WordPress core, not configuring Bedrock.
- For how those packages are generated, read [package-wordpress-packager.md](package-wordpress-packager.md).
