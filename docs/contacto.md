# Pagina de contacto (`contacto.php`)

- Ultima actualizacion: 2026-03-20
- Responsable: usuario (nazaret)
- Proxima revision: tras primer despliegue a Arsys y primer envio SMTP real

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

✅ **Completado:** El contenido de `preguntas-frecuentes.php` esta publicado y enlazado desde contacto.
La pagina incluye preguntas sobre tapiceria, materiales, tejidos ecologicos, mantenimiento y plazos.
La seccion FAQ esta completamente operativa como canal de soporte educativo.

## Formulario de contacto (v1 implementado y activo)

Estado: ✅ Completado. Formulario implementado y activo en `contacto.php` como canal complementario.

**Estado actual de envio:**
- Transporte de correo: PHPMailer + SMTP autenticado (migracion completada desde `mail()`)
- Validacion: server-side obligatoria (nombre, email, mensaje, consentimiento)
- Protecciones: CSRF + honeypot + rate limit basico por sesion
- UX: Accesible (resumen errores, aria-live, foco dirigido, funcional sin JS)

### Objetivo funcional

- El formulario sera un canal complementario para contacto general y solicitud de presupuesto.
- Los canales principales del negocio se mantienen: email, telefono y WhatsApp.
- El formulario no sustituye el CTA principal de WhatsApp.

### Ubicacion en la pagina

- Insertar una seccion nueva entre "Canales de contacto" y "Como llegar" en `contacto.php`.
- Mantener flujo de conversion: canales rapidos -> formulario -> ubicacion/horario -> CTA WhatsApp.

### Dependencias legales ya preparadas

- `public/politica-privacidad.php`: publicada y enlazable desde formulario.
- `public/politica-cookies.php`: publicada.
- `public/aviso-legal.php`: actualizado.

### Campos v1

- `nombre` (obligatorio)
- `email` (obligatorio)
- `telefono` (opcional)
- `preferencia_contacto` (obligatorio: email, llamada o WhatsApp)
- `mensaje` (obligatorio)
- `consentimiento_privacidad` (obligatorio)

### Fuera de alcance v1

- Selector de tipo de servicio
- Campo empresa/organismo
- Adjuntos/fotos
- Autorespuesta automatica

### Reglas de validacion previstas

- `nombre`: 2 a 80 caracteres
- `email`: formato valido
- `telefono`: formato flexible, no obligatorio
- `mensaje`: 20 a 2000 caracteres
- `consentimiento_privacidad`: obligatorio para enviar

Regla adicional para implementacion:

- `preferencia_contacto`: limitar a valores permitidos (`email`, `llamada`, `whatsapp`).

### Comportamiento esperado

- Confirmacion de envio correcto en la misma pagina
- Mensaje de error si hay validaciones fallidas
- Mensaje de contingencia con canales directos si falla el envio
- Texto operativo visible: respuesta manual en menos de 24 horas laborales

### Implementacion tecnica aplicada

- Endpoint dedicado POST: `public/api/contacto.php`.
- Validacion y sanitizacion server-side en helper: `app/includes/contact-form.php`.
- Protecciones anti-spam minimas: CSRF + honeypot + rate limit basico por sesion.
- Envio de correo a la cuenta Gmail del negocio definida en `MADAYA_EMAIL`.
- Trazabilidad operativa incluida en el correo enviado:
	- fecha/hora local (Atlantic/Canary),
	- timestamp ISO8601,
	- IP de origen,
	- User-Agent.
- UX accesible en `contacto.php`:
	- resumen de errores,
	- errores por campo con `aria-describedby`,
	- foco al primer error tras validacion fallida,
	- region `aria-live` para confirmacion o contingencia.

### JavaScript (mejora progresiva)

- Se anade validacion previa no bloqueante en `public/assets/js/main.js`.
- El flujo sin JavaScript se mantiene funcional y es el flujo base.
- Toda regla de cliente se replica en servidor.

### Backend esperado (resumen)

- Endpoint dedicado por `POST`
- Validacion y sanitizacion server-side
- Protecciones anti-spam: CSRF + honeypot + rate limit basico
- Entrega del correo a una unica cuenta Gmail del negocio

### Siguiente iteracion sugerida

- Migrar transporte de correo de `mail()` a PHPMailer con SMTP autenticado.
- Ejecutar Composer en CI/CD y desplegar artefacto con `vendor/` (sin subir `vendor/` al repositorio).
- Mantener intacto el flujo funcional v1: validacion server-side, CSRF, honeypot, rate limit, PRG y mensajes flash.
- Confirmar primero con Arsys la compatibilidad del plan para este cambio de uso y despliegue automatizado.
- Anadir selector de tipo de servicio y contexto particular/empresa.
- Definir politica de retencion operativa para solicitudes recibidas por email.

### Cambio planificado v1.1 (correo)

- Objetivo: mejorar fiabilidad y entregabilidad del envio de correo en produccion.
- Alcance tecnico:
	- Sustituir solo el bloque de envio en `public/api/contacto.php`.
	- Introducir helper de transporte con PHPMailer (`app/includes/`).
	- Configurar credenciales SMTP via entorno/panel de hosting.
- Fuera de alcance v1.1:
	- Cambios en campos del formulario.
	- Cambios en UX del formulario.
	- Cambios de SEO o rutas publicas.

