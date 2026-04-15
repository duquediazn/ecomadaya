# SEO – Estado actual y guía de referencia (2026-03-25)

**Última revisión SEO:** 2026-03-25

## Resumen ejecutivo

El sitio Madaya implementa SEO técnico y on-page alineado con buenas prácticas para sitios multipágina estáticos en PHP. Todas las páginas indexables cuentan con metadatos únicos, canonical coherente y enlazado interno estratégico. El sitemap y robots.txt están actualizados y alineados con la estructura real del sitio.

## Estado actual (marzo 2026)

- **Metadatos:** Todas las páginas indexables (`index`, `servicios`, `galeria`, `contacto`, `quienes-somos`, `preguntas-frecuentes`, `aviso-legal`, `politica-privacidad`, `politica-cookies`, `condiciones-servicio`) tienen `<title>`, `meta description` y `<h1>` únicos y orientados a intención de búsqueda.
- **Canonical:** Definido por página, consistente con la URL pública y el sitemap.
- **Sitemap:** `sitemap.xml` incluye solo URLs reales y vigentes. Ver detalles en `docs/sitemap.md`.
- **robots.txt:** Permite indexación global y referencia el sitemap público.
- **Enlazado interno:** Flujo estratégico entre home, servicios, galería, contacto y soporte legal. Sin enlaces rotos.
- **JSON-LD:**
  - Global: `FurnitureRepair` (`LocalBusiness`) en todas las páginas vía `header.php`.
  - FAQ: `FAQPage` en `preguntas-frecuentes.php` (20 Q&A visibles).
- **Rendimiento:** Imágenes optimizadas, carga de CSS/JS controlada. Métricas CWV a revisar tras despliegue.
- **Redirecciones:** Pendiente plan 301 desde WordPress previo (imprescindible antes de cierre de migración).
- **Keywords estratégicas:** Todas las páginas principales integran de forma natural las palabras clave prioritarias del sector (tapicería, restauración, muebles, Tenerife, ecológica, artesanal, etc.) y variantes semánticas relevantes. El wording está optimizado para SEO local y conversión, evitando sobreoptimización. Revisar siempre la presencia y naturalidad de keywords en títulos, descripciones y encabezados al crear o modificar contenido.
- **Analítica:** No implementada aún. Si se añade, coordinar con legal.

## Guía rápida para futuras adiciones

1. **Nuevas páginas:**
	- Definir `$pageTitle`, `$pageDescription`, `$canonicalUrl` y `<h1>` únicos.
	- Añadir la URL al sitemap si es indexable.
	- Revisar enlazado interno desde y hacia la nueva página.
2. **Datos estructurados:**
	- Usar `FurnitureRepair` como base en JSON-LD global.
	- Añadir tipos específicos (`FAQPage`, `Product`, etc.) solo si el contenido lo justifica y es visible.
3. **Revisión periódica:**
	- Validar canonical vs sitemap tras cada despliegue.
	- Revisar `aggregateRating` en schema si cambian reseñas.
	- Mantener actualizado el plan de redirecciones.
4. **Referencias:**
	- [docs/sitemap.md](sitemap.md) para reglas de inclusión y generación.
	- [docs/schema-json-ld.md](schema-json-ld.md) para detalles de marcado estructurado.


## Plan de redirecciones 301 (WordPress → PHP)

Para preservar el SEO y evitar errores 404 tras la migración, se implementa un plan de redirecciones 301 desde las URLs antiguas de WordPress a las nuevas rutas PHP. 

### Mapeo de URLs

| URL antigua (WordPress)         | Nueva URL (PHP)                | Observaciones                |
|---------------------------------|--------------------------------|------------------------------|
| /acerca-de/                     | /quienes-somos.php             | Cambia el slug               |
| /contacto/                      | /contacto.php                  | Igual                        |
| /aviso-legal/                   | /aviso-legal.php               | Igual                        |
| /politica-de-cookies-2/         | /politica-cookies.php          | Cambia el slug               |
| /politica-de-privacidad/        | /politica-privacidad.php       | Cambia el slug               |
| /servicios/                     | /servicios.php                 | Igual                        |
| /galeria/                       | /galeria.php                   | Igual                        |
| /condiciones-servicio/          | /condiciones-servicio.php      | Igual                        |
| /faq/                           | /preguntas-frecuentes.php      | Cambia el slug               |

### Plantilla de reglas .htaccess

```apache
# Redirecciones 301 de URLs antiguas de WordPress a nuevas rutas PHP
Redirect 301 /acerca-de/ /quienes-somos.php
Redirect 301 /contacto/ /contacto.php
Redirect 301 /aviso-legal/ /aviso-legal.php
Redirect 301 /politica-de-cookies-2/ /politica-cookies.php
Redirect 301 /politica-de-privacidad/ /politica-privacidad.php
Redirect 301 /servicios/ /servicios.php
Redirect 301 /galeria/ /galeria.php
Redirect 301 /condiciones-servicio/ /condiciones-servicio.php
Redirect 301 /faq/ /preguntas-frecuentes.php
```

**Notas:**
- Documentar cualquier cambio adicional en este plan.


