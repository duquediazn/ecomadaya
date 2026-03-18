# SEO

- Ultima actualizacion: 2026-03-18
- Responsable: PENDIENTE
- Proxima revision: tras revisar sitemap y rich results en entorno publico

## Objetivo

Mantener consistencia SEO on-page y tecnica en todas las paginas del sitio.

## SEO tecnico

- `robots.txt`: presente y actualizado
- `sitemap.xml`: presente y actualizado
- Canonical por pagina: PARCIALMENTE ACTUALIZADO
- URLs amigables y estables: PENDIENTE
- Plan de redirecciones desde WordPress previo: PENDIENTE (obligatorio antes de produccion)

## SEO on-page por plantilla/pagina

Documentar para cada pagina:

- Titulo SEO
- Meta description
- H1 principal
- Intencion de busqueda
- Enlazado interno

### `contacto.php`

- Titulo SEO: Contacto | Tapizados Madaya - Taller en La Laguna, Tenerife
- Meta description: orientada a intencion transaccional local (contactar/pedir presupuesto)
- H1 principal: Contacta con Tapizados Madaya
- Intencion de busqueda: contacto local + conversion (llamada/WhatsApp/email)
- Enlazado interno: CTA a `preguntas-frecuentes.php` + enlace a reseñas en Google
- Canonical: `https://ecomadaya.es/contacto/`

### `index.php`

- Titulo SEO: Tapicería ecológica de muebles en Tenerife
- Meta description: orientada a descubrimiento de servicios + solicitud de presupuesto
- H1 principal: Tapicería ecológica en Tenerife
- Intencion de busqueda: servicio principal local + branding
- Enlazado interno: CTA a `contacto.php` y `servicios.php`
- Canonical: `https://ecomadaya.es/`

### `servicios.php`

- Titulo SEO: Servicios de tapicería en Tenerife
- Meta description: orientada a portfolio de servicios (hogar, profesionales, fabricacion)
- H1 principal: Servicios de Tapicería y Restauración
- Intencion de busqueda: comparacion y evaluacion de servicios
- Enlazado interno: CTA a `galeria.php`, `contacto.php` y secciones internas
- Canonical: `https://ecomadaya.es/servicios/`

### `galeria.php`

- Titulo SEO: Galería de trabajos realizados
- Meta description: orientada a evidencia visual de trabajos finalizados en Tenerife
- H1 principal: Galería de Trabajos Realizados
- Intencion de busqueda: validacion visual antes de contacto
- Enlazado interno: CTA de carga progresiva + navegacion hacia servicios/contacto
- Canonical: `https://ecomadaya.es/galeria/`

### `quienes-somos.php`

- Titulo SEO: Quienes somos | Taller familiar de tapiceria en Tenerife
- Meta description: orientada a confianza de marca + historia del taller + enfoque artesanal
- H1 principal: Quienes somos
- Intencion de busqueda: marca + confianza + contexto de negocio local
- Enlazado interno: CTA hacia `contacto.php` y conexion con bloque de prueba social
- Canonical: `https://ecomadaya.es/quienes-somos/`

### `preguntas-frecuentes.php`

- Titulo SEO: Preguntas frecuentes de tapiceria en Tenerife | Madaya
- Meta description: orientada a dudas transaccionales (precios, tejidos, plazos, recogida/entrega)
- H1 principal: Preguntas frecuentes de tapiceria en Tenerife
- Intencion de busqueda: resolver objeciones antes de pedir presupuesto
- Enlazado interno: enlace a `contacto.php`, `condiciones-servicio.php` y acciones por WhatsApp
- Canonical: `https://ecomadaya.es/preguntas-frecuentes/`

### `condiciones-servicio.php`

- Titulo SEO: Condiciones del servicio | Taller familiar de tapiceria en Tenerife
- Meta description: orientada a transparencia contractual (presupuesto, plazos, ajustes y responsabilidades)
- H1 principal: Condiciones del servicio
- Intencion de busqueda: informacion legal-operativa previa a contratacion
- Enlazado interno: enlazada desde `preguntas-frecuentes.php`
- Canonical: `https://ecomadaya.es/condiciones-servicio/`

## Datos estructurados

- Uso de schema.org: PARCIALMENTE IMPLEMENTADO
- Tipo de schema por pagina:
	- `preguntas-frecuentes.php`: `FAQPage` en JSON-LD con 20 preguntas y respuestas visibles
	- Resto de paginas: PENDIENTE

## Rendimiento y CWV

- Peso de imagenes optimizado
- Carga de CSS/JS controlada
- Metricas objetivo (LCP/CLS/INP): PENDIENTE

## Checklist pre-produccion

- [ ] Todas las paginas indexables con metadatos definidos
- [ ] No hay contenido duplicado sin canonical
- [ ] Sitemap refleja URLs reales
- [ ] Enlaces internos sin errores
- [ ] Redirecciones legacy de WordPress verificadas (sin perdida de trafico)

## Analitica y medicion

- Herramienta de analitica: PENDIENTE DE DECIDIR
- Si hay analitica con cookies, coordinar implementacion con `legal-y-cumplimiento.md`
