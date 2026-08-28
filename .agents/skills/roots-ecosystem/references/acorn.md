# Acorn

Use this file for booting Acorn, service providers, routing, WP-CLI, and rendering Blade views outside normal Sage theme templates.

## What Acorn Adds

Acorn brings Laravel-style application patterns into WordPress:

- service container
- service providers
- Blade rendering
- routing
- middleware/controllers
- WP-CLI commands similar to Artisan

## Booting Model

- Sage already boots Acorn.
- Custom themes or plugins must boot `Roots\Acorn\Application` explicitly.
- The common pattern is `Application::configure()->withProviders([...])->boot();`
- Add routing or middleware with extra chained calls only when the project actually needs them.

## Service Providers

- Providers are the main place for app-level registration and boot logic.
- Use them to register bindings, boot view logic, attach commands, or publish/merge config in package-style code.
- Keep provider responsibilities focused. Small providers are easier to reason about and reuse.

## Blade Rendering Outside Theme Templates

Use Acorn’s `view()` helper when rendering Blade from:

- block render callbacks
- ACF block callbacks
- emails or notifications
- custom callbacks and integration points

This is the cleanest way to keep Blade as the rendering layer even outside normal template hierarchy flows.

## Routing And HTTP Features

- Acorn can load `routes/web.php` if you configure routing during boot.
- Use routing for virtual pages or app-like request handling.
- Controllers and middleware are appropriate when the project is behaving more like an application than a simple theme.
- Check Roots docs first, then Laravel docs for syntax and behavior that Acorn mirrors.

## WP-CLI

`wp acorn` is the operational interface for many framework tasks:

- `make:*` generators
- `view:*`, `config:*`, `route:*`
- `package:discover`
- cache, queue, and migration commands where supported

Use generators when they match the project’s conventions instead of hand-writing boilerplate.

## Boundaries

- Do not assume every Laravel feature exists just because it exists in Laravel.
- Do not route everything through Acorn if normal WordPress hooks or template hierarchy are the simpler fit.
- Do not boot Acorn twice in the same project.
