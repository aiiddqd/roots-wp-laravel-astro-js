# wp-roots

Эксперимент: WordPress на Roots-стеке (Bedrock + Acorn + Blade) под lerd. RFC: `docs/rfc/wp-roots.md` (после завершения — `docs/rfc/archive/`).

- Сам сайт (composer.json, WP-ядро, `.env`) — в `wp/`.
- Сайт: http://wp-roots.localhost
- Админка: **http://wp-roots.localhost/wp/wp-admin/** — НЕ `/wp-admin/` (тот отдаёт 200 с главной страницей, а не 404 и не редирект). WP-ядро в Bedrock живёт в подпапке `web/wp`, поэтому и админка там же, `WP_SITEURL="${WP_HOME}/wp"`.
  - Логин: `admin` / `lerdadmin1`, email `admin@wp-roots.localhost`.
- PHP 8.3 (lerd по умолчанию предлагал 8.5 при линковке — выставлено вручную под конвенцию остальных Laravel/Acorn-сайтов в `projects/`).
- БД: MySQL через общий lerd-сервис, база `wp_roots`.

## wp-cli

Глобальный `wp` (Homebrew phar) в этом окружении не запускается — падает с `PharException: unable to open phar for reading .../fd/pipe`. Рабочий путь:

```
composer require --dev wp-cli/wp-cli-bundle
./vendor/bin/wp <command> --allow-root   # из корня wp/
```

`--allow-root` обязателен, т.к. команды выполняются от root в этой среде.

## Acorn поверх Bedrock — известный конфликт конфигов

Если просто добавить `roots/acorn` и mu-plugin `web/app/mu-plugins/acorn.php` с дефолтным `Application::configure()->boot()` — сайт падает целиком (и в браузере, и в wp-cli, без вменяемого сообщения об ошибке в CLI — просто exit 255 и пустой вывод).

Причина: Acorn'овский `LoadConfiguration`-бутстрапер сканирует **все** `*.php`-файлы в `config/` как Laravel-конфиги (ожидает `return [...]` из каждого). Bedrock'овский `config/application.php` — не такой файл, он side-effect'ово вызывает `Roots\WPConfig\Config::define(...)` для `WP_HOME`, `DB_NAME` и т.д. Acorn выполняет его повторно → `Config::define('WP_HOME', ...)` натыкается на уже реально определённую PHP-константу → `Roots\WPConfig\Exceptions\ConstantAlreadyDefinedException`.

Фикс — дать Acorn отдельный config path, не пересекающийся с Bedrock:

```php
// web/app/mu-plugins/acorn.php
$builder = Roots\Acorn\Application::configure();
$builder->create()->useConfigPath($builder->create()->basePath('config/acorn'));
$builder->boot();
```

и создать пустую `config/acorn/` (там уже лежат конфиги самого Acorn/Laravel-компонентов, если понадобятся — `cache.php`, `session.php` и т.п., НЕ трогать `config/application.php` и `config/environments/`).

Если ошибку всё же нужно диагностировать — писать лог из mu-plugin'а надо не в `/tmp` (в PHP-процессе он недоступен в этом окружении, `file_put_contents` тихо молчит), а в путь внутри проекта, например `__DIR__.'/../../../acorn_debug.log'`.

## lerd: framework "bedrock"

В сторе lerd готового профиля под Bedrock нет, только generic `wordpress` (`public_dir: "."` — для Bedrock не подходит, т.к. docroot у Bedrock — `web/`, а не корень). Локально зарегистрирован кастомный framework `bedrock` (`public_dir: web`, детект по `wp-cli.yml`/пакетам `roots/bedrock`, `roots/wordpress`). Это локальная запись в `~/.local/share/lerd`, не переживёт `lerd framework prune` или переустановку lerd — при необходимости пересоздать через `framework add`.

## wp-packages.org

Bedrock из коробки уже подключает composer-репозиторий `https://repo.wp-packages.org` (см. `composer.json` → `repositories`). Namespace пакетов: `wp-plugin/<slug>` и `wp-theme/<slug>`, слаги как на wordpress.org. Пример: `composer require wp-plugin/query-monitor`.

## Blade

Рендерится через `Roots\view('name', [...])` (helper из `roots/acorn`), файлы — `resources/views/*.blade.php`. Директории `app/`, `database/`, `resources/` в чистом Bedrock не создаются автоматически — их нужно завести руками (или через `wp acorn make:migration ...`, который сам создаёт `database/migrations/`).

## Trellis

Не разворачивался, отдельное направление на будущее (см. RFC, «Открытые вопросы»).

## Astro-фронтенд

RFC: `docs/rfc/astro.md`. Отдельный headless-фронтенд в `astro/` — Astro (TS-шаблон) + DaisyUI, SSG-главная, на этапе сборки забирает последний пост блога через `GET /wp-json/wp/v2/posts?per_page=1` и рендерит его. Типизация ответа — `src/lib/wp.ts` (интерфейс `Post`).

Не регистрируется как lerd-сайт — проверяется напрямую через `npm run build && npm run preview` (или `npm run dev`) из `astro/`, без привязки к lerd-воркспейсу.

DaisyUI подключается как CSS-плагин (`@plugin "daisyui";` в `src/styles/global.css`, рядом с `@import "tailwindcss";`), а не через `tailwind.config` — так у DaisyUI 5 + Tailwind 4.
