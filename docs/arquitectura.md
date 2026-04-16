# Arquitectura

- Última actualización: 2026-03-24
- Próxima revisión: tras cerrar despliegue inicial en Arsys y ejecutar auditorías finales (Lighthouse + axe)

## Objetivo técnico

Documentar la arquitectura real actual del proyecto (estado de código en repositorio), para facilitar mantenimiento, despliegue y toma de decisiones sin depender de conocimiento tácito.

## Alcance del análisis

Se revisaron todos los archivos propios del proyecto relevantes para arquitectura:

- Código: `*.php`, `api/*.php`, `app/includes/*.php`, `assets/js/main.js`, `assets/css/main.css`, `scripts/generate-sitemap.php`
- Configuración y metadatos: `composer.json`, `.gitignore`, `robots.txt`, `sitemap.xml`, `.htaccess`
- Documentación operativa/técnica en `docs/`
- Soporte de agentes en `.github/agents/`

Dependencias de terceros en `vendor/` no se auditan funcionalmente en detalle (fuente externa), salvo confirmar su uso (PHPMailer).

## Stack y principios

- Lenguaje/stack: PHP 8+ (dev local 8.4.11, objetivo prod 8.2 en Arsys), HTML5, CSS3, JS vanilla
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

- Ubicación: `app/includes/`
- `bootstrap.php`: entorno (`APP_ENV`), constantes de negocio, utilidades de entorno (`madayaEnv`), URLs WhatsApp, estado abierto/cerrado del taller, configuración SMTP
- `header.php`: metadatos, canonical, Open Graph, JSON-LD de negocio, navegación principal, apertura de `main`
- `footer.php`: navegación secundaria/legal, contacto, horarios, cierre de `main`
- `contact-form.php`: sesión/flash, CSRF, normalización, validación, rate limit, PRG redirect helper
- `mail-transport.php`: transporte SMTP con PHPMailer
- `gallery-service.php`: lectura, validación y armado de items de galería

- Ubicación: `api/`
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

## 1) Render de página (SSR)

1. El navegador solicita una ruta pública (`/index.php`, `/servicios.php`, etc.).
2. La página carga `bootstrap.php`.
3. `bootstrap.php` inicializa entorno y constantes transversales.
4. Se incluye `header.php` (head + nav + apertura de `main`).
5. Se renderiza contenido específico de página.
6. Se incluye `footer.php` (pie + cierre de `main`).

Notas:

- No hay consultas a BD.
- El tiempo de render depende solo de I/O de archivos y lógica en memoria.

## 2) Formulario de contacto (flujo PRG)

Endpoint de procesamiento: `POST /api/contacto.php`

Secuencia real:

1. `contacto.php` renderiza formulario con CSRF token en sesion.
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

## 3) Galería progresiva (hybrid no-JS/JS)

1. `galeria.php` renderiza un primer lote (10) de galería hogar.
2. Sin JS: el enlace "Cargar más" usa fallback por query string (`hogar_limit`).
3. Con JS: `main.js` intercepta clic y consume `/api/galeria-hogar.php?offset=...&limit=...`.
4. El endpoint devuelve JSON con `items`, `nextOffset`, `total`.
5. El cliente inserta `<figure>` dinámicamente y actualiza estado `aria-live`.

Limites operativos:

- Tope de visualización hogar en servidor: 35 ítems.
- El endpoint limita `limit` máximo a 50.

## 4) Consentimiento de embeds externos (server-side)

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

## 5) SEO técnico y sitemap

- Canonical por página: se define como `$canonicalUrl = MADAYA_SITE_URL . '/ruta/'`.
- `header.php` inyecta `<link rel="canonical">` cuando existe variable.
- `scripts/generate-sitemap.php` recorre `*.php`, extrae canonical por regex y genera `sitemap.xml`.
- `robots.txt` publica `Sitemap: https://ecomadaya.es/sitemap.xml`.

## 6) Datos estructurados

- Global: JSON-LD tipo `LocalBusiness` en `header.php` con `additionalType` = `FurnitureRepair` (incluye dirección, horario, `aggregateRating`, etc.).
- Específico: `preguntas-frecuentes.php` añade JSON-LD `FAQPage`.

## Configuración y entorno

## Detección de entorno

- `APP_ENV` se obtiene por `getenv`, `$_ENV`, `$_SERVER` o autodetección por host.
- Hosts locales (`localhost`, `127.0.0.1`, `::1`, `*.local`, `*.test`) se marcan como `development`; resto `production`.

## Configuración SMTP

Variables soportadas:

- `MADAYA_SMTP_ENABLED`, `MADAYA_SMTP_HOST`, `MADAYA_SMTP_PORT`, `MADAYA_SMTP_ENCRYPTION`, `MADAYA_SMTP_USERNAME`, `MADAYA_SMTP_PASSWORD`, `MADAYA_SMTP_FROM_EMAIL`, `MADAYA_SMTP_FROM_NAME`, `MADAYA_SMTP_TIMEOUT`, `MADAYA_SMTP_DEBUG`, `MADAYA_SMTP_AUTH`

## Modelo de seguridad actual

- Sin BD y sin panel admin público.
- Validación server-side obligatoria en formulario.
- Protecciones anti-abuso en contacto: CSRF + honeypot + rate limit por sesión.
- Escape de salida en valores y mensajes del formulario (`htmlspecialchars`).
- Credenciales SMTP fuera del repo (variables de entorno).
- Separación de código interno (`app/includes`) respecto al código público.

## Estado operativo real (marzo 2026)

Completado en código:

- Sitio multipágina estable con parciales compartidos.
- Formulario de contacto v1 activo con PRG y transporte SMTP por PHPMailer.
- Galería progresiva con fallback no-JS.
- SEO base (title, description, canonical, Open Graph, robots, sitemap).
- Documentación legal publicada.

Pendiente de operación/despliegue:

- Pipeline CI/CD GitHub Actions -> SFTP (no existe workflow en `.github/workflows/`).
- Configuración final de variables SMTP en hosting Arsys.
- Validación de redirecciones 301 desde WordPress previo.
- Auditoría final Lighthouse/axe en entorno de producción.

## Riesgos y deuda técnica

1. `.htaccess` está en la raíz del proyecto.
2. El patrón del menú móvil usa `input[type="checkbox"]`, funcional sin JS pero con deuda semántica accesible frente a un botón de menú.
3. Hay desalineación parcial entre documentos de `docs/` (algunos en plantilla/PENDIENTE) y estado real del código.
4. Faltan automatizaciones de despliegue y rollback documentado ejecutable.

## Recomendaciones expertas (priorizadas)

## Alta prioridad (antes de producción)

1. Definir estrategia de rutas limpias y redirecciones 301 en Apache.
2. Crear pipeline CI/CD reproducible (build + deploy SFTP + smoke checks).
3. Ejecutar prueba E2E de contacto en Arsys con SMTP real y logging controlado.
4. Consolidar runbook de rollback con pasos verificables y tiempos objetivo.

## Media prioridad

1. Reducir deuda semántica del menú móvil (patrón accesible equivalente no-JS o botón con mejora robusta).
2. Incorporar validaciones operativas adicionales al endpoint de contacto:
  - límite por IP (además de sesión)
  - registro de intentos fallidos con nivel de severidad
3. Añadir chequeo de integridad automatizado para sitemap/canonical en CI.
4. Unificar docs que siguen en estado "PENDIENTE" para que reflejen arquitectura actual.

## Baja prioridad

1. Evolucionar a versionado semántico de releases y changelog operativo por despliegue.
2. Evaluar cache headers para estáticos cuando se cierre infraestructura final en Arsys.
3. Si se incorpora analítica, diseñar desde inicio el flujo de consentimiento y su impacto legal/SEO.

## Resumen ejecutivo

La arquitectura actual es coherente para un sitio PHP multipágina sin framework, con buena base de seguridad en formulario, mejora progresiva en frontend y SEO técnico funcional. El principal gap no está en la capa de código de negocio, sino en la capa operativa: despliegue automatizado, estrategia de URL/redirects en Apache y cierre de runbooks para producción.
