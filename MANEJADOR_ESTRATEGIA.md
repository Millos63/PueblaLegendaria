# Estrategia — Manejador de contenido (CMS) para Puebla Legendaria

## Contexto

El sitio es estático (`index.html` + `style.css` + JS vanilla, hoy en Netlify). El cliente necesita **editar contenido sin tocar código**. En esta primera etapa el alcance es acotado a las 3 secciones que cambian más seguido: **Promociones, Eventos de temporada y Tienda**. El resto del sitio se queda fijo (se podrá volver editable después, reusando el mismo patrón).

**Decisiones confirmadas con el cliente:**
- **Arquitectura:** Laravel + **Blade** (el HTML actual se convierte en plantilla Blade; CSS y JS quedan idénticos → la página se ve **exactamente igual**). Panel de administración con **Filament**.
- **Alcance fase 1:** Promociones · Eventos de temporada · Tienda.
- **Hosting:** compartido con PHP + MySQL (cPanel). Esto implica que **el sitio se muda de Netlify a cPanel** (el dominio apunta al Laravel; Netlify puede quedar como respaldo).

**Objetivo:** que el dueño entre a `/admin`, inicie sesión, y pueda **crear/editar/activar/desactivar** promociones, eventos y productos —con su imagen— y que se reflejen en el sitio de inmediato.

---

## Arquitectura elegida

```
┌───────────────┐    edita     ┌──────────────┐   lee    ┌────────────────────┐
│  Dueño        │─────────────▶│  MySQL       │◀─────────│  Laravel (Blade)   │
│  /admin       │   Filament   │  3 tablas    │          │  = index en Blade  │
│  (login)      │              └──────────────┘          │  sirve el sitio    │
└───────────────┘                                        └────────────────────┘
        Fotos → carpeta public/uploads (optimizadas al subir)     ▲
                                                          visitante ve el sitio
```

- **Un solo proyecto Laravel** sirve el sitio público (Blade) y el panel (Filament en `/admin`).
- Solo 3 secciones leen de la base de datos; el resto del HTML queda tal cual dentro del Blade.

---

## Modelo de datos (3 tablas, muy simples)

Campos comunes: `activo` (bool, para mostrar/ocultar sin borrar), `orden` (int, para acomodar), `timestamps`.

- **`promociones`**: `badge` (ej. "Mamá gratis"), `titulo`, `texto`, `vigencia`, `imagen`, `cta_url` (WhatsApp).
- **`eventos`**: `fecha_badge` (ej. "31 Oct"), `icono` (clave del sprite, p. ej. `ic-ghost`), `titulo`, `texto`, `imagen`, `cta_url`.
- **`productos`** (Tienda): `icono` (clave del sprite), `titulo`, `texto`, `imagen`, `cta_url`.

El campo `icono` se edita con un **desplegable** de los íconos que ya existen en el sprite SVG (no texto libre), para que el dueño elija sin equivocarse.

---

## Manejo de imágenes (importante en cPanel)

- Subida con el campo **FileUpload de Filament**, con **redimensionado/optimización al subir** (máx ~1000 px, calidad ~80) para no subir archivos pesados.
- Se guardan en **`public/uploads/`** (disco público directo), **evitando el symlink `storage:link`** que a veces está bloqueado en hosting compartido.
- Si una promo/evento/producto no tiene imagen, se usa una genérica por defecto (como ahora).

---

## Plan de ejecución por pasos

### Paso 1 — Crear el proyecto Laravel y migrar el sitio (sin cambiar el diseño)
1. `laravel new` (Laravel 11, PHP 8.2+).
2. Mover el sitio actual al proyecto: `index.html` → `resources/views/home.blade.php`; `style.css`, carpeta `image/` y assets → `public/`.
3. Ruta `/` que devuelve la vista `home`.
4. **Verificación crítica:** la página debe verse **idéntica** a la actual (comparar capturas antes/después). Aún sin base de datos.

### Paso 2 — Base de datos y contenido inicial
1. Migraciones de las 3 tablas + modelos Eloquent (`Promocion`, `Evento`, `Producto`).
2. **Seeders** con el contenido actual (las 3 promos reales, los 3 eventos, los 3 productos) para no perder nada.
3. En `home.blade.php`, convertir esas 3 secciones a `@foreach` que recorren la base de datos (el HTML de la tarjeta es el mismo, solo cambian los valores por `{{ $item->campo }}`).

### Paso 3 — Panel de administración (Filament)
1. Instalar Filament; crear usuario administrador (el dueño).
2. Un **Resource por tabla** (Promociones, Eventos, Tienda) con: campos de texto, `FileUpload` de imagen (con redimensionado), selector de ícono, interruptor `activo` y orden arrastrable.
3. Login protegido en `/admin`; el resto del panel sin acceso público.

### Paso 4 — Despliegue a cPanel + entrega
1. Confirmar con el hosting: **PHP 8.2+**, **MySQL**, y acceso (SSH/Composer o subida por archivos).
2. Apuntar el document root del dominio a la carpeta `public/` del proyecto (o el ajuste equivalente en cPanel).
3. Crear la base de datos MySQL, configurar `.env`, correr migraciones y seeders.
4. Crear la cuenta del dueño y entregar una **mini-guía** (1 página) de cómo editar cada sección.
5. Cambiar el DNS del dominio de Netlify a cPanel cuando todo esté verificado (Netlify queda de respaldo).

---

## Verificación

1. **Local (Herd):** el sitio se ve idéntico al actual; en `/admin` inicio sesión, creo una promoción de prueba con imagen y aparece en el sitio; la desactivo y desaparece; reordeno y cambia el orden.
2. **Imágenes:** subir una foto grande y confirmar que se guarda optimizada en `public/uploads` y se ve bien.
3. **Comparación visual:** capturas antes/después de las 3 secciones para confirmar 0 cambios de diseño.
4. **Producción (cPanel):** repetir la prueba de editar una promo y verla reflejada en el dominio real; revisar en móvil y escritorio.

---

## Riesgos / cosas a confirmar con el hosting (cPanel)
- **Versión de PHP** ≥ 8.2 (necesario para Laravel 11/Filament).
- **Composer y consola (SSH):** si no hay, se sube el proyecto ya “compilado” (con `vendor/`) y se corren migraciones vía SSH o un comando puntual.
- **Document root al `public/`**: si el hosting no deja moverlo, se usa el ajuste estándar de Laravel en compartido.
- **Symlink de storage:** lo evitamos guardando en `public/uploads` directamente.

## Fuera de alcance (fase 2, cuando se quiera)
Hacer editables también: Recorridos, textos del hero/nosotros, testimonios, FAQ, Servicios Extras, Galería y datos de contacto. Todo reusa el **mismo patrón** (tabla + Resource de Filament + `@foreach` en el Blade), así que crece sin rediseñar nada.

## Nota
Tras aprobar, guardo una copia de esta estrategia como `MANEJADOR_ESTRATEGIA.md` en el proyecto, junto al `PLAN_MAPA_RECORRIDOS.md`.
