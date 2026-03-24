# Madaya – PHP Estático | Tapicería Ecológica

**Última actualización:** 2026-03-20 | **Responsable:** usuario (nazaret)

## Stack Técnico

- **Lenguaje:** PHP 8+ (actual 8.4.11 en local, 8.2 en Arsys)
- **Frontend:** HTML5, CSS3, JS (sin dependencias críticas)
- **Frameworks:** Ninguno | **Librerías:** PHPMailer (Composer, solo vendor)
- **BD:** No | **Alojar:** Arsys (plan WP Básico confirmado ✅)
- **CI/CD:** GitHub Actions → SFTP a Arsys
- **Principios:** Accesibilidad WCAG AA, SEO orgánico, simplicidad

## Estructura del Código

```
/public/                      # DocumentRoot (Apache)
  *.php (10+ páginas)         # index, servicios, galeria, contacto, legal, etc.
  /assets (css, js, img, icons)
  /api                        # Endpoints (galería)
/app/includes/               # Parciales (fuera de public)
  bootstrap.php              # Config centralizada
  header.php, footer.php     # Parciales reutilizables
  contact-form.php           # Lógica del formulario
  mail-transport.php         # PHPMailer (SMTP)
  gallery-service.php        # Lógica de galería
/docs/                       # Documentación técnica
  README.md, arquitectura.md, seo.md, accesibilidad.md,
  despliegue-y-entornos.md, deploy-arsys-runbook.md,
  contacto.md, testing-manual.md, adr/, etc.
/scripts/                    # Utilidades (generate-sitemap.php)
```

## Negocio

**Empresa:** Tapicería y restauración de muebles (enfoque ecológico)  
**Público:** Particulares, pymes, organismos públicos en Tenerife  
**Propuesta de valor:** Materiales eco-friendly + servicio artesanal + reparación antes que compra nueva  
**Servicios:** Restauración, tapicería habitual, fabricación a medida (particulares y empresas)  
**Tono:** Cercano/profesional para particulares; técnico/eficiente para empresas

## Estado Actual (Marzo 2026)

✅ **Completado en producción:**
- Estructura multipágina completa en `/public` (10+ páginas)
- Paginas principales: index, servicios, galería, contacto, quienes-somos
- Paginas legales: preguntas-frecuentes, política-privacidad, política-cookies, aviso-legal, condiciones-servicio
- Parciales reutilizables en `/app/includes` (header, footer, bootstrap)
- Formulario de contacto v1: validación server-side, CSRF, honeypot, rate limit ✅ ACTIVO
- Transporte de correo: PHPMailer + SMTP autenticado ✅ MIGRADO
- Meta tags, canonical, Open Graph, robots.txt, sitemap.xml
- Accesibilidad: h1 único, navegación por teclado, foco visible, aria-*, labels en formularios
- Configuración centralizada + bootstrap.php con constantes de entorno

⚠️ **Pendientes antes de producción:**
- [ ] Configurar GitHub Actions + SFTP a hosting Arsys (requiere tokens/credenciales Arsys)
- [ ] Configurar variables de entorno SMTP en panel Arsys
- [ ] Plan de redirecciones 301 desde WordPress anterior
- [ ] Auditoría final: Lighthouse + axe (accesibilidad/SEO/performance)
- [ ] Testing manual: checklist de navegación, formularios, assets

## Confirmaciones de Arsys (2026-03-20)

✅ Plan WP Básico soporta: PHP + SMTP autenticado + acceso SFTP  
✅ Certificado SSL permanecerá activo (ecomadaya.es)  
✅ No requiere cambio de plan  

## Seguridad

- `/app/` fuera de DocumentRoot (no accesible vía web)
- Credenciales SMTP: variables de entorno del panel (nunca en repo)
- Formulario: validación server-side + CSRF + honeypot + rate limit

## Referencias de Documentación

- **Contexto técnico detallado:** `/memories/repo/proyecto-madaya-contexto-tecnico.md` (para agentes)
- **Arquitectura:** `/docs/arquitectura.md`
- **Despliegue:** `/docs/deploy-arsys-runbook.md` + `/docs/despliegue-y-entornos.md`
- **Accesibilidad:** `/docs/accesibilidad.md` (WCAG AA)
- **SEO:** `/docs/seo.md` (meta tags, canonical, on-page)
- **Formulario & contacto:** `/docs/contacto.md` + `/docs/testing-manual.md`
- **ADRs:** `/docs/adr/` (decisiones registradas)
