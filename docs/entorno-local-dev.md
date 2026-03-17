# Entorno de Desarrollo Local

- Ultima actualizacion: 2026-03-17
- Aplicable a: Windows (XAMPP) y Linux (Apache nativo)
- Objetivo: reproducir el entorno de pruebas SMTP local en cualquier maquina

## Requisitos previos

- PHP 8.0 o superior
- Apache con mod_env activo
- Composer
- Mailpit (capturador SMTP local)

---

## Windows (XAMPP)

### 1. Instalar XAMPP

Descargar desde https://www.apachefriends.org e instalar en `C:\xampp`.

### 2. Instalar Mailpit

Mailpit no requiere instalacion como servicio; basta con tener el binario.

**Opcion A: descarga directa (recomendada)**

1. Ir a https://github.com/axllent/mailpit/releases
2. Descargar `mailpit-windows-amd64.zip`
3. Descomprimir en `C:\tools\mailpit\`

**Opcion B: instalar con Go (si tienes Go >= 1.25)**

```powershell
$env:GOTOOLCHAIN = 'auto'
go install github.com/axllent/mailpit@latest
# Binario en: C:\Users\<tu_usuario>\go\bin\mailpit.exe
```

### 3. Levantar Mailpit

```powershell
C:\tools\mailpit\mailpit.exe --smtp 127.0.0.1:1025 --listen 127.0.0.1:8025
```

UI accesible en http://127.0.0.1:8025

Dejar esta terminal abierta durante las pruebas. Para cerrar: `Ctrl+C`.

### 4. Configurar VirtualHost en XAMPP

**Opcion recomendada: servir `public/` como raiz web**

Editar `C:\xampp\apache\conf\extra\httpd-vhosts.conf` y anadir:

```apache
<VirtualHost *:80>
    ServerName ecomadaya.local
    DocumentRoot "C:/xampp/htdocs/ecomadaya/public"

    <Directory "C:/xampp/htdocs/ecomadaya/public">
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog "logs/ecomadaya-error.log"
    CustomLog "logs/ecomadaya-access.log" common
</VirtualHost>
```

Anadir dominio local al archivo `hosts` (como Administrador):

```
C:\Windows\System32\drivers\etc\hosts
```

Anadir la linea:

```
127.0.0.1 ecomadaya.local
```

### 5. Configurar variables de entorno SMTP en Apache

Anadir al final de `C:\xampp\apache\conf\httpd.conf`:

```apache
# --- Web Madaya: entorno local SMTP (Mailpit) ---
SetEnv APP_ENV development
SetEnv MADAYA_SMTP_ENABLED 1
SetEnv MADAYA_SMTP_HOST 127.0.0.1
SetEnv MADAYA_SMTP_PORT 1025
SetEnv MADAYA_SMTP_ENCRYPTION none
SetEnv MADAYA_SMTP_AUTH 0
SetEnv MADAYA_SMTP_USERNAME test
SetEnv MADAYA_SMTP_PASSWORD test
SetEnv MADAYA_SMTP_FROM_EMAIL no-reply@ecomadaya.local
SetEnv MADAYA_SMTP_FROM_NAME "Web Madaya"
SetEnv MADAYA_SMTP_TIMEOUT 15
SetEnv MADAYA_SMTP_DEBUG 0
# --- fin Web Madaya ---
```

Nota importante: `MADAYA_SMTP_AUTH 0` es necesario porque Mailpit no requiere autenticacion.
En produccion no definir esta variable (el valor por defecto es autenticacion activa).

### 6. Reiniciar Apache

Usar el panel de XAMPP: **Stop** completo y luego **Start**.
Evitar el boton Restart porque a veces no recarga `SetEnv`.

### 7. Instalar dependencias PHP

```powershell
cd C:\xampp\htdocs\ecomadaya
composer install
```

### 8. Verificar entorno

Crear temporalmente `public/debug-env.php`:

```php
<?php
header('Content-Type: text/plain');
echo 'SMTP_PORT=' . (getenv('MADAYA_SMTP_PORT') ?: 'NO_DEFINIDO') . "\n";
echo 'SMTP_HOST=' . (getenv('MADAYA_SMTP_HOST') ?: 'NO_DEFINIDO') . "\n";
echo 'SMTP_AUTH=' . (getenv('MADAYA_SMTP_AUTH') ?: 'NO_DEFINIDO') . "\n";
echo 'APP_ENV='   . (getenv('APP_ENV') ?: 'NO_DEFINIDO') . "\n";
```

Abrir http://ecomadaya.local/debug-env.php y verificar los valores.
**Borrar este archivo inmediatamente despues de verificar.**

### 9. Ver logs de errores SMTP

```
C:\xampp\apache\logs\error.log
```

Buscar prefijo: `[contacto][smtp]`

---

## Linux (Apache nativo)

### 1. Instalar Apache y PHP

```bash
sudo apt update
sudo apt install apache2 php php-mbstring php-openssl libapache2-mod-php
sudo a2enmod env rewrite
sudo systemctl restart apache2
```

### 2. Instalar Composer

```bash
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
```

### 3. Instalar Mailpit

```bash
# Descarga el binario oficial para Linux amd64
curl -LO https://github.com/axllent/mailpit/releases/latest/download/mailpit-linux-amd64.tar.gz
tar xzf mailpit-linux-amd64.tar.gz
sudo mv mailpit /usr/local/bin/mailpit
```

Levantar Mailpit:

```bash
mailpit --smtp 127.0.0.1:1025 --listen 127.0.0.1:8025 &
```

UI en http://127.0.0.1:8025

Para detenerlo:

```bash
pkill mailpit
```

### 4. Configurar VirtualHost en Apache

Crear `/etc/apache2/sites-available/ecomadaya.conf`:

```apache
<VirtualHost *:80>
    ServerName ecomadaya.local
    DocumentRoot /var/www/ecomadaya/public

    <Directory /var/www/ecomadaya/public>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>

    SetEnv APP_ENV development
    SetEnv MADAYA_SMTP_ENABLED 1
    SetEnv MADAYA_SMTP_HOST 127.0.0.1
    SetEnv MADAYA_SMTP_PORT 1025
    SetEnv MADAYA_SMTP_ENCRYPTION none
    SetEnv MADAYA_SMTP_AUTH 0
    SetEnv MADAYA_SMTP_USERNAME test
    SetEnv MADAYA_SMTP_PASSWORD test
    SetEnv MADAYA_SMTP_FROM_EMAIL no-reply@ecomadaya.local
    SetEnv MADAYA_SMTP_FROM_NAME "Web Madaya"
    SetEnv MADAYA_SMTP_TIMEOUT 15
    SetEnv MADAYA_SMTP_DEBUG 0

    ErrorLog ${APACHE_LOG_DIR}/ecomadaya-error.log
    CustomLog ${APACHE_LOG_DIR}/ecomadaya-access.log combined
</VirtualHost>
```

Activar el site y recargar:

```bash
sudo a2ensite ecomadaya
sudo systemctl reload apache2
```

Anadir dominio local en `/etc/hosts`:

```
127.0.0.1 ecomadaya.local
```

### 5. Colocar el proyecto

```bash
sudo mkdir -p /var/www/ecomadaya
sudo cp -r /ruta/al/repo/* /var/www/ecomadaya/
cd /var/www/ecomadaya
composer install
```

### 6. Permisos

```bash
sudo chown -R www-data:www-data /var/www/ecomadaya
sudo chmod -R 755 /var/www/ecomadaya
```

### 7. Ver logs de errores SMTP

```bash
tail -f /var/log/apache2/ecomadaya-error.log | grep '\[contacto\]'
```

---

## Bateria de pruebas a ejecutar tras montar el entorno

Ver seccion completa en `docs/testing-manual.md`.

Resumen minimo:

| # | Prueba | Esperado |
|---|--------|----------|
| 1 | Envio formulario valido | Exito en web + correo en Mailpit |
| 2 | Email invalido | Error de validacion, sin correo |
| 3 | Sin consentimiento | Error de validacion, sin correo |
| 4 | Refrescar tras exito (F5) | Sin duplicado en Mailpit (PRG) |
| 5 | Puerto SMTP incorrecto | Mensaje de contingencia, sin correo |
| 6 | Restaurar puerto y reenviar | Exito confirmado |

---

## Notas de seguridad

- `MADAYA_SMTP_AUTH 0` solo para Mailpit local. Nunca en produccion.
- Borrar `debug-env.php` inmediatamente despues de usarlo.
- No subir al repositorio archivos con credenciales reales.
- `vendor/` no se sube al repositorio (esta en `.gitignore`).
