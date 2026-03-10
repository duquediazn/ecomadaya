# Manifest de Despliegue (Arsys)

## Subir a hosting (publico)

- Todo el contenido de `public/`:
  - `*.php`
  - `assets/`
  - `.htaccess`
  - `robots.txt`
  - `sitemap.xml`
  - `LICENSE`
  - `NOTICE`

## Subir a hosting (interno)

- `app/includes/` (fuera de carpeta publica siempre que sea posible)

## No subir al hosting

- `docs/`
- `.git/`
- `agents.md`
- `README.md`
- `CHANGELOG.md`
- scripts locales (`*.py`, herramientas locales)
- archivos de entorno y secretos (`.env*`)

## Mantener en repo Git

- Codigo fuente (`public/` + `app/`)
- Documentacion (`docs/`)
- Licencias (`LICENSE`, `NOTICE`)
- Configuracion de proyecto

## No versionar en Git (usar .gitignore)

- secretos (`.env`, `.env.*.local`)
- logs (`*.log`)
- backups (`*.sql`, `*.zip`, `*.tar.gz`)
- caches temporales (`tmp/`, `cache/`, `sessions/`)
