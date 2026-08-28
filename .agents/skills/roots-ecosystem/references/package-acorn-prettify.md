# Package Deep Dive: `roots/acorn-prettify`

Use this file when the task is specifically about `roots/acorn-prettify`.

## What It Is

`acorn-prettify` applies theme-agnostic frontend cleanup and URL behavior to Acorn-powered WordPress sites.

## Default Feature Areas

- clean up WordPress markup and noisy assets
- nice search redirects from query-string search to pretty paths
- optional relative URLs for configured hooks

## Provider Pattern

- merges config and registers a singleton in `register()`
- publishes config under the `prettify-config` tag
- activates immediately by resolving the main service in `boot()`

## When To Use It

- Use it when the project wants a configurable cleanup layer without hand-writing many WordPress hook tweaks.

## Watch For

- relative URLs are disabled by default and need deliberate enablement
- cleanup features may conflict with plugin or theme assumptions, so review defaults before enabling everything blindly
