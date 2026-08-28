# roots-wp-laravel-astro-js

A modern starter stack for content-rich websites and web services. It combines a fast JAMstack frontend built with [Astro](https://astro.build/) and JavaScript/TypeScript with a headless CMS layer built on WordPress, [Roots Bedrock](https://roots.io/bedrock/), and [Acorn](https://roots.io/acorn/).

The result is a pragmatic meeting point between the JavaScript ecosystem and WordPress: editors keep the WordPress workflow they know, while developers get Composer-managed dependencies, Laravel-style application tooling, Blade views, and an independently deployable static frontend.

> **Project status:** an experimental reference implementation. It validates the architecture and records its decisions and rough edges before it becomes a production-ready template.

## Why this stack

- **Fast by default.** Astro ships static HTML for the public frontend, so pages need little JavaScript and do not require a Node server at runtime.
- **A familiar editorial experience.** WordPress remains the place where editors create and publish content; its built-in REST API exposes that content to the frontend without a GraphQL plugin or custom API in the initial use case.
- **A cleaner WordPress codebase.** Bedrock keeps WordPress core, plugins, themes, and configuration in predictable, Composer-managed locations.
- **Laravel-inspired developer experience.** Acorn brings Blade templates and Laravel/Illuminate components to WordPress, making application code and server-rendered views more pleasant to build and maintain.
- **Clear separation of concerns.** The CMS, frontend, and local infrastructure can evolve independently. Rebuild and deploy the frontend whenever content or UI changes, without coupling every request to PHP.
- **An incremental path, not a rewrite.** Use Astro for new headless pages while retaining WordPress and Blade where they make sense, then move further toward headless delivery at your own pace.

## Architecture

```text
WordPress editors
       │
       ▼
WordPress + Bedrock + Acorn ── REST API ──► Astro build ──► static site
       │                                      │
       └── Blade views for WordPress          └── Tailwind CSS + DaisyUI
```

Acorn is the Laravel bridge in this stack; it is not a separate Laravel CMS or application. It supplies Laravel/Illuminate components and Blade on top of the WordPress/Bedrock backend.

## Stack components

| Layer | Choice | What it provides |
| --- | --- | --- |
| Frontend | Astro + TypeScript | Static-site generation (SSG) and component-based UI with minimal client-side JavaScript. |
| UI | Tailwind CSS 4 + DaisyUI 5 | Utility-first styling with accessible, ready-to-use component classes. |
| Headless content API | WordPress REST API | Public content delivery using WordPress's built-in endpoints—no custom endpoint or GraphQL dependency in v1. |
| CMS foundation | Roots Bedrock | Composer-based WordPress dependency management, environment-aware configuration, and a cleaner directory layout. |
| Application layer | Roots Acorn + Blade | Laravel/Illuminate primitives and Blade templates within WordPress. |
| Data | MySQL | Local CMS database managed as a lerd service. |
| Local development | lerd | Podman-based PHP runtime, Nginx routing, TLS/DNS support, and managed services. |

## What is implemented

- The WordPress backend lives in [`wp/`](wp/) and uses Bedrock, Acorn, PHP 8.3, and MySQL.
- The Astro frontend lives in [`astro/`](astro/). It is an SSG site with a single home page.
- During `astro build`, the home page requests the latest published WordPress post from `GET /wp-json/wp/v2/posts?per_page=1` and renders it as static HTML.
- WordPress REST responses are typed in TypeScript; public content requires no authentication in this first iteration.
- DaisyUI is installed as a Tailwind CSS plugin, using the current CSS-plugin approach rather than a legacy `tailwind.config` setup.

## Repository layout

```text
.
├── astro/              # Astro SSG frontend: TypeScript, Tailwind, DaisyUI
├── docs/
│   ├── rfc/            # Design and implementation RFCs
│   └── specs/          # Completed implementation summaries
├── wp/                 # Bedrock root: WordPress, Acorn, Composer, web/
├── README.md
└── ROADMAP.md
```

## Local development with lerd

[lerd](https://github.com/geodro/lerd) is the local development environment for the PHP backend. It runs PHP and supporting services in Podman, routes local domains through Nginx, and manages the MySQL service used by WordPress. This keeps the PHP version, database connection, and web-server setup out of the host machine.

The backend is served at `http://wp-roots.localhost`; because Bedrock installs WordPress core in `web/wp`, the admin area is available at:

```text
http://wp-roots.localhost/wp/wp-admin/
```

The project uses a local lerd framework definition named `bedrock` so that lerd serves `web/` as the document root. That definition is machine-local: set it up before linking a fresh clone, and do not remove it with `lerd framework prune`.

For a new local checkout, add the framework definition first:

```bash
lerd framework add bedrock \
  --label Bedrock \
  --public-dir web \
  --detect-file wp-cli.yml \
  --detect-composer roots/bedrock \
  --detect-composer roots/wordpress
```

The project is configured for MySQL; then pin PHP 8.3, link the site, and let lerd install dependencies and prepare its environment:

```bash
cd wp
lerd isolate 8.3
lerd link
lerd setup
```

The Astro frontend is deliberately not a separate lerd site in this iteration. With the WordPress backend running, use its own scripts for frontend development and static preview:

```bash
cd astro
npm install
npm run dev

# Or produce and inspect the static build
npm run build
npm run preview
```

Publishing or editing a WordPress post is reflected in the frontend after the next `npm run build`.

## Backend notes

### Bedrock paths

Bedrock's document root is `wp/web`, and WordPress core is installed in `wp/web/wp`, not in the repository root. Use the `/wp/wp-admin/` URL above; `/wp-admin/` is not the WordPress admin route for this project.

### WP-CLI

Use the Composer-installed WP-CLI from the `wp/` directory. The globally installed Homebrew Phar does not work in this environment.

```bash
./vendor/bin/wp <command> --allow-root
```

`--allow-root` is required because lerd executes these commands as `root` inside the PHP container.

### Acorn configuration

Acorn must use its own `config/acorn` directory. If it reads Bedrock's `config/application.php` as a Laravel configuration file, WordPress constants are defined twice and the application fails during boot. Keep Acorn configuration separate from Bedrock's `config/application.php` and `config/environments/` files.

When debugging a mu-plugin, write any temporary log inside the project rather than `/tmp`: that path is not available to the PHP process in this environment.

### WordPress packages and Blade

WordPress plugins and themes are installed through Composer via [WP Packages](https://repo.wp-packages.org/):

```bash
composer require wp-plugin/query-monitor
composer require wp-theme/<theme-slug>
```

Blade views belong in `resources/views/*.blade.php` and are rendered with `Roots\view(...)`. A clean Bedrock install does not create `app/`, `database/`, or `resources/` automatically, so add those directories when the application first needs them.

## Further reading

- [`docs/rfc/astro.md`](docs/rfc/astro.md) — Astro, DaisyUI, and WordPress REST API implementation decisions.
- [`ROADMAP.md`](ROADMAP.md) — next experiments and planned work.
- [Bedrock documentation](https://roots.io/bedrock/docs/installation/) and [Acorn documentation](https://roots.io/acorn/docs/).
