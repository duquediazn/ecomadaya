# Despliegue (Resumen)

- Última actualización: 2026-05-29
- Entorno: producción en Arsys
- Método actual: GitHub Actions manual + SFTP

## Flujo actual

1. `dev` se usa para integrar y validar cambios de trabajo.
2. `main` representa la versión candidata a producción (o ya publicada).
3. Si cambia el workflow en `dev`, se abre un Pull Request a `main` y, tras la aprobación requerida, se hace merge para que GitHub Actions muestre la versión actual del workflow.
4. Para publicar cambios del sitio, se abre un Pull Request `dev -> main` y, tras la aprobación requerida, se hace merge y se lanza el workflow manual seleccionando rama `main`.
5. Se publican archivos por SFTP y se ejecutan smoke checks HTTP.

## Alcance del despliegue

Se despliega contenido web del sitio:

- `*.php` de raiz
- `api/`
- `assets/`
- `app/`
- `vendor/`
- `robots.txt`, `sitemap.xml`, `LICENSE`, `NOTICE`

No se despliegan:

- `docs/`
- `scripts/`
- `.github/`
- archivos de desarrollo local

## Seguridad

- No se guardan secretos en repositorio.
- Las credenciales se gestionan en GitHub Actions Environment `production`.
- El archivo `.htaccess` se mantiene manualmente en hosting (no se sobreescribe desde CI en esta fase).

## Ejecución del workflow

Workflow: `.github/workflows/deploy-arsys-manual.yml`

Notas importantes sobre ramas:

- GitHub Actions muestra workflows manuales tomando como referencia la rama por defecto (`main`).
- Si el workflow no existe o no está actualizado en `main`, puede no aparecer en la UI de Actions.
- Una vez visible, al pulsar `Run workflow` puedes elegir la rama sobre la que correrlo (`dev` o `main`).
- Aunque puedas elegir `dev`, para despliegue final de producción se recomienda lanzar desde `main`.

- `full_deploy=true`: despliegue completo.
- `full_deploy=false`: despliegue incremental de cambios.

## Verificación post-despliegue

Comprobar:

- `/`
- `/quienes-somos/`
- `/servicios/`
- `/galeria/`
- `/contacto/`
- `/assets/css/main.css`
- `/assets/js/main.js`
- `/robots.txt`
- `/sitemap.xml`
