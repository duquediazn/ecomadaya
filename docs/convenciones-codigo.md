# Convenciones de Codigo

- Ultima actualizacion: PENDIENTE
- Responsable: PENDIENTE
- Proxima revision: PENDIENTE

## Objetivo

Establecer criterios comunes para mantener coherencia y facilitar el relevo entre desarrolladores.

## PHP

- Convencion de nombres de archivos: PENDIENTE
- Convencion de funciones/helpers: PENDIENTE
- Uso de includes/requires: PENDIENTE
- Manejo de errores y logs: PENDIENTE

## HTML

- Estructura semantica obligatoria (header/main/nav/footer): PENDIENTE
- Jerarquia de headings (h1-h6): PENDIENTE
- Reglas para atributos ARIA y accesibilidad: ver `accesibilidad.md`

## CSS

- Convencion recomendada: modelo hibrido por componentes (BEM-like + utilidades).
- Organizacion por componentes/secciones: mantener bloques por seccion funcional (header, hero, reviews, gallery, lightbox, footer, responsive).
- Variables CSS y tokens de diseno: centralizar en `:root` (tipografia, espaciado, color, tamanos).

### Analisis del estado actual (`assets/css/main.css`)

- Ya existe base de diseno con tokens (`--color-*`, `--space-*`, `--fs-*`).
- Ya existe nomenclatura tipo BEM en varias zonas: `hero__subtitle`, `reviews__grid`, `lightbox__nav--prev`, `btn--primary`.
- Convive con clases utilitarias/globales: `bg-primary`, `primary-link`, `section--narrow`.
- Aun hay selectores por id y selectores profundos de estructura (`#reviews`, `#hero-image-desktop`, `.site-footer > .row-section-site > .footer-col`).

### Regla de convencion a partir de ahora

- Nuevos estilos de componente: usar prefijo `c-` en bloque (`.c-component`) + elementos (`.c-component__item`) + modificadores (`.c-component--variant`).
- Utilidades permitidas para casos globales y atomicos (ejemplo: clases de fondo, texto o espaciado), con prefijo `u-`.
- Evitar nuevos estilos acoplados a id para presentacion visual. Los ids se reservan para anclas, accesibilidad o JS cuando sea necesario.
- Reducir selectores excesivamente largos; preferir clases directas en el markup.
- Mantener un mapa de migracion de nombres en `docs/css-mapa-renombrado.md` antes de cualquier cambio masivo.

### Migracion progresiva (sin refactor agresivo)

- No renombrar de golpe clases existentes que ya funcionan.
- En cada cambio funcional, normalizar solo el componente tocado.
- Prioridad de normalizacion: footer y menu responsive (zonas con selectores mas acoplados).

## JS (si aplica)

- JS no critico para funcionalidad principal.
- Convenciones de modulos/funciones: PENDIENTE

## Assets

- Convenciones de nombres para imagenes/iconos: PENDIENTE
- Formatos permitidos y peso maximo: PENDIENTE

## Checklist de revision en PR

- [ ] Nombres coherentes
- [ ] Sin codigo muerto
- [ ] Semantica HTML correcta
- [ ] Accesibilidad basica validada
- [ ] No rompe SEO tecnico
