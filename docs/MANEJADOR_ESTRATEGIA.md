# Estrategia — Manejador de contenido (CMS) para Puebla Legendaria

## Contexto

Estamos construyendo un **sitio nuevo hecho a mano** (HTML/CSS/JS propio) para reemplazar el sitio actual del cliente, que hoy corre en **WordPress alojado en Neubox** (`pueblalegendaria.com`). El cliente necesita **editar contenido sin tocar código**.

En esta primera etapa el alcance es acotado a las 3 secciones que cambian más seguido: **Promociones, Eventos de temporada y Tienda** (+ formulario de contacto funcional). El resto del sitio se queda fijo (se podrá volver editable después, reusando el mismo patrón).

**Decisiones confirmadas con el cliente:**
- **Arquitectura:** **Laravel 12 (PHP 8.2)** + **Blade**. El HTML actual se convierte en plantilla Blade; CSS y JS quedan idénticos → la página se ve **exactamente igual**. Panel con **Filament**.
- **Alcance fase 1:** Promociones · Eventos de temporada · Tienda · **Formulario de contacto funcional** ✅.
- **Vigencias automáticas** (promos/eventos que se muestran y ocultan solos por fecha) ✅.
- **Hosting:** **Neubox** (cPanel). PHP disponible **hasta 8.2** → compatible ✅. El sitio nuevo convive con el WordPress hasta el cambio final.

> **📁 IMPORTANTE — carpetas separadas:**
> - Sitio actual (NO se toca, queda de respaldo): `~/Documents/Work/PueblaLegendariaArchivos/PueblaLegendaria`
> - Proyecto nuevo Laravel: `~/Herd/puebla-legendaria` (servido por Herd en `puebla-legendaria.test`)

---

## Registro de avance

- [x] **Paso 1 — Proyecto Laravel + migración del sitio** (verificado: HTML idéntico byte a byte)
- [x] **Paso 2 — Base de datos + 3 secciones dinámicas** (verificado: promos/eventos/tienda desde la BD, se ven idénticos)
- [x] **Paso 3 — Panel Filament + formulario de contacto** (verificado local; falta solo el SMTP real, que va al desplegar)
- [~] **Paso 4 — Despliegue a Neubox (subdominio) + respaldos + cambio final** — EN PROGRESO (ver [Bitácora de despliegue](#bitácora-de-despliegue-a-neubox-ago-2026) al final: subdominio + BD + código ya arriba y funcionando; faltan SMTP, respaldos y cambio final)

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

## Modelo de datos (3 tablas)

Campos comunes: `activo` (bool), `orden` (int), `timestamps`.

- **`promociones`**: `imagen`, `badge`, `titulo`, `texto`, `vigencia_texto`, `cta_url`, `fecha_inicio`, `fecha_fin`.
- **`eventos`**: `imagen`, `fecha_icono` (sprite), `fecha_texto`, `icono` (sprite), `titulo`, `texto`, `cta_url`, `fecha_inicio`, `fecha_fin`.
- **`productos`** (Tienda): `imagen`, `icono` (sprite), `titulo`, `texto`, `cta_url`.
- **`servicios`** (Servicios Extras): `icono` (sprite), `titulo`, `texto`, `activo`, `orden`. Editable desde el panel, con orden arrastrable.

- El campo de ícono se edita con un **desplegable** de los íconos del sprite SVG (no texto libre).
- **Vigencias automáticas:** con `fecha_inicio`/`fecha_fin` el sitio muestra/oculta solo, además del `activo` manual.

---

## Manejo de imágenes (importante en cPanel)
- **FileUpload de Filament** con **redimensionado/optimización** al subir (máx ~1000 px, calidad ~80).
- Disco propio a **`public/uploads/`**, evitando el symlink `storage:link`.
- Imagen por defecto si un registro no tiene foto.

## Autenticación y recuperación de acceso
- Un usuario admin (el dueño), contraseña fuerte. **SMTP de Neubox** para "olvidé mi contraseña".
- Comando de rescate por consola documentado. Login protegido en `/admin`.

## Respaldos / Backups
- Respaldar **base de datos + `public/uploads`** (el código va en Git).
- **Backups de cPanel de Neubox** + (recomendado) `spatie/laravel-backup` con respaldo diario; si no hay cron, respaldo manual documentado.
- Respaldo manual antes de cada cambio importante en producción.

## Seguridad y producción
- **SSL/HTTPS** de Neubox forzado; `APP_URL=https://...`.
- `.env` producción: `APP_ENV=production`, `APP_DEBUG=false`, `APP_KEY`, credenciales MySQL.
- `config:cache` / `route:cache` / `view:cache`; permisos escribibles; **panel en español**.

---

## Plan de ejecución por pasos

### Paso 1 — Crear el proyecto Laravel y migrar el sitio ✅
- [x] Proyecto **Laravel 12** en `~/Herd/puebla-legendaria` (separado del actual).
- [x] `index.html` → `home.blade.php`; `style.css`, `image/`, `Images/` → `public/`.
- [x] Ruta `/` → vista `home`.
- [x] **Verificado:** HTML idéntico byte a byte (0 cambios de diseño).

### Paso 2 — Base de datos y contenido inicial  ✅
- [x] Migraciones de las 3 tablas (`promociones`, `eventos`, `productos`) con `fecha_inicio`/`fecha_fin` + modelos con scope `vigentes()`.
- [x] **Seeder** `ContenidoInicialSeeder` con el contenido actual (3 promos, 3 eventos, 3 productos).
- [x] Las 3 secciones del Blade convertidas a `@foreach` (mismo HTML, valores desde la BD) + filtro de vigencia por fecha.
- [x] Verificado: las 3 secciones se generan desde la BD y se ven idénticas (único cambio menor: el texto de promociones ya no lleva "gratis" en negrita, por ser texto editable).

### Paso 3 — Panel de administración (Filament) + correo + contacto  (EN PROGRESO)
- [x] Filament instalado; panel en `/admin`; **panel en español**; usuario temporal creado.
- [x] Un **Resource por tabla** (Promociones, Eventos, Tienda) con `FileUpload` (a `public/uploads`, redimensionado), selector de ícono, fechas de vigencia, `activo`, **orden arrastrable** y validaciones. Verificado: login + lista + formulario de edición.
- [ ] Configurar **SMTP de Neubox** (recuperar contraseña + contacto) — al desplegar.
- [x] **Formulario de contacto funcional:** al enviarse hace **tres cosas** → (1) guarda la solicitud en la BD (bandeja del panel), (2) envía aviso por correo (Reply-To al visitante) y (3) **abre WhatsApp** con la solicitud ya escrita (nombre, teléfono, email, recorrido, personas, mensaje) lista para mandarse al número del negocio. Muestra mensaje de éxito; bandeja en el panel con contador de no leídas. Verificado local (correo al log; en Neubox saldrá por SMTP). El número vive en `.env` → `CONTACTO_WHATSAPP` (default `522222650024`).

> **Acceso al panel (local, Herd):** `http://puebla-legendaria.test/admin`
> Usuario temporal: `admin@pueblalegendaria.com` · Contraseña: _(guardada aparte, fuera del repo — no se documenta aquí por seguridad)_.

### Paso 4 — Despliegue a Neubox + cambio seguro
- [x] Confirmar cPanel: **PHP 8.2** ✅, **MySQL** ✅, **SSH/Composer/Terminal** ❌ (NO hay → se hizo por FTP/File Manager, sin consola).
- [x] Desplegar primero en **subdominio de prueba** `nuevo.pueblalegendaria.com` (document root → `public/`), **sin tocar el sitio actual**.
- [x] Sin SSH: subido por **File Manager** (zip con `vendor/` incluido); BD armada en local y **importada por phpMyAdmin** (no se corrieron migraciones en el server).
- [x] Crear BD MySQL, `.env` de producción, contenido + usuario admin cargados. **SSL del subdominio: pendiente/omitido** (ver bitácora).
- [ ] **Activar respaldos** (cPanel y/o `laravel-backup`).
- [ ] Probar todo en el subdominio; entregar **mini-guía** (1 pág.).
- [ ] **Cambio final:** apuntar `pueblalegendaria.com` al Laravel (el sitio actual queda de respaldo).

> Detalle completo, decisiones y pendientes en la **Bitácora de despliegue** al final del documento.

---

## Verificación
1. **Local (Herd):** sitio idéntico; en `/admin` creo una promo con imagen y aparece; la desactivo y desaparece; reordeno y cambia el orden.
2. **Vigencias:** promo con `fecha_fin` pasada no se muestra; con fechas vigentes sí.
3. **Imágenes:** subir una foto grande y confirmar que se guarda optimizada en `public/uploads`.
4. **Contraseña:** probar "olvidé mi contraseña" (SMTP) y el restablecimiento por consola.
5. **Contacto:** enviar el formulario y confirmar que llega el correo.
6. **Respaldos:** generar un respaldo y **probar una restauración** en local.
7. **Comparación visual:** capturas antes/después de las 3 secciones → 0 cambios de diseño.
8. **Producción (subdominio):** editar una promo y verla reflejada; revisar móvil, escritorio y **HTTPS**.

---

## Riesgos / cosas a confirmar con Neubox (cPanel)
- **PHP 8.2** disponible ✅ (WordPress puede seguir en 7.4; el subdominio nuevo usa 8.2).
- **SSH/Composer/Terminal:** por confirmar; si no hay, despliegue por **FTP** + plan de migraciones sin consola.
- **Document root del subdominio → `public/`**.
- **Cron** para respaldos automáticos; si no hay, respaldo manual.
- **Convivencia con WordPress:** el Laravel va en subdominio aparte; el WP no se toca hasta el cambio final.

## Fuera de alcance (Fase 2)
- **Ajustes del sitio** (singleton): WhatsApp, redes y datos de contacto editables en un solo lugar.
- Hacer editables: Recorridos, mapa (lugares), hero/nosotros, testimonios, FAQ y Galería (mismo patrón).

---

## Cambios posteriores (27 jul 2026)
- **Servicios Extras** ahora es **editable en el panel** (tabla `servicios` + Resource Filament "Servicios extras", en *Contenido del sitio*). Los 9 servicios actuales quedaron cargados por seeder (`ServicioSeeder`). Ya no está en Fase 2.
- **Formulario → WhatsApp:** además de guardar en el manejador y enviar correo, ahora **abre WhatsApp** con la solicitud pre-escrita al número del negocio (`CONTACTO_WHATSAPP` en `.env`).
- **Carrusel deslizable en Promociones, Eventos de temporada y Tienda:** las tres secciones se deslizan horizontalmente (flechas ‹ › + scroll táctil); al agregar más elementos se acomodan **a la derecha**. Muestran ~1 tarjeta en móvil, ~2 en tablet y ~3 en escritorio. CSS compartido (`.carousel__nav`) y una sola función JS `carruselDeslizar(idTrack, dir)`.
- **Cache-busting del CSS:** el `<link>` de `style.css` ahora lleva `?v={{ filemtime }}`, así los navegadores siempre bajan la versión nueva cuando cambia el estilo (evita ver estilos viejos por caché).
- **Testimonios:** el título cambió de "Lo que dicen quienes sobrevivieron..." a **"Opiniones de la experiencia..."**.

> Al desplegar recuerda: agregar `CONTACTO_WHATSAPP` al `.env` de producción y correr `php artisan migrate` (migración `servicios`) + `php artisan db:seed --class=ServicioSeeder`.

---

## Bitácora de despliegue a Neubox (ago 2026)

Despliegue del **subdominio de prueba** `nuevo.pueblalegendaria.com`, sin tocar el sitio en vivo. Panel de Neubox = **DirectAdmin + CloudLinux** (rutas `/domains/...`, PHP Selector).

### Entorno confirmado (Fase A)
- **PHP 8.2** ✅ con extensiones necesarias (bcmath, gd, intl, mbstring, pdo_mysql, zip, etc.). Se activó `opcache`.
- **MySQL** ✅ · **phpMyAdmin** ✅ · **File Manager** ✅ · **Cron Jobs** ✅.
- **SSH / Terminal / Composer en el server:** ❌ NO hay → todo el despliegue fue **sin consola** (File Manager + phpMyAdmin).

### Hallazgo importante
- El **sitio actual NO es WordPress** (como asumía el plan), sino una **app PHP/MySQL a la medida**. Su BD es `u128043_pueblalegendaria` (tablas `recorridos`, `galeria`, `slider_principal`, `usuarios`, `contador`, `imagenes_recorridos`, `img_editor`). **NO tocar esa BD.** Relevante para el cambio final.

### Subdominio y base de datos (Fase B) ✅
- Subdominio `nuevo.pueblalegendaria.com` creado con opción **Default**, y luego **Document Root cambiado a `/domains/nuevo.pueblalegendaria.com/public`** (la carpeta `public` real de Laravel). **Obligatorio**: las imágenes usan el disco `public_root` = `public_path()`, así que el doc root debe ser `public`, no `public_html`.
- BD de producción creada: **`u128043_puebla`** · usuario `u128043_puebla` · host `localhost` · (password la tiene el cliente).

### Cómo se subió el proyecto (Fase C) ✅
- **Composer se corre en la Mac** (no hay en Neubox): se subió un `.zip` **con `vendor/` incluido**, extraído por File Manager.
- **Pinning a PHP 8.2:** el `vendor/` armado con PHP 8.4 (Herd) traía **Symfony 8** (exige PHP ≥ 8.4.1) → error `platform_check`. Solución: `composer config platform.php 8.2` + `composer update --no-dev --optimize-autoloader` → bajó a **Symfony 7.4** (compatible con 8.2). Este cambio quedó en `composer.json`/`composer.lock` del repo.
- **Base de datos por phpMyAdmin (no migraciones en server):** se armó la BD completa en el **MySQL local (DBngin)**, se exportó `.sql` y se **importó por phpMyAdmin** a `u128043_puebla`. Contenido cargado: **3 promos, 3 eventos, 4 productos, 12 callejoneadas, 9 servicios, 6 FAQ, 0 solicitudes** (limpio) + **usuario admin**.
- **`.env` de producción:** plantilla en `~/Herd/puebla-legendaria/.env.production` (git-ignored), inyectada como `.env` en el zip. `APP_KEY` nueva, `APP_ENV=production`, `QUEUE_CONNECTION=sync`, `MAIL_MAILER=log` (SMTP pendiente). La `DB_PASSWORD` real se escribió en el `.env` del server.

### Cambios de código para producción (en `~/Herd/puebla-legendaria`)
- `app/Models/User.php` → implementa `FilamentUser::canAccessPanel()` (si no, Filament da 403 en producción).
- `app/Providers/Filament/AdminPanelProvider.php` → `->profile()` (para que el dueño cambie su contraseña).
- `app/php-polyfills.php` + `require` en `bootstrap/app.php` → **polyfill de `tmpfile()`** (ver abajo).
- Permisos locales de 5 imágenes normalizados a 644.
> ⚠️ Estos cambios locales **faltan por commitear** en el repo de `~/Herd/puebla-legendaria`.

### Problemas encontrados y resueltos
1. **Imágenes no cargaban (403):** 5 archivos en `public/` estaban con permisos **600** (hero `Images/ImagenPuebla.png`, imágenes de recorridos y una de galería). El zip conservó esos permisos. Arreglado poniéndolos en **644** en File Manager. (Regla: archivos 644, carpetas 755.)
2. **Subida de imágenes daba 500 — `Call to undefined function tmpfile()`:** Neubox (CloudLinux) tiene una lista **`disable_functions`** muy agresiva que bloquea `tmpfile()` (la usa Livewire para subir archivos) y `highlight_file()`. **`disable_functions` NO es editable** desde el PHP Selector del cliente. Solución **sin ticket**: `app/php-polyfills.php` define `tmpfile()`/`highlight_file()` **en los namespaces de Livewire/Symfony** usando `tempnam()`+`fopen()` (que sí están permitidas); se carga desde `bootstrap/app.php`. Delega en la función real si algún día se habilita. (Ticket a Neubox = opcional, no necesario.)

### Estado de acceso
- **Panel:** `https://nuevo.pueblalegendaria.com/admin` · usuario `admin@pueblalegendaria.com` · **password temporal** (cambiar en el panel → Perfil tras el primer login).
- **SSL:** el subdominio **no tiene certificado propio**; el dominio principal `pueblalegendaria.com` **sí** (Let's Encrypt, vigente ~hasta 24-sep-2026). Como el destino final es el dominio real (que ya tiene SSL), se **omitió el SSL del subdominio** y se puso `SESSION_SECURE_COOKIE=false` temporal para poder probar el login sobre "Not Secure".

### Pendientes
- [ ] **Confirmar** que la subida de imágenes funciona con el polyfill (en prueba).
- [ ] **Regresar `APP_DEBUG=false`** en el `.env` del server (se puso `true` para depurar).
- [ ] **Commitear** los cambios locales del proyecto Laravel (pinning 8.2, User, profile, polyfill, permisos).
- [ ] **SMTP de Neubox:** crear cuenta de correo (ej. `contacto@pueblalegendaria.com`) y poner `MAIL_MAILER=smtp` + credenciales en `.env` (formulario de contacto + "olvidé mi contraseña").
- [ ] **Subir límites de PHP** (para fotos grandes): `upload_max_filesize` 2M→8/16M, `post_max_size` 8M→16M, `memory_limit` 128M→256M.
- [ ] (Opcional) SSL propio del subdominio si se le mostrará al cliente antes del cambio final; y regresar `SESSION_SECURE_COOKIE=true`.
- [ ] **Respaldos** (cPanel/DirectAdmin y/o `laravel-backup`).
- [ ] **Mini-guía** de 1 página para el cliente.
- [ ] **Cambio final:** apuntar `pueblalegendaria.com` (Document Root → carpeta `public` del Laravel), poner `APP_URL` al dominio real y `SESSION_SECURE_COOKIE=true`. El sitio PHP actual queda de respaldo.
