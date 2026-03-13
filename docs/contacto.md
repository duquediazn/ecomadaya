# Pagina de contacto (`contacto.php`)

- Ultima actualizacion: 2026-03-13
- Responsable: PENDIENTE
- Proxima revision: PENDIENTE

## Objetivo de la pagina

Convertir visitas en contactos cualificados desde busquedas locales en Tenerife.

## Arquitectura de contenido

1. Intro de contacto local con propuesta de valor
2. Canales de contacto en tarjetas (WhatsApp, Telefono, Email, Taller)
3. Bloque practico con horario + mapa
4. CTA principal de presupuesto por WhatsApp
5. Enlace de apoyo a FAQ

## Reglas de conversion

- CTA principal: WhatsApp con mensaje pre-rellenado
- CTA secundarias: llamada telefonica y email
- Prueba social visible en CTA principal (valoracion y total de reseñas)
- Reducir friccion: botones con verbos de accion y contexto claro

## Reglas SEO

- Un solo `h1`
- Mencion explicita de localizacion: La Laguna, Tenerife
- Canonical configurado para URL final en produccion
- Enlace interno a FAQ

## Reglas de accesibilidad

- SVG decorativos: `aria-hidden="true"` y `focusable="false"`
- `iframe` de mapa con `title`
- Horario marcado con `time` y `dl`
- Direccion en `address`

## Configuracion reutilizable

Se centralizan constantes en `app/includes/bootstrap.php`:

- `MADAYA_PHONE_E164`
- `MADAYA_PHONE_DISPLAY`
- `MADAYA_EMAIL`
- `MADAYA_MAPS_URL`
- `MADAYA_GOOGLE_REVIEWS_URL`
- `MADAYA_REVIEW_RATING`
- `MADAYA_REVIEW_COUNT`

## Nota sobre FAQ

La seccion FAQ esta enlazada desde contacto, pero el contenido de `preguntas-frecuentes.php` aun esta pendiente.
Mientras no se publique contenido real, revisar periodicamente esta CTA para evitar frustracion del usuario.
