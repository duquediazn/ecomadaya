# Mapa de Renombrado CSS

- Ultima actualizacion: 2026-03-10
- Responsable: PENDIENTE
- Proxima revision: en cada refactor de componente

## Objetivo

Trazar cambios de nombres de clases de forma controlada para aplicar refactors masivos sin romper estilos ni marcado.

## Regla operativa

- Este mapa define un "nombre actual -> nombre objetivo".
- No ejecutar renombrado global de todo el proyecto en una sola pasada.
- Aplicar por componente, validando en cada pagina afectada.

## Mapeo inicial sugerido

| Nombre actual | Nombre objetivo | Ambito | Estado |
| --- | --- | --- | --- |
| `hero` | `c-hero` | Hero | pendiente |
| `hero__subtitle` | `c-hero__subtitle` | Hero | pendiente |
| `hero__tags` | `c-hero__tags` | Hero | pendiente |
| `hero__actions` | `c-hero__actions` | Hero | pendiente |
| `hero__image` | `c-hero__image` | Hero | pendiente |
| `reviews__grid` | `c-reviews__grid` | Reviews | pendiente |
| `review` | `c-review` | Reviews | pendiente |
| `review__stars` | `c-review__stars` | Reviews | pendiente |
| `review__text` | `c-review__text` | Reviews | pendiente |
| `review__author` | `c-review__author` | Reviews | pendiente |
| `gallery` | `c-gallery` | Galeria | pendiente |
| `lightbox` | `c-lightbox` | Lightbox | pendiente |
| `lightbox__content` | `c-lightbox__content` | Lightbox | pendiente |
| `lightbox__frame` | `c-lightbox__frame` | Lightbox | pendiente |
| `lightbox__image` | `c-lightbox__image` | Lightbox | pendiente |
| `lightbox__caption` | `c-lightbox__caption` | Lightbox | pendiente |
| `lightbox__nav` | `c-lightbox__nav` | Lightbox | pendiente |
| `lightbox__nav--prev` | `c-lightbox__nav--prev` | Lightbox | pendiente |
| `lightbox__nav--next` | `c-lightbox__nav--next` | Lightbox | pendiente |
| `lightbox__close` | `c-lightbox__close` | Lightbox | pendiente |
| `site-header` | `c-site-header` | Header | pendiente |
| `main-nav` | `c-main-nav` | Header/Nav | pendiente |
| `site-footer` | `c-site-footer` | Footer | pendiente |
| `footer-heading` | `c-footer__heading` | Footer | pendiente |
| `btn` | `c-btn` | Botones | pendiente |
| `btn-small` | `c-btn c-btn--small` | Botones | pendiente |
| `btn--primary` | `c-btn--primary` | Botones | pendiente |
| `btn--secondary` | `c-btn--secondary` | Botones | pendiente |
| `bg-primary` | `u-bg-primary` | Utilidad | pendiente |
| `primary-link` | `u-link-primary` | Utilidad | pendiente |
| `secondary-link` | `u-link-secondary` | Utilidad | pendiente |
| `light-link` | `u-link-light` | Utilidad | pendiente |
| `dark-link` | `u-link-dark` | Utilidad | pendiente |

## Nota sobre IDs

Hay ids de presentacion (`#reviews`, `#hero-image-desktop`, `#hero-image-mobile`) que conviene migrar a clases con el mismo flujo por componente.

## Checklist por cada bloque migrado

- [ ] Cambios de clase aplicados en PHP/HTML
- [ ] Selectores CSS actualizados
- [ ] Estado hover/focus/active validado
- [ ] Responsive validado
- [ ] Sin regresiones visuales en pagina
