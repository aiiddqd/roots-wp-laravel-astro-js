# Package Deep Dive: `roots/acorn-mail`

Use this file when the task is specifically about `roots/acorn-mail`.

## What It Is

`acorn-mail` provides SMTP/mail configuration for Acorn-powered WordPress projects.

## Operational Model

- install via Composer
- optionally publish mail config with `wp acorn mail:config`
- configure SMTP via environment variables
- validate setup with `wp acorn mail:test`

## Provider Pattern

- registers an `AcornMail` singleton
- exposes console commands only when running in console
- eagerly resolves the mail service during boot

## When To Use It

- Use it when the project needs SMTP or Acorn-driven mail configuration instead of ad hoc WordPress mail tweaks.

## Watch For

- environment-driven config is the normal path
- test mail behavior from CLI before assuming the transport is correct
