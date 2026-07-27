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
- [ ] **Paso 4 — Despliegue a Neubox (subdominio) + respaldos + cambio final**

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
- [x] **Formulario de contacto funcional:** guarda la solicitud en la BD **y** envía aviso por correo (Reply-To al visitante); muestra mensaje de éxito; bandeja en el panel con contador de no leídas. Verificado local (correo al log; en Neubox saldrá por SMTP).

> **Acceso al panel (local, Herd):** `http://puebla-legendaria.test/admin`
> Usuario temporal: `admin@pueblalegendaria.com` · Contraseña: _(guardada aparte, fuera del repo — no se documenta aquí por seguridad)_.

### Paso 4 — Despliegue a Neubox + cambio seguro
- [ ] Confirmar cPanel: **PHP 8.2** ✅, **MySQL**, y si hay **SSH/Composer/Terminal** (si no, plan por FTP).
- [ ] Desplegar primero en **subdominio de prueba** `nuevo.pueblalegendaria.com` (document root → `public/`), **sin tocar el WordPress**.
- [ ] Si NO hay SSH: subir por **FTP** con `vendor/` incluido; correr migraciones por Terminal de cPanel, MySQL remota, o ruta de instalación temporal.
- [ ] Crear BD MySQL, `.env` de producción, migraciones + seeders, cachés, SSL.
- [ ] **Activar respaldos** (cPanel y/o `laravel-backup`).
- [ ] Probar todo en el subdominio; entregar **mini-guía** (1 pág.).
- [ ] **Cambio final:** apuntar `pueblalegendaria.com` al Laravel (WordPress queda de respaldo).

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
- Hacer editables: Recorridos, mapa (lugares), hero/nosotros, testimonios, FAQ, Servicios Extras y Galería (mismo patrón).
