# Schema.org / JSON-LD (`application/ld+json`)

- Ultima actualizacion: 2026-03-13
- Responsable: PENDIENTE
- Proxima revision: Cuando cambie cualquier dato del negocio

## Qué es y para qué sirve

El bloque `<script type="application/ld+json">` del `header.php` contiene datos estructurados en formato JSON-LD siguiendo el vocabulario de [Schema.org](https://schema.org). No afecta al aspecto visual del sitio: lo leen exclusivamente los crawlers de buscadores (Google, Bing) para comprender mejor el negocio.

Sus efectos concretos en este sitio:

- Permite que Google muestre el número de teléfono, dirección y valoración directamente en los resultados de búsqueda (rich results / knowledge panel).
- Asocia el negocio con una identidad única y estable mediante `@id`.
- Confirma los datos de contacto, horario y área de servicio sin depender de que el robot los infiera del texto de la página.

## Dónde está

**Único punto de edición:** `app/includes/header.php`, bloque `<!-- LocalBusiness Schema -->`.

Se incluye en todas las páginas del sitio porque el `header.php` es compartido. Esto es correcto: los datos del negocio son globales y no varían por página.

## Por qué las URLs están hardcodeadas (y deben quedarse así)

A diferencia del canonical, og:url o og:image, las URLs del JSON-LD **no se generan con `MADAYA_SITE_URL`**. Motivos:

1. **`@id` es un identificador permanente de entidad**, no una URL navegable. Cambiar entre entornos rompe la continuidad del grafo de conocimiento que Google construye sobre el negocio.
2. **Los crawlers solo leen el JSON-LD en producción.** Google nunca va a rastrear `localhost`. No hay riesgo de contaminación de datos.
3. **Consistencia con herramientas externas.** El [Google Rich Results Test](https://search.google.com/test/rich-results) y el [Schema Markup Validator](https://validator.schema.org/) se usan con la URL de producción. Si el `@id` fuera dinámico, los resultados en dev serían inválidos.

## Tipo de entidad usado

`FurnitureRepair` — subtipo de `LocalBusiness` en Schema.org.  
Es el tipo más específico y correcto disponible para una tapicería y restauración de muebles.

## Campos presentes y qué representan

| Campo | Valor actual | Notas |
|---|---|---|
| `@id` | `https://ecomadaya.es/#madaya` | Identificador único estable. No cambiar salvo cambio de dominio. |
| `name` | `Tapizados Madaya` | Nombre comercial exacto. |
| `url` | `https://ecomadaya.es/` | URL principal del sitio. |
| `image` | `hero-1600.webp` | Imagen representativa del negocio. Actualizar si cambia la imagen principal. |
| `telephone` | `+34922033303` | Formato E.164. Debe coincidir con `MADAYA_PHONE_E164` en `bootstrap.php`. |
| `priceRange` | `€€` | Indicativo relativo. Actualizar si cambia el posicionamiento de precio. |
| `address` | C/ Obispo Pérez Cáceres, 97, La Laguna | Dirección física completa. |
| `geo` | lat/lon del taller | Coordenadas. Verificar en Google Maps si cambia la ubicación. |
| `openingHoursSpecification` | L-V 8-15, S 9-12 | **Campo crítico.** Debe actualizarse si cambia el horario. |
| `aggregateRating` | 4.1 / 34 reseñas | **Campo manual.** Ver sección de mantenimiento más abajo. |

## Mantenimiento

### Cambio de horario

Editar `openingHoursSpecification` en `header.php`. Formato de horas: `"HH:MM"` en 24h.  
Recordar actualizar también el bloque de horario en `contacto.php` (`<dl class="schedule-list">`), que es independiente.

### Cambio de teléfono o dirección

1. Actualizar `MADAYA_PHONE_E164` y `MADAYA_PHONE_DISPLAY` en `bootstrap.php`.
2. Actualizar `telephone` y `address` en el JSON-LD de `header.php` manualmente (no está conectado a las constantes).
3. Actualizar `MADAYA_MAPS_URL` en `bootstrap.php` si cambia la ubicación.

### Actualización de reseñas (`aggregateRating`)

Este campo es **manual** y no se conecta a la API de Google Maps para evitar complejidad y dependencias externas. Actualizarlo periódicamente:

```json
"aggregateRating": {
    "@type": "AggregateRating",
    "ratingValue": "X.X",
    "reviewCount": "XX"
}
```

Frecuencia recomendada: cada vez que el número de reseñas cambie significativamente (cada ~10 nuevas reseñas o cada trimestre).  
Fuente: [Google Maps del negocio](https://maps.app.goo.gl/XCqtZLrG558Dqzb76).

### Cambio de dominio

Si el dominio cambiara, actualizar en `header.php`:
- `@id`
- `image`
- `url`

Y en `bootstrap.php`: `MADAYA_SITE_URL`.

## Validación

Tras cualquier cambio, validar con:

- **Google Rich Results Test:** https://search.google.com/test/rich-results  
  (introducir la URL de producción, no localhost)
- **Schema Markup Validator:** https://validator.schema.org/

## Campos no incluidos (y por qué)

- `menu` / `hasMap`: no relevante para tapicería.
- `servesCuisine`: no aplica.
- `founder` / `employee`: opcional, puede añadirse en el futuro si se quiere reforzar el perfil de "negocio familiar con historia".
- `review` (reseñas individuales): posible adición futura para mostrar reseñas en rich results, coordinándolo con el bloque de reseñas de `index.php`.
