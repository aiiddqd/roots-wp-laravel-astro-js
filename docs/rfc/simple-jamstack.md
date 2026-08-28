---
title: "Stylist mini-site: Astro SSG and a /my personal area via WordPress JWT"
status: implementing
created: 2026-08-28
---

# RFC: Stylist mini-site — Astro SSG + WordPress JWT personal area

## todo


## Prerequisites

- the WordPress Roots backend lives here: /Users/aa/Projects/4px/projects/wp-roots/roots
- the Astro-based site has to be brought up here: /Users/aa/Projects/4px/projects/wp-roots/docs/rfc/astro.md
- we use the current versions of Astro and DaisyUI https://daisyui.com/docs/install/astro/

## Background

We are growing the current Astro project into a demo business-card site for a hairstylist. The public part stays a static site (SSG); alongside it a `/my` route appears with a login form and a minimal personal area. Accounts and password verification stay in the existing WordPress (Bedrock + Acorn); Astro stores no users and receives no secrets at build time.

For v1 we pick the free [JWT Authentication for WP REST API](https://wordpress.org/plugins/jwt-authentication-for-wp-rest-api/) plugin: it issues a token at `POST /wp-json/jwt-auth/v1/token` and verifies it via `POST /wp-json/jwt-auth/v1/token/validate`. The `wp-plugin/jwt-authentication-for-wp-rest-api` package is already pinned at 1.5.0 in `roots/composer.lock`, and `JWT_AUTH_SECRET_KEY` is already defined in `roots/config/application.php`; this is not a new dependency, but configuring and putting an existing one into service.

## Purpose and goals

- Get the first version of the stylist's site: a homepage with services, work samples / a call to book, and a "Personal area" link.
- Keep Astro's advantage: the public HTML is generated at `astro build`, with no Node server in production for it.
- Allow access to `/my` only after a successful authentication in WordPress; the password is transmitted only in an HTTPS request to the WordPress API.
- Set up a reproducible local check and Playwright UI E2E tests: successful login, wrong password, session restore within the tab, and logout.

Stakeholders: the site owner (approves the copy and the visuals), the personal-area user, and the developer maintaining WordPress/Astro. The RFC is reviewed by the initiator of the experiment.

## Components and specifics

### Solution boundaries

| Part | v1 decision |
| --- | --- |
| Public site | Astro + TypeScript + Tailwind/DaisyUI, SSG; `/` — the stylist's mini business card. |
| Personal area | A statically built `/my` with a client-side TypeScript script; before login only the form is visible. |
| Identity provider | The existing WordPress; user creation and roles happen in the WP admin / WP-CLI. |
| Session | The JWT is kept in `sessionStorage` only: it survives a page reload, and is dropped when the tab is closed and on an explicit logout. |
| Personal-area data | In v1 the safe fields of the JWT plugin's response are shown: `user_display_name`, `user_email`, `user_nicename`. No appointments, bookings, profile editing, or new WP REST endpoints yet. |

`/my` does not require Astro SSR: a neutral HTML page is produced at build time, and after the form is submitted the browser calls WordPress. This means the `/my` URL by itself does not hide a static file; protection of future user data must always be enforced by the WordPress REST API through the `Authorization: Bearer <JWT>` header, not by the UI state alone.

### Authorization contract

1. The form sends `username` and `password` as a JSON request to `${PUBLIC_WP_API_URL}/wp-json/jwt-auth/v1/token`.
2. On a 200 response the client puts only the `token` into `sessionStorage`; the display name and email are taken from that same response. The password is not logged and is not stored anywhere.
3. When `/my` is opened or reloaded, the client reads the token and calls `POST …/token/validate` with the Bearer header. Success shows the personal area; an error/expiry clears storage and returns the form.
4. "Log out" removes the token and user data from `sessionStorage`, then shows the form.

`PUBLIC_WP_API_URL` is public client configuration (locally `http://wp-roots.localhost`), not a secret. The address is not hardcoded in `src/lib/wp.ts`: both the build-time fetch of public content and the auth client use one variable with a suitable default for local. Do not use `PUBLIC_` for the JWT key, credentials, or any server-side secret.

### WordPress and security

- Activate the plugin from `roots/` through `./vendor/bin/wp … --allow-root` under lerd, not by manually copying it into `web/app/plugins`.
- Add `JWT_AUTH_SECRET_KEY` to `roots/.env.example` only as a non-production placeholder; the real long random value lives in the untracked `roots/.env` / a secret store. The key is not the same as the WordPress salts and never reaches the frontend or the logs.
- In a small mu-plugin, set the JWT lifetime to one hour via the `jwt_auth_expire` filter. The free version of the plugin provides neither refresh nor token revocation, so after expiry the user logs in again; instant server-side logout is not claimed.
- Explicitly verify that `Authorization` is passed through from production Nginx to PHP-FPM. For different origins, configure CORS/preflight for exactly the local Astro origin and the future public origin; do not leave an "any origin" rule as the final production setting. In production HTTPS is mandatory for both origins.
- Create a dedicated E2E user with the `subscriber` role; existing administrator credentials are not to be used in tests. The E2E password is kept locally in an ignored `.env.e2e`, read by Playwright through environment variables, and never printed in reports.

### Tests and running

In `astro/`, add `@playwright/test`, `playwright.config.ts`, an `npm run test:e2e` command, and Chromium via `npx playwright install --with-deps chromium` (or the equivalent for the environment). The Playwright config brings up `npm run preview -- --host 127.0.0.1 --port 4321` through `webServer`; WordPress has to be started beforehand and reachable at `PUBLIC_WP_API_URL`.

The E2E spec covers the browser path rather than replacing the WordPress API with mocks:

- a guest at `/my` sees an accessible login form, and the password is not present in the URL;
- valid credentials lead to a visible test-user name and a successful JWT validation;
- a wrong password shows a neutral error, creates no session, and does not reveal whether the user exists;
- a reload in the same tab preserves access after a repeated validation; "Log out" clears the session and shows the form again;
- `astro check`, `astro build`, and the E2E tests pass, and a search through `dist/` confirms the absence of `JWT_AUTH_SECRET_KEY`, passwords, and the test session's JWT.

## Acceptance criteria

- [ ] The homepage `/` is an SSG business-card page for the stylist that uses DaisyUI; `astro build` does not depend on the personal area and completes successfully.
- [ ] The static `/my` route contains an accessible login form and contains no personal data or token before login.
- [ ] The JWT plugin is activated, `JWT_AUTH_SECRET_KEY` is set only in the local/production configuration, and `roots/.env.example` documents the required variable without the secret value.
- [ ] A POST with the E2E user to `/wp-json/jwt-auth/v1/token` issues a JWT, and `token/validate` with the Bearer header returns 200; invalid credentials return an error without a token.
- [ ] CORS/preflight and the pass-through of `Authorization` are verified for the Astro origin; production uses HTTPS and a specific origin allowlist.
- [ ] The token is not stored in `localStorage`, cookies, or the built files; logout and a failed validation clear `sessionStorage`.
- [ ] `npm run test:e2e`, `npm run build`, and `npx astro check` all pass in a clean local run; E2E uses a dedicated subscriber user and secrets kept out of Git.
- [ ] The backend is registered in lerd and available before E2E, the Astro preview is available on a local port; the documentation contains the exact command order.

## Roadmap

1. Check/create the Bedrock lerd profile, link `roots/` as `wp-roots`, bring up MySQL and run `env setup` + `framework setup`; make sure `/wp-json/` is reachable.
2. Activate the already installed JWT plugin, set the secret and the one-hour TTL, create the E2E subscriber. Run the token/validate requests by hand without printing the token into the log.
3. Move the API URL into the frontend configuration, build the public business card and the static `/my` page with the client-side session logic.
4. Configure CORS and Nginx forwarding, then verify the auth flow from a real Astro preview.
5. Install Playwright, implement the E2E specs, and add the local run, build, and test commands to the README.
6. Work through the whole acceptance checklist. Only after that decide whether dedicated WP REST endpoints for stylist appointments are needed.

## Alternatives

### Astro SSR with an HttpOnly cookie

Gives a more traditional session and does not hand the JWT to JavaScript, but requires a Node/edge runtime, an adapter, and a server-side proxy. That breaks the goal of a simple SSG experiment, so it is deferred until genuinely sensitive data or long-lived sessions appear.

### Storing the JWT in localStorage

Survives closing the browser, but increases the impact of XSS and makes token revocation harder. Rejected for v1 in favor of `sessionStorage` and a short TTL.

## Summary and recommendations

The recommendation is to implement `/my` as a light client-side layer on top of the unchanged Astro SSG and the already added WordPress JWT plugin. This minimally validates the "static business card + authorization in the CMS" architecture, honestly limits v1 to a profile-only personal area, and leaves SSR / real personal data to the next iteration.

## Open questions

- Which public production domain will become the allowed CORS origin for Astro, and will Astro be deployed on a separate subdomain?
- What should the personal area contain beyond the profile: booking requests, the stylist's calendar, or editing one's data? Any of these needs its own protected WP REST contract and its own RFC.
