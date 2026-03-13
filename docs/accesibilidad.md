# Accesibilidad

- Ultima actualizacion: PENDIENTE
- Responsable: PENDIENTE
- Proxima revision: PENDIENTE

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
