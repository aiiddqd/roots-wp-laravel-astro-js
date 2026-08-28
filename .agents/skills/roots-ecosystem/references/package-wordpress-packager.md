# Package Deep Dive: `roots/wordpress-packager`

Use this file when the task is specifically about `roots/wordpress-packager`.

## What It Is

`roots/wordpress-packager` is the tool Roots uses to generate Composer packages for WordPress releases.

## Key Model

- takes a repository remote and target package name
- supports different release types such as `full`, `new-bundled`, and `no-content`
- can optionally include unstable beta/RC releases
- abstracts release-source logic through a source interface

## When To Use It

- Use it when the question is about how WP Packages are generated or how to produce a Composer package from a WordPress release source.
- Do not use it for normal Bedrock consumption of WordPress packages.

## Operational Notes

- CLI entrypoint: `vendor/bin/wordpress-packager`
- default release source: `WPDotOrgAPI`
- package generation concerns are separate from runtime app concerns

## Boundaries

- This is package-generation infrastructure, not a project bootstrap tool.
- Most Roots users consume the packages it produces rather than using it directly.
