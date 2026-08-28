# Package Deep Dive: `roots/acorn-post-types`

Use this file when the task is specifically about `roots/acorn-post-types`.

## What It Is

`acorn-post-types` manages post types and taxonomies from config using Extended CPTs.

## Config Model

- `config/post-types.php` defines both post types and taxonomies
- post type definitions include labels, supports, REST exposure, icons, and naming
- taxonomy definitions can map to post types and customize UI behavior such as `meta_box`

## Provider Pattern

- merges config in `register()`
- publishes config in `boot()`
- instantiates registration on `init`

## When To Use It

- Use it when CPT/taxonomy registration should be config-driven instead of imperative hook code.

## Watch For

- this package is opinionated around Extended CPTs
- keep the config readable; overloading it with runtime logic defeats the package’s value
