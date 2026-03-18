# Accesibilidad

- Ultima actualizacion: 2026-03-18
- Responsable: PENDIENTE
- Proxima revision: tras auditoria automatica final (Lighthouse/axe) en entorno de produccion

## Objetivo

Definir criterios de accesibilidad aplicables al proyecto para cumplir buenas practicas y reducir barreras de uso.

## Nivel objetivo

- WCAG objetivo: AA
- Criterio de calidad: intentar superar AA en componentes donde la simplicidad del sitio lo permita

## Criterios base

- Semantica HTML correcta
- Navegacion por teclado completa
- Indicadores de foco visibles
- Contraste suficiente texto/fondo
- Texto alternativo en imagenes informativas
- Labels y mensajes de error accesibles en formularios

## Checklist por pagina

- [ ] Existe un solo `h1`
- [ ] Orden de headings logico
- [ ] Enlaces con texto descriptivo
- [ ] `alt` en imagenes relevantes
- [ ] Se puede usar sin raton
- [ ] Formularios con `label` asociado

## Herramientas y validacion

- Auditoria automatica: Lighthouse / axe / WAVE (PENDIENTE DEFINIR)
- Prueba manual minima: teclado + lector de pantalla (PENDIENTE DEFINIR)

## Registro de hallazgos

- Fecha:
- Pagina:
- Hallazgo:
- Severidad:
- Estado:

## Estado actual `contacto.php`

- Estructura semantica por secciones con jerarquia de headings valida (1 `h1`)
- Tarjetas de contacto con acciones reales (`tel:`, `mailto:`, `https://wa.me/`)
- Uso de `address`, `time` y `dl` para direccion y horario
- `iframe` de mapa con atributo `title`
- Iconos decorativos en tarjetas marcados con `aria-hidden="true"`
- Seccion de estado dinamico de apertura/cierre legible por lector de pantalla

## Estado actual `footer.php`

- Email y telefono convertidos en enlaces reales (`mailto:` y `tel:`)
- Enlaces a redes sociales con `aria-label` y `rel="noopener noreferrer"`
- Iconos de redes tratados como decorativos (`aria-hidden="true"`)
- `iframe` del mapa con atributo `title`
- Horarios con marcado `time`
- Indicadores de foco visibles en enlaces del footer

## Estado actual `header.php`

- El menu movil expone `aria-controls` y `aria-expanded`
- El estado visible/oculto de la navegacion se sincroniza con JS en pantallas pequenas
- Los iconos del menu se marcan como decorativos
- Los submenus se pueden abrir tambien con teclado mediante `:focus-within`

## Estado actual `index.php`, `servicios.php` y `galeria.php`

- Enlaces externos abiertos en nueva pestana con `rel="noopener noreferrer"`
- Botones y enlaces de galeria con indicadores de foco visibles
- SVG decorativos en CTA marcados con `aria-hidden="true"`
- `servicios.php` corrige un bloque con clase mal escrita (`section--narrow`)
- `servicios.php` mejora el titulo del `iframe` de YouTube

## Estado actual `quienes-somos.php`

- Unico `h1` y jerarquia semantica valida.
- Secciones principales etiquetadas con `aria-labelledby` para navegacion por regiones.
- Imagenes informativas con `alt` y `figcaption`.
- Enlaces de imagen compatibles con teclado, foco visible y fallback sin JavaScript.
- Valores migrados a `dl/dt/dd` para mejorar semantica de termino/descripcion.
- Iconos SVG en bloque de valores marcados como decorativos (`aria-hidden="true"`).

## Estado actual `preguntas-frecuentes.php`

- Unico `h1` y estructura de headings por categorias.
- Uso de `details/summary` para disclosure nativo accesible sin JS.
- Correccion de marcado HTML invalido en listas para evitar lectura erratica en lector de pantalla.
- Enlaces de accion (WhatsApp/correo/contacto) con texto descriptivo y navegacion directa.
- Seccion principal etiquetada con `aria-labelledby`.

## Estado actual `public/assets/js/main.js` (lightbox)

- El lightbox conserva compatibilidad con `.gallery` y acepta tambien `[data-lightbox-gallery]`.
- Permite activar comportamiento en secciones narrativas sin acoplar semantica visual de galeria.

## Requisitos de accesibilidad para formulario (pre-implementacion)

Estado: requisitos listos para ejecutar en implementacion.

### Marcado y semantica

- Usar `form`, `fieldset` y `legend` para agrupar el bloque.
- Cada campo debe tener `label` visible asociado por `for`/`id`.
- No usar placeholder como sustituto de etiqueta.

### Errores y ayudas

- Mensajes de error por campo enlazados mediante `aria-describedby`.
- Resumen de errores al inicio del formulario cuando falle validacion.
- Mover foco al primer campo con error tras envio fallido.
- Marcar campos obligatorios de forma visible y programatica (`required` + texto explicito).

### Feedback de estado

- Mostrar confirmacion o error en una region con `aria-live="polite"`.
- Mantener mensajes breves y orientados a accion.
- Evitar depender solo de color para transmitir estados de error/exito.

### Teclado y foco

- Orden de tabulacion natural sin saltos.
- Indicador de foco visible en todos los controles.
- El formulario debe ser usable completamente sin JavaScript.
- Si se usa JavaScript para validaciones en cliente, debe mantenerse equivalencia funcional sin JavaScript y sin perdida de accesibilidad.
