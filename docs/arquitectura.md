# Arquitectura

- Ultima actualizacion: PENDIENTE
- Responsable: PENDIENTE
- Proxima revision: PENDIENTE

## Objetivo tecnico

Describir como esta construido el sitio, sin depender del conocimiento de una sola persona.

## Stack y principios

- Lenguaje/stack: PHP 8+ (entorno actual de desarrollo: PHP 8.4.11) + HTML + CSS + JS opcional
- Frameworks: PENDIENTE DE CONFIRMAR
- Librerias externas: PENDIENTE DE CONFIRMAR
- Principios clave: accesibilidad, SEO tecnico, simplicidad

## Estructura del proyecto

Completar con explicacion breve de cada ruta relevante.

```text
/
  public/                       # Raiz publica en hosting (DocumentRoot)
    index.php
    servicios.php
    galeria.php
    contacto.php
    quienes-somos.php
    ...
    assets/
    robots.txt
    sitemap.xml
    .htaccess
  app/
    includes/                   # Codigo PHP compartido fuera de publico
      bootstrap.php
      header.php
      footer.php
      gallery-service.php
  docs/
  LICENSE
  NOTICE
```

## Flujo de renderizado

Las paginas publicas en `public/*.php` cargan parciales compartidos desde `app/includes` mediante rutas de sistema (`__DIR__`), manteniendo estos ficheros fuera de la carpeta expuesta por Apache.

Los recursos estaticos se sirven desde `public/assets` usando rutas web absolutas (`/assets/...`).

## Decisiones tecnicas importantes

Registrar decisiones de arquitectura y enlazar ADRs cuando aplique.

- Decision 1: PENDIENTE
- Decision 2: PENDIENTE

## Riesgos conocidos

- PENDIENTE

## Preguntas abiertas

- Integracion de analitica: no definida aun (podria impactar cookies y consentimiento)
