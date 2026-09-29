# SCADA Learning

A small Laravel practice project using simulated device heartbeats. Separate from Monitor: no connection to that project or to real equipment.

The supplied application retrieves device records from SQLite, checks heartbeat age, and saves a status. You write one small piece at a time. Begin with [Lesson 01](lessons/01-call-the-check.md), connecting a task to the existing check. Teaching preferences and prior progress are in [LEARNING_GUIDE.md](LEARNING_GUIDE.md).

## Setup

Requires PHP 8.3+ with SQLite support and Composer. From this directory:

```sh
composer setup
php artisan device:list
```

No frontend build, server, Redis, or queue worker is needed for this lesson. Setup creates `.env` and SQLite if missing, migrates, and seeds three named devices. Repeating setup preserves their existing records. All begin with no heartbeat and an `unchecked` saved status.

## Try the supplied behavior

Use an ID shown by `device:list`:

```sh
php artisan device:heartbeat 1
php artisan device:check-now 1
php artisan device:list
```

A heartbeat records the current time; it does not update the status by itself. A check saves `unknown` for no heartbeat, `offline` for a heartbeat at least 30 seconds old, and `online` for a newer heartbeat. Saved status stays unchanged until another check. You may see `offline` if you wait more than 30 seconds between commands.

## What you edit now

`app/Tasks/CheckDevice.php` has an intentionally unfinished `handle()` method. The constructor and import are supplied. Your task connects its stored ID to `app/DeviceCheck.php` without copying the status logic.

```sh
php artisan device:run-task 1
composer test:lesson
```

Both report an unfinished lesson until you implement it. This task currently runs in the command's process; later lessons can introduce queues, workers, and scheduling when their purpose is clear.

## Checks

```sh
composer test
```

Checks the supplied service, database behavior, and commands. Uses an isolated in-memory database. Lesson tests live separately under `tests/Lessons` and are intentionally excluded from this command and CI until completed.

## Supplied files

- `app/Models/Device.php`: database record and timestamp types.
- `app/DeviceCheck.php`: completed status rules and persistence.
- `routes/console.php`: operator commands and the task runner.
- `database/seeders/DatabaseSeeder.php`: three simulated devices.
- `lessons/01-call-the-check.md`: one bounded exercise.

Use ordinary Laravel tooling for future boilerplate. Learn unfamiliar framework operations when a lesson needs them; the supplied files are not a memorization assignment.

Framework reference: [Laravel Eloquent](https://laravel.com/framework/docs/13.x/eloquent) and [Artisan commands](https://laravel.com/framework/docs/13.x/artisan).
