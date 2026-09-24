# Plan — Mapa interactivo con 3 recorridos seleccionables

## Contexto

La sección `#mapa` del sitio (index.html + style.css, JS vanilla al final del HTML) hoy muestra **un solo recorrido** con pines estáticos en HTML. El cliente quiere convertirla en un mapa con **3 recorridos seleccionables por botones**:

1. **Santa Clara** (11 puntos)
2. **Leyendas de Ultratumba** (7 puntos visibles — el cliente pidió omitir el pin 5 porque los pines 4 y 5 son el mismo lugar: Edificio Carolino) — **recorrido por defecto al cargar**
3. **Otros Recorridos** (7 puntos visibles — los pines 6, 7 y 8 del mapa de referencia son el mismo lugar, "alrededores del Edificio Carolino": **solo se pone el pin 7** y se omiten 6 y 8; el pin 3 es la "maqueta de la fundación")

Comportamiento: **un solo mapa base** de fondo; al elegir un recorrido se muestran **solo los pines/postales de ese recorrido**. Los lugares repetidos entre recorridos (Palacio Municipal, Fuente de San Miguel, Catedral, Carolino…) se definen **una sola vez** y aparecen en cada recorrido que los incluya. Se conservan el zoom/arrastre, el popup con imagen+descripción y la leyenda ya construidos.

**Material disponible** (carpetas en la raíz del proyecto):
- `mapa_santa_clara/` — 11 ilustraciones numeradas + `mapa_recorrido_santa_clara.jpg` (referencia con pines)
- `mapas_leyendas_ultratumba/` — ilustraciones numeradas (renombradas por el cliente con el número correcto) + `mapa_recorrido_leyendas_de_ultratumba.jpg`
- `mapa_otros_recorridos/` — ilustraciones numeradas + `mapa_otros_recorridos.jpg`
- Los 3 mapas de referencia comparten encuadre exacto: **2953×1969**
- **Mapa base limpio** con ese encuadre: el cliente dijo que lo agrega ahora → localizarlo al iniciar (paso 1). Si aún no está, pedirlo antes de continuar con el fondo (la mecánica se puede construir mientras).

Decisiones confirmadas con el cliente:
- Ultratumba: omitir pin 5 (mismo lugar que el 4, Edificio Carolino). Mantener la numeración del mapa de referencia (con hueco en el 5).
- Otros: pines 6-7-8 son el mismo lugar (alrededores del Carolino) → **solo se coloca el pin 7**, se omiten 6 y 8; pin 3 = maqueta de la fundación.
- Default al cargar: **Leyendas de Ultratumba**.
- En los 3 recorridos el pin 1 (Palacio Municipal) es también el **punto de inicio** (pin verde).
- Los estacionamientos "E" difieren por recorrido (cada mapa de referencia muestra los suyos) → también por-recorrido.

---

## Paso 0 — Guardar este plan en el proyecto

El cliente pidió el plan en un archivo `.md`: guardar una copia como **`PLAN_MAPA_RECORRIDOS.md`** en la raíz del proyecto.

## Paso 1 — Localizar y optimizar assets → `image/mapa/`

1. Re-listar las 3 carpetas (el cliente renombró archivos) y **localizar el mapa base limpio nuevo** que dijo que agregaba. Verificar que su encuadre coincida con los mapas de referencia (2953×1969 o proporcional).
2. Exportar con `sips` a JPEG optimizado:
   - Mapa base → `image/mapa/mapa-base.jpg` (ancho 2200 px, calidad ~78; reemplaza al actual).
   - Ilustraciones nuevas → 800 px de ancho, calidad ~82, nombres kebab-case:
     `pasaje-ayuntamiento`, `santo-domingo`, `mercado-victoria`, `calle-dulces`, `fabrica-talavera`, `exconvento-santa-clara`, `casa-hermanos-serdan`, `casa-munecos`, `maqueta-fundacion`, `explanada-compania`, `casa-inquisicion`.
   - **Reutilizar** las ya optimizadas: `palacio-municipal.jpg`, `fuente-san-miguel.jpg`, `catedral.jpg`, `el-parian.jpg`, `iglesia-compania.jpg`, `edificio-carolino.jpg` (los archivos de las carpetas nuevas con el mismo tamaño en bytes son idénticos a los ya procesados).
   - `barrio-artista` y `teatro-principal`: el cliente subió versiones nuevas (tamaño distinto a las previas) → re-exportar desde las nuevas.
3. Comprobar pesos finales (< ~350 KB por ilustración, base < ~1 MB).

## Paso 2 — Medir posiciones de pines (calibración inicial)

Para cada mapa de referencia, estimar las coordenadas `left%/top%` de cada pin numerado y de cada "E" (recortes con `sips` + inspección visual). Producir la tabla de posiciones por recorrido. La precisión final se afina en el Paso 6.

## Paso 3 — Datos en JS (des-duplicación de lugares)

En el `<script>` de `index.html`, definir:

```js
const LUGARES = {            // cada lugar UNA sola vez (título, img, desc)
  "palacio-municipal": { titulo: "Palacio Municipal", img: "image/mapa/palacio-municipal.jpg", desc: "… (Texto editable)" },
  "fuente-san-miguel": { … }, "catedral": { … }, "edificio-carolino": { … },
  // … resto de lugares, incl. "alrededores-carolino" reutilizando la img del carolino
};
const RECORRIDOS = {
  "ultratumba":  { nombre: "Leyendas de Ultratumba",
    puntos: [ { lugar: "palacio-municipal", num: 1, x: …, y: …, inicio: true }, … ],   // sin el 5
    estacionamientos: [ {x,y}, … ] },
  "santa-clara": { nombre: "Santa Clara", puntos: [ …11 puntos… ], estacionamientos: [ … ] },
  "otros":       { nombre: "Otros Recorridos",
    puntos: [ …, { lugar: "alrededores-carolino", num: 7, … } ],   // solo el 7; se omiten 6 y 8
    estacionamientos: [ … ] },
};
```

Las descripciones quedan como "(Texto editable)" hasta que el cliente las pase. Esta estructura es la que después migrará tal cual al manejador (Laravel).

## Paso 4 — HTML (`index.html`, sección `#mapa`)

1. **Quitar** los `<button class="mapa__point">` y `<span class="mapa__park">` estáticos del canvas; dejar solo `<img class="mapa__base">` y un contenedor vacío `<div class="mapa__pins" id="mapaPins">` donde el JS renderiza.
2. **Agregar tabs** arriba del viewport (`role="tablist"`): 3 botones píldora — Leyendas de Ultratumba · Santa Clara · Otros Recorridos — con `aria-selected` y estado activo dorado.
3. Agregar la nota de la revisión: *"Nuestros recorridos están sujetos a cambios por situaciones externas."* bajo el título.
4. Actualizar el aviso ⚠️ a: descripciones y posiciones finas pendientes.
5. El modal `#mapaModal` y la leyenda no cambian.

## Paso 5 — JS de render + CSS

1. `renderRecorrido(id)`: limpia `#mapaPins`, crea por cada punto un `<button class="mapa__point">` (postal `mapa__thumb` + pin numerado `mapa__pin-num` + pin verde si `inicio`) y por cada estacionamiento un `<span class="mapa__park">E</span>`, con `left/top` en %. Los datos del popup se toman de `LUGARES[punto.lugar]` (des-duplicado real).
2. Al cambiar de tab: `renderRecorrido(nuevo)`, resetear vista (scale 1, centrado), animación suave de aparición de pines (reutilizar `fadeUp`), actualizar `aria-selected`.
3. El popup se engancha por **delegación de eventos** en el contenedor (los pines ahora son dinámicos); mantener la guarda clic-vs-arrastre existente (`moved`).
4. Cargar por defecto `renderRecorrido("ultratumba")`.
5. CSS nuevo: `.mapa__tabs` y `.mapa__tab` (píldoras glass, activa dorada — mismo lenguaje de `.btn`), `.mapa__pin-num` (círculo numerado estilo referencia), transición de aparición. Responsive en los `@media` existentes.
6. Conservar intactos: zoom (rueda/pinch/botones), arrastre, constrain, modal accesible, modo calibración.

## Paso 6 — Calibración fina de posiciones

1. Servir con el preview (php vía `.claude/launch.json`), activar `CALIBRATION=true` temporalmente.
2. Comparar cada recorrido lado a lado con su mapa de referencia (screenshots) y ajustar las coordenadas en los datos hasta que coincidan.
3. Desactivar `CALIBRATION`.

## Paso 7 — Verificación end-to-end

1. **Escritorio (1280px):** los 3 tabs cambian los pines correctamente; Ultratumba sale por defecto; lugares compartidos (Palacio, Fuente, Catedral) aparecen en cada recorrido que los usa; popup abre con imagen/título correctos; zoom/arrastre/reset funcionan tras cambiar de tab.
2. **Móvil (375px):** tabs usables al tacto, pinch-zoom, tap abre popup, arrastrar no lo abre.
3. Ultratumba muestra numeración sin el 5 (4 = Carolino); Otros muestra solo el pin 7 para alrededores del Carolino (sin 6 ni 8) y el 3 = maqueta.
4. Consola sin errores; todas las imágenes cargan.
5. Screenshots de los 3 recorridos como evidencia (comparados contra los mapas de referencia).

## Fuera de alcance (siguen pendientes de las notas de revisión)

Renombrar título a "Rutas de Leyendas"* y demás cambios de la revisión (terminología callejoneada/recorrido, botón de ubicación en el hero, "Nuestras Callejoneadas", promociones reales con imágenes, secciones Servicios Extras y Tienda). *Salvo que el cliente quiera incluir el retitulado ahora, se hace junto con el resto.
