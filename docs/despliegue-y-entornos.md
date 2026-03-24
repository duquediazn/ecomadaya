# Despliegue y Entornos

- Ultima actualizacion: 2026-03-20
- Responsable: usuario (nazaret)
- Proxima revision: tras despliegue inicial a Arsys y auditorias finales

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

## Estado de decisiones (marzo 2026) - ACTUALIZADO

✅ **Completados:**
- Formulario v1 implementado con validacion y seguridad server-side.
- Migracion de transporte: `mail()` → PHPMailer + SMTP autenticado (COMPLETADO).
- Confirmacion de Arsys: Plan WP Basico soporta PHP + SMTP + SFTP (CONFIRMADO 2026-03-20).
- Paginas legales: preguntas-frecuentes.php, politica-privacidad.php, politica-cookies.php (COMPLETADAS).

**Pendientes:**
- Decision de despliegue: Implementar pipeline de GitHub Actions → SFTP a Arsys.
- Configurar variables de entorno SMTP en panel Arsys.
- Auditorias finales: Lighthouse + axe + pruebas manuales.

## Estrategia de despliegue recomendada (GitHub Actions)

- El repositorio NO incluye `vendor/`.
- Composer se ejecuta en CI para construir el artefacto de release.
- El artefacto de despliegue SI incluye `vendor/` y se sube al hosting.
- No es requisito ejecutar Composer en el hosting si CI entrega artefacto completo.
- Metodo de despliegue pendiente de confirmar con Arsys: SFTP o SSH.
- Si no hay SSH, el objetivo minimo aceptable es despliegue automatizado por SFTP desde GitHub Actions.

## Bloqueadores resueltos con Arsys (2026-03-20) ✅

✅ Plan WP Basico permite: PHP + SMTP autenticado + SFTP
✅ Metodo de despliegue confirmado: SFTP (GitHub Actions)
✅ SMTP autenticado soportado en panel
✅ No requiere cambio de plan
✅ SSL permanecera activo en ecomadaya.es

**Pendiente de configuracion en panel Arsys:**
- Variables de entorno SMTP (host, puerto, usuario, password, from, etc.)
- Acceso SFTP para GitHub Actions (usuario/token dedicado recomendado)

## Estructura de despliegue

- Escenario ideal: DocumentRoot configurable apuntando a `public/`.
- Escenario probable en el plan actual: `html/` como raiz publica fija del sitio.
- Si `html/` es fija, el despliegue real podria requerir que `app/` quede dentro de `html/`, protegido mediante `.htaccess`.
- Objetivo recomendado: exponer solo paginas publicas y assets, y bloquear acceso web a carpetas internas (`app/`, `docs/`, configuracion y dependencias no publicas).

## Contexto de migracion

- El sitio sustituira a una web existente en WordPress.
- Validar redirecciones y equivalencia SEO de URLs antes de produccion.
- La migracion no debe asumirse viable hasta que Arsys confirme compatibilidad del plan con una app PHP propia y despliegue automatizado.

## URLs publicas objetivo

- En local, las rutas actuales se sirven por archivo (`/servicios.php`, `/contacto.php`, etc.).
- En produccion, el objetivo es mantener URLs limpias equivalentes al sitio publicado actual.
- Convencion objetivo en produccion:
	- `/`
	- `/servicios/`
	- `/galeria/`
	- `/contacto/`
	- resto de paginas publicas siguiendo el mismo criterio
- La resolucion de estas rutas limpias probablemente dependera de reglas Apache en `.htaccess`.
- No se debe publicar en produccion una version que exponga `.php` en las URLs si eso rompe equivalencia con el sitio actual o contradice las canonical ya definidas.

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
