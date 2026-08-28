# Source Priority

Use this order when guidance conflicts or when you need to decide what to trust.

## Authority Order

1. Current Roots documentation for workflows, recommended setup, and supported usage.
2. Current Roots repository code for concrete structure, file locations, defaults, and implementation patterns.
3. Laravel documentation only when Acorn intentionally mirrors Laravel behavior.
4. Generic WordPress references only for WordPress core behavior that Roots builds on.
5. Structural inspiration from external skill libraries only for skill organization, never for technical Roots behavior.

## How To Apply It

- Prefer Roots docs for “how should this be done?”
- Prefer repo code for “what does the project actually ship today?”
- Prefer Laravel docs for Blade, providers, routing, middleware, controllers, or container concepts only after confirming Acorn supports the feature.
- Use [source-coverage.md](source-coverage.md) when the question is about whether this skill includes a given Roots repo or package.
- If Roots docs and repo code disagree, treat repo code as current implementation and call out the mismatch.

## Practical Examples

- Bedrock env loading, config paths, and mu-plugin behavior: trust Bedrock docs and the Bedrock repo.
- Sage component, composer, and Vite conventions: trust Sage docs and current Sage starter files.
- Acorn provider, routing, and WP-CLI patterns: trust Acorn docs and Acorn repo code, then use Laravel docs for the mirrored concept.
- Trellis deploy hooks and CLI behavior: trust Trellis docs and Trellis repo defaults.

## Anti-Patterns

- Do not answer a Roots question from Laravel docs alone.
- Do not answer a Bedrock or Sage question from generic WordPress tutorials.
- Do not infer package conventions from one example package if official docs or current code say otherwise.
