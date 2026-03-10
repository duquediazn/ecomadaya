# Despliegue y Entornos

- Ultima actualizacion: PENDIENTE
- Responsable: PENDIENTE
- Proxima revision: PENDIENTE

## Entornos

- Local: desarrollo en PHP 8.4.11
- Staging/Preproduccion: no disponible actualmente (sin plan contratado)
- Produccion: hosting Arsys

## Requisitos previos

- Version de PHP: objetivo PHP 8+
- Servidor web (Apache/Nginx): Apache (deducido por uso actual de `.htaccess` en WordPress)
- Extensiones PHP necesarias: PENDIENTE

## Estructura de despliegue

- DocumentRoot publico esperado en Arsys: `public/` (o carpeta equivalente `public_html`).
- Solo deben quedar expuestos los archivos de `public/`.
- `app/` y `docs/` deben permanecer fuera de la carpeta publica.

## Contexto de migracion

- El sitio sustituira a una web existente en WordPress.
- Validar redirecciones y equivalencia SEO de URLs antes de produccion.

## Proceso de despliegue

1. Preparar release (branch/tag): PENDIENTE
2. Ejecutar checklist tecnico: PENDIENTE
3. Subir estructura respetando separacion `public/` (publico) vs `app/` (interno)
4. Verificar salud de pagina principal y rutas clave

## Checklist post-despliegue

- [ ] Inicio responde correctamente
- [ ] Formularios funcionan
- [ ] Assets cargan sin 404
- [ ] robots/sitemap accesibles
- [ ] Paginas legales publicadas

## Rollback

- Procedimiento de rollback: PENDIENTE
- Responsable de ejecucion: PENDIENTE
- Tiempo objetivo de recuperacion: PENDIENTE
