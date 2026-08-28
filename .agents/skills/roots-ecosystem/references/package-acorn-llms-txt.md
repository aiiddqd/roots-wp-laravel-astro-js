# Package Deep Dive: `roots/acorn-llms-txt`

Use this file when the task is specifically about `roots/acorn-llms-txt`.

## What It Is

`acorn-llms-txt` exposes structured LLM-readable content endpoints from WordPress.

## Key Features

- `/llms.txt`, `/llms-full.txt`, `/llms-small.txt`
- optional individual `/{slug}.txt` endpoints
- sitemap integration and SEO-aware filtering
- shortcode processing, caching, taxonomy/author/date enrichment
- optional WooCommerce metadata in output

## Provider Pattern

- registers fetcher, formatter, markdown converter, cache invalidator, and SEO services
- publishes config
- registers a CLI command
- loads routes and conditionally enables individual post routes

## When To Use It

- Use it when a site needs machine-readable content output for LLM ingestion or tool consumption.

## Watch For

- individual post endpoints are disabled by default for performance/security reasons
- SEO filtering and `X-Robots-Tag: noindex` behavior are part of the package contract
- output size and performance are governed heavily by config limits and cache TTLs
