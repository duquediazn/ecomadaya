# Testing Manual

- Ultima actualizacion: 2026-03-16
- Responsable: PENDIENTE
- Proxima revision: al terminar la primera implementacion del formulario

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

- [ ] Todos los casos del bloque de formulario en estado OK.
- [ ] Comprobacion manual de enlace legal junto al checkbox de consentimiento.
- [ ] Verificacion de mensaje de contingencia con canales directos ante fallo de envio.

## Casos pendientes para migracion a PHPMailer (v1.1)

- [ ] Envio correcto mediante SMTP autenticado (produccion o entorno controlado).
- [ ] Fallback funcional a mensaje de contingencia cuando SMTP falle.
- [ ] No se exponen errores tecnicos sensibles en la UI.
- [ ] Logs tecnicos permiten diagnosticar fallo de autenticacion/timeout SMTP.
- [ ] Mantener comportamiento PRG (sin reenvio al refrescar).
- [ ] Mantener validaciones y protecciones actuales (CSRF, honeypot, rate limit).
