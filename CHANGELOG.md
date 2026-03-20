# Changelog

Cambios relevantes del proyecto.

El formato esta inspirado en Keep a Changelog.

## [Unreleased]

### Added

- Nueva pagina `public/quienes-somos.php` con contenido definitivo de historia del taller, bloque de valores e imagenes.
- Nueva pagina `public/preguntas-frecuentes.php` con 20 FAQs agrupadas por categoria.
- Nueva pagina legal `public/condiciones-servicio.php` enlazada desde FAQ.
- Marcado estructurado `FAQPage` (JSON-LD) en `public/preguntas-frecuentes.php`.
- Selector semantico de lightbox por atributo `data-lightbox-gallery` en `public/assets/js/main.js`.
- Especificacion previa del formulario de contacto en documentacion:
	- `docs/contacto.md`
	- `docs/accesibilidad.md`
	- `docs/legal-y-cumplimiento.md`
	- `docs/testing-manual.md`
- Guia de datos estructurados JSON-LD en `docs/schema-json-ld.md`.
- Configuracion reutilizable de datos de negocio en `app/includes/bootstrap.php`.
- Script de generacion automatica de sitemap en `scripts/generate-sitemap.php`.
- Guia de mantenimiento de sitemap en `docs/sitemap.md`.

### Changed

- Centralizacion de URLs de WhatsApp en `app/includes/bootstrap.php` para reutilizacion en paginas.
- Ajustes de conversion y copy en `public/contacto.php` (CTA de presupuesto y acceso a FAQ).
- Ajustes de bloque de reseñas en `public/index.php` para reutilizar datos globales.
- Estilos nuevos para secciones `Quienes somos` y `FAQ` en `public/assets/css/main.css`.
- `public/quienes-somos.php` adaptado para accesibilidad y lightbox progresivo:
	- secciones con nombre accesible (`aria-labelledby`),
	- `dl/dt/dd` en valores,
	- enlaces de imagen preparados para lightbox con fallback sin JS.
- `public/preguntas-frecuentes.php` adaptado para SEO y accesibilidad:
	- title + meta description orientados a intencion de busqueda,
	- h1/h2 semanticos con ids,
	- limpieza de marcado invalido en listas.
- Rediseño y ampliacion de `public/contacto.php` con enfoque de conversion (WhatsApp como canal principal) y mejoras semanticas.
- Mejoras de accesibilidad en `app/includes/header.php`, `app/includes/footer.php` y paginas principales:
	- foco visible,
	- navegacion de menu movil mas accesible,
	- marcado semantico de horario/direccion,
	- enlaces externos reforzados.
- Actualizacion SEO tecnica:
	- canonical por pagina en `index.php`, `servicios.php`, `galeria.php`, `contacto.php`.
	- ajustes de Open Graph.
	- documentacion SEO actualizada en `docs/seo.md`.
- `composer.json` actualizado con comando corto `composer run sitemap`.
- `public/robots.txt` actualizado para incluir `Sitemap: https://ecomadaya.es/sitemap.xml`.
- `public/sitemap.xml` regenerado con URLs canonicas indexables y `lastmod` por pagina.
- Actualizacion de contexto de proyecto en `agents.md`.

### Fixed

- Correccion de marcado HTML invalido en FAQ (`li` y `strong` mal cerrados).
- Correccion de consistencia de textos/labels accesibles en enlaces de imagen y acciones de contacto.
- Correccion de enlaces de contacto en footer (`mailto:` y `tel:`).
- Correccion de atributos faltantes de accesibilidad en iframes e iconos decorativos.
- Correccion de clases/estilos inconsistentes detectados en revisiones de accesibilidad (por ejemplo `section--narrow` y `link-dark`).
- Correccion del patron de extraccion de canonical en `scripts/generate-sitemap.php` para evitar advertencias y asegurar deteccion de URLs.

## [0.1.0] - PENDIENTE

### Added

- Estructura inicial del sitio
- Estructura inicial de documentacion en `docs/`
