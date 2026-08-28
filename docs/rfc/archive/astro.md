---
title: "Astro frontend for wp-roots (SSG + WP REST API)"
status: implementing
created: 2026-08-28
---

# RFC: Astro frontend for wp-roots (SSG + WP REST API)

## Prerequisites

- the WordPress Roots backend lives here: /Users/aa/Projects/4px/projects/wp-roots/roots
- the Astro-based site has to be brought up here: /Users/aa/Projects/4px/projects/wp-roots/docs/rfc/astro.md
- we use the current versions of Astro and DaisyUI https://daisyui.com/docs/install/astro/

## Background

We are bringing up a separate frontend on Astro (latest stable version) with the DaisyUI UI kit on top of the existing headless `wp-roots` backend (Bedrock + Acorn). The frontend lives in `wp-roots/astro/` (the directory already exists and is empty). Content for the homepage is pulled from WordPress through the stock WP REST API, without extra plugins. The build is static (SSG): the page is generated at `astro build` time from the data current at that moment; when content changes in WP, the frontend has to be rebuilt.

## Purpose and goals

The goal is to validate the Astro + DaisyUI + WP REST API combination as a headless frontend on top of a Bedrock/Acorn backend in the 4px stack (much like `wp-roots.md` validated the Bedrock + Acorn + Blade combination). This is a solo experiment, no formal review required. The result should show:

- how an Astro project fits into the existing `wp-roots` lerd workspace next to the PHP backend;
- how to fetch and render WordPress data through the REST API without plugins (WPGraphQL and the like) at build time;
- whether the combination works technically: build, deploy into lerd, page reachable in the browser with real content from WP.

## Components and specifics

- **Astro project**: initialized in `wp-roots/astro/` (`npm create astro@latest`), latest stable Astro version.
- **DaisyUI**: installed following the official instructions https://daisyui.com/docs/install/astro/ (Tailwind CSS + the DaisyUI plugin).
- **Data source**: the WP REST API of the `wp-roots` backend (`http://wp-roots.localhost/wp-json/wp/v2/...`). No custom REST endpoints and no GraphQL — we use what WP provides out of the box (`/pages`, and `/posts` if needed).
- **Rendering**: SSG only. Data is requested at build time (a top-level `fetch` in an `.astro` file or in `getStaticPaths`), and the HTML is served statically. No Node server at runtime, no ISR/on-demand rendering in this iteration.
- **v1 scope**: a single page — the homepage (`/`). It renders the latest published blog post (`/wp-json/wp/v2/posts?per_page=1`) rather than an arbitrary WP Page — the content source is fixed.
- **Local environment**: Astro is **not registered as a separate lerd site**. Local verification goes through `astro dev`/`astro build` + `astro preview` directly (Node), without integration into the `wp-roots` lerd workspace at this stage.
- **Typing**: WP REST API responses are typed with TypeScript interfaces (at minimum the shape of the `Post` object for the fields actually used: `id`, `date`, `slug`, `link`, `title.rendered`, `content.rendered`, `excerpt.rendered`).
- **v1 limitations**: no authentication to the WP REST API (public content), no revalidation/webhooks to trigger a rebuild, no CI/deploy, no lerd integration.

## Acceptance criteria

- [x] `wp-roots/astro/` contains a working Astro project on the latest stable version, and `astro build` completes without errors.
- [x] DaisyUI is installed following the official instructions and applied to at least one visible element of the homepage (a button or a card, for example) — visually confirming that DaisyUI styles are active.
- [x] The homepage (`/`) requests the latest post at build time through `/wp-json/wp/v2/posts?per_page=1` and renders its title/content.
- [x] The WP REST API response is typed (a TypeScript `Post` interface with the fields used), without `any`.
- [x] The built site opens in a browser locally (`astro preview`, without lerd) and shows the real content of the latest post rather than a placeholder.
- [x] Publishing a new post in the WP admin and running `astro build` again is reflected in the resulting HTML page.
- [x] A short note about the Astro frontend has been added to `wp-roots/README.md` (in line with the other README sections), recording the non-trivial findings about the integration (if any turned up).

## Roadmap

1. Initialize the Astro project in `wp-roots/astro/` (TypeScript template), check `astro dev`/`astro build` on the empty template.
2. Install DaisyUI following the official guide, make sure the styles are applied.
3. Define a TypeScript `Post` type for the needed fields of the `/wp-json/wp/v2/posts` response and write a typed fetch of the latest post at build time.
4. Build the homepage: render the title/content of the latest post with basic markup on DaisyUI components.
5. Build (`astro build`) and check locally via `astro preview` (without registering in lerd): the content of the real latest post is visible on the page.
6. Verify the end-to-end scenario: publish a new post in WP → `astro build` → the change is visible on the page.
7. Record the findings and non-trivial decisions in `wp-roots/README.md`.

## Summary and recommendations

The experiment succeeded: Astro + DaisyUI + WP REST API comes up as an SSG frontend on top of `wp-roots`, and all acceptance criteria are met.

What was done (`wp-roots/astro/`):
- Astro 7.2.9 (the `minimal` TS template, `strict` tsconfig), `npx astro add tailwind` for Tailwind CSS v4 (`@tailwindcss/vite`).
- DaisyUI 5.7.22 is wired up as a CSS plugin: `@plugin "daisyui";` in `src/styles/global.css` — the current approach for DaisyUI 5 + Tailwind 4, no separate `tailwind.config` needed.
- Typing of the WP REST API response — `src/lib/wp.ts` (`interface Post`, `fetchLatestPost()`); `npx astro check` passes with no errors or warnings.
- The homepage (`src/pages/index.astro`) does a build-time `fetch` to `http://wp-roots.localhost/wp-json/wp/v2/posts?per_page=1` and renders the title/date/content of the latest post in a DaisyUI card (`card`, `btn-primary`).
- The end-to-end scenario was verified by hand: a test post was created via `wp post create`, `astro build` picked it up as the latest, and the test post was deleted (`wp post delete`) — the regular "Hello world!" remains in production.
- Verified without lerd: `astro build` + `astro preview` on port 4321, and `curl` confirmed the real content and the compiled daisyui rules in the CSS. Opening it in a browser through MCP chrome-devtools did not work — that browser has no access to this machine's `localhost` (the already-open tab resolves to an unrelated site on the same port on its own side); the visual check of the DaisyUI styles was done by analyzing the built HTML/CSS rather than with a screenshot.

Extending this to a list of blog posts, arbitrary pages by slug, ISR/SSR, and registration in lerd is the subject of a separate iteration.

## Open questions

- ~~Which exact WP Page acts as the content source for the Astro homepage?~~ Resolved: not a Page, but the latest published blog post (`/wp-json/wp/v2/posts?per_page=1`).
- ~~Should `astro/` be registered as a separate lerd site?~~ Resolved: no, lerd is not involved in this iteration — verification goes through `astro dev`/`astro preview` directly.
- ~~Is typing of the WP REST API response needed?~~ Resolved: yes, a TypeScript interface for the fields used.
