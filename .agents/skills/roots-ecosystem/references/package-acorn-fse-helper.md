# Package Deep Dive: `roots/acorn-fse-helper`

Use this file when the task is specifically about `roots/acorn-fse-helper`.

## What It Is

`acorn-fse-helper` bridges Acorn-powered themes into full-site editing and block-template workflows.

## Key Features

- `wp acorn fse:init` bootstrap flow
- priority for `templates/` block templates over existing Blade views after initialization
- Blade directives `@blocks`, `@endblocks`, and `@blockpart`
- optional automatic Vite asset injection for FSE themes

## Provider Pattern

- loads views, publishes config, and registers `fse:init` in console mode
- merges config in boot
- hooks Vite assets into `wp_head` when enabled

## When To Use It

- Use it when an Acorn theme is moving toward block templates or hybrid FSE patterns.

## Watch For

- `vite_enabled` is off by default
- custom Vite entrypoints can be filtered through `acorn/fse/vite_entrypoints`
