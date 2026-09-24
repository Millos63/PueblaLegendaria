# Cómo funciona el mapa interactivo

Documento técnico que explica cómo está construido el mapa de la sección **“El mapa de la leyenda”** (`#mapa`) del sitio de Puebla Legendaria: su HTML, sus datos, su lógica de interacción (zoom, arrastre, popups) y cómo modificarlo.

> **Dónde vive todo:** el mapa es **HTML + CSS + JavaScript vanilla** (sin librerías tipo Leaflet o Google Maps). Todo está en tres lugares del mismo proyecto:
> - **`index.html`** → sección `#mapa` (líneas ~270–316) y el `<script>` del mapa (líneas ~1147–1522).
> - **`style.css`** → estilos `.mapa__*` y `.mapa-modal__*` (líneas ~1444–1810) + animaciones.
> - **`image/mapa/`** → el mapa base (`mapa-base.jpg`) y las postales de cada lugar.

---

## 1. La idea en una frase

Hay **una sola imagen de mapa de fondo** (el Centro Histórico de Puebla). Encima se dibuja una capa de **pines** posicionados en porcentajes. Cada pin corresponde a un **lugar** (con foto y descripción). El usuario elige uno de **tres recorridos** con pestañas, y el mapa muestra solo los pines de ese recorrido. Se puede hacer **zoom** y **arrastrar**, y al tocar un pin se abre un **popup** con la imagen y la historia del lugar.

No es un mapa geográfico real (no usa coordenadas GPS): es una **ilustración** con puntos colocados a mano sobre ella.

---

## 2. Estructura HTML de la sección

```
#mapa
├── Título, intro y avisos
├── .mapa__tabs           ← las 3 pestañas de recorrido (role="tablist")
│   ├── botón "Leyendas de Ultratumba"  (data-recorrido="ultratumba")
│   ├── botón "Santa Clara"             (data-recorrido="santa-clara")
│   └── botón "Otros Recorridos"        (data-recorrido="otros")
├── .mapa__frame
│   ├── #mapaViewport      ← la "ventana" recortada que se ve (overflow:hidden)
│   │   └── #mapaCanvas    ← la capa que se mueve/escala (transform)
│   │       ├── img.mapa__base   ← la imagen del mapa de fondo
│   │       └── #mapaPins        ← contenedor VACÍO; el JS pinta aquí los pines
│   └── .mapa__controls   ← botones +, −, ⟲ (acercar, alejar, restablecer)
└── .mapa__legend         ← leyenda (inicio, puntos, estacionamientos "E")
```

Y aparte, al final del `<body>`, está el modal reutilizable:

```
#mapaModal (hidden)
├── .mapa-modal__backdrop   ← fondo oscuro; al hacer clic cierra (data-close)
└── .mapa-modal__card
    ├── img #mapaModalImg    ← foto del lugar
    ├── h3  #mapaModalTitle  ← nombre del lugar
    ├── p   #mapaModalDesc   ← descripción
    └── botón cerrar (×)
```

**Clave del diseño:** `#mapaPins` se entrega **vacío** en el HTML. Todos los pines los crea el JavaScript según el recorrido elegido. Así, cambiar de recorrido = volver a pintar esa capa.

### Los dos contenedores que hacen la magia: viewport vs canvas

- **`#mapaViewport`** es la ventana visible. Tiene `overflow: hidden`, altura fija (`60vh`) y `touch-action: none` (para controlar nosotros el gesto táctil, no el navegador).
- **`#mapaCanvas`** es la capa interior que **se mueve y se agranda**. Tiene `transform-origin: 0 0` y su ancho es `125%` (más grande que el visor, para dar aire a los pines de las orillas). El zoom y el arrastre se logran cambiando su propiedad CSS `transform`.

---

## 3. El modelo de datos (lo más importante)

Dentro del `<script>` hay dos objetos de JavaScript. **Esta es la parte que se edita para cambiar contenido.**

### 3.1 `LUGARES` — cada lugar definido UNA sola vez

```js
const LUGARES = {
  "palacio-municipal": {
    titulo: "Palacio Municipal",
    img: "image/mapa/palacio-municipal.jpg",
    desc: "Sede del gobierno municipal… (Texto editable.)"
  },
  "fuente-san-miguel": { … },
  // …
};
```

Cada lugar tiene una **clave** (ej. `"palacio-municipal"`), un **título**, una **imagen** y una **descripción**. Se definen una sola vez, aunque el mismo lugar aparezca en varios recorridos (el Palacio Municipal está en los tres). Esto evita duplicar textos e imágenes: se cambia en un solo sitio y se refleja en todos lados.

> Truco de reutilización: `"alrededores-carolino"` reutiliza la **misma foto** del `"edificio-carolino"`, porque es el mismo lugar visto desde otro ángulo del recorrido.

### 3.2 `RECORRIDOS` — qué puntos tiene cada recorrido y dónde van

```js
const RECORRIDOS = {
  "ultratumba": {
    nombre: "Leyendas de Ultratumba",
    puntos: [
      { lugar: "palacio-municipal", num: 1, x: 30.6, y: 43.2, inicio: true },
      { lugar: "fuente-san-miguel", num: 2, x: 22.2, y: 47.5 },
      // …
    ],
    estacionamientos: [
      { x: 39.0, y: 49.0 }, { x: 36.3, y: 64.3 }, // …
    ],
  },
  "santa-clara": { … },
  "otros": { … },
};
```

Cada recorrido tiene:
- **`nombre`**: el nombre para mostrar.
- **`puntos`**: la lista de paradas. Cada punto **apunta a un lugar** por su clave (`lugar`), lleva un **número** visible (`num`), su **posición** (`x`, `y`) y, opcionalmente, `inicio: true` si es el punto de partida (pin verde).
- **`estacionamientos`**: posiciones de las “E” (solo `x`, `y`; no tienen popup).

### 3.3 El sistema de coordenadas: porcentajes, no píxeles

`x` e `y` **no son píxeles**: son **porcentajes** sobre la imagen del mapa.

- `x` = distancia desde la **izquierda** (0 % = borde izquierdo, 100 % = borde derecho).
- `y` = distancia desde **arriba** (0 % = borde superior, 100 % = borde inferior).

Ejemplo: `x: 30.6, y: 43.2` significa “a 30.6 % del ancho y 43.2 % del alto”. Como son porcentajes, **los pines se mantienen en su lugar aunque el mapa cambie de tamaño** (celular, tablet, escritorio) o se le haga zoom. El JS solo escribe estos valores como `style.left` y `style.top`.

---

## 4. Cómo se dibujan los pines: `renderRecorrido(id)`

Es la función que **pinta la capa de pines** para un recorrido. Cada vez que se llama:

1. Limpia `#mapaPins` (`innerHTML = ""`).
2. Recorre `puntos` y, por cada uno, crea un `<button class="mapa__point">` con:
   - `left`/`top` en % → lo coloca sobre el mapa.
   - `animationDelay` escalonado (`i * 45ms`) → los pines aparecen en cascada.
   - `zIndex = 100 − num` → las paradas tempranas quedan por encima de las tardías.
   - `data-title`, `data-img`, `data-desc` → tomados de `LUGARES[punto.lugar]`; el popup los lee de aquí.
   - Contenido: el **número** (`.mapa__pin-num`), la **postal** (`.mapa__thumb`, la fotito), el **pin de gota** (verde si es inicio, morado si es leyenda) y la etiqueta **“Inicio”** cuando aplica.
3. Recorre `estacionamientos` y crea un `<span class="mapa__park">E</span>` por cada uno.

Al final del script se llama `renderRecorrido("ultratumba")`, por eso **el recorrido por defecto al cargar es Leyendas de Ultratumba**.

---

## 5. Las pestañas (cambiar de recorrido)

Cada `.mapa__tab` tiene un atributo `data-recorrido`. Al hacer clic:

1. Se marca esa pestaña como activa (clase `is-active` + `aria-selected="true"`) y se desmarcan las demás.
2. Se llama `renderRecorrido(tab.dataset.recorrido)` → repinta los pines.
3. Se llama `resetView()` → recoloca la vista (zoom/centrado) al estado inicial del nuevo recorrido, con una animación suave.

---

## 6. Zoom y arrastre (la navegación)

Todo el movimiento se guarda en un solo objeto:

```js
const view = { scale: 1, x: 0, y: 0 };  // escala y desplazamiento actuales
```

Y se aplica al canvas con una sola línea (función `apply()`):

```js
mapaCanvas.style.transform = "translate(" + view.x + "px," + view.y + "px) scale(" + view.scale + ")";
```

Es decir: **mover el mapa = cambiar `view.x/y`; acercar = cambiar `view.scale`**, y luego repintar el `transform`.

### 6.1 Zoom

- **Botones + / −**: `zoomCenter(factor)` hace zoom hacia el centro del visor (×1.3 o ÷1.3).
- **Rueda del mouse**: hace zoom **hacia el cursor** (`zoomAt` con la posición del ratón).
- **Pellizco (pinch) en celular**: con dos dedos, se mide la distancia entre ellos y se escala en proporción.
- Límites: `MIN_SCALE = 1` … `MAX_SCALE = 4` (no se puede alejar de más ni acercar de más).

La función `zoomAt(px, py, nextScale)` es la que mantiene fijo el punto bajo el cursor/dedo mientras se hace zoom (matemática de “zoom hacia un punto”), para que la sensación sea natural.

### 6.2 Arrastre

Se usa la **Pointer Events API** (funciona igual con mouse y con dedo). Se guardan los punteros activos en un `Map`:

- **1 puntero** = arrastrar → se suma el desplazamiento a `view.x/y`.
- **2 punteros** = pellizcar → zoom.

### 6.3 `constrain()` — que el mapa no “se escape”

Después de cada movimiento, `constrain()` recorta `view.x/y` para que el mapa no deje huecos vacíos en el visor. En celular deja un pequeño margen arriba (`topRoom`) para que las postales que sobresalen por encima de su pin no se corten con el borde.

### 6.4 Distinguir un “clic” de un “arrastre”

Problema clásico: si arrastras el mapa y sueltas encima de un pin, no quieres que se abra el popup. Solución:

- Se acumula cuánto se movió el dedo/ratón en la variable **`moved`**.
- Al soltar (`pointerup`), solo se considera **toque limpio** si `moved <= 8` píxeles.
- Además, como `setPointerCapture` (necesario para arrastrar) desvía el evento `click` normal, el popup **no** se abre con el `click` del navegador: se resuelve manualmente con `document.elementFromPoint(x, y)` para saber qué pin está justo debajo al soltar.

El teclado sí usa el `click` normal (Enter/Espacio sobre un pin enfocado, detectado con `e.detail === 0`), para mantener la accesibilidad.

---

## 7. El popup de cada lugar (modal)

- `openModal(point)` lee los `data-title`, `data-img` y `data-desc` del pin y los vuelca en `#mapaModal`, lo muestra y bloquea el scroll del fondo.
- Se cierra con la **×**, haciendo clic en el **fondo oscuro** (`data-close`) o con la tecla **Escape**.
- Es **accesible**: `role="dialog"`, `aria-modal`, el foco salta al botón de cerrar al abrir y **regresa al pin** que lo abrió al cerrar.

---

## 8. Vista inicial responsive: `resetView()`

Ajusta cómo se ve el mapa al cargar, al cambiar de pestaña, al pulsar ⟲ y al cambiar el tamaño de la ventana:

- **En escritorio**: escala 1, pegado arriba y centrado horizontalmente. Se ve el mapa completo.
- **En celular (≤767px)**: se **acerca** (`MOBILE_SCALE = 1.6`) y se **centra en el promedio de los pines** del recorrido, para que las postales (más chicas en móvil) se vean grandes y no encimadas.

---

## 9. Modo calibración (para colocar los pines)

Para medir las coordenadas de un pin nuevo hay un interruptor al inicio del script:

```js
const CALIBRATION = false; // poner true para imprimir coordenadas % al hacer clic
```

Con `CALIBRATION = true`, cada clic sobre el mapa imprime en la **consola del navegador** algo como `left:30.6%;top:43.2%`. Se copia ese valor a los datos y se vuelve a poner en `false`. Así se calibraron todas las posiciones actuales comparando contra los mapas de referencia de cada recorrido (`mapa_santa_clara/`, `mapas_leyendas_ultratumba/`, `mapa_otros_recorridos/`).

---

## 10. Cómo hacer cambios comunes

### Mover un pin de lugar
Edita su `x`/`y` en `RECORRIDOS`. Para saber los números exactos, usa el **modo calibración** (sección 9).

### Cambiar la foto, el título o el texto de un lugar
Edita su entrada en **`LUGARES`**. El cambio se refleja en **todos** los recorridos que lo usan.

### Agregar un lugar nuevo a un recorrido
1. Si el lugar no existe, agrégalo a `LUGARES` con su clave, título, imagen (colócala en `image/mapa/`) y descripción.
2. Agrega un `{ lugar: "su-clave", num: N, x: …, y: … }` al array `puntos` del recorrido.

### Agregar un recorrido nuevo (una 4.ª pestaña)
1. Agrega un botón `.mapa__tab` en el HTML con su `data-recorrido="nuevo-id"`.
2. Agrega la entrada `"nuevo-id": { nombre, puntos, estacionamientos }` en `RECORRIDOS`.

### Cambiar el recorrido por defecto
Cambia la última línea `renderRecorrido("ultratumba")` y el estado inicial de `currentRecorrido` / la pestaña con `is-active`.

---

## 11. Decisiones de diseño y particularidades

- **Des-duplicación de lugares:** los sitios repetidos (Palacio, Fuente, Catedral, Carolino) se definen una sola vez en `LUGARES` y se referencian por clave. Ahorra trabajo y mantiene todo consistente.
- **Numeración continua por recorrido:** el número visible (`num`) de cada punto es **independiente de la clave del lugar**; se puede reasignar libremente sin mover el pin. Cada recorrido lleva su propia numeración correlativa (Ultratumba 1–7, Otros 1–7, Santa Clara 1–11). Al fusionar lugares repetidos del material de referencia, la numeración final se ajusta a mano en el campo `num` para que quede sin saltos.
- **Sin librerías externas:** todo es JS propio (~370 líneas). Ventaja: liviano, sin dependencias, fácil de migrar. Ese mismo `view/transform` reemplaza a un motor de mapas completo para este caso ilustrado.
- **Preparado para el manejador (Laravel):** la estructura `LUGARES` + `RECORRIDOS` está pensada para, en una fase futura, venir de la base de datos y ser editable desde el panel, sin cambiar la lógica de render.

---

## 12. Referencia rápida de archivos

| Qué | Dónde |
|---|---|
| HTML de la sección | `index.html` · sección `#mapa` (~L270–316) |
| HTML del popup | `index.html` · `#mapaModal` (~L967) |
| Lógica y datos (JS) | `index.html` · `<script>` (~L1147–1522) |
| Datos editables | `LUGARES` (~L1355) y `RECORRIDOS` (~L1379) |
| Estilos del mapa | `style.css` (~L1444–1810) |
| Mapa base e imágenes | `image/mapa/` |
| Mapas de referencia (calibración) | `mapa_santa_clara/`, `mapas_leyendas_ultratumba/`, `mapa_otros_recorridos/` |
| Plan original del mapa | `PLAN_MAPA_RECORRIDOS.md` |

---

*Documento de referencia técnica del mapa interactivo · Puebla Legendaria.*
