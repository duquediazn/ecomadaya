# Changelog

Cambios relevantes del proyecto.

El formato esta inspirado en Keep a Changelog.

## [Unreleased]

### Added

- Especificacion previa del formulario de contacto en documentacion:
	- `docs/contacto.md`
	- `docs/accesibilidad.md`
	- `docs/legal-y-cumplimiento.md`
	- `docs/testing-manual.md`
- Guia de datos estructurados JSON-LD en `docs/schema-json-ld.md`.
- Configuracion reutilizable de datos de negocio en `app/includes/bootstrap.php`.

### Changed

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
- Actualizacion de contexto de proyecto en `agents.md`.

### Fixed

- Correccion de enlaces de contacto en footer (`mailto:` y `tel:`).
- Correccion de atributos faltantes de accesibilidad en iframes e iconos decorativos.
- Correccion de clases/estilos inconsistentes detectados en revisiones de accesibilidad (por ejemplo `section--narrow` y `link-dark`).

## [0.1.0] - PENDIENTE

### Added

- Estructura inicial del sitio
- Estructura inicial de documentacion en `docs/`
