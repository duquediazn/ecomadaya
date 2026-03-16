# Legal y Cumplimiento

- Ultima actualizacion: 2026-03-16
- Responsable: PENDIENTE
- Proxima revision: antes de activar envio real del formulario

## Objetivo

Controlar el estado de las paginas y requisitos legales antes de publicar.

## Paginas legales del proyecto

- `aviso-legal.php`
- `politica-privacidad.php`
- `politica-cookies.php`
- `condiciones-servicio.php`

## Checklist de cumplimiento

- [ ] Textos legales validados por responsable legal/negocio
- [x] Fecha de ultima revision visible en paginas legales publicadas
- [x] Politica de cookies publicada con estado actual del sitio
- [x] Formularios alineados con politica de privacidad

## Estado legal actual (marzo 2026)

- `public/aviso-legal.php`: actualizado y alineado con privacidad/cookies.
- `public/politica-privacidad.php`: redactada y publicada.
- `public/politica-cookies.php`: redactada y publicada.
- `public/condiciones-servicio.php`: pendiente de revision final de contenido.

## Estado cookies y analitica

- Estado actual: no hay cookies propias de analitica/publicidad implementadas.
- Contexto actual: hay recursos de terceros (Google Maps, YouTube nocookie, Google Fonts) que pueden tratar datos de conexion y/o aplicar cookies propias.
- Riesgo de cambio: si se incorpora analitica (por ejemplo Google Analytics), implementar banner/consentimiento previo y actualizar textos legales.

## Responsable y aprobacion

- Responsable legal/negocio: PENDIENTE
- Responsable tecnico: PENDIENTE
- Fecha de aprobacion pre-produccion: PENDIENTE

## Formulario de contacto (pre-implementacion)

### Estado legal actual del formulario

- [x] `politica-privacidad.php` completada.
- [x] Checkbox obligatorio de consentimiento enlazado a politica de privacidad.
- [x] Texto legal de consentimiento con finalidad explicita de consulta/presupuesto.
- [x] Bloqueo de envio en backend si no existe consentimiento.
- [x] Trazabilidad de fecha/hora de envio incluida en backend.
- [x] Mensaje de contingencia visible con canales directos ante fallo de envio.

### Minimos legales a reflejar en politica de privacidad

- Responsable del tratamiento
- Finalidad (atender contactos y solicitudes de presupuesto)
- Base juridica (consentimiento)
- Conservacion de datos
- Derechos de las personas usuarias y canal para ejercerlos
- Cesiones o terceros (si aplica por infraestructura de correo)

Estado: cubiertos en la version publicada de `public/politica-privacidad.php`.

### Decision operativa acordada

- Gestion de solicitudes desde una unica cuenta de Gmail
- Sin autorespuesta automatica
- Respuesta manual en menos de 24 horas laborales

## Handoff para agente de implementacion del formulario

### Requisitos legales obligatorios en UI (cumplido)

- Checkbox obligatorio no preseleccionado para consentimiento.
- Enlace visible a `/politica-privacidad.php` junto al checkbox.
- Si falta consentimiento, bloqueo de envio y mensaje de error accesible.

Texto legal recomendado para el checkbox (v1):

"He leido y acepto la Politica de privacidad para el tratamiento de mis datos con la finalidad de atender mi consulta o solicitud de presupuesto."

### Requisitos legales obligatorios en backend (cumplido)

- No procesar envio si `consentimiento_privacidad` no esta marcado.
- Registrar fecha/hora del envio para trazabilidad operativa.
- No usar los datos para finalidades distintas a atencion de consultas/presupuestos.
- En caso de error de envio, no perder el contexto legal del formulario (mantener checkbox y enlace en respuesta).

### Condicion de activacion en produccion

- No activar el envio real del formulario hasta completar:
	- validaciones server-side,
	- protecciones anti-spam minimas,
	- pruebas manuales de accesibilidad,
	- checklist de pruebas de `docs/testing-manual.md` para formulario.
