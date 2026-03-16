# Runbook de Despliegue en Arsys (Apache)

- Ultima actualizacion: 2026-03-16
- Responsable: PENDIENTE
- Proxima revision: antes del cutover a produccion

## Objetivo

Desplegar el sitio en Arsys manteniendo separacion entre contenido publico y codigo interno, con rollback rapido.

## Contexto tecnico actual

- PHP 8.2 disponible en el panel (confirmado).
- SMTP aparece habilitado en el panel (pendiente confirmar parametros para app PHP).
- Hay acceso FTP.
- No se puede editar `.htaccess` por FTP (pendiente alternativa en panel).
- Se prioriza despliegue por GitHub Actions en lugar de migracion manual por FTP.
- Se planifica migrar transporte de correo de `mail()` a PHPMailer + SMTP autenticado.

## Mensaje corto recomendado para Arsys

Hola, tengo un hosting WordPress basico con vosotros y quiero sustituir la instalacion WordPress por una web propia en PHP multipagina, sin base de datos, con formulario de contacto, despliegue desde GitHub Actions y envio por SMTP autenticado. ¿Mi plan actual soporta este uso o necesito cambiar a otro? Si debo cambiar, ¿que plan me recomendais?

## Nota sobre Composer y dependencias

- `vendor/` no se sube al repositorio.
- Composer se ejecuta en CI y el artefacto de despliegue incluye `vendor/`.
- El hosting no necesita ejecutar Composer si recibe artefacto completo.

## Nota sobre URLs limpias y `.htaccess`

- El sitio local funciona con rutas de archivo (`/servicios.php`, `/contacto.php`, etc.).
- En produccion se debe mantener la estructura de URLs limpias ya publicada (`/servicios/`, `/contacto/`, etc.).
- Esta equivalencia se resolvera previsiblemente mediante reglas de reescritura en el `.htaccess` de `html/`.
- Antes del cutover, verificar que Apache resuelve las rutas limpias hacia los archivos PHP reales sin exponer `.php` en la URL publica.
- Si no es posible mantener URLs limpias, evaluar impacto SEO antes de publicar.

## Escenario A (preferido): el DocumentRoot puede apuntar a `public/`

### Estructura en servidor (recomendada)

```text
/home/tu_cuenta/ecomadaya/
  app/
    includes/
  public/
    index.php
    ...
    assets/
    .htaccess
```

- Configuracion de hosting: DocumentRoot => `/home/tu_cuenta/ecomadaya/public`
- Ventaja: `app/` queda fuera del alcance web.

## Escenario B: Arsys obliga a usar `public_html` fijo

### Estructura en servidor (alternativa)

```text
/home/tu_cuenta/
  app/
    includes/
  public_html/
    index.php
    ...
    assets/
    .htaccess
```

- `app/` queda como carpeta hermana de `public_html`.
- Las rutas `__DIR__ . '/../app/includes/...` siguen funcionando desde `public_html`.

## Escenario C (ultimo recurso): todo dentro de `public_html`

### Estructura en servidor (no ideal)

```text
/home/tu_cuenta/public_html/
  app/
    includes/
  index.php
  ...
  assets/
  .htaccess
```

- Requiere proteger `/app` por `.htaccess` para denegar acceso web directo.
- Usar solo si Arsys no permite carpetas hermanas o rutas fuera de `public_html`.

## Checklist previo al despliegue

- [ ] Backup completo de WordPress (archivos + BD)
- [ ] Export de `.htaccess` actual
- [ ] Confirmar version PHP en Arsys (objetivo PHP 8+)
- [ ] Confirmar modo de estructura permitido (A, B o C)
- [ ] Congelar cambios de contenido durante ventana de migracion

## Orden de despliegue recomendado

1. Subir carpeta `app/` al destino final (segun escenario).
2. Subir contenido de `public/` al destino publico (o mapear DocumentRoot a `public/`).
3. Configurar `.htaccess` con redirecciones y protecciones.
4. Verificar homepage y 4-5 rutas clave.
5. Verificar assets (`/assets/css/main.css`, `/assets/js/main.js`).
6. Verificar legales (`/aviso-legal.php`, `/LICENSE`, `/NOTICE`).
7. Validar `robots.txt` y `sitemap.xml`.

## Verificaciones post-despliegue (10 minutos)

- [ ] `https://tu-dominio/` responde 200
- [ ] `https://tu-dominio/servicios.php` responde 200
- [ ] `https://tu-dominio/galeria.php` carga imagenes
- [ ] Footer muestra enlaces legales y licencia
- [ ] No hay rutas rotas en menu principal

## Hardening minimo para Escenario C

Si `app/` queda dentro de carpeta publica, incluir en `.htaccess`:

```apache
# Bloquear acceso web a codigo interno
RewriteEngine On
RewriteRule ^app/ - [F,L]
```

## Rollback rapido

1. Restaurar archivos WordPress respaldados.
2. Restaurar BD WordPress.
3. Restaurar `.htaccess` original.
4. Validar inicio y paginas de negocio.

## Nota operativa

Mantener GitHub como fuente de verdad.
En servidor, evitar ediciones manuales directas salvo emergencia.
