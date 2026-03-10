# Servicio de Galeria (`includes/gallery-service.php`)

- Ultima actualizacion: 2026-03-10
- Responsable: Equipo de desarrollo
- Proxima revision: 2026-04-10

## Objetivo

Documentar el comportamiento del servicio de galeria que construye el listado de imagenes para renderizado, validando estructura de archivos, descripciones y coherencia entre miniaturas y versiones grandes.

## Resumen funcional

El archivo `includes/gallery-service.php` concentra funciones puras de soporte para:

- Detectar entorno de desarrollo.
- Registrar logs de diagnostico solo en desarrollo.
- Listar y ordenar imagenes validas por extension/fecha.
- Cargar descripciones desde JSON.
- Resolver descripcion por archivo con fallback.
- Construir items finales de galeria con metrica de descartes.

## Funciones

### `isDevelopmentEnvironment(): bool`

Responsabilidad:

- Determina si el entorno actual debe considerarse de desarrollo.

Comportamiento:

- Lee `APP_ENV` si esta definida.
- Normaliza el valor (`trim` + minusculas).
- Devuelve `true` para: `dev`, `development`, `local`, `test`, `testing`.
- Si `APP_ENV` no existe, asume `production`.

Uso practico:

- Evitar logs verbosos o mensajes internos en produccion.

### `logIfDevelopment(string $message): void`

Responsabilidad:

- Escribir en `error_log` un mensaje de diagnostico solo cuando el entorno es de desarrollo.

Comportamiento:

- Evalua `isDevelopmentEnvironment()`.
- Si devuelve `true`, ejecuta `error_log($message)`.

Uso practico:

- Centralizar logging condicional para no repetir ifs en el resto del servicio.

### `galleryImagesList(string $dir, array $allowedExtensions): array`

Responsabilidad:

- Devolver archivos de imagen validos dentro de un directorio, filtrados por extension y ordenados por fecha de modificacion descendente.

Comportamiento:

- Verifica que el directorio exista y sea legible.
- Lee contenido con `scandir`.
- Filtra solo archivos reales (`is_file`) con extension permitida.
- Ordena con `usort` por `filemtime` (mas reciente primero).
- En empate de fecha, usa `strcmp` por nombre para orden estable.
- Si hay error de acceso/lectura, devuelve `[]` y registra aviso en desarrollo.

Entrada esperada:

- `dir`: ruta fisica del directorio de imagenes.
- `allowedExtensions`: lista en minusculas, por ejemplo `['jpg', 'jpeg', 'png', 'webp']`.

Salida:

- `string[]` con nombres de archivo (sin ruta), indexados.

### `loadImageDescriptions(string $jsonPath): array`

Responsabilidad:

- Cargar un mapa opcional de descripciones por nombre de archivo desde JSON.

Comportamiento:

- Si el archivo no existe o no es legible, devuelve `[]`.
- Lee el JSON con `file_get_contents`.
- Decodifica con `json_decode(..., true)`.
- Filtra pares validos donde clave y valor son `string` y la descripcion no queda vacia tras `trim`.
- Si hay error de lectura/parseo, devuelve `[]` y loguea aviso en desarrollo.

Formato esperado:

```json
{
  "ejemplo_small.webp": "Descripcion breve y util"
}
```

### `getImageDescription(string $fileName, array $descriptionsMap): string`

Responsabilidad:

- Obtener descripcion para una imagen concreta, con valor por defecto si no existe.

Comportamiento:

- Si `descriptionsMap[fileName]` existe y no esta vacio, devuelve esa cadena.
- En otro caso devuelve fallback: `Trabajo de tapiceria`.

Impacto:

- Garantiza texto no vacio para UI, SEO y accesibilidad, aunque se recomienda descripcion especifica por imagen.

### `buildGalleryItems(string $dirSmall, string $dirLarge, array $allowedExtensions, string $descriptionsPath): array`

Responsabilidad:

- Construir la estructura final de items consumible por la vista de galeria, validando correspondencia entre `*_small` y `*_large`.

Comportamiento:

- Obtiene miniaturas con `galleryImagesList`.
- Carga descripciones con `loadImageDescriptions`.
- Por cada miniatura, mapea nombre a grande con regex:
  - `nombre_small.ext` -> `nombre_large.ext`.
- Si no puede mapear, incrementa `invalidMapCount` y descarta.
- Si falta archivo grande, incrementa `missingLargeCount` y descarta.
- Para cada par valido agrega item con:
  - `small`
  - `large`
  - `description` (via `getImageDescription`).
- Si hubo descartes, registra log en desarrollo.

Salida:

```php
[
  'items' => [
    ['small' => '...', 'large' => '...', 'description' => '...'],
  ],
  'invalidMapCount' => 0,
  'missingLargeCount' => 0,
]
```

## Convenciones y dependencias

- Convencion de nombres requerida: sufijos `_small` y `_large`.
- Si no se respeta la convencion, el item se omite.
- Las extensiones permitidas dependen del array recibido por parametro.
- El mapa de descripciones es opcional: la galeria sigue funcionando sin JSON.

## Operacion y diagnostico

Checklist rapido cuando faltan imagenes en galeria:

- Verificar que exista par `small/large` para cada imagen.
- Revisar sufijos exactos `_small`/`_large`.
- Confirmar que la extension este en `allowedExtensions`.
- Confirmar permisos de lectura en directorios y JSON.
- En desarrollo, revisar logs de PHP para contadores de descartes.

## Mejora recomendada

- Evitar texto de log acoplado a una categoria concreta (`galeria-hogar`) y reemplazarlo por contexto dinamico (ruta o nombre de categoria) para mejorar trazabilidad.
