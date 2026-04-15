# Madaya - Sitio web multipágina PHP

Sitio web corporativo de Madaya (tapicería y restauración ecológica en Tenerife), construido con PHP server-rendered, sin base de datos y con foco en accesibilidad y SEO.

Sitio en producción: https://ecomadaya.es

## Estado actual

- Sitio operativo en producción.
- Flujo principal de desarrollo en rama dev.
- Despliegue objetivo: CI/CD con GitHub Actions y publicación automática por SFTP al hacer push en main.

## Stack técnico

- PHP 8+
- HTML5 + CSS3 + JavaScript vanilla
- PHPMailer para envío SMTP autenticado
- Sin framework ni base de datos

## Estructura del proyecto

```text
*.php                         # Páginas públicas (raíz del sitio)
api/                          # Endpoints públicos
assets/                       # CSS, JS, imágenes, iconos, fuentes
app/includes/                 # Lógica interna y parciales
scripts/                      # Utilidades locales (ej. sitemap)
docs/                         # Documentación técnica
vendor/                       # Dependencias Composer
robots.txt
sitemap.xml
LICENSE
NOTICE
```

## Requisitos

- PHP 8.0 o superior
- Composer
- Apache con mod_rewrite y mod_env
- Opcional para pruebas de correo local: Mailpit

## Desarrollo local

1. Clonar repositorio y entrar al proyecto.

```bash
git clone https://github.com/duquediazn/ecomadaya.git
cd ecomadaya
```

2. Instalar dependencias.

```bash
composer install
```

3. Definir entorno de desarrollo.

- Linux/macOS:

```bash
export APP_ENV=development
```

- Windows PowerShell:

```powershell
$env:APP_ENV = "development"
```

- Windows CMD:

```cmd
set APP_ENV=development
```

4. Levantar servidor local desde la raíz del proyecto.

```bash
php -S localhost:8000
```

5. Abrir http://localhost:8000

Más detalle en [docs/entorno-local-dev.md](docs/entorno-local-dev.md).

## Variables de entorno

Las credenciales nunca se versionan. Se configuran en entorno seguro (hosting y/o GitHub Secrets).

| Variable | Descripción |
|---|---|
| APP_ENV | development o production |
| MADAYA_SMTP_ENABLED | Activa envío SMTP (1/true/yes/on) |
| MADAYA_SMTP_HOST | Host SMTP |
| MADAYA_SMTP_PORT | Puerto SMTP |
| MADAYA_SMTP_ENCRYPTION | tls, ssl o none |
| MADAYA_SMTP_AUTH | Activa autenticacion SMTP |
| MADAYA_SMTP_USERNAME | Usuario SMTP |
| MADAYA_SMTP_PASSWORD | Password SMTP |
| MADAYA_SMTP_FROM_EMAIL | Remitente |
| MADAYA_SMTP_FROM_NAME | Nombre remitente |
| MADAYA_SMTP_TIMEOUT | Timeout SMTP |
| MADAYA_SMTP_DEBUG | Nivel debug PHPMailer |

## Scripts Composer útiles

```bash
composer sitemap
```

## Seguridad

- Validación server-side en formulario de contacto.
- Protecciones CSRF + honeypot + rate limit.
- app/ y vendor/ protegidos en hosting mediante reglas de servidor.
- Sin secretos en repositorio.

## Accesibilidad y SEO

- Criterios WCAG 2.1 AA aplicados.
- Canonical, Open Graph, robots.txt, sitemap.xml y JSON-LD.

## CI/CD y despliegue

Objetivo operativo:

1. Los cambios se integran en dev.
2. Se hace squash/merge hacia main.
3. Un workflow de GitHub Actions en main construye artefacto y despliega por SFTP a Arsys.
4. Se ejecutan smoke checks al finalizar.

Credenciales y valores sensibles se guardan en GitHub Actions Environment production.

## Documentación técnica

- [docs/arquitectura.md](docs/arquitectura.md)
- [docs/accesibilidad.md](docs/accesibilidad.md)
- [docs/seo.md](docs/seo.md)
- [docs/convenciones-codigo.md](docs/convenciones-codigo.md)
- [docs/legal-y-cumplimiento.md](docs/legal-y-cumplimiento.md)

## Licencia

Código bajo GPL-3.0-or-later. Ver [LICENSE](LICENSE).

Activos de marca, imágenes y contenido comercial: derechos reservados. Ver [NOTICE](NOTICE).
