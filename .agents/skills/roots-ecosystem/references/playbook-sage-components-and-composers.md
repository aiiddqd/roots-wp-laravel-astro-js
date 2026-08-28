# Playbook: Sage Components, Composers, And Views

Use this playbook for theme rendering work in Sage.

## Workflow

1. Inspect the active theme structure under `app/`, `resources/views/`, and `vite.config.js`.
2. Decide the smallest rendering unit that fits:
   - partial for simple inclusion
   - component for reusable UI with explicit inputs
   - composer for scoped data binding
3. If a generator fits, use `wp acorn make:component` or `wp acorn make:composer`.
4. Put Blade files under the expected `resources/views/...` location.
5. Put component/composer classes under `app/View/...` with PSR-4-friendly names.
6. Keep data preparation out of Blade when the logic is non-trivial.
7. Keep theme-level setup and asset wiring in `app/setup.php`.
8. If the work touches editor assets or `theme.json`, confirm the Vite integration path used by the theme.

## Heuristics

- Use a component when the same markup with variable inputs appears in multiple places.
- Use a composer when a view or group of views needs repeated derived data.
- Use a plain include when the markup is simple and the data is already available.

## Verification

- Confirm the view path matches the call site naming.
- Confirm component attribute names match constructor parameters.
- Confirm the change respects the WordPress template hierarchy rather than fighting it.
