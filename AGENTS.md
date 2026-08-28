# wp-roots — notes for the agent

An experiment: WordPress on the Roots stack (Bedrock + Acorn + Blade) under lerd, plus
a separate headless frontend on Astro + DaisyUI. Details and the pitfalls found along
the way are in [`README.md`](README.md); architectural decisions live in the RFCs:
`docs/rfc/wp-roots.md` (moves to `docs/rfc/archive/` once finished) and
`docs/rfc/astro.md` (frontend, status draft).

## Structure

```
./
├── README.md            # pitfalls found in backend/lerd/Acorn (read this first)
├── ROADMAP.md            # next steps of the experiment
├── docs/
│   ├── rfc/               # RFCs (wp-roots.md — backend, astro.md — frontend)
│   └── specs/              # final summaries after sdd-apply (backend.md still empty)
├── roots/                 # the site itself: Bedrock root, composer.json, .env, web/
└── astro/                 # Astro frontend (still empty, see docs/rfc/astro.md)
```

## Backend (`roots/`)

- Bedrock: docroot `web/`, WP core in `web/wp` (not at the root) → admin panel at
  `http://wp-roots.localhost/wp/wp-admin/`, not `/wp-admin/`.
- Admin login: `admin` / `lerdadmin1`.
- PHP 8.3, MySQL via lerd (`wp_roots`), lerd profile — a custom `bedrock`
  framework (local, will not survive `lerd framework prune`).
- `wp-cli`: the global `wp` does not work here (PharException). Use
  `./vendor/bin/wp <command> --allow-root` from `roots/`.
- Acorn on top of Bedrock requires a separate `useConfigPath` (`config/acorn`),
  otherwise it conflicts with Bedrock's `config/application.php` — details and
  ready-made fix code are in README.md, do not reinvent them.
- WP Composer packages: `wp-plugin/<slug>`, `wp-theme/<slug>` via
  `repo.wp-packages.org` (already wired up in `roots/composer.json`).
- Blade views — `resources/views/*.blade.php`, rendered through `Roots\view(...)`.
  The `app/`, `database/`, and `resources/` directories have to be created by hand
  on first use.

## Frontend (`astro/`)

- v1 scope (see `docs/rfc/astro.md`): a single page `/`, SSG, data from the backend's
  WP REST API (`wp-json/wp/v2/pages`) at `astro build` time, no plugins
  (WPGraphQL and the like) and no custom REST endpoints.
- DaisyUI is installed following the official guide
  (https://daisyui.com/docs/install/astro/), on top of Tailwind.
- Open question: register `astro/` as a separate lerd site (with its own
  subdomain) or serve the static output some other way — to be decided during
  implementation.

## Before fixing a problem

First check [`README.md`](README.md) — it already covers: the Acorn/Bedrock config
conflict, where to write the debug log from an mu-plugin (not `/tmp`), and the reason
for the custom lerd framework. Do not rediscover what is already described there.
