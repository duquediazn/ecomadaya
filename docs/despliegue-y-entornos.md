# Despliegue y Entornos

- Ultima actualizacion: 2026-03-16
- Responsable: PENDIENTE
- Proxima revision: tras confirmacion de Arsys sobre compatibilidad del plan y metodo de despliegue

## Entornos

- Local: desarrollo en PHP 8.4.11
- Staging/Preproduccion: no disponible actualmente (sin plan contratado)
- Produccion: hosting Arsys

## Requisitos previos

- Version de PHP: objetivo PHP 8+
- Servidor web (Apache/Nginx): Apache (deducido por uso actual de `.htaccess` en WordPress)
- Extensiones PHP necesarias: PENDIENTE

## Estado conocido del hosting Arsys (marzo 2026)

- PHP 8.2 disponible en panel (confirmado).
- SMTP aparece habilitado en panel (pendiente confirmar parametros exactos para app PHP).
- Acceso FTP disponible.
- La instalacion WordPress actual esta publicada dentro de `html/`.
- `html/` es el candidato mas probable a DocumentRoot real del sitio.
- No hay permisos para crear carpetas en la raiz del hosting fuera de `html/`.
- El `.htaccess` de la raiz del hosting no es editable por FTP.
- El `.htaccess` dentro de `html/` si es visible y editable.

## Estado de decisiones (marzo 2026)

- Formulario v1 implementado con validacion y seguridad server-side.
- Capa de transporte actual: `mail()` en produccion.
- Decision de siguiente iteracion: migrar transporte de correo a PHPMailer con SMTP autenticado.
- Decision de despliegue: priorizar pipeline de GitHub Actions frente a subida manual por FTP.
- Decision operativa de soporte: consultar primero a Arsys si el plan WordPress basico admite este cambio de uso antes de seguir con la migracion tecnica.

## Estrategia de despliegue recomendada (GitHub Actions)

- El repositorio NO incluye `vendor/`.
- Composer se ejecuta en CI para construir el artefacto de release.
- El artefacto de despliegue SI incluye `vendor/` y se sube al hosting.
- No es requisito ejecutar Composer en el hosting si CI entrega artefacto completo.
- Metodo de despliegue pendiente de confirmar con Arsys: SFTP o SSH.
- Si no hay SSH, el objetivo minimo aceptable es despliegue automatizado por SFTP desde GitHub Actions.

## Bloqueadores pendientes con Arsys

- Confirmar si el plan WordPress basico permite servir un proyecto PHP propio sin WordPress.
- Confirmar metodo de despliegue automatizable desde GitHub Actions (SFTP/SSH).
- Confirmar capacidades SMTP autenticado (host, puerto, TLS, limites).
- Confirmar si el cambio de uso de WordPress a PHP propio requiere cambio de plan.
- Confirmar si se pueden definir variables de entorno o alternativa equivalente en panel.
- Confirmar si existe opcion de entorno de pruebas (subdominio o carpeta separada).

## Estructura de despliegue

- Escenario ideal: DocumentRoot configurable apuntando a `public/`.
- Escenario probable en el plan actual: `html/` como raiz publica fija del sitio.
- Si `html/` es fija, el despliegue real podria requerir que `app/` quede dentro de `html/`, protegido mediante `.htaccess`.
- Objetivo recomendado: exponer solo paginas publicas y assets, y bloquear acceso web a carpetas internas (`app/`, `docs/`, configuracion y dependencias no publicas).

## Contexto de migracion

- El sitio sustituira a una web existente en WordPress.
- Validar redirecciones y equivalencia SEO de URLs antes de produccion.
- La migracion no debe asumirse viable hasta que Arsys confirme compatibilidad del plan con una app PHP propia y despliegue automatizado.

## Proceso de despliegue

1. Preparar release (branch/tag)
2. Ejecutar pipeline CI (composer install --no-dev + empaquetado artefacto)
3. Desplegar artefacto al hosting por metodo permitido (SFTP/SSH)
4. Verificar salud de pagina principal y rutas clave

## Checklist post-despliegue

- [ ] Inicio responde correctamente
- [ ] Formularios funcionan
- [ ] Assets cargan sin 404
- [ ] robots/sitemap accesibles
- [ ] Paginas legales publicadas

## Rollback

- Procedimiento de rollback: PENDIENTE
- Responsable de ejecucion: PENDIENTE
- Tiempo objetivo de recuperacion: PENDIENTE
