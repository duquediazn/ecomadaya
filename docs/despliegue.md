# Despliegue (Resumen)

- Ultima actualizacion: 2026-04-15
- Entorno: produccion en Arsys
- Metodo actual: GitHub Actions manual + SFTP

## Flujo actual

1. `dev` se usa para integrar y validar cambios de trabajo.
2. `main` representa la version candidata a produccion (o ya publicada).
3. Si cambia el workflow en `dev`, se hace merge a `main` para que GitHub Actions muestre la version actual del workflow.
4. Para publicar cambios del sitio, se hace merge `dev -> main` y se lanza el workflow manual seleccionando rama `main`.
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

## Ejecucion del workflow

Workflow: `.github/workflows/deploy-arsys-manual.yml`

Notas importantes sobre ramas:

- GitHub Actions muestra workflows manuales tomando como referencia la rama por defecto (`main`).
- Si el workflow no existe o no esta actualizado en `main`, puede no aparecer en la UI de Actions.
- Una vez visible, al pulsar `Run workflow` puedes elegir la rama sobre la que correrlo (`dev` o `main`).
- Aunque puedas elegir `dev`, para despliegue final de produccion se recomienda lanzar desde `main`.

- `full_deploy=true`: despliegue completo.
- `full_deploy=false`: despliegue incremental de cambios.

## Verificacion post-despliegue

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
