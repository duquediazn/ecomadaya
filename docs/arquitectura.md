# Arquitectura

- Ultima actualizacion: 2026-03-20
- Responsable: usuario (nazaret)
- Proxima revision: tras completar despliegue a produccion y auditorias finales

## Objetivo tecnico

Describir como esta construido el sitio, sin depender del conocimiento de una sola persona.

## Stack y principios

- Lenguaje/stack: PHP 8+ (entorno actual de desarrollo: PHP 8.4.11, produccion: PHP 8.2 en Arsys) + HTML5 + CSS3 + JS (mejora progresiva, no critico)
- Frameworks: Ninguno
- Librerias externas: PHPMailer (Composer, solo en vendor/)
- Principios clave: accesibilidad WCAG AA, SEO tecnico, simplicidad, sin dependencias criticas

## Estructura del proyecto

```text
/
  public/                       # DocumentRoot en hosting Apache
    index.php, servicios.php, galeria.php, contacto.php, quienes-somos.php
    preguntas-frecuentes.php, aviso-legal.php, politica-privacidad.php
    politica-cookies.php, condiciones-servicio.php
    robots.txt, sitemap.xml, .htaccess
    /assets/css/, /assets/js/, /assets/img/, /assets/icons/
    /api/contacto.php, galeria-hogar.php
  app/includes/                 # Codigo PHP compartido (fuera de public)
    bootstrap.php               # Config centralizada + constantes
    header.php, footer.php      # Parciales reutilizables
    contact-form.php            # Logica validacion formulario
    mail-transport.php          # PHPMailer + SMTP autenticado
    gallery-service.php         # Logica galeria dinamica
  docs/                         # Documentacion tecnica y operativa
  vendor/                       # Dependencias Composer (no en repo)
  scripts/                      # Scripts auxiliares
  LICENSE, NOTICE, README.md, composers.json
```

## Flujo de renderizado

1. **Paginas publicas** (`public/*.php`) requieren `bootstrap.php` para:
   - Definir constantes de aplicacion (email, telefonos, URL base, etc.)
   - Crear variables reutilizables (ej: URLs de WhatsApp, Google Reviews, etc.)
   - Cargar parciales compartidos (header, footer)

2. **Parciales reutilizables** (`app/includes/*.php`) cargan desde rutas de sistema (`__DIR__`), manteniendose fuera de la carpeta expuesta por Apache.

3. **Recursos estaticos** (`public/assets/**/*`) se sirven directamente por Apache con rutas web absolutas (`/assets/...`).

4. **APIs internas** (`public/api/*.php`) manejan logica dinamica (galeria, contacto) y responden JSON o redirigen.

5. **Acceso web prohibido** a:
   - `/app/` (protegido fuera de DocumentRoot)
   - `/docs/` (fuera de DocumentRoot)
   - `vendor/` (fuera de DocumentRoot)
   - Archivos de configuracion `.htaccess`

## Decisiones tecnicas importantes

- **ADR-001**: Usar PHP puro sin frameworks (simplicity, zero build time, bajo TCO)
- **ADR-002**: Parciales compartidos fuera de public (seguridad, reutilizacion)
- **ADR-003**: Configuracion centralizada en bootstrap.php (mantenibilidad, entornos)
- **ADR-004**: Formulario v1 con validacion obligatoria server-side (sin JS es critico)
- **ADR-005**: PHPMailer + SMTP autenticado en lugar de mail() (confiabilidad, trazabilidad)
- **ADR-006**: Favicon + Open Graph en todas las paginas (SEO, UX)

## Flujo de formulario de contacto

Endpoint: `POST /api/contacto.php`

1. Client (navegador) envia `{ nombre, email, telefono?, mensaje, consentimiento }`
2. `public/api/contacto.php` valida y sanitiza con `contact-form.php`
3. Protecciones: CSRF token + honeypot + rate limit por sesion
4. Si valido, envia correo con `mail-transport.php` (PHPMailer + SMTP)
5. Responde JSON o redirige con mensaje flash si error
6. UX accesible: resumen de errores, `aria-live`, foco dirigido

## Riesgos conocidos

- URLs limpias en produccion dependen de reglas `.htaccess` (validar ante cambios Apache)
- Variables de entorno SMTP requieren acceso a panel Arsys (no es CI/CD, sino configuracion manual)
- Google Analytics aun no integrado (sera decision posterior sobre cookies/consentimiento)

## Preguntas abiertas

- Integracion de Google Analytics o herramienta analitisca (impactaria cookies y RGPD)
- Plan de redirecciones completo desde WordPress anterior
- Auditorias de performance/accesibilidad/SEO finales antes de produccion
