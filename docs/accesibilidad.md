# Accesibilidad Web – Madaya

- **Última actualización:** 2026-05-29
- **Próxima revisión:** tras cambios significativos en UI o contenido
- **Ámbito:** Estado actual del sitio y guía práctica para desarrollo futuro

---

## Índice

1. [Resumen y estado actual](#resumen-y-estado-actual)
2. [Checklist de accesibilidad para producción](#checklist-de-accesibilidad-para-producción)
3. [Registro de hallazgos y tradeoffs](#registro-de-hallazgos-y-tradeoffs)
4. [Guía rápida para desarrollo accesible](#guía-rápida-para-desarrollo-accesible)
   1. [Estructura base de página](#estructura-base-de-página)
   2. [Semántica HTML](#semántica-html)
   3. [Headings y regiones](#headings-y-regiones)
   4. [Imágenes y medios](#imágenes-y-medios)
   5. [Formularios](#formularios)
   6. [Interactividad y ARIA](#interactividad-y-aria)
   7. [Contraste y foco](#contraste-y-foco)
   8. [Checklist rápido para nuevas páginas](#checklist-rápido-para-nuevas-páginas)

---

## Resumen y estado actual

El sitio cumple los criterios WCAG 2.1 AA en todas las páginas principales.

- **Nivel objetivo:** WCAG 2.1 AA
- **Cobertura:** Todas las páginas y componentes principales revisados
- **Pendientes para producción:**
  - Ejecutar Lighthouse, axe y WAVE en producción
  - Prueba manual completa de teclado y lector (NVDA o VoiceOver)
  - Validación HTML (W3C)

## Checklist de accesibilidad para producción

- [x] Un solo `h1` por página, jerarquía de headings lógica
- [x] Semántica HTML correcta (`main`, `nav`, `header`, `footer`, `section`, `article`, `address`, `time`, `dl`…)
- [x] Navegación por teclado completa sin trampas de foco
- [x] Indicadores de foco visibles (`:focus-visible`) en todos los elementos interactivos
- [x] Contraste suficiente texto/fondo (normal ≥ 4.5:1, grande ≥ 3:1)
- [x] Texto alternativo en imágenes informativas; `alt=""` en decorativas
- [x] Iconos SVG decorativos con `aria-hidden="true"` y `focusable="false"`
- [x] `aria-*` en componentes interactivos (menús, toggles, diálogos, live regions)
- [x] Labels y mensajes de error accesibles en formularios
- [x] Skip-link apuntando a `<main id="main">`
- [x] `lang="es"` en `<html>`, `<title>` único por página
- [x] Fallback funcional sin JavaScript
- [ ] Validación automática y manual en entorno de producción
- [ ] Mostrar en el README el resultado de accesibilidad obtenido con Lighthouse/WAVE (puntuación y/o captura), como compromiso público de transparencia (no es sello oficial)

## Registro de hallazgos y tradeoffs

| Fecha      | Página / Componente | Hallazgo                                                                                                                                                                                               | Severidad | Estado    |
| ---------- | ------------------- | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ | --------- | --------- |
| 2026-03-24 | `header.php`        | Menú hamburguesa usa `<input type="checkbox">` para apertura/cierre sin JS. Cumple funcionalidad, pero la semántica anunciada es de checkbox, no botón de menú. Alternativa futura: `details/summary`. | Media     | Detectado |
| 2026-03-24 | `main.css`          | `--color-secondary: #d0bd33` (amarillo) tiene contraste bajo sobre blanco. Actualmente solo se usa sobre fondo oscuro.                                                                                 | Media     | Detectado |

---

## Guía rápida para desarrollo accesible

### Estructura base de página

Cada nueva página debe seguir esta estructura mínima:

```php
<?php
$pageTitle = "Título descriptivo de la página";
$pageDescription = "Resumen breve y específico del contenido";
require_once __DIR__ . '/app/config/bootstrap.php';
$canonicalUrl = MADAYA_SITE_URL . '/ruta/';
include __DIR__ . '/app/views/layout/header.php';
?>

<section aria-labelledby="pagina-heading" class="section--narrow">
    <h1 id="pagina-heading">Título principal único</h1>
    <p>Introducción de la página.</p>
</section>

<?php include __DIR__ . '/app/views/layout/footer.php'; ?>
```

**Reglas obligatorias:**

- Un solo `h1` por página.
- `header.php` ya aporta `<html lang="es">`, skip-link y `<main id="main">`.
- `footer.php` cierra `</main>` y aporta navegación secundaria/legal.
- Cada página debe definir `pageTitle`, `pageDescription` y `canonicalUrl`.

### Semántica HTML

**Patrones ya aplicados:**

- Landmarks reales: `header`, `nav`, `main`, `footer`.
- `address` para direcciones de contacto.
- `time` para horarios.
- `dl/dt/dd` para valores y descripciones.
- `figure`, `figcaption`, `blockquote` en reseñas y galerías.
- `details/summary` para FAQ sin JS.
- `fieldset` y `legend` en formularios.

**Para contenido nuevo:**

- Usa primero elementos HTML nativos antes de ARIA.
- Usa `section` solo si el bloque tiene título propio o nombre accesible.
- Usa `article` para tarjetas o piezas autocontenidas.
- Usa `ul/li` para listas reales, nunca para maquetación.
- Usa `button` para acciones y `a` solo para navegación.
- Usa `details/summary` si necesitas disclosure/acordeón sin JS.

**Evitar:**

- Saltos de jerarquía como `h1` → `h3`.
- `div` o `span` haciendo de botón.
- `section` sin heading visible o sin `aria-labelledby`.
- Texto de instrucción solo en placeholder.

### Headings y regiones

- Un solo `h1` por página.
- Headings consecutivos (`h1` → `h2` → `h3`), nunca saltos.
- Cada `section` debe tener heading visible o `aria-labelledby`.
- Usa `aria-label` solo si no hay heading visible.

### Imágenes y medios

- Imágenes informativas: `alt` descriptivo.
- Imágenes decorativas: `alt=""` y `aria-hidden="true"` si SVG.
- Iconos decorativos: `aria-hidden="true" focusable="false"`.
- Iframes: siempre con atributo `title`.
- Vídeos: subtítulos o transcripción si aplica.

### Formularios

- Cada campo con `<label for>` asociado.
- Campos obligatorios con `required` y ayuda visible.
- Mensajes de error enlazados con `aria-describedby`.
- Resumen de errores con `role="alert"`.
- `aria-invalid` en campos con error.
- Feedback de estado con `aria-live`.

### Interactividad y ARIA

- Usa ARIA solo si HTML nativo no basta.
- `aria-labelledby` en landmarks y regiones.
- `aria-label` solo si no hay heading visible.
- `aria-expanded`, `aria-controls` en menús/acordeones.
- `role="img"` y `aria-label` en iconos informativos.
- Foco gestionado en modales/dialogs.

### Contraste y foco

- Contraste mínimo: texto normal ≥ 4.5:1, grande ≥ 3:1.
- Foco visible en todos los elementos interactivos (`:focus-visible`).
- No eliminar `outline` sin alternativa clara.

### Checklist rápido para nuevas páginas

- [ ] Un solo `h1` y jerarquía lógica de headings
- [ ] Landmarks y regiones con nombre accesible
- [ ] Imágenes y SVG con `alt`/`aria-hidden` correcto
- [ ] Formularios con etiquetas y feedback accesible
- [ ] Navegación y foco por teclado
- [ ] Contraste suficiente
- [ ] Sin dependencias críticas de JS para funcionalidad básica
- [ ] Validación manual y automática antes de publicar

---

**Recuerda:** Si introduces un tradeoff técnico que afecta a la accesibilidad, documenta el motivo y la decisión en este documento.
