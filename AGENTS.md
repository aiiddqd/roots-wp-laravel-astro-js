# wp-roots — заметки для агента

Эксперимент: WordPress на Roots-стеке (Bedrock + Acorn + Blade) под lerd, плюс
отдельный headless-фронтенд на Astro + DaisyUI. Подробности и найденные грабли
— в [`README.md`](README.md), архитектурные решения — в RFC:
`docs/rfc/wp-roots.md` (после завершения переезжает в `docs/rfc/archive/`) и
`docs/rfc/astro.md` (фронтенд, в статусе draft).

## Структура

```
wp-roots/
├── README.md            # найденные грабли по backend/lerd/Acorn (читать в первую очередь)
├── ROADMAP.md            # ближайшие шаги эксперимента
├── docs/
│   ├── rfc/               # RFC (wp-roots.md — бэкенд, astro.md — фронтенд)
│   └── specs/              # итоговые сводки после sdd-apply (backend.md пока пуст)
├── wp/                    # сам сайт: Bedrock-корень, composer.json, .env, web/
└── astro/                 # Astro-фронтенд (пока пусто, см. docs/rfc/astro.md)
```

## Backend (`wp/`)

- Bedrock: docroot `web/`, WP-ядро в `web/wp` (не в корне) → админка
  `http://wp-roots.localhost/wp/wp-admin/`, а не `/wp-admin/`.
- Логин админки: `admin` / `lerdadmin1`.
- PHP 8.3, MySQL через lerd (`wp_roots`), lerd-профиль — кастомный framework
  `bedrock` (локальный, не переживёт `lerd framework prune`).
- `wp-cli`: глобальный `wp` тут не работает (PharException). Использовать
  `./vendor/bin/wp <command> --allow-root` из `wp/`.
- Acorn поверх Bedrock требует отдельный `useConfigPath` (`config/acorn`),
  иначе конфликт с `config/application.php` Bedrock'а — подробности и
  готовый код фикса в README.md, не переизобретать.
- Composer-пакеты WP: `wp-plugin/<slug>`, `wp-theme/<slug>` через
  `repo.wp-packages.org` (уже подключён в `wp/composer.json`).
- Blade-вьюхи — `resources/views/*.blade.php`, рендер через `Roots\view(...)`.
  Директории `app/`, `database/`, `resources/` заводить руками при первом
  использовании.

## Frontend (`astro/`)

- Скоуп v1 (см. `docs/rfc/astro.md`): одна страница `/`, SSG, данные — WP REST
  API бэкенда (`wp-json/wp/v2/pages`) на этапе `astro build`, без плагинов
  (WPGraphQL и т.п.) и без своих REST-эндпоинтов.
- DaisyUI подключается по официальному гайду
  (https://daisyui.com/docs/install/astro/), поверх Tailwind.
- Открытый вопрос: регистрировать `astro/` отдельным lerd-сайтом (свой
  поддомен) или обслуживать статику иначе — решается на этапе реализации.

## Прежде чем чинить проблему

Сначала проверить [`README.md`](README.md) — там уже разобраны: Acorn/Bedrock
конфликт конфигов, где писать debug-лог из mu-plugin (не `/tmp`), причина
кастомного lerd-framework. Не переоткрывать заново то, что там уже описано.
