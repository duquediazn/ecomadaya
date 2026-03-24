# Testing Manual

- Ultima actualizacion: 2026-03-20
- Responsable: usuario (nazaret)
- Proxima revision: tras primer despliegue a Arsys y primer envio SMTP real

## Objetivo

Disponer de una bateria minima de pruebas manuales para reducir regresiones antes de publicar.

## Cobertura minima

- Navegacion principal
- Enlaces internos y externos
- Formularios
- Responsive (movil/escritorio)
- Accesibilidad basica
- SEO tecnico basico

## Casos de prueba por pagina

Plantilla:

- Pagina:
- Caso:
- Paso a paso:
- Resultado esperado:
- Resultado real:
- Estado: OK/KO

## Casos criticos sugeridos

- [ ] Carga de `index.php`
- [ ] Carga de `servicios.php`
- [ ] Carga de `galeria.php`
- [ ] Carga de `contacto.php`
- [ ] Navegacion con teclado en menu
- [ ] Sin errores 404 en assets principales

## Casos adicionales para formulario de contacto (pre-implementacion)

- [x] Envio correcto con nombre + email + mensaje + consentimiento
- [x] Envio rechazado sin consentimiento
- [x] Envio rechazado con email invalido
- [x] Envio correcto sin telefono (campo opcional)
- [x] Validacion de longitud minima del mensaje
- [x] Resumen de errores visible y foco en el primer error
- [x] Confirmacion de envio anunciada en region `aria-live`
- [x] Prueba completa solo con teclado
- [x] Prueba sin JavaScript (debe seguir funcionando)
- [x] Prueba con JavaScript habilitado (intercepta envio, valida y no rompe el flujo)
- [x] Verificar protecciones anti-spam basicas (CSRF/honeypot/rate limit)

## Evidencias minimas ejecutadas (2026-03-16)

- Formulario visible entre el bloque de canales y el bloque de como llegar en `contacto.php`.
- En errores de validacion server-side se mantiene valor de campos y se renderiza resumen enlazado a cada campo.
- Envio bloqueado si el checkbox de privacidad no esta marcado.
- Si falla `mail()`, se muestra contingencia con WhatsApp, telefono y email directo.
- Se registra fecha/hora de envio en el contenido del correo generado por backend.

## Criterio de salida para activar envio real del formulario

✅ **Todos los criterios completados:**

- [x] Todos los casos del bloque de formulario en estado OK.
- [x] Comprobacion manual de enlace legal junto al checkbox de consentimiento.
- [x] Verificacion de mensaje de contingencia con canales directos ante fallo de envio.
- [x] Migracion a PHPMailer + SMTP completada y validada en local.

**Pendiente en producción:** Configurar variables SMTP en panel Arsys para activar envio real.

## Migración a PHPMailer (v1.1) - COMPLETADA ✅

Ejecutados en local con XAMPP + Mailpit (2026-03-17) y en código:

- [x] Envio correcto mediante SMTP autenticado (local con Mailpit).
- [x] Fallback funcional a mensaje de contingencia cuando SMTP falle (puerto incorrecto).
- [x] No se exponen errores tecnicos sensibles en la UI.
- [x] Logs tecnicos permiten diagnosticar fallo: prefijo `[contacto][smtp]` en error.log de Apache.
- [x] Mantener comportamiento PRG (sin reenvio al refrescar).
- [x] Mantener validaciones y protecciones actuales (CSRF, honeypot, rate limit).

**Pendiente en producción:**

- [ ] Envio correcto con credenciales SMTP del proveedor (Arsys SMTP).
- [ ] Correo recibido en buzon objetivo sin caer en spam.
- [ ] `MADAYA_SMTP_AUTH` activo (no definir o valor `1`).
- [ ] `MADAYA_SMTP_DEBUG=0` confirmado en produccion.

## Testeo local recomendado (XAMPP + SMTP de pruebas)

### Opcion A (recomendada): Mailpit local

1. Levantar Mailpit en local (SMTP: `127.0.0.1:1025`, UI: `http://127.0.0.1:8025`).
2. Definir variables de entorno para Apache/PHP de XAMPP:
	- `APP_ENV=development`
	- `MADAYA_SMTP_ENABLED=1`
	- `MADAYA_SMTP_HOST=127.0.0.1`
	- `MADAYA_SMTP_PORT=1025`
	- `MADAYA_SMTP_ENCRYPTION=none`
	- `MADAYA_SMTP_USERNAME=test`
	- `MADAYA_SMTP_PASSWORD=test`
	- `MADAYA_SMTP_FROM_EMAIL=no-reply@ecomadaya.local`
	- `MADAYA_SMTP_FROM_NAME=Web Madaya`
	- `MADAYA_SMTP_DEBUG=0`
3. Reiniciar Apache en XAMPP para aplicar entorno.
4. Enviar formulario valido y comprobar recepcion en UI de Mailpit.
5. Forzar fallo (por ejemplo puerto incorrecto) y verificar mensaje de contingencia en la web.

### Opcion B: SMTP real (solo smoke test final)

1. Configurar variables reales del proveedor SMTP.
2. Ejecutar un unico envio controlado.
3. Verificar recepcion en buzon objetivo y revisar carpeta spam.
4. Restaurar `MADAYA_SMTP_DEBUG=0` tras la prueba.
