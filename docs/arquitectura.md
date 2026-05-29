# Arquitectura

- Última actualización: 2026-03-24
- Próxima revisión: tras cambios significativos

## Objetivo técnico

Documentar la arquitectura real actual del proyecto (estado de código en repositorio), para facilitar mantenimiento, despliegue y toma de decisiones sin depender de conocimiento tácito.

## Stack y principios

- Lenguaje/stack: PHP 8+ (prod 8.2 en Arsys), HTML5, CSS3, JS vanilla
- Frameworks: ninguno
- Dependencias externas: PHPMailer (`phpmailer/phpmailer:^6.9`)
- Arquitectura de frontend: multi-page server-rendered + mejora progresiva
- Base de datos: no aplica
- Principios: simplicidad operativa, accesibilidad WCAG AA, SEO técnico, no depender de JS para flujos críticos

## Arquitectura lógica por capas

- Ubicación: `*.php`
- Páginas de negocio/legales: `index.php`, `servicios.php`, `galeria.php`, `contacto.php`, `quienes-somos.php`, `preguntas-frecuentes.php`, `aviso-legal.php`, `politica-privacidad.php`, `politica-cookies.php`, `condiciones-servicio.php`
- Patrón común: cada página define `pageTitle`, `pageDescription`, `canonicalUrl`, carga `bootstrap.php`, y renderiza `header.php` + contenido + `footer.php`

### 2) Capa de lógica compartida

- Ubicación: `app/includes/` (archivos PHP incluidos por páginas o endpoints)
- `bootstrap.php`: entorno (`APP_ENV`), constantes de negocio, utilidades de entorno (`madayaEnv`), URLs WhatsApp, estado abierto/cerrado del taller, configuración SMTP
- `header.php`: metadatos, canonical, Open Graph, JSON-LD de negocio, navegación principal, apertura de `main`
- `footer.php`: navegación secundaria/legal, contacto, horarios, cierre de `main`
- `contact-form.php`: sesión/flash, CSRF, normalización, validación, rate limit, PRG redirect helper
- `mail-transport.php`: transporte SMTP con PHPMailer
- `gallery-service.php`: lectura, validación y armado de items de galería

- Ubicación: `api/` (Endpoints públicos)
- `contacto.php`: procesa `POST`, aplica controles de seguridad, envía (si SMTP activo), guarda flash y redirige 303 a `contacto.php#formulario-contacto`
- `galeria-hogar.php`: endpoint `GET` JSON con paginación `offset/limit` para carga progresiva de galería
- `consentimiento-embeds.php`: endpoint `POST` para aceptar/rechazar consentimiento de embeds externos, persistiendo cookie y redirigiendo de forma segura a ruta interna

### 4) Capa de activos estáticos

- Ubicación: `assets/`
- CSS global: `assets/css/main.css` (tokens CSS + layout + componentes + responsive)
- JS global: `assets/js/main.js` (menú móvil, lightbox, carga progresiva de galería, validación cliente no bloqueante en formulario)
- Medios: `assets/img/` y `assets/icons/`

### 5) Capa de automatización

- Script de mantenimiento SEO: `scripts/generate-sitemap.php`
- Comandos Composer:
  - `composer run sitemap` (genera sitemap.xml)

## Estructura física

```text
  index.php
  servicios.php
  galeria.php
  contacto.php
  quienes-somos.php
  preguntas-frecuentes.php
  aviso-legal.php
  politica-privacidad.php
  politica-cookies.php
  condiciones-servicio.php
  api/
    contacto.php
    galeria-hogar.php
    consentimiento-embeds.php
  assets/
    css/
    js/
    img/
    icons/
  robots.txt
  sitemap.xml
  .htaccess
  app/
    includes/
      bootstrap.php
      header.php
      footer.php
      contact-form.php
      mail-transport.php
      gallery-service.php
  docs/
  scripts/
  vendor/
  composer.json
  LICENSE
  NOTICE
```

## Flujos técnicos reales

### 1) Render de página (SSR)

1. El navegador solicita una ruta pública (`/index.php`, `/servicios.php`, etc.).
2. La página carga `bootstrap.php`.
3. `bootstrap.php` inicializa entorno y constantes transversales.
4. Se incluye `header.php` (head + nav + apertura de `main`).
5. Se renderiza contenido específico de página.
6. Se incluye `footer.php` (pie + cierre de `main`).

Notas:

- No hay consultas a BD.
- El tiempo de render depende solo de I/O de archivos y lógica en memoria.

### 2) Formulario de contacto (flujo PRG)

Endpoint de procesamiento: `POST /api/contacto.php`

Secuencia real:

1. `contacto.php` renderiza formulario con CSRF token en sesión.
2. `POST` entra por `api/contacto.php`.
3. Se validan, en este orden:

- método HTTP
- rate limit por sesión (4 intentos / 900s)
- CSRF (`hash_equals`)
- honeypot (`website`)
- validación de campos (nombre, email, teléfono opcional, preferencia, mensaje, consentimiento)

4. Si todo es válido y `MADAYA_SMTP_ENABLED` está activo, intenta envío SMTP con PHPMailer.
5. Siempre termina en patrón PRG: guarda flash, rota CSRF y redirige 303 a `/contacto.php#formulario-contacto`.

Importante:

- La API de contacto no devuelve JSON como flujo principal; usa redirección con flash.
- La validación en JS es solo mejora de UX: la validación canónica es server-side.

### 3) Galería progresiva (hybrid no-JS/JS)

1. `galeria.php` renderiza un primer lote (10) de galería hogar.
2. Sin JS: el enlace "Cargar más" usa fallback por query string (`hogar_limit`).
3. Con JS: `main.js` intercepta clic y consume `/api/galeria-hogar.php?offset=...&limit=...`.
4. El endpoint devuelve JSON con `items`, `nextOffset`, `total`.
5. El cliente inserta `<figure>` dinámicamente y actualiza estado `aria-live`.

Limites operativos:

- Tope de visualización hogar en servidor: 35 ítems.
- El endpoint limita `limit` máximo a 50.

### 4) Consentimiento de embeds externos (server-side)

Endpoint de procesamiento: `POST /api/consentimiento-embeds.php`

Secuencia real:

1. Se recibe `decision` (`accept` o `reject`) y `return_to`.
2. Si `decision` no es válida, se normaliza a `reject`.
3. `return_to` se valida para permitir solo rutas internas seguras (sin esquema externo ni `//`).
4. Se persiste preferencia mediante cookie `madaya_external_media_consent`.
5. Se redirige 303 a la ruta interna indicada.

Importante:

- El flujo de consentimiento se resuelve sin JavaScript obligatorio.
- Se evita redirección abierta hacia dominios externos.

### 5) SEO técnico y sitemap

- Canonical por página: se define como `$canonicalUrl = MADAYA_SITE_URL . '/ruta/'`.
- `header.php` inyecta `<link rel="canonical">` cuando existe variable.
- `scripts/generate-sitemap.php` recorre `*.php`, extrae canonical por regex y genera `sitemap.xml`.
- `robots.txt` publica `Sitemap: https://ecomadaya.es/sitemap.xml`.

### 6) Datos estructurados

- Global: JSON-LD tipo `LocalBusiness` en `header.php` con `additionalType` = `FurnitureRepair` (incluye dirección, horario, `aggregateRating`, etc.).
- Específico: `preguntas-frecuentes.php` añade JSON-LD `FAQPage`.

## Configuración y entorno

### Detección de entorno

- `APP_ENV` se obtiene por `getenv`, `$_ENV`, `$_SERVER` o autodetección por host.
- Hosts locales (`localhost`, `127.0.0.1`, `::1`, `*.local`, `*.test`) se marcan como `development`; resto `production`.

### Configuración SMTP

Variables soportadas:

- `MADAYA_SMTP_ENABLED`, `MADAYA_SMTP_HOST`, `MADAYA_SMTP_PORT`, `MADAYA_SMTP_ENCRYPTION`, `MADAYA_SMTP_USERNAME`, `MADAYA_SMTP_PASSWORD`, `MADAYA_SMTP_FROM_EMAIL`, `MADAYA_SMTP_FROM_NAME`, `MADAYA_SMTP_TIMEOUT`, `MADAYA_SMTP_DEBUG`, `MADAYA_SMTP_AUTH`

## Modelo de seguridad actual

- Validación server-side obligatoria en formulario.
- Protecciones anti-abuso en contacto: CSRF + honeypot + rate limit por sesión.
- Escape de salida en valores y mensajes del formulario (`htmlspecialchars`).
- Credenciales SMTP fuera del repo (variables de entorno).
- Separación de código interno (`app/includes`) respecto al código público.

## Riesgos y deuda técnica

- El patrón del menú móvil usa `input[type="checkbox"]`, funcional sin JS pero con deuda semántica accesible frente a un botón de menú.
