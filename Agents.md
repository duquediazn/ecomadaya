# Web Madaya – Contexto del Proyecto

## 1. Objetivo del proyecto
**Contexto:** Madaya es un sitio web estático en contrucción en PHP para un negocio real: tapicería de muebles con enfoque ecológico. 
**Objetivo principal:** El objetivo principal es terminar de contruir el sitio web con especial énfassis en los prinicpios de accesibilidad, usabilidad y SEO orgánico.

### Estructura del proyecto
- /public (paginas publicas y recursos web)
    - index.php
    - servicios.php
    - galeria.php
    - contacto.php
    - quienes-somos.php
    - aviso-legal.php
    - politica-privacidad.php
    - politica-cookies.php
    - condiciones-servicio.php
    - preguntas-frecuentes.php
    - /assets
        - /css/main.css
        - /js/main.js
        - /img
        - /icons
    - /api (endpoints actuales de galeria)
- /app/includes (parciales y bootstrap)
    - bootstrap.php
    - header.php
    - footer.php
    - gallery-service.php
- /docs (especificaciones, runbooks y mantenimiento)
- .gitignore
- README.md
- LICENSE

## 2. Público objetivo
La web va dirigida al público general y empresas (autónomos, pymes, etc.), así como a organismos públicos.

## 3. Propuesta de valor
Madaya se diferencia como tapicería y restauración de muebles en su enfoque centrado particularmente en el uso de materiales ecológicos siempre que sea posible. También poniendo en valor el carácter ecológico de la profesión en sí misma: reparar antes que comprar nuevo y tirar. Para ello ofrece un catálogo de telas de alta calidad con propiedades diseñadas con tecnologías anti mancha, eco-friendly y protecciones higiénicas (anti ácaros y anti virus)

## 4. Servicios
- Tapicería y restauración de muebles habitual para particulares y empresas: sofás, sillas, butacas, cabeceros... cualquier mueble clásico o moderno. Incluyendo muebles de armazón metálico y no de madera.
- Fabricación a medida para particulares: cabeceros, colchones plegables para furgonetas camperizadas, etc. 
- Fabricación a medida para empresas y organismos públicos: fabricación de protectores para canchas deportivas, fabricación de módulos de asientos a medida para negocios, cortinaje, toldos, etc.

## 5. Estrategia de la web
El sitio está pensado para ser multipágina con la estructura planteada en la sección de este documento "Estructura del proyecto". Pero se plantearán posibles modificaciones según se avance en la construcción del mismo. La idea es convencer a los visitantes de contratar los servicios que la página ofrece explorando las estrategias que mejor se alineen con la filosofía de la empresa y del sitio, citadas en el punto 1, "Objetivo del proyecto".

## 6. Tono y comunicación
Preferiblemente un tono cercano pero profesional a clientes particulares, pero más técnico y enfocado en eficiencia y resultados en los apartados dirigidos a empresas y organismos públicos. 

## 7. Decisiones técnicas
- Stack: PHP, HTML, CSS y JS opcional pero nada crucial debe depender de JS. 
- Frameworks: No
- Librerías: Intentar evitar.
- SEO orgánico/técnico
- Accesibilidad aplicada desde cero

## 8. Decisiones de diseño
El diseño debe estar centrado en accesbilidad, pero debe también resultar suave y elegante para el usuario.
Los estilos principales se encuentran en main.css (aún pendiente de revisiones y nuevas adiciones)

## 9. Estado actual del proyecto
Estado actualizado (marzo 2026):

- Estructura multipagina consolidada en `/public` con parciales compartidos en `/app/includes`.
- Paginas principales en produccion de contenido: `index.php`, `servicios.php`, `galeria.php`, `contacto.php`.
- `contacto.php` redisenada con enfoque de conversion y accesibilidad:
    - canales de contacto priorizados,
    - horario + mapa semanticos,
    - CTA principal de presupuesto por WhatsApp,
    - seccion de soporte a FAQ.
- Mejoras de accesibilidad aplicadas en header/footer y paginas principales:
    - foco visible,
    - navegacion por teclado mejorada,
    - enlaces externos con `rel="noopener noreferrer"`,
    - iframes con `title`,
    - uso de `time`, `address` y jerarquia semantica.
- SEO tecnico parcialmente actualizado:
    - canonical por pagina,
    - datos Open Graph actualizados,
    - documentacion SEO ampliada en `/docs/seo.md`.
- Configuracion centralizada en `bootstrap.php` para datos de negocio y entorno.

Pendientes relevantes:

- Completar contenido de `preguntas-frecuentes.php`.
- Completar `politica-privacidad.php` y resto legal pendiente.
- Implementar formulario de contacto (ya especificado en docs, aun no desarrollado).
- Ejecutar bateria final de pruebas manuales y auditoria automatica de accesibilidad/SEO antes de cierre.
