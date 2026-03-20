# Sitemap

- Ultima actualizacion: 2026-03-20
- Responsable: PENDIENTE
- Archivo objetivo: /public/sitemap.xml
- Generador: /scripts/generate-sitemap.php

## Objetivo

Mantener un sitemap XML valido, alineado con las URLs canonicas de produccion y con todas las paginas indexables reales del sitio.

## Fuente de verdad

El sitemap se genera desde los archivos PHP de primer nivel en /public que tengan una asignacion de canonical en este formato:

- $canonicalUrl = MADAYA_SITE_URL . '/ruta/';

No se generan entradas para:

- Endpoints de API (/public/api/*)
- Recursos estaticos (imagenes, CSS, JS)
- Paginas sin canonical definido

## Reglas de inclusion

Incluir solo URLs que cumplan todo lo siguiente:

- Responden 200 en produccion.
- Son indexables (sin noindex y no bloqueadas por robots.txt).
- Tienen canonical a si mismas.
- Son paginas publicas con valor SEO o de servicio.

## Criterio de lastmod

- El script usa la fecha de modificacion del archivo PHP origen.
- Formato: YYYY-MM-DD.
- Si hay cambios relevantes en contenido SEO, regenerar el sitemap.

## Uso

Desde la raiz del repositorio:

```bash
php scripts/generate-sitemap.php
```

Resultado esperado:

- Se sobrescribe /public/sitemap.xml
- Se muestra por consola el numero de URLs generadas

## Checklist rapido tras generar

- Confirmar que /public/sitemap.xml abre sin errores XML.
- Confirmar coherencia entre canonical y loc.
- Confirmar que /public/robots.txt referencia https://ecomadaya.es/sitemap.xml.
- Enviar sitemap actualizado a Google Search Console.
