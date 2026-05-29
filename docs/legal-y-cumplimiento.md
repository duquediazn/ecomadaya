# Legal y Cumplimiento

- Última actualización: 2026-03-25
- Estado global: resumen de estado actual legal-técnico
- Próxima revisión: tras cambios en el formulario, cookies, embeds o condiciones del servicio

## Objetivo de este documento

Ofrecer una vista resumida y operativa del estado legal del sitio según lo implementado en el código y en los textos publicados.

Importante:

- Este documento no certifica cumplimiento legal absoluto.
- Identifica coherencia técnica, riesgos residuales y pendientes de validación externa.

## Estado actual por documento legal

### Aviso legal (`aviso-legal.php`)

- Estado: publicado y alineado con la estructura actual del proyecto.
- Coherencia técnica: alta.
- Observación: mantiene referencias correctas a licencia y activos propietarios (`/LICENSE` y `/NOTICE`).
- Riesgo residual: bajo.

### Politica de privacidad (`politica-privacidad.php`)

- Estado: publicada y actualizada al estado técnico real.
- Coherencia técnica: alta.
- Refleja:
  - formulario con datos de contacto y metadatos técnicos (fecha/hora, IP, User-Agent),
  - Gmail como canal operativo de gestión,
  - Arsys Correo como infraestructura SMTP técnica de envio del formulario,
  - terceros de contenido externo (Google Maps/YouTube) y contacto por WhatsApp.
- Riesgo residual: bajo. La política refleja el estado técnico real: datos del formulario, metadatos técnicos, terceros implicados (Arsys Correo como SMTP, Google Maps/YouTube con bloqueo previo, WhatsApp como enlace iniciado por el usuario).

### Politica de cookies (`politica-cookies.php`)

- Estado: publicada y coherente con la implementación.
- Coherencia técnica: alta.
- Refleja:
  - ausencia de cookies propias de analítica/publicidad,
  - cookie técnica `madaya_external_media_consent`,
  - bloqueo previo de Google Maps y YouTube hasta accion expresa.
- Riesgo residual: bajo. El mecanismo click-to-play empleado (ningún embed de tercero se carga sin acción expresa) es coherente con el art. 5.3 de la Directiva ePrivacy, el art. 22.2 LSSI-CE y el concepto de consentimiento del RGPD (art. 4.11). La cookie de preferencia tiene función estrictamente técnica y no elabora perfiles. Cada bloque de consentimiento incluye enlace a la política de cookies para evidenciar información previa suficiente en el punto de aceptación.

### Condiciones del servicio (`condiciones-servicio.php`)

- Estado: publicado y revisado con redacción mas prudente.
- Coherencia con FAQ y mensajes comerciales: media-alta.
- Riesgo residual: medio (requiere validación jurídica externa en materias de consumo: devoluciones, garantía, limitaciones y arbitraje).

## Estado de areas críticas

### Formulario de contacto

- Implementación actual:
  - consentimiento de privacidad obligatorio,
  - validación server-side,
  - CSRF, honeypot y rate limit,
  - trazabilidad técnica mínima en el correo generado.
- Estado legal-técnico: alineado.
- Pendiente operativo: validar extremo a extremo en producción tras primer despliegue manual.

### Cookies, embeds y terceros

- Estado actual:
  - Google Fonts servida en local,
  - Google Maps y YouTube bloqueados hasta aceptación,
  - no analítica propia detectada.
- Estado legal-técnico: alineado con políticas publicadas.
