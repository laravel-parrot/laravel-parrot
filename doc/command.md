# commands

## create console

```bash
# core parrot purpose
php artisan p-m:command {name}
# plugin purpose
php artisan p-m:command {name} {--pkg=}
```

## controller

```bash
# core parrot purpose
php artisan p-m:controller {name}
# plugin purpose
php artisan p-m:controller {name} {--pkg=}
```

## job

```bash
# core parrot purpose
php artisan p-m:job {name} {--sync=}
# plugin purpose
php artisan p-m:job {name} {--pkg=} {--sync=}
```

## mail

```bash
# core parrot purpose
php artisan p-m:mail {{name}} {--markdown}
# plugin purpose
php artisan p-m:mail {name} {--pkg=} {--markdown}
```

## migrations

```bash
# core parrot purpose
php artisan p-m:migrations {{name}} {--create=}
# plugin purpose
php artisan p-m:migrations {name} {--create=} {--pkg=}
```

## plugin

```bash
php artisan p-m:pkg {name}
```

## middleware

```bash
php artisan p-m:middleware {name}
# plugin purpose
php artisan p-m:middleware {name} {--pkg=}
```

## model

```bash
php artisan p-m:model {name}
# plugin purpose
php artisan p-m:model {name} {--pkg=}
```

## notification

```bash
php artisan p-m:notification {name} {--markdown=}
# plugin purpose
php artisan p-m:notification {name} {--pkg=} {--markdown=}
```

## request

```bash
php artisan p-m:request {name}
# plugin purpose
php artisan p-m:request {name} {--pkg=}
```

## provider

```bash
php artisan p-m:provider {name}
# plugin purpose
php artisan p-m:provider {name} {--pkg=}
```
