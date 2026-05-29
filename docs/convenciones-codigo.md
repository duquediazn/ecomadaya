# Convenciones de Código

- Última actualización: 2026-03-24
- Próxima revisión: cuando se introduzcan nuevas capas, tooling o una refactorización amplia de frontend/backend

## Objetivo

Establecer reglas prácticas y realistas basadas en el estado actual del repositorio, para mantener coherencia técnica y facilitar relevo entre personas y agentes.

## Principios generales

- Priorizar simplicidad y legibilidad frente a abstracciones innecesarias.
- Mantener coherencia con el estilo ya existente salvo que haya una razón clara para evolucionarlo.
- Preferir cambios incrementales y localizados.
- Toda funcionalidad crítica debe funcionar sin JavaScript.
- Seguridad, accesibilidad y SEO forman parte de la definición de "código correcto", no son trabajo posterior.

## Estructura del proyecto

Separación por responsabilidad:

- `*.php`: páginas públicas principales en la raíz
- `api/`: endpoints PHP públicos (AJAX, formularios, etc.)
- `assets/`: archivos estáticos (CSS, JS, imágenes, iconos)
- `app/config/`: configuración transversal y constantes
- `app/services/`: lógica compartida de aplicación
- `app/views/`: layout y secciones reutilizables de presentación
- `scripts/`: automatizaciones locales/mantenimiento
- `docs/`: documentación técnica y operativa

Regla:

- No introducir lógica de negocio compleja dentro de `app/views/layout/header.php` o `app/views/layout/footer.php`; esa lógica debe vivir en `app/services/` o en `app/config/bootstrap.php` si es transversal.

## PHP

### Archivos y nombres

- Las páginas públicas usan nombres descriptivos en minúsculas con guiones: `quienes-somos.php`, `preguntas-frecuentes.php`, `condiciones-servicio.php`.
- Los includes compartidos pueden usar guion cuando representan un módulo funcional: `contact-form.php`, `mail-transport.php`, `gallery-service.php`.
- Evitar camelCase en nombres de archivo PHP nuevos.
- Mantener el criterio actual: nombres orientados a contenido o responsabilidad, no a implementación interna.

### Includes y rutas

- Usar siempre rutas absolutas basadas en `__DIR__`.
- Preferir `require_once` para dependencias obligatorias.
- Usar `include` solo para parciales de presentación compartidos cuando esa sea la convención existente del archivo.

Patrones actuales válidos:

```php
require_once __DIR__ . '/app/config/bootstrap.php';
include __DIR__ . '/app/views/layout/header.php';
<?php include __DIR__ . '/app/views/layout/footer.php'; ?>
```

### Tipado y firma de funciones

- En módulos funcionales y endpoints, usar `declare(strict_types=1);`.
- Tipar parámetros y retornos siempre que sea razonable.
- Usar tipos de retorno expresivos (`bool`, `array`, `string`, `never`, etc.).
- Cuando el array tenga una forma relevante, documentarla en PHPDoc.

Patrones actuales a seguir:

```php
function madayaEnv(string $name): string
function madayaContactRedirectToPage(): never
```

### Nombres de funciones, constantes y variables

- Helpers y funciones globales del proyecto: prefijo `madaya` + contexto funcional.
  - Ejemplos: `madayaEnv`, `madayaContactValidate`, `madayaSendContactMailSmtp`
- Constantes globales del proyecto: prefijo `MADAYA_` en mayúsculas.
  - Ejemplos: `MADAYA_SITE_URL`, `MADAYA_SMTP_HOST`, `MADAYA_CONTACT_CSRF_KEY`
- Variables locales: camelCase descriptivo.
  - Ejemplos: `$contactFormFlash`, `$smtpTimeoutRaw`, `$whatsAppBudgetUrl`
- Evitar abreviaturas ambiguas salvo convenciones técnicas comunes (`$tz`, `$now`, `$dir`).

### Estilo y formato

- Mantener llaves en línea separada para funciones y bloques PHP, como en el código actual.
- Respetar el estilo existente del archivo: algunos archivos usan tabs en bloques de vista, otros espacios en módulos de lógica.
- No mezclar estilos arbitrariamente dentro del mismo bloque editado.
- Mantener arrays multilínea cuando mejoren legibilidad.

### Comentarios y PHPDoc

- Los comentarios deben explicar intención, reglas de negocio o decisiones técnicas, no repetir lo obvio.
- En funciones reutilizables, incluir PHPDoc con parámetros y retorno.
- Se acepta documentación en español, como ya ocurre en el proyecto.

### Errores, logging y seguridad

- No mostrar errores técnicos sensibles al usuario final.
- Usar `error_log()` solo para diagnóstico técnico y preferiblemente condicionado por entorno cuando aplique.
- Repetir en servidor cualquier validación o protección hecha en cliente.
- Escapar siempre salida HTML derivada de input o mensajes dinámicos (`htmlspecialchars`).

Patrones actuales:

- `logIfDevelopment()` para logs solo en desarrollo.
- Mensajes de UI neutros y no técnicos en el formulario.

### Organización de páginas PHP

Patrón base por página pública:

1. Definir `pageTitle` y `pageDescription`
2. Cargar `bootstrap.php`
3. Definir `$canonicalUrl`
4. Cargar `header.php`
5. Renderizar contenido propio
6. Cargar `footer.php`

Ejemplo de estructura objetivo:

```php
<?php
$pageTitle = "Título de página";
$pageDescription = "Descripción SEO";
require_once __DIR__ . '/app/config/bootstrap.php';
$canonicalUrl = MADAYA_SITE_URL . '/ruta/';
include __DIR__ . '/app/views/layout/header.php';
?>

<!-- contenido -->

<?php include __DIR__ . '/app/views/layout/footer.php'; ?>
```

## HTML

### Semántica estructural

- Mantener landmarks reales: `header`, `nav`, `main`, `footer`.
- Usar `section` para bloques temáticos y `article` para piezas autocontenidas.
- Usar `figure` y `figcaption` en galerías y reseñas cuando la imagen o cita necesite leyenda.
- Usar `address`, `time`, `dl/dt/dd`, `details/summary` cuando aporten semántica real.

### Headings

- Cada página debe tener un único `h1`.
- Mantener jerarquía lógica `h1 -> h2 -> h3` sin saltos arbitrarios.
- Los headings deben describir contenido real y apoyar SEO y accesibilidad.

### Accesibilidad y atributos

- Seguir como referencia principal `docs/accesibilidad.md`.
- Iconos SVG decorativos: `aria-hidden="true" focusable="false"`.
- `iframe` siempre con `title`.
- Formularios con `label`, `required`, `aria-invalid`, `aria-describedby`, y región `aria-live` si hay feedback dinámico.
- Evitar `aria-label` redundantes o inconsistentes con el texto visible.

### Enlaces y CTAs

- El texto visible del enlace debe describir la acción o destino.
- En enlaces externos con nueva pestaña usar `rel="noopener noreferrer"`.
- Usar `tel:`, `mailto:` y URLs absolutas cuando el caso de negocio lo pida.

## CSS

- Convención base: modelo híbrido entre componentes y utilidades.
- Mantener bloques CSS por zona funcional: variables, reset/base, layout, tipografía, header/nav, componentes, footer, responsive.
- Centralizar tokens de diseño en `:root`.

### Nomenclatura CSS

- Preferir clases tipo bloque/elemento/modificador:
  - `.contact-card`
  - `.contact-card__title`
  - `.contact-status--open`
- Se permiten utilidades globales ya existentes:
  - `.bg-primary`
  - `.link-light`
  - `.section--narrow`
- Evitar introducir nuevos ids para estilo visual.
- Evitar selectores excesivamente profundos si puede resolverse con una clase directa.

### Evolución de CSS

- No renombrar en masa clases existentes que ya funcionan sin una necesidad real.
- En cada cambio funcional, normalizar solo el componente tocado.
- Antes de una migración grande de nombres o estructura, documentar el plan en `docs/`.

## JS

### Principio base

- El JavaScript es mejora progresiva, no dependencia crítica.
- Toda funcionalidad esencial debe tener fallback sin JS.

### Organización y estilo

- Mantener encapsulación con IIFE para evitar contaminar el scope global.
- Nombrar funciones en camelCase descriptivo.
- Preferir funciones pequeñas con una responsabilidad clara.
- Documentar tipos con JSDoc cuando el módulo tenga estado o estructuras complejas.

Patrones actuales válidos:

- `parseIntOrDefault`
- `buildLoadMoreContext`
- `updateLoadMoreStatus`
- `initContactFormEnhancements`

### Interactividad y backend

- La validación cliente nunca sustituye a la validación server-side.
- Si JS intercepta una acción, debe existir degradación limpia al flujo HTML nativo.
- Mantener sincronizados estados accesibles (`aria-live`, `aria-disabled`, `aria-expanded`) con el DOM real.

## Assets

### Imágenes

- Mantener nombres descriptivos y estables.
- En galerías con variantes, respetar el patrón `_small` / `_large` porque forma parte de la lógica del backend.
- Cuando existan descripciones asociadas, usar JSON por colección como en `/assets/img/galeria/hogar/descripciones.json`.

## Iconos y formatos

- Favorecer `webp` para imágenes donde ya exista ese flujo.
- Mantener `jpg/jpeg/png` solo cuando haya necesidad real o legado existente.
- Iconos SVG inline deben tratarse como decorativos salvo que transmitan información por sí mismos.

## Documentación del proyecto

- Los documentos en `docs/` deben tener:
  - Ultima actualizacion
  - Responsable
  - Proxima revision
- Evitar documentos plantilla indefinidos cuando ya exista una convención real en el código.
- Si un documento deja de ser fuente de verdad, o se elimina o se reduce a un alias explícito.

## Checklist de revision

- [ ] Nombres de archivo, funciones, clases y variables coherentes con el repositorio
- [ ] Includes con `__DIR__` y `require_once` cuando corresponda
- [ ] Tipado aplicado en PHP reutilizable o endpoint nuevo
- [ ] Semántica HTML correcta y headings consistentes
- [ ] Accesibilidad básica validada
- [ ] No se rompe el flujo sin JavaScript
- [ ] No se rompe SEO técnico (`title`, `description`, `canonical`, enlazado)
- [ ] No se introducen logs o errores técnicos visibles al usuario
- [ ] Documentación actualizada si cambia una convención real
