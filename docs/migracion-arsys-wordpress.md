# Migracion WordPress a Sitio PHP en Arsys

- Ultima actualizacion: 2026-03-10
- Responsable: PENDIENTE
- Proxima revision: antes del primer despliegue

## Objetivo

Definir una migracion segura para sustituir WordPress por el nuevo sitio, minimizando riesgo tecnico y perdida SEO.

## Recomendacion de estrategia

Para tu caso (sin staging contratado), la estrategia mas segura es:

1. Crear copia de seguridad completa de WordPress (archivos + base de datos).
2. Preparar en local el nuevo sitio con estructura final.
3. Realizar despliegue por ventana de cambio corta.
4. Mantener posibilidad de rollback inmediato restaurando backup.

No es necesario cambiar de tipo de servicio si Arsys ya soporta PHP 8+ y acceso FTP/gestor de archivos.

## Pre-check en Arsys

- Confirmar version de PHP disponible en produccion (ideal 8.2+).
- Confirmar que `.htaccess` funciona en el hosting (Apache).
- Confirmar espacio disponible y limites de archivos.

## Pasos propuestos

1. Exportar backup completo del WordPress actual.
2. Descargar copia local de `public_html` (o raiz web equivalente).
3. Guardar reglas actuales de `.htaccess` para referencia.
4. Subir nueva estructura de carpetas y archivos del proyecto.
5. Configurar `.htaccess` nuevo (redirecciones y reglas minimas).
6. Verificar rutas criticas y formularios.
7. Validar `robots.txt` y `sitemap.xml`.
8. Activar monitorizacion post-cambio (24-72h).

## Rollback rapido

Si algo falla:

1. Restaurar archivos WordPress desde backup.
2. Restaurar base de datos WordPress.
3. Reponer `.htaccess` original.
4. Validar home y paginas clave.

## SEO y continuidad

- Preparar mapeo de URLs antiguas de WordPress a nuevas URLs.
- Añadir redirecciones 301 en `.htaccess`.
- Revisar Search Console despues del cambio.

## Datos necesarios para ejecutar migracion (cuando quieras que te ayude paso a paso)

- Ruta raiz real del hosting en Arsys (por ejemplo `public_html`).
- Version de PHP disponible en el panel de Arsys.
- Acceso FTP/SFTP y si tienes gestor de archivos web.
- Dominio principal y variantes (`www` y sin `www`).
- Lista de URLs WordPress actuales mas importantes (top trafico).
- Ventana horaria en la que quieras hacer el cambio.
