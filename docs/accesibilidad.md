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
