<!DOCTYPE html>
<html lang="es-MX">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Puebla Legendaria | Portal a las Leyendas</title>
    <meta
      name="description"
      content="Puebla Legendaria: recorridos turísticos actuados con actores profesionales en Puebla, México. Vive una experiencia inmersiva de misterio, historia y aventura."
    />
    <meta name="theme-color" content="#0A0A0F" />

    <meta property="og:title" content="Puebla Legendaria | Portal a las Leyendas" />
    <meta
      property="og:description"
      content="Donde las leyendas cobran vida. Más de 16 recorridos temáticos en Puebla."
    />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://www.pueblalegendaria.com" />
    <meta property="og:image" content="https://www.pueblalegendaria.com/Images/ImagenPuebla.jpg" />

    <link rel="icon" type="image/svg+xml" href="favicon.svg?v={{ @filemtime(public_path('favicon.svg')) ?: '1' }}" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@700;900&family=Playfair+Display:ital,wght@0,700;1,700&family=Cormorant+Garamond:ital,wght@0,400;1,400;1,600&family=Inter:wght@300;400;500;600&family=Montserrat:wght@500;600;700&display=swap"
      rel="stylesheet"
    />

    <link rel="stylesheet" href="style.css?v={{ @filemtime(public_path('style.css')) ?: '1' }}" />
  </head>
  <body>
    <!-- ================= SPRITE DE ÍCONOS (línea fina, se reutilizan con <use>) ================= -->
    <svg class="icon-sprite" aria-hidden="true" focusable="false" xmlns="http://www.w3.org/2000/svg">
      <symbol id="ic-building" viewBox="0 0 24 24"><path d="M3 9 12 4l9 5Z"/><path d="M5 9v9M9.5 9v9M14.5 9v9M19 9v9"/><path d="M3 19h18"/></symbol>
      <symbol id="ic-candle" viewBox="0 0 24 24"><path d="M12 3c1.6 2 1.6 3.7 0 5-1.6-1.3-1.6-3 0-5Z"/><rect x="9.5" y="9" width="5" height="11" rx="1.2"/><path d="M9.5 20h5"/></symbol>
      <symbol id="ic-walk" viewBox="0 0 24 24"><circle cx="13" cy="4.4" r="1.8"/><path d="M13 7 11 12l-2.5 5M13 7l3.2 2.6M11 12l3 4.5M13 7l1.5 4"/></symbol>
      <symbol id="ic-key" viewBox="0 0 24 24"><circle cx="7.5" cy="8" r="3.6"/><path d="M9.8 10.5 19 19.7M15.7 16.4l2-2M13 13.7l2-2"/></symbol>
      <symbol id="ic-church" viewBox="0 0 24 24"><path d="M12 2v4M10 4h4"/><path d="M6 22V11l6-4 6 4v11Z"/><rect x="10.3" y="15" width="3.4" height="7"/></symbol>
      <symbol id="ic-moon" viewBox="0 0 24 24"><path d="M20 13a8 8 0 1 1-9-9 6.5 6.5 0 0 0 9 9Z"/></symbol>
      <symbol id="ic-crown" viewBox="0 0 24 24"><path d="M4 8l3 6h10l3-6-4.5 3.2L12 6 8.5 11.2Z"/><path d="M6.5 17h11"/></symbol>
      <symbol id="ic-swords" viewBox="0 0 24 24"><path d="M4 4l9.5 9.5M20 4l-9.5 9.5"/><path d="M9 15l3 3 3-3"/><path d="M3 6l2-2M21 6l-2-2"/></symbol>
      <symbol id="ic-fire" viewBox="0 0 24 24"><path d="M12 3c3 3.5 5 6 4 10a4 4 0 1 1-8 0c0-2 1-2.5 2-1 0-3.5 1-4.5 2-9Z"/></symbol>
      <symbol id="ic-masks" viewBox="0 0 24 24"><path d="M5 5h14v6a7 7 0 0 1-14 0Z"/><circle cx="9.5" cy="9.2" r=".6"/><circle cx="14.5" cy="9.2" r=".6"/><path d="M9 13c1.8 1.6 4.2 1.6 6 0"/></symbol>
      <symbol id="ic-ghost" viewBox="0 0 24 24"><path d="M6 20V10a6 6 0 0 1 12 0v10l-2-2-2 2-2-2-2 2-2-2Z"/><circle cx="10" cy="10" r=".8"/><circle cx="14" cy="10" r=".8"/></symbol>
      <symbol id="ic-skull" viewBox="0 0 24 24"><path d="M5 10a7 7 0 1 1 14 0v3a3 3 0 0 1-3 3H8a3 3 0 0 1-3-3Z"/><circle cx="9" cy="10.5" r="1.6"/><circle cx="15" cy="10.5" r="1.6"/><path d="M12 12.5 11 15h2Z"/><path d="M9 16v3M12 16v3M15 16v3"/></symbol>
      <symbol id="ic-castle" viewBox="0 0 24 24"><path d="M4 20V9h2V7h2v2h2V7h2v2h2V7h2v2h2v11Z"/><rect x="10.2" y="14" width="3.6" height="6"/></symbol>
      <symbol id="ic-scroll" viewBox="0 0 24 24"><path d="M7 5h9a2 2 0 0 1 2 2v10a2 2 0 0 0 2 2H8a2 2 0 0 1-2-2V7a2 2 0 0 0-2-2Z"/><path d="M9.5 9h6M9.5 12h6M9.5 15h4"/></symbol>
      <symbol id="ic-dagger" viewBox="0 0 24 24"><path d="M12 3l2 9h-4Z"/><path d="M8 12h8M12 12v7M10 20h4"/></symbol>
      <symbol id="ic-sun" viewBox="0 0 24 24"><circle cx="12" cy="12" r="4"/><path d="M12 2v2.5M12 19.5V22M2 12h2.5M19.5 12H22M4.9 4.9l1.8 1.8M17.3 17.3l1.8 1.8M19.1 4.9l-1.8 1.8M6.7 17.3l-1.8 1.8"/></symbol>
      <symbol id="ic-family" viewBox="0 0 24 24"><circle cx="7" cy="7" r="2.1"/><circle cx="17" cy="7" r="2.1"/><circle cx="12" cy="9.3" r="1.6"/><path d="M3.6 19v-3a3.4 3.4 0 0 1 6.8 0M13.6 19v-3a3.4 3.4 0 0 1 6.8 0M9.7 19.5v-2.2a2.3 2.3 0 0 1 4.6 0"/></symbol>
      <symbol id="ic-pumpkin" viewBox="0 0 24 24"><path d="M12 6V4c1.6 0 2 1 2 2"/><ellipse cx="12" cy="13.5" rx="7.5" ry="6.5"/><path d="M9 7.5c-2 1.8-2 10.2 0 12M15 7.5c2 1.8 2 10.2 0 12M12 7v13"/></symbol>
      <symbol id="ic-flower" viewBox="0 0 24 24"><circle cx="12" cy="7.3" r="2.3"/><circle cx="17" cy="10.8" r="2.3"/><circle cx="15.1" cy="16.4" r="2.3"/><circle cx="8.9" cy="16.4" r="2.3"/><circle cx="7" cy="10.8" r="2.3"/><circle cx="12" cy="12" r="2"/></symbol>
      <symbol id="ic-calendar" viewBox="0 0 24 24"><rect x="4" y="6" width="16" height="15" rx="2"/><path d="M4 10h16M8 3v4M16 3v4"/></symbol>
      <symbol id="ic-dress" viewBox="0 0 24 24"><path d="M9 4h6l-1 4 3 12H7l3-12Z"/><path d="M9 4 7 7M15 4l2 3"/></symbol>
      <symbol id="ic-toast" viewBox="0 0 24 24"><path d="M5 5l3 6v6M5 5h6l-3 6M5 19h6"/><path d="M19 5l-3 6v6M19 5h-6l3 6M13 19h6"/></symbol>
      <symbol id="ic-dance" viewBox="0 0 24 24"><circle cx="13" cy="4.2" r="1.7"/><path d="M13 6l-3.5 5M13 6l4.5 2.5M13 6v5M9.5 11 7 19h11l-2.5-8Z"/></symbol>
      <symbol id="ic-ring" viewBox="0 0 24 24"><circle cx="12" cy="15" r="5"/><path d="M9 8l3-3 3 3-3 2Z"/></symbol>
      <symbol id="ic-trumpet" viewBox="0 0 24 24"><path d="M3 12h3M6 10h6v4H6zM12 8l6-2v12l-6-2M8 10V8M10 10V8M8 14v2M10 14v2"/></symbol>
      <symbol id="ic-bride" viewBox="0 0 24 24"><circle cx="12" cy="6" r="3"/><path d="M9.2 6.4C5.5 8 5 12 5 15M14.8 6.4C18.5 8 19 12 19 15M8 21v-4a4 4 0 0 1 8 0v4"/></symbol>
      <symbol id="ic-bus" viewBox="0 0 24 24"><rect x="4" y="5" width="16" height="12" rx="2"/><path d="M4 12h16M8 5v7M12 5v7M16 5v7"/><circle cx="8" cy="18.5" r="1.5"/><circle cx="16" cy="18.5" r="1.5"/></symbol>
      <symbol id="ic-cap" viewBox="0 0 24 24"><path d="M4 15a8 7 0 0 1 16 0Z"/><path d="M20 15c2.6 0 2.6 3 0 3h-8"/></symbol>
      <symbol id="ic-shirt" viewBox="0 0 24 24"><path d="M9 4 4 7.2 6 10.6l2.2-1.2V20h7.6V9.4l2.2 1.2L20 7.2 15 4l-3 2Z"/></symbol>
      <symbol id="ic-gift" viewBox="0 0 24 24"><rect x="4" y="9" width="16" height="11" rx="1"/><path d="M4 13h16M12 9v11"/><path d="M12 9C9 4 6 6.5 12 9 15 4 18 6.5 12 9"/></symbol>
      <symbol id="ic-phone" viewBox="0 0 24 24"><path d="M5 4h3l2 5-2.5 1.5a11 11 0 0 0 5 5L14 13l5 2v3a2 2 0 0 1-2 2A16 16 0 0 1 3 6a2 2 0 0 1 2-2Z"/></symbol>
      <symbol id="ic-pin" viewBox="0 0 24 24"><path d="M12 22s7-7 7-12a7 7 0 0 0-14 0c0 5 7 12 7 12Z"/><circle cx="12" cy="10" r="2.5"/></symbol>
      <symbol id="ic-mail" viewBox="0 0 24 24"><rect x="3" y="6" width="18" height="12" rx="2"/><path d="M3.5 7.5 12 13.5 20.5 7.5"/></symbol>
      <symbol id="ic-chat" viewBox="0 0 24 24"><path d="M5 4h14a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2h-8l-4 4v-4H5a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2Z"/></symbol>
      <symbol id="ic-clock" viewBox="0 0 24 24"><circle cx="12" cy="12" r="8"/><path d="M12 7.5V12l3 2"/></symbol>
      <symbol id="ic-star" viewBox="0 0 24 24"><path d="M12 3l2.6 6 6.4.5-4.9 4.1 1.5 6.4L12 17l-5.6 3 1.5-6.4L3 9.5 9.4 9Z"/></symbol>
      <symbol id="ic-flag" viewBox="0 0 24 24"><path d="M6 3v18"/><path d="M6 4h12l-3 3 3 3H6"/></symbol>
      <symbol id="ic-map" viewBox="0 0 24 24"><path d="M9 4 3 6v14l6-2 6 2 6-2V4l-6 2Z"/><path d="M9 4v14M15 6v14"/></symbol>
    </svg>

    <header class="header" id="inicio">
      <div class="container nav">
        <a class="nav__brand" href="#inicio" aria-label="Puebla Legendaria inicio">
          <img class="nav__brand-logo" src="logos/logo_horizontal.svg" alt="Puebla Legendaria" width="180" height="90" />
        </a>

        <button
          class="nav__toggle"
          id="navToggle"
          aria-label="Abrir menú"
          aria-expanded="false"
          aria-controls="navMenu"
        >
          <span class="nav__line"></span>
          <span class="nav__line"></span>
          <span class="nav__line"></span>
        </button>

        <nav class="nav__menu" id="navMenu" aria-label="Navegación principal">
          <a class="nav__link" href="#inicio">Inicio</a>
          <a class="nav__link" href="#mapa">Mapa</a>
          <a class="nav__link" href="#recorridos">Recorridos</a>
          <a class="nav__link" href="#promociones">Promociones</a>
          <a class="nav__link" href="#eventos">Eventos</a>
          <a class="nav__link" href="#servicios">Servicios</a>
          <a class="nav__link" href="#tienda">Tienda</a>
          <a class="nav__link" href="#galeria">Galería</a>
          <a class="nav__link" href="#faq">FAQ</a>
          <a class="nav__link" href="#contacto">Contacto</a>
        </nav>
      </div>
    </header>

    <main>
      <section class="hero noise" aria-label="Invitación principal">
        <div class="particles" aria-hidden="true">
          <span class="particle" style="left:5%;animation-duration:11s;animation-delay:0s;"></span>
          <span class="particle" style="left:12%;animation-duration:14s;animation-delay:1s;"></span>
          <span class="particle" style="left:19%;animation-duration:9s;animation-delay:2s;"></span>
          <span class="particle" style="left:24%;animation-duration:15s;animation-delay:1.2s;"></span>
          <span class="particle" style="left:29%;animation-duration:12s;animation-delay:0.6s;"></span>
          <span class="particle" style="left:35%;animation-duration:17s;animation-delay:2.3s;"></span>
          <span class="particle" style="left:40%;animation-duration:10s;animation-delay:1.1s;"></span>
          <span class="particle" style="left:45%;animation-duration:18s;animation-delay:2.8s;"></span>
          <span class="particle" style="left:50%;animation-duration:8s;animation-delay:0.4s;"></span>
          <span class="particle" style="left:56%;animation-duration:16s;animation-delay:1.7s;"></span>
          <span class="particle" style="left:61%;animation-duration:13s;animation-delay:0.9s;"></span>
          <span class="particle" style="left:67%;animation-duration:19s;animation-delay:2.4s;"></span>
          <span class="particle" style="left:73%;animation-duration:12s;animation-delay:1.6s;"></span>
          <span class="particle" style="left:78%;animation-duration:9s;animation-delay:0.2s;"></span>
          <span class="particle" style="left:82%;animation-duration:14s;animation-delay:2s;"></span>
          <span class="particle" style="left:86%;animation-duration:11s;animation-delay:1.3s;"></span>
          <span class="particle" style="left:90%;animation-duration:20s;animation-delay:2.6s;"></span>
          <span class="particle" style="left:93%;animation-duration:15s;animation-delay:0.5s;"></span>
          <span class="particle" style="left:96%;animation-duration:10s;animation-delay:1.4s;"></span>
          <span class="particle" style="left:98%;animation-duration:13s;animation-delay:2.2s;"></span>
        </div>
        
        <div class="hero__fog"></div>
        <div class="hero__fog--2"></div>
        <div class="hero__fog--3"></div>

        <div class="container hero__content">
          <p class="hero__pretitle">Desde 2002</p>
          <h1 class="hero__title">PUEBLA LEGENDARIA</h1>
          <p class="hero__subtitle">Donde las leyendas cobran vida</p>
          <div class="hero__actions">
            <a class="btn btn--gold" href="#recorridos">Explorar Recorridos</a>
            <a class="btn btn--outline" href="#nosotros">▶ Ver Trailer</a>
          </div>
        </div>

        <div class="scroll-indicator" aria-hidden="true">⌄</div>
      </section>

      <section class="section story noise" id="nosotros" aria-label="Historia Puebla Legendaria">
        <div class="container">
          <p class="story__text reveal">
            “En las calles empedradas de Puebla, cuando cae la noche, los personajes del pasado
            regresan para contar su historia. Entre velas, sombras y campanas antiguas, cada paso
            abre un portal a lo imposible.”
          </p>
          <div class="baroque-divider reveal"></div>

          <div class="counters reveal">
            <article class="counter">
              <span class="counter__number" data-target="20">0</span>
              <span class="counter__label">+20 Años</span>
            </article>
            <article class="counter">
              <span class="counter__number" data-target="16">0</span>
              <span class="counter__label">16+ Recorridos</span>
            </article>
            <article class="counter">
              <span class="counter__number" data-target="98">0</span>
              <span class="counter__label">98% Recomendación</span>
            </article>
            <article class="counter">
              <span class="counter__number" data-target="1000">0</span>
              <span class="counter__label">1000+ Noches</span>
            </article>
          </div>
        </div>
      </section>

      <section class="section callejoneada noise" id="callejoneada" aria-label="Cómo es una callejoneada">
        <div class="container">
          <span class="section__kicker reveal">Antes de comenzar</span>
          <h2 class="section__title reveal">¿Cómo es una callejoneada?</h2>
          <p class="callejoneada__intro reveal">
            No es un espectáculo en un teatro cerrado: es un recorrido <strong>caminando al aire libre</strong>
            por las calles, callejones y rincones históricos de Puebla. Avanzas con tu guía y, en cada parada,
            los personajes del pasado salen a tu encuentro. Toca cada punto de la ruta para ver qué te espera.
          </p>

          <div class="ruta reveal">
            <div class="ruta__track" role="tablist" aria-label="Paradas de la ruta">
              <button class="ruta__node is-active" role="tab" aria-selected="true" aria-controls="ruta-panel-0" id="ruta-tab-0" data-step="0">
                <span class="ruta__dot"></span>
                <span class="ruta__node-label">Punto de reunión</span>
              </button>
              <button class="ruta__node" role="tab" aria-selected="false" aria-controls="ruta-panel-1" id="ruta-tab-1" data-step="1">
                <span class="ruta__dot"></span>
                <span class="ruta__node-label">Adentrándonos a la historia</span>
              </button>
              <button class="ruta__node" role="tab" aria-selected="false" aria-controls="ruta-panel-2" id="ruta-tab-2" data-step="2">
                <span class="ruta__dot"></span>
                <span class="ruta__node-label">Sitios Emblemáticos</span>
              </button>
              <button class="ruta__node" role="tab" aria-selected="false" aria-controls="ruta-panel-3" id="ruta-tab-3" data-step="3">
                <span class="ruta__dot"></span>
                <span class="ruta__node-label">Personajes Legendarios</span>
              </button>
              <button class="ruta__node" role="tab" aria-selected="false" aria-controls="ruta-panel-4" id="ruta-tab-4" data-step="4">
                <span class="ruta__dot"></span>
                <span class="ruta__node-label">Final Inolvidable</span>
              </button>
            </div>

            <div class="ruta__detail" id="rutaStage">
              <article class="ruta__panel ruta__card is-active" role="tabpanel" id="ruta-panel-0" aria-labelledby="ruta-tab-0">
                <img class="ruta__card-img" src="image/callejoneada/paso-1-punto-reunion.jpg" alt="Personajes de época colonial dan la bienvenida frente al Palacio Municipal de Puebla" loading="lazy" />
                <span class="ruta__card-shine" aria-hidden="true"></span>
                <div class="ruta__card-body">
                  <span class="ruta__panel-icon"><svg class="ic"><use href="#ic-candle"/></svg></span>
                  <h3 class="ruta__panel-title">Punto de reunión</h3>
                  <p class="ruta__panel-text">Iniciamos en el portal junto a la entrada a Palacio Municipal. Ahí te daremos la bienvenida, se hace una introducción de la fundación de Puebla y comienza nuestro andar por los callejones.</p>
                </div>
              </article>
              <article class="ruta__panel ruta__card" role="tabpanel" id="ruta-panel-1" aria-labelledby="ruta-tab-1" hidden>
                <img class="ruta__card-img" src="image/callejoneada/paso-2-adentrandonos-historia.jpg" alt="Guía narrando la historia ante el grupo y la fuente de San Miguel iluminada" loading="lazy" />
                <span class="ruta__card-shine" aria-hidden="true"></span>
                <div class="ruta__card-body">
                  <span class="ruta__panel-icon"><svg class="ic"><use href="#ic-walk"/></svg></span>
                  <h3 class="ruta__panel-title">Adentrándonos a la historia</h3>
                  <p class="ruta__panel-text">Caminamos juntos por calles y callejones donde inicia el relato. Con cada paso nos adentramos más en la historia y las leyendas de Puebla.</p>
                </div>
              </article>
              <article class="ruta__panel ruta__card" role="tabpanel" id="ruta-panel-2" aria-labelledby="ruta-tab-2" hidden>
                <img class="ruta__card-img" src="image/callejoneada/paso-3-sitios-emblematicos.jpg" alt="Actuación frente a un edificio colonial emblemático del Centro Histórico de Puebla" loading="lazy" />
                <span class="ruta__card-shine" aria-hidden="true"></span>
                <div class="ruta__card-body">
                  <span class="ruta__panel-icon"><svg class="ic"><use href="#ic-church"/></svg></span>
                  <h3 class="ruta__panel-title">Sitios Emblemáticos</h3>
                  <p class="ruta__panel-text">Recorremos plazas, templos y rincones emblemáticos del Centro Histórico, donde la arquitectura colonial guarda siglos de misterio.</p>
                </div>
              </article>
              <article class="ruta__panel ruta__card" role="tabpanel" id="ruta-panel-3" aria-labelledby="ruta-tab-3" hidden>
                <img class="ruta__card-img" src="image/callejoneada/paso-4-personajes-legendarios.jpg" alt="Personaje legendario caracterizado actuando en un callejón adornado con papel picado" loading="lazy" />
                <span class="ruta__card-shine" aria-hidden="true"></span>
                <div class="ruta__card-body">
                  <span class="ruta__panel-icon"><svg class="ic"><use href="#ic-masks"/></svg></span>
                  <h3 class="ruta__panel-title">Personajes Legendarios</h3>
                  <p class="ruta__panel-text">Entre sombras y velas, los personajes del pasado salen a tu encuentro y cobran vida ante tus ojos.</p>
                </div>
              </article>
              <article class="ruta__panel ruta__card" role="tabpanel" id="ruta-panel-4" aria-labelledby="ruta-tab-4" hidden>
                <img class="ruta__card-img" src="image/callejoneada/paso-5-final-inolvidable.jpg" alt="El grupo reunido con los personajes al final del recorrido nocturno" loading="lazy" />
                <span class="ruta__card-shine" aria-hidden="true"></span>
                <div class="ruta__card-body">
                  <span class="ruta__panel-icon"><svg class="ic"><use href="#ic-moon"/></svg></span>
                  <h3 class="ruta__panel-title">Final Inolvidable</h3>
                  <p class="ruta__panel-text">Un cierre inmersivo que se queda contigo para siempre. Caminaste por Puebla… y la historia caminó contigo.</p>
                </div>
              </article>
            </div>
          </div>
        </div>
      </section>

      <section class="section mapa noise" id="mapa" aria-label="Mapa interactivo de la ruta">
        <div class="container">
          <span class="section__kicker reveal">El recorrido en el mapa</span>
          <h2 class="section__title reveal">El mapa de la leyenda</h2>
          <p class="mapa__intro reveal">
            Elige un recorrido y descubre los lugares que cobran vida en él. Acércate con el zoom,
            arrastra para explorar y toca cada punto para ver su imagen y su historia.
          </p>
          <p class="mapa__aviso reveal">Nuestros recorridos están sujetos a cambios por situaciones externas.</p>
          <div class="mapa__tabs reveal" role="tablist" aria-label="Selecciona un recorrido">
            <button class="mapa__tab is-active" role="tab" aria-selected="true" data-recorrido="ultratumba"><svg class="ic ic--inline"><use href="#ic-candle"/></svg>Leyendas de Ultratumba</button>
            <button class="mapa__tab" role="tab" aria-selected="false" data-recorrido="santa-clara"><svg class="ic ic--inline"><use href="#ic-church"/></svg>Santa Clara</button>
            <button class="mapa__tab" role="tab" aria-selected="false" data-recorrido="otros"><svg class="ic ic--inline"><use href="#ic-masks"/></svg>Otros Recorridos</button>
          </div>

          <div class="mapa__frame reveal">
            <div class="mapa__viewport" id="mapaViewport">
              <div class="mapa__canvas" id="mapaCanvas">
                <img
                  class="mapa__base"
                  src="image/mapa/mapa-base.jpg"
                  onerror="this.onerror=null;this.src='image/mapa-placeholder.svg'"
                  alt="Mapa del Centro Histórico de Puebla"
                  draggable="false"
                />

                <!-- Los pines se generan dinámicamente según el recorrido elegido -->
                <div class="mapa__pins" id="mapaPins"></div>
              </div>
            </div>

            <div class="mapa__controls" aria-label="Controles de zoom">
              <button class="mapa__ctrl" id="mapaZoomIn" aria-label="Acercar">+</button>
              <button class="mapa__ctrl" id="mapaZoomOut" aria-label="Alejar">−</button>
              <button class="mapa__ctrl" id="mapaReset" aria-label="Restablecer vista">⟲</button>
            </div>
          </div>

          <ul class="mapa__legend reveal" aria-label="Referencias del mapa">
            <li class="mapa__legend-item"><span class="mapa__pin mapa__pin--inicio mapa__pin--static"></span> Punto de inicio</li>
            <li class="mapa__legend-item"><span class="mapa__pin mapa__pin--leyenda mapa__pin--static"></span> Puntos de Leyendas</li>
            <li class="mapa__legend-item"><span class="mapa__park mapa__park--static">E</span> Estacionamientos 24 horas</li>
          </ul>
        </div>
      </section>

      <section class="section tours" id="recorridos" aria-label="Recorridos disponibles">
        <div class="container">
          <header class="chapter reveal">
            <span class="chapter__mini">— Capítulo II —</span>
            <h2 class="chapter__title">NUESTRAS CALLEJONEADAS</h2>
          </header>

          <div class="tours__grid">
            @foreach ($callejoneadas as $callejoneada)
              <article class="tour-card tour-card--{{ $callejoneada->estilo }} reveal">
                @if ($callejoneada->imagen)
                  <button
                    class="tour-card__image-button"
                    type="button"
                    data-tour-modal
                    data-title="{{ $callejoneada->titulo }}"
                    data-description="{{ $callejoneada->descripcion_ampliada ?: 'Descubre todos los detalles de esta callejoneada y vive una experiencia inolvidable por las calles de Puebla.' }}"
                    data-image="{{ $callejoneada->imagen }}"
                    data-contact-url="{{ $callejoneada->cta_url ?: '#contacto' }}"
                    aria-label="Ver detalles de {{ $callejoneada->titulo }}"
                  ><img class="tour-card__img" src="{{ $callejoneada->imagen }}" alt="{{ $callejoneada->titulo }}" loading="lazy" /></button>
                @endif
                <div class="tour-card__overlay"></div>
                <div class="tour-card__content">
                  @if ($callejoneada->badge)<span class="tour-card__badge">@if ($callejoneada->badge_icono)<svg class="ic ic--inline"><use href="#{{ $callejoneada->badge_icono }}"/></svg>@endif{{ $callejoneada->badge }}</span>@endif
                  @if ($callejoneada->icono)<span class="tour-card__icon"><svg class="ic"><use href="#{{ $callejoneada->icono }}"/></svg></span>@endif
                  <h3 class="tour-card__title">{{ $callejoneada->titulo }}</h3>
                  <p class="tour-card__text">{{ $callejoneada->texto }}</p>
                  <a class="tour-card__cta" href="{{ $callejoneada->cta_url ?: '#contacto' }}">Adentrarse →</a>
                </div>
              </article>
            @endforeach
          </div>
        </div>
      </section>

      <section class="section promos" id="promociones" aria-label="Promociones">
        <div class="container">
          <span class="section__kicker reveal">Ofertas vivas</span>
          <h2 class="section__title reveal">Promociones</h2>
          <div class="promos__carousel">
            <button type="button" class="carousel__nav carousel__nav--prev" aria-label="Anterior" onclick="carruselDeslizar('promosTrack', -1)">‹</button>
            <div class="promos__grid" id="promosTrack">
            @foreach ($promociones as $promo)
            <article class="promo-card reveal">
              <img class="promo-card__img" src="{{ $promo->imagen }}" alt="{{ $promo->titulo }}" loading="lazy" />
              <div class="promo-card__body">
                @if ($promo->badge)<span class="promo-card__badge">{{ $promo->badge }}</span>@endif
                <h3 class="promo-card__title">{{ $promo->titulo }}</h3>
                <p class="promo-card__text">{{ $promo->texto }}</p>
                <div class="promo-card__footer">
                  @if ($promo->vigencia_texto)<p class="promo-card__valid">{{ $promo->vigencia_texto }}</p>@endif
                  <a class="btn btn--gold btn--shine promo-card__cta" href="{{ $promo->cta_url }}" target="_blank" rel="noopener">Reservar por WhatsApp</a>
                </div>
              </div>
            </article>
            @endforeach
            </div>
            <button type="button" class="carousel__nav carousel__nav--next" aria-label="Siguiente" onclick="carruselDeslizar('promosTrack', 1)">›</button>
          </div>
        </div>
      </section>

      <section class="section eventos noise" id="eventos" aria-label="Eventos de temporada">
        <div class="container">
          <span class="section__kicker reveal">Fechas marcadas en rojo</span>
          <h2 class="section__title reveal">Eventos de temporada</h2>
          <div class="eventos__carousel">
            <button type="button" class="carousel__nav carousel__nav--prev" aria-label="Anterior" onclick="carruselDeslizar('eventosTrack', -1)">‹</button>
            <div class="eventos__grid" id="eventosTrack">
            @foreach ($eventos as $evento)
            <article class="evento-card reveal">
              <img class="evento-card__img" src="{{ $evento->imagen }}" alt="{{ $evento->titulo }}" loading="lazy" />
              <div class="evento-card__overlay"></div>
              <div class="evento-card__content">
                <span class="evento-card__date">@if ($evento->fecha_icono)<svg class="ic ic--inline"><use href="#{{ $evento->fecha_icono }}"/></svg>@endif{{ $evento->fecha_texto }}</span>
                @if ($evento->icono)<span class="evento-card__icon"><svg class="ic"><use href="#{{ $evento->icono }}"/></svg></span>@endif
                <h3 class="evento-card__title">{{ $evento->titulo }}</h3>
                <p class="evento-card__text">{{ $evento->texto }}</p>
                <a class="evento-card__cta" href="{{ $evento->cta_url }}" target="_blank" rel="noopener">Más información →</a>
              </div>
            </article>
            @endforeach
            </div>
            <button type="button" class="carousel__nav carousel__nav--next" aria-label="Siguiente" onclick="carruselDeslizar('eventosTrack', 1)">›</button>
          </div>
        </div>
      </section>

      <section class="section servicios" id="servicios" aria-label="Servicios extras">
        <div class="container">
          <span class="section__kicker reveal">Más allá de la callejoneada</span>
          <h2 class="section__title reveal">Servicios Extras</h2>
          <p class="servicios__intro reveal">
            Además de nuestros recorridos, damos vida a todo tipo de eventos con personajes,
            vestuario y tradición poblana.
          </p>

          <div class="servicios__grid">
            @foreach ($servicios as $servicio)
            <article class="servicio-card reveal">
              @if ($servicio->icono)<span class="servicio-card__icon"><svg class="ic"><use href="#{{ $servicio->icono }}"/></svg></span>@endif
              <h3 class="servicio-card__title">{{ $servicio->titulo }}</h3>
              <p class="servicio-card__text">{{ $servicio->texto }}</p>
            </article>
            @endforeach
          </div>

          <aside class="servicios__cta reveal">
            <p class="servicios__cta-text">Cuéntanos tu idea, nosotros la hacemos realidad.</p>
            <a class="btn btn--gold btn--shine" href="https://wa.me/522222650024" target="_blank" rel="noopener">Cuéntanos tu idea</a>
          </aside>
        </div>
      </section>

      <section class="section experience noise" aria-label="Cómo se vive la experiencia">
        <div class="container">
          <span class="section__kicker reveal">Así vives Puebla Legendaria</span>
          <h2 class="section__title reveal">El ritual de cada noche</h2>

          <div class="timeline">
            <article class="step reveal">
              <div class="step__icon"><svg class="ic"><use href="#ic-phone"/></svg></div>
              <h3 class="step__title">Reserva</h3>
              <p>Elige recorrido, fecha y reúne a tu grupo.</p>
            </article>
            <article class="step reveal">
              <div class="step__icon"><svg class="ic"><use href="#ic-masks"/></svg></div>
              <h3 class="step__title">Vive la Leyenda</h3>
              <p>Actores profesionales te llevan por historias vivas.</p>
            </article>
            <article class="step reveal">
              <div class="step__icon"><svg class="ic"><use href="#ic-skull"/></svg></div>
              <h3 class="step__title">Nunca Olvidarás</h3>
              <p>Una noche inmersiva que se queda contigo para siempre.</p>
            </article>
          </div>
        </div>
      </section>

      <section class="section pact" aria-label="Por qué elegirnos">
        <div class="container">
          <span class="section__kicker reveal">Nuestro pacto</span>
          <h2 class="section__title reveal">¿Por qué elegir Puebla Legendaria?</h2>

          <div class="pact__grid">
            <article class="pact-item reveal"><span class="pact-item__icon"><svg class="ic"><use href="#ic-masks"/></svg></span><span>Actores Poblanos Profesionales</span></article>
            <article class="pact-item reveal"><span class="pact-item__icon"><svg class="ic"><use href="#ic-scroll"/></svg></span><span>Guías Certificados</span></article>
            <article class="pact-item reveal"><span class="pact-item__icon"><svg class="ic"><use href="#ic-clock"/></svg></span><span>+20 Años de Experiencia</span></article>
            <article class="pact-item reveal"><span class="pact-item__icon"><svg class="ic"><use href="#ic-map"/></svg></span><span>16+ Recorridos Únicos</span></article>
            <article class="pact-item reveal"><span class="pact-item__icon"><svg class="ic"><use href="#ic-star"/></svg></span><span>98% de Recomendación</span></article>
            <article class="pact-item reveal"><span class="pact-item__icon"><svg class="ic"><use href="#ic-flag"/></svg></span><span>Empresa 100% Poblana e Independiente</span></article>
          </div>
        </div>
      </section>

      <section class="section testimonials" aria-label="Testimonios">
        <div class="container">
          <span class="section__kicker reveal">Voces del más allá</span>
          <h2 class="section__title reveal">Opiniones de la experiencia...</h2>

          <div class="testimonials__grid">
            <article class="testimonial reveal">
              <p class="testimonial__text">★★★★★ “Nunca había vivido algo así. Los actores te hacen sentir que realmente estás en otra época. ¡Increíble!”</p>
              <p class="testimonial__author">— María González, CDMX</p>
            </article>
            <article class="testimonial reveal">
              <p class="testimonial__text">★★★★★ “La Santa Inquisición fue TERRORÍFICO en el mejor sentido. Mi esposa no dejaba de gritar. 100% recomendado.”</p>
              <p class="testimonial__author">— Roberto Sánchez, Guadalajara</p>
            </article>
            <article class="testimonial reveal">
              <p class="testimonial__text">★★★★★ “Llevé a mis hijos al tour familiar y quedaron fascinados. Aprendieron más historia en 2 horas que en todo el semestre.”</p>
              <p class="testimonial__author">— Ana López, Monterrey</p>
            </article>
          </div>
        </div>
      </section>

      <section class="section faq" id="faq" aria-label="Preguntas frecuentes">
        <div class="container">
          <span class="section__kicker reveal">Resuelve tus dudas</span>
          <h2 class="section__title reveal">Preguntas frecuentes</h2>

          <div class="faq__list">
            @foreach ($preguntasFrecuentes as $preguntaFrecuente)
              <article class="faq-item reveal">
                <button class="faq-item__q" aria-expanded="false" aria-controls="faq-a-{{ $preguntaFrecuente->id }}" id="faq-q-{{ $preguntaFrecuente->id }}">
                  <span>{{ $preguntaFrecuente->pregunta }}</span>
                  <span class="faq-item__chevron" aria-hidden="true">⌄</span>
                </button>
                <div class="faq-item__a" id="faq-a-{{ $preguntaFrecuente->id }}" role="region" aria-labelledby="faq-q-{{ $preguntaFrecuente->id }}" hidden>
                  <p>{{ $preguntaFrecuente->respuesta }}</p>
                </div>
              </article>
            @endforeach
          </div>
        </div>
      </section>

      <section class="section gallery" id="galeria" aria-label="Galería">
        <div class="container">
          <span class="section__kicker reveal">Fragmentos de la noche</span>
          <h2 class="section__title reveal">Galería de apariciones</h2>

          <div class="gallery__grid">
            <figure class="gallery__item reveal">
              <img src="image/galeria/la-parca-guadana-templo.jpg" alt="La Parca con su guadaña frente a un templo iluminado de Puebla por la noche" loading="lazy" />
              <figcaption class="gallery__overlay">La Parca · Leyendas del Estado</figcaption>
            </figure>
            <figure class="gallery__item reveal">
              <img src="image/galeria/fogata-ex-hacienda-chautla.jpg" alt="Personaje actuando junto a una fogata rodeado de visitantes en el patio de la Ex Hacienda de Chautla" loading="lazy" />
              <figcaption class="gallery__overlay">Fogata en la Ex Hacienda de Chautla</figcaption>
            </figure>
            <figure class="gallery__item reveal">
              <img src="image/galeria/nahual-hombre-lobo-catedral.jpg" alt="Personaje caracterizado como nahual frente a la Catedral de Puebla" loading="lazy" style="object-position: 50% 18%;" />
              <figcaption class="gallery__overlay">El Nahual en el Centro Histórico</figcaption>
            </figure>
            <figure class="gallery__item reveal">
              <img src="image/galeria/marquesa-vestido-dorado.jpg" alt="La Marquesa con vestido colonial dorado arrodillada en una calle empedrada de noche" loading="lazy" style="object-position: 50% 18%;" />
              <figcaption class="gallery__overlay">La Marquesa de la Selva Nevada</figcaption>
            </figure>
            <figure class="gallery__item reveal">
              <img src="image/galeria/guia-narrador-publico-callejoneada.jpg" alt="Guía narrador actuando ante el público sentado durante una callejoneada nocturna" loading="lazy" />
              <figcaption class="gallery__overlay">Callejoneada bajo las estrellas</figcaption>
            </figure>
            <figure class="gallery__item reveal">
              <img src="image/galeria/tuneles-secretos-recorrido.jpg" alt="Grupo de visitantes recorriendo los túneles secretos de piedra de Puebla" loading="lazy" />
              <figcaption class="gallery__overlay">Los túneles secretos de Puebla</figcaption>
            </figure>
          </div>
        </div>
      </section>

      <section class="section tienda noise" id="tienda" aria-label="Tienda">
        <div class="container">
          <span class="section__kicker reveal">Llévate la leyenda</span>
          <h2 class="section__title reveal">Tienda</h2>
          <p class="tienda__intro reveal">
            Recuerdos de Puebla Legendaria para que la noche te acompañe a donde vayas.
          </p>
          <div class="tienda__carousel">
            <button type="button" class="carousel__nav carousel__nav--prev" aria-label="Anterior" onclick="carruselDeslizar('tiendaTrack', -1)">‹</button>
            <div class="tienda__grid" id="tiendaTrack">
              @foreach ($productos as $producto)
              <article class="tienda-card reveal">
                <img class="tienda-card__img" src="{{ $producto->imagen }}" alt="{{ $producto->titulo }}" loading="lazy" />
                <div class="tienda-card__body">
                  @if ($producto->icono)<span class="tienda-card__icon"><svg class="ic"><use href="#{{ $producto->icono }}"/></svg></span>@endif
                  <h3 class="tienda-card__title">{{ $producto->titulo }}</h3>
                  <p class="tienda-card__text">{{ $producto->texto }}</p>
                  <a class="tienda-card__cta" href="{{ $producto->cta_url }}" target="_blank" rel="noopener">Pedir por WhatsApp →</a>
                </div>
              </article>
              @endforeach
            </div>
            <button type="button" class="carousel__nav carousel__nav--next" aria-label="Siguiente" onclick="carruselDeslizar('tiendaTrack', 1)">›</button>
          </div>
        </div>
      </section>

      <section class="section contact noise" id="contacto" aria-label="Contacto y reservaciones">
        <div class="container">
          <span class="section__kicker reveal">Invoca tu reservación</span>
          <h2 class="section__title reveal">Contacto</h2>

          <div class="contact__grid">
            <article class="form reveal">
              @if (session('contacto_ok'))
                <div class="form__aviso form__aviso--ok">
                  ✅ ¡Gracias! Tu mensaje fue enviado. Te contactaremos muy pronto.
                  @if (session('whatsapp_url'))
                    <br />
                    Se abrirá WhatsApp para enviar tu solicitud. Si no se abre solo,
                    <a href="{{ session('whatsapp_url') }}" target="_blank" rel="noopener" id="whatsappLink">toca aquí</a>.
                  @endif
                </div>
                @if (session('whatsapp_url'))
                  <script>
                    (function () {
                      var url = @json(session('whatsapp_url'));
                      var w = window.open(url, '_blank');
                      // Si el navegador bloqueó la pestaña nueva, abrimos en la misma.
                      if (!w || w.closed || typeof w.closed === 'undefined') {
                        setTimeout(function () { window.location.href = url; }, 1500);
                      }
                    })();
                  </script>
                @endif
              @endif
              @if ($errors->any())
                <div class="form__aviso form__aviso--error">Revisa los campos marcados, por favor.</div>
              @endif
              <form action="{{ route('contacto') }}#contacto" method="post" aria-label="Formulario de reservación">
                @csrf
                <div class="form__group">
                  <label for="nombre">Nombre completo</label>
                  <input id="nombre" name="nombre" type="text" value="{{ old('nombre') }}" required />
                  @error('nombre')<span class="form__error">{{ $message }}</span>@enderror
                </div>
                <div class="form__group">
                  <label for="email">Email</label>
                  <input id="email" name="email" type="email" value="{{ old('email') }}" required />
                  @error('email')<span class="form__error">{{ $message }}</span>@enderror
                </div>
                <div class="form__group">
                  <label for="telefono">Teléfono</label>
                  <input id="telefono" name="telefono" type="tel" value="{{ old('telefono') }}" required />
                  @error('telefono')<span class="form__error">{{ $message }}</span>@enderror
                </div>
                <div class="form__group">
                  <label for="recorrido">Recorrido de interés</label>
                  <select id="recorrido" name="recorrido" required>
                    <option value="">Selecciona un recorrido</option>
                    @foreach (['Tour de Leyendas Clásico','La Marquesa de la Selva Nevada','Fundación de Cholula','Los Hermanos Serdán','La Santa Inquisición','Tour Divertido de Leyendas','Ángeles y Demonios','Batalla del 5 de Mayo','Leyendas del Estado','Ex Hacienda de Chautla','La Verdadera Fundación','Callejones del Centro'] as $op)
                      <option @selected(old('recorrido') === $op)>{{ $op }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form__group">
                  <label for="personas">Número de personas</label>
                  <select id="personas" name="personas" required>
                    <option value="">Selecciona</option>
                    @foreach (['1-2','3-5','6-10','11-15','16-20'] as $op)
                      <option @selected(old('personas') === $op)>{{ $op }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form__group">
                  <label for="mensaje">Mensaje o peticiones especiales</label>
                  <textarea id="mensaje" name="mensaje" rows="5" required>{{ old('mensaje') }}</textarea>
                  @error('mensaje')<span class="form__error">{{ $message }}</span>@enderror
                </div>
                <button class="btn btn--gold btn--shine" type="submit">Enviar Mensaje</button>
              </form>
            </article>

            <aside class="contact-info reveal" aria-label="Datos de contacto">
              <p class="contact-info__item"><svg class="ic ic--inline"><use href="#ic-pin"/></svg>3 Poniente No. 305, Int. 202, Centro, Puebla, Pue. 72000</p>
              <p class="contact-info__item"><svg class="ic ic--inline"><use href="#ic-phone"/></svg><a href="tel:+522222650024">+52 222 265 0024</a></p>
              <p class="contact-info__item"><svg class="ic ic--inline"><use href="#ic-mail"/></svg><a href="mailto:pueblalegendaria@hotmail.com">pueblalegendaria@hotmail.com</a></p>
              <p class="contact-info__item"><svg class="ic ic--inline"><use href="#ic-chat"/></svg><a href="https://wa.me/522222650024" target="_blank" rel="noopener">WhatsApp directo</a></p>
              <p class="contact-info__item"><svg class="ic ic--inline"><use href="#ic-clock"/></svg>Siempre abiertos por reservación</p>

              <iframe
                title="Mapa Puebla Legendaria"
                aria-label="Mapa de Puebla Legendaria"
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
                src="https://www.google.com/maps?q=3%20Poniente%20305%20Centro%20Puebla&output=embed"
              ></iframe>
            </aside>
          </div>
        </div>
      </section>
    </main>

    <footer class="footer" aria-label="Pie de página">
      <div class="container footer__grid">
        <section>
          <h3 class="footer__brand"><img class="footer__logo" src="logos/logo_vertical.svg" alt="Puebla Legendaria" width="130" height="130" /></h3>
          <p>Turismo cultural actuado con identidad poblana. Misterio, historia y emoción en cada recorrido.</p>
          <p><strong>Desde 2002</strong></p>
        </section>
        <section>
          <h4>Links rápidos</h4>
          <ul>
            <li><a href="#inicio">Inicio</a></li>
            <li><a href="#callejoneada">¿Cómo es una callejoneada?</a></li>
            <li><a href="#mapa">Mapa de la ruta</a></li>
            <li><a href="#recorridos">Recorridos</a></li>
            <li><a href="#promociones">Promociones</a></li>
            <li><a href="#eventos">Eventos de temporada</a></li>
            <li><a href="#servicios">Servicios Extras</a></li>
            <li><a href="#tienda">Tienda</a></li>
            <li><a href="#faq">Preguntas frecuentes</a></li>
            <li><a href="#galeria">Galería</a></li>
            <li><a href="#contacto">Contacto</a></li>
          </ul>
        </section>
        <section>
          <h4>Recorridos populares</h4>
          <ul>
            <li><a href="#recorridos">Tour de Leyendas Clásico</a></li>
            <li><a href="#recorridos">La Santa Inquisición</a></li>
            <li><a href="#recorridos">Ángeles y Demonios</a></li>
            <li><a href="#recorridos">Batalla del 5 de Mayo</a></li>
          </ul>
        </section>
        <section>
          <h4>Redes</h4>
          <ul>
            <li><a href="https://facebook.com/tourdeleyendas" target="_blank" rel="noopener">Facebook</a></li>
            <li><a href="https://x.com/PueblaLegendaria" target="_blank" rel="noopener">X</a></li>
            <li><a href="https://www.youtube.com/@PueblaLegendaria" target="_blank" rel="noopener">YouTube</a></li>
            <li><a href="#" target="_blank" rel="noopener">Instagram</a></li>
            <li><a href="https://wa.me/522222650024" target="_blank" rel="noopener">WhatsApp</a></li>
            <li><a href="#" target="_blank" rel="noopener">TikTok</a></li>
          </ul>
        </section>
      </div>

      <div class="container">
        <div class="footer__line"></div>
        <p class="footer__copy">© 2025 Puebla Legendaria — Las leyendas nunca mueren.</p>
        <p class="footer__final">Nos vemos en las calles de Puebla... cuando caiga la noche <svg class="ic ic--inline"><use href="#ic-candle"/></svg></p>
      </div>
    </footer>

    <div class="mapa-modal" id="mapaModal" hidden>
      <div class="mapa-modal__backdrop" data-close></div>
      <figure class="mapa-modal__card" role="dialog" aria-modal="true" aria-labelledby="mapaModalTitle">
        <button class="mapa-modal__close" data-close aria-label="Cerrar">✕</button>
        <img class="mapa-modal__img" id="mapaModalImg" src="" alt="" />
        <figcaption class="mapa-modal__body">
          <h3 class="mapa-modal__title" id="mapaModalTitle"></h3>
          <p class="mapa-modal__desc" id="mapaModalDesc"></p>
        </figcaption>
      </figure>
    </div>

    <div class="tour-modal" id="tourModal" hidden>
      <div class="tour-modal__backdrop" data-tour-close></div>
      <article class="tour-modal__card" role="dialog" aria-modal="true" aria-labelledby="tourModalTitle" aria-describedby="tourModalDescription">
        <button class="tour-modal__close" type="button" data-tour-close aria-label="Cerrar">✕</button>
        <img class="tour-modal__img" id="tourModalImg" src="" alt="" />
        <div class="tour-modal__body">
          <h3 class="tour-modal__title" id="tourModalTitle"></h3>
          <p class="tour-modal__description" id="tourModalDescription"></p>
          <a class="btn btn--gold btn--shine tour-modal__cta" id="tourModalCta" href="#contacto">Pedir más información</a>
        </div>
      </article>
    </div>

    <a
      class="whatsapp-float"
      href="https://wa.me/522222650024"
      target="_blank"
      rel="noopener"
      aria-label="Contactar por WhatsApp"
      title="WhatsApp"
    ><svg class="ic"><use href="#ic-chat"/></svg></a>

    <script>
      // Carrusel deslizable (Promociones, Eventos y Tienda)
      function carruselDeslizar(trackId, dir) {
        var track = document.getElementById(trackId);
        if (!track) return;
        var card = track.querySelector(":scope > *");
        var step = card ? card.getBoundingClientRect().width + 16 : track.clientWidth * 0.8;
        track.scrollBy({ left: dir * step, behavior: "smooth" });
      }

      // Detalle ampliado de las callejoneadas
      (function () {
        var modal = document.getElementById("tourModal");
        var modalImg = document.getElementById("tourModalImg");
        var modalTitle = document.getElementById("tourModalTitle");
        var modalDescription = document.getElementById("tourModalDescription");
        var modalCta = document.getElementById("tourModalCta");
        var lastFocused = null;

        function openTourModal(trigger) {
          lastFocused = trigger;
          modalTitle.textContent = trigger.dataset.title || "";
          modalDescription.textContent = trigger.dataset.description || "";
          modalImg.src = trigger.dataset.image || "";
          modalImg.alt = trigger.dataset.title || "";
          modalCta.href = trigger.dataset.contactUrl || "#contacto";
          modal.hidden = false;
          document.body.style.overflow = "hidden";
          modal.querySelector(".tour-modal__close").focus();
        }

        function closeTourModal() {
          if (modal.hidden) return;
          modal.hidden = true;
          document.body.style.overflow = "";
          if (lastFocused) lastFocused.focus();
        }

        document.querySelectorAll("[data-tour-modal]").forEach(function (trigger) {
          trigger.addEventListener("click", function () { openTourModal(trigger); });
        });
        modal.querySelectorAll("[data-tour-close]").forEach(function (control) {
          control.addEventListener("click", closeTourModal);
        });
        modalCta.addEventListener("click", closeTourModal);
        document.addEventListener("keydown", function (event) {
          if (event.key === "Escape") closeTourModal();
        });
      })();

      const header = document.querySelector(".header");
      const navToggle = document.getElementById("navToggle");
      const navMenu = document.getElementById("navMenu");
      const navLinks = document.querySelectorAll(".nav__link");
      const revealItems = document.querySelectorAll(".reveal");
      const counters = document.querySelectorAll(".counter__number");

      function onScrollHeader() {
        if (window.scrollY > 24) {
          header.classList.add("header--scrolled");
        } else {
          header.classList.remove("header--scrolled");
        }
      }
      window.addEventListener("scroll", onScrollHeader);
      onScrollHeader();

      navToggle.addEventListener("click", () => {
        const isOpen = navMenu.classList.toggle("is-open");
        navToggle.classList.toggle("is-active", isOpen);
        navToggle.setAttribute("aria-expanded", String(isOpen));
      });

      navLinks.forEach((link) => {
        link.addEventListener("click", () => {
          navMenu.classList.remove("is-open");
          navToggle.classList.remove("is-active");
          navToggle.setAttribute("aria-expanded", "false");
        });
      });

      const revealObserver = new IntersectionObserver(
        (entries) => {
          entries.forEach((entry) => {
            if (entry.isIntersecting) entry.target.classList.add("reveal--visible");
          });
        },
        { threshold: 0.12 }
      );
      revealItems.forEach((item) => revealObserver.observe(item));

      function animateCounter(el) {
        const target = Number(el.dataset.target || 0);
        const duration = 1400;
        const startTime = performance.now();

        function update(now) {
          const progress = Math.min((now - startTime) / duration, 1);
          const eased = 1 - Math.pow(1 - progress, 3);
          const value = Math.floor(eased * target);
          el.textContent = value.toLocaleString("es-MX");
          if (progress < 1) requestAnimationFrame(update);
          else {
            if (target === 20) el.textContent = "+20";
            if (target === 16) el.textContent = "16+";
            if (target === 98) el.textContent = "98%";
            if (target === 1000) el.textContent = "1000+";
          }
        }
        requestAnimationFrame(update);
      }

      const counterObserver = new IntersectionObserver(
        (entries, observer) => {
          entries.forEach((entry) => {
            if (entry.isIntersecting && !entry.target.dataset.animated) {
              entry.target.dataset.animated = "true";
              animateCounter(entry.target);
              observer.unobserve(entry.target);
            }
          });
        },
        { threshold: 0.6 }
      );
      counters.forEach((counter) => counterObserver.observe(counter));

      // Ruta interactiva "¿Cómo es una callejoneada?"
      const rutaNodes = document.querySelectorAll(".ruta__node");
      const rutaPanels = document.querySelectorAll(".ruta__panel");
      rutaNodes.forEach((node) => {
        node.addEventListener("click", () => {
          const step = Number(node.dataset.step);

          rutaNodes.forEach((n) => {
            const active = n === node;
            n.classList.toggle("is-active", active);
            n.setAttribute("aria-selected", String(active));
          });

          rutaPanels.forEach((panel, index) => {
            const active = index === step;
            panel.classList.toggle("is-active", active);
            panel.hidden = !active;
          });
        });
      });

      // Efecto 3D (tilt) de las tarjetas de la ruta
      const rutaStage = document.getElementById("rutaStage");
      const prefersReducedMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;

      if (rutaStage && !prefersReducedMotion) {
        const MAX_TILT = 10; // grados

        function tiltFrom(clientX, clientY) {
          const card = rutaStage.querySelector(".ruta__panel.is-active");
          if (!card) return;
          const rect = card.getBoundingClientRect();
          const px = (clientX - rect.left) / rect.width; // 0..1
          const py = (clientY - rect.top) / rect.height; // 0..1
          const rotateY = (px - 0.5) * 2 * MAX_TILT;
          const rotateX = (0.5 - py) * 2 * MAX_TILT;
          card.classList.add("is-tilting");
          card.style.transform = `rotateX(${rotateX.toFixed(2)}deg) rotateY(${rotateY.toFixed(2)}deg)`;
          const shine = card.querySelector(".ruta__card-shine");
          if (shine) {
            shine.style.setProperty("--shine-x", (px * 100).toFixed(1) + "%");
            shine.style.setProperty("--shine-y", (py * 100).toFixed(1) + "%");
          }
        }

        function resetTilt() {
          const card = rutaStage.querySelector(".ruta__panel.is-active");
          if (!card) return;
          card.classList.remove("is-tilting");
          card.style.transform = "";
          const shine = card.querySelector(".ruta__card-shine");
          if (shine) {
            shine.style.removeProperty("--shine-x");
            shine.style.removeProperty("--shine-y");
          }
        }

        rutaStage.addEventListener("mousemove", (e) => tiltFrom(e.clientX, e.clientY));
        rutaStage.addEventListener("mouseleave", resetTilt);
        rutaStage.addEventListener("touchmove", (e) => {
          const t = e.touches[0];
          if (t) tiltFrom(t.clientX, t.clientY);
        }, { passive: true });
        rutaStage.addEventListener("touchend", resetTilt);

        // Al cambiar de parada, limpiar la inclinación de la anterior
        rutaNodes.forEach((node) => node.addEventListener("click", resetTilt));
      }

      // Acordeón de Preguntas frecuentes
      const faqButtons = document.querySelectorAll(".faq-item__q");
      faqButtons.forEach((button) => {
        button.addEventListener("click", () => {
          const answer = document.getElementById(button.getAttribute("aria-controls"));
          const isOpen = button.getAttribute("aria-expanded") === "true";
          button.setAttribute("aria-expanded", String(!isOpen));
          button.classList.toggle("is-open", !isOpen);
          answer.hidden = isOpen;
        });
      });

      // ===== Mapa interactivo: zoom, arrastre y popup =====
      const mapaViewport = document.getElementById("mapaViewport");
      const mapaCanvas = document.getElementById("mapaCanvas");

      if (mapaViewport && mapaCanvas) {
        const MIN_SCALE = 1;
        const MAX_SCALE = 4;
        const CALIBRATION = false; // poner true para imprimir coordenadas % al hacer clic
        const view = { scale: 1, x: 0, y: 0 };
        let currentRecorrido = "ultratumba";

        function clamp(val, min, max) {
          return Math.min(Math.max(val, min), max);
        }

        // Mantiene el canvas dentro de los límites del viewport
        function constrain() {
          const vw = mapaViewport.clientWidth;
          const vh = mapaViewport.clientHeight;
          const cw = mapaCanvas.offsetWidth * view.scale;
          const ch = mapaCanvas.offsetHeight * view.scale;
          // En móvil se deja margen arriba para que las postales que sobresalen
          // por encima de su pin no se corten con el borde del visor.
          const isMobile = window.matchMedia("(max-width: 767px)").matches;
          const topRoom = isMobile ? 70 : 0;
          const minX = Math.min(0, vw - cw);
          const minY = Math.min(0, vh - ch);
          view.x = clamp(view.x, minX, cw > vw ? 0 : minX);
          view.y = clamp(view.y, minY, topRoom);
          if (cw <= vw) view.x = (vw - cw) / 2;
          if (!isMobile && ch <= vh) view.y = (vh - ch) / 2;
        }

        function apply() {
          constrain();
          mapaCanvas.style.transform =
            "translate(" + view.x + "px," + view.y + "px) scale(" + view.scale + ")";
        }

        // Vista inicial. En escritorio: escala 1, pegado arriba, centrado.
        // En celular: acercado y centrado en los pines del recorrido, para que
        // las postales (más pequeñas en móvil) se vean grandes y separadas.
        const MOBILE_SCALE = 1.6;
        function resetView() {
          const cw0 = mapaCanvas.offsetWidth;
          const ch0 = mapaCanvas.offsetHeight;
          const vw = mapaViewport.clientWidth;
          const vh = mapaViewport.clientHeight;
          const isMobile = window.matchMedia("(max-width: 767px)").matches;

          if (isMobile) {
            view.scale = MOBILE_SCALE;
            const pts = (RECORRIDOS[currentRecorrido] || {}).puntos || [];
            let cx = 0.5, minYf = 0.1;
            if (pts.length) {
              cx = pts.reduce((a, p) => a + p.x, 0) / pts.length / 100;
              minYf = Math.min.apply(null, pts.map((p) => p.y)) / 100;
            }
            const OVERHANG = 46; // alto de la postal por encima del pin (sin escalar)
            view.x = vw / 2 - view.scale * cx * cw0;
            // Alinea el bloque de pines arriba, dejando ver la postal más alta
            view.y = 14 - view.scale * (minYf * ch0 - OVERHANG);
          } else {
            view.scale = 1;
            view.y = 0;
            view.x = Math.min(0, (vw - cw0) / 2);
          }
          apply();
        }

        // Zoom centrado en un punto (px relativos al viewport)
        function zoomAt(px, py, nextScale) {
          nextScale = clamp(nextScale, MIN_SCALE, MAX_SCALE);
          const ratio = nextScale / view.scale;
          view.x = px - (px - view.x) * ratio;
          view.y = py - (py - view.y) * ratio;
          view.scale = nextScale;
          apply();
        }

        function zoomCenter(factor) {
          mapaCanvas.classList.add("is-animating");
          zoomAt(mapaViewport.clientWidth / 2, mapaViewport.clientHeight / 2, view.scale * factor);
          setTimeout(() => mapaCanvas.classList.remove("is-animating"), 300);
        }

        document.getElementById("mapaZoomIn").addEventListener("click", () => zoomCenter(1.3));
        document.getElementById("mapaZoomOut").addEventListener("click", () => zoomCenter(1 / 1.3));
        document.getElementById("mapaReset").addEventListener("click", () => {
          mapaCanvas.classList.add("is-animating");
          resetView();
          setTimeout(() => mapaCanvas.classList.remove("is-animating"), 300);
        });

        // Rueda del mouse = zoom hacia el cursor
        mapaViewport.addEventListener("wheel", (e) => {
          e.preventDefault();
          const rect = mapaViewport.getBoundingClientRect();
          const factor = e.deltaY < 0 ? 1.12 : 1 / 1.12;
          zoomAt(e.clientX - rect.left, e.clientY - rect.top, view.scale * factor);
        }, { passive: false });

        // Arrastre (mouse y táctil) + pellizco para zoom
        const pointers = new Map();
        let dragging = false;
        let moved = 0;
        let lastX = 0, lastY = 0;
        let pinchDist = 0;

        function pointerMidAndDist() {
          const pts = [...pointers.values()];
          const dx = pts[0].x - pts[1].x;
          const dy = pts[0].y - pts[1].y;
          const rect = mapaViewport.getBoundingClientRect();
          return {
            dist: Math.hypot(dx, dy),
            mx: (pts[0].x + pts[1].x) / 2 - rect.left,
            my: (pts[0].y + pts[1].y) / 2 - rect.top,
          };
        }

        mapaViewport.addEventListener("pointerdown", (e) => {
          pointers.set(e.pointerId, { x: e.clientX, y: e.clientY });
          mapaViewport.setPointerCapture(e.pointerId);
          if (pointers.size === 1) {
            dragging = true;
            moved = 0;
            lastX = e.clientX;
            lastY = e.clientY;
            mapaViewport.classList.add("is-grabbing");
          } else if (pointers.size === 2) {
            pinchDist = pointerMidAndDist().dist;
          }
        });

        mapaViewport.addEventListener("pointermove", (e) => {
          if (!pointers.has(e.pointerId)) return;
          pointers.set(e.pointerId, { x: e.clientX, y: e.clientY });

          if (pointers.size === 2) {
            const info = pointerMidAndDist();
            if (pinchDist > 0) {
              zoomAt(info.mx, info.my, view.scale * (info.dist / pinchDist));
            }
            pinchDist = info.dist;
            moved = 999; // evita disparar popup tras pellizcar
            return;
          }

          if (dragging) {
            const dx = e.clientX - lastX;
            const dy = e.clientY - lastY;
            moved += Math.abs(dx) + Math.abs(dy);
            view.x += dx;
            view.y += dy;
            lastX = e.clientX;
            lastY = e.clientY;
            apply();
          }
        });

        function endPointer(e) {
          // ¿Fue un toque/clic limpio (sin arrastrar) del último puntero?
          const esToque = e.type === "pointerup" && pointers.size === 1 && moved <= 8;

          pointers.delete(e.pointerId);
          if (pointers.size < 2) pinchDist = 0;
          if (pointers.size === 0) {
            dragging = false;
            mapaViewport.classList.remove("is-grabbing");
          }

          // setPointerCapture (necesario para arrastrar) hace que el navegador
          // reasigne el destino del evento "click", así que ese evento no sirve
          // para abrir el popup con mouse. Lo resolvemos aquí: buscamos nosotros
          // qué punto está bajo el cursor/dedo al soltar.
          if (esToque) {
            const bajoCursor = document.elementFromPoint(e.clientX, e.clientY);
            const point = bajoCursor && bajoCursor.closest ? bajoCursor.closest(".mapa__point") : null;
            if (point) openModal(point);
          }
        }
        mapaViewport.addEventListener("pointerup", endPointer);
        mapaViewport.addEventListener("pointercancel", endPointer);

        // Modal de lugar
        const mapaModal = document.getElementById("mapaModal");
        const mapaModalImg = document.getElementById("mapaModalImg");
        const mapaModalTitle = document.getElementById("mapaModalTitle");
        const mapaModalDesc = document.getElementById("mapaModalDesc");
        let lastFocused = null;

        function openModal(point) {
          lastFocused = point;
          mapaModalTitle.textContent = point.dataset.title || "";
          mapaModalDesc.textContent = point.dataset.desc || "";
          mapaModalImg.src = point.dataset.img || "";
          mapaModalImg.alt = point.dataset.title || "";
          mapaModal.hidden = false;
          document.body.style.overflow = "hidden";
          mapaModal.querySelector(".mapa-modal__close").focus();
        }
        function closeModal() {
          mapaModal.hidden = true;
          document.body.style.overflow = "";
          if (lastFocused) lastFocused.focus();
        }

        // Un lugar se define UNA sola vez, aunque aparezca en varios recorridos
        const LUGARES = {
          "palacio-municipal":      { titulo: "Palacio Municipal",                img: "image/mapa/palacio-municipal.jpg",      desc: "Sede del gobierno municipal, joya arquitectónica frente al Zócalo." },
          "fuente-san-miguel":      { titulo: "Fuente de San Miguel",             img: "image/mapa/fuente-san-miguel.jpg",      desc: "Fuente emblemática del Zócalo, rodeada de arquitectura colonial." },
          "catedral":               { titulo: "Santa Basílica Catedral de Puebla", img: "image/mapa/catedral.jpg",              desc: "La Catedral Basílica de Nuestra Señora de la Inmaculada Concepción, símbolo de la ciudad." },
          "pasaje-ayuntamiento":    { titulo: "Pasaje del Ayuntamiento",          img: "image/mapa/pasaje-ayuntamiento.jpg",    desc: "Pasaje histórico junto al Palacio Municipal." },
          "santo-domingo":          { titulo: "Iglesia de Santo Domingo",         img: "image/mapa/santo-domingo.jpg",          desc: "Templo que alberga la Capilla del Rosario, joya del barroco." },
          "mercado-victoria":       { titulo: "Mercado La Victoria",              img: "image/mapa/mercado-victoria.jpg",       desc: "Antiguo mercado tradicional de Puebla." },
          "calle-dulces":           { titulo: "Calle de los Dulces",              img: "image/mapa/calle-dulces.jpg",           desc: "La calle de los dulces típicos poblanos." },
          "fabrica-talavera":       { titulo: "Fábrica de Talavera",              img: "image/mapa/fabrica-talavera.jpg",       desc: "Taller tradicional de la talavera poblana." },
          "exconvento-santa-clara": { titulo: "Exconvento de Santa Clara",        img: "image/mapa/exconvento-santa-clara.jpg", desc: "Exconvento que da nombre a este recorrido." },
          "casa-hermanos-serdan":   { titulo: "Casa de los Hermanos Serdán",      img: "image/mapa/casa-hermanos-serdan.jpg",   desc: "Donde inició la Revolución Mexicana en Puebla." },
          "casa-munecos":           { titulo: "Casa de los Muñecos",              img: "image/mapa/casa-munecos.jpg",           desc: "Famosa por los personajes de talavera de su fachada." },
          "edificio-carolino":      { titulo: "Edificio Carolino",                img: "image/mapa/edificio-carolino.jpg",      desc: "Sede histórica de la Universidad, con bellos patios coloniales." },
          "el-parian":              { titulo: "Mercado de Artesanías El Parián",  img: "image/mapa/el-parian.jpg",              desc: "El mercado de artesanías más tradicional de Puebla." },
          "barrio-artista":         { titulo: "Barrio del Artista",               img: "image/mapa/barrio-artista.jpg",         desc: "Espacio bohemio donde pintores y artistas trabajan al aire libre." },
          "teatro-principal":       { titulo: "Teatro Principal",                 img: "image/mapa/teatro-principal.jpg",       desc: "“Antiguo Coliseo”, el primer teatro en América." },
          "maqueta-fundacion":      { titulo: "Maqueta de la Fundación",          img: "image/mapa/maqueta-fundacion.jpg",      desc: "Maqueta que recrea la fundación de la ciudad." },
          "explanada-compania":     { titulo: "Explanada de la Compañía",         img: "image/mapa/explanada-compania.jpg",     desc: "Explanada junto a la Iglesia de la Compañía." },
          "casa-inquisicion":       { titulo: "Casa de la Inquisición",           img: "image/mapa/casa-inquisicion.jpg",       desc: "Antigua casa ligada a la historia de la Santa Inquisición." },
          "iglesia-compania":       { titulo: "Iglesia de la Compañía",           img: "image/mapa/iglesia-compania.jpg",       desc: "Templo barroco ligado a la leyenda de la China Poblana." },
          "alrededores-carolino":   { titulo: "Alrededores del Edificio Carolino", img: "image/mapa/edificio-carolino.jpg",     desc: "Los callejones e historias que rodean al Carolino." },
        };

        // x = left %, y = top % sobre el mapa base (pin 1 = punto de inicio en los tres)
        const RECORRIDOS = {
          "ultratumba": {
            nombre: "Leyendas de Ultratumba",
            puntos: [
              { lugar: "palacio-municipal",      num: 1,  x: 30.6, y: 43.2, inicio: true },
              { lugar: "fuente-san-miguel",      num: 2,  x: 22.2, y: 47.5 },
              { lugar: "catedral",               num: 3,  x: 25.5, y: 56.0 },
              { lugar: "edificio-carolino",      num: 4,  x: 45.2, y: 73.8 },
              { lugar: "el-parian",              num: 5,  x: 65.3, y: 59.2 },
              { lugar: "barrio-artista",         num: 6,  x: 74.7, y: 44.7 },
              { lugar: "teatro-principal",       num: 7,  x: 75.8, y: 32.7 },
            ],
            estacionamientos: [
              { x: 39.0, y: 49.0 }, { x: 36.3, y: 64.3 },
              { x: 81.0, y: 52.6 }, { x: 77.7, y: 67.9 }, { x: 74.9, y: 75.5 },
            ],
          },
          "santa-clara": {
            nombre: "Santa Clara",
            puntos: [
              { lugar: "palacio-municipal",      num: 1,  x: 30.6, y: 43.2, inicio: true },
              { lugar: "fuente-san-miguel",      num: 2,  x: 22.2, y: 47.5 },
              { lugar: "catedral",               num: 3,  x: 25.5, y: 56.0 },
              { lugar: "pasaje-ayuntamiento",    num: 4,  x: 27.1, y: 37.8 },
              { lugar: "santo-domingo",          num: 5,  x: 27.6, y: 16.8 },
              { lugar: "mercado-victoria",       num: 6,  x: 31.3, y: 11.0 },
              { lugar: "calle-dulces",           num: 7,  x: 37.2, y: 13.7 },
              { lugar: "fabrica-talavera",       num: 8,  x: 41.7, y: 16.0 },
              { lugar: "exconvento-santa-clara", num: 10, x: 48.7, y: 20.3 },
              { lugar: "casa-hermanos-serdan",   num: 9,  x: 52.4, y: 27.0 },
              { lugar: "casa-munecos",           num: 11, x: 35.2, y: 45.9 },
            ],
            estacionamientos: [
              { x: 40.2, y: 49.8 }, { x: 36.3, y: 62.8 },
            ],
          },
          "otros": {
            nombre: "Otros Recorridos",
            puntos: [
              { lugar: "palacio-municipal",      num: 1,  x: 30.6, y: 43.2, inicio: true },
              { lugar: "fuente-san-miguel",      num: 2,  x: 22.2, y: 47.5 },
              { lugar: "maqueta-fundacion",      num: 3,  x: 28.8, y: 50.3 },
              { lugar: "explanada-compania",     num: 5,  x: 41.8, y: 61.1 },
              { lugar: "casa-inquisicion",       num: 6,  x: 38.9, y: 70.2 },
              { lugar: "alrededores-carolino",   num: 7,  x: 48.1, y: 76.7 },
              { lugar: "iglesia-compania",       num: 4,  x: 46.6, y: 61.5 },
            ],
            estacionamientos: [
              { x: 38.9, y: 49.7 }, { x: 36.6, y: 64.1 },
              { x: 82.6, y: 55.6 }, { x: 77.6, y: 65.6 }, { x: 74.7, y: 75.8 },
            ],
          },
        };

        const mapaPins = document.getElementById("mapaPins");

        function renderRecorrido(id) {
          const rec = RECORRIDOS[id];
          if (!rec || !mapaPins) return;
          currentRecorrido = id;
          mapaPins.innerHTML = "";

          rec.puntos.forEach((punto, i) => {
            const lugar = LUGARES[punto.lugar];
            const btn = document.createElement("button");
            btn.className = "mapa__point" + (punto.inicio ? " mapa__point--inicio" : "");
            btn.style.left = punto.x + "%";
            btn.style.top = punto.y + "%";
            btn.style.animationDelay = (i * 45) + "ms";
            btn.style.zIndex = String(100 - punto.num); // paradas tempranas al frente
            btn.dataset.title = lugar.titulo;
            btn.dataset.img = lugar.img;
            btn.dataset.desc = lugar.desc;
            btn.innerHTML =
              '<span class="mapa__pin-num">' + punto.num + "</span>" +
              '<img class="mapa__thumb" src="' + lugar.img + '" alt="' + lugar.titulo + '" draggable="false" />' +
              '<span class="mapa__pin ' + (punto.inicio ? "mapa__pin--inicio" : "mapa__pin--leyenda") + '" aria-hidden="true"></span>' +
              (punto.inicio ? '<span class="mapa__point-label">Inicio</span>' : "");
            mapaPins.appendChild(btn);
          });

          rec.estacionamientos.forEach((est, i) => {
            const park = document.createElement("span");
            park.className = "mapa__park";
            park.style.left = est.x + "%";
            park.style.top = est.y + "%";
            park.style.animationDelay = ((rec.puntos.length + i) * 45) + "ms";
            park.title = "Estacionamiento 24 horas";
            park.textContent = "E";
            mapaPins.appendChild(park);
          });
        }

        // Los clics con mouse/dedo se atienden en endPointer (pointerup).
        // Aquí solo el teclado: Enter/Espacio sobre un pin enfocado (detail 0).
        mapaCanvas.addEventListener("click", (e) => {
          if (e.detail !== 0) return;
          const point = e.target.closest(".mapa__point");
          if (point) openModal(point);
        });

        // Tabs de recorridos
        const mapaTabs = document.querySelectorAll(".mapa__tab");
        mapaTabs.forEach((tab) => {
          tab.addEventListener("click", () => {
            mapaTabs.forEach((t) => {
              const active = t === tab;
              t.classList.toggle("is-active", active);
              t.setAttribute("aria-selected", String(active));
            });
            renderRecorrido(tab.dataset.recorrido);
            mapaCanvas.classList.add("is-animating");
            resetView();
            setTimeout(() => mapaCanvas.classList.remove("is-animating"), 300);
          });
        });

        renderRecorrido("ultratumba");

        mapaModal.querySelectorAll("[data-close]").forEach((el) =>
          el.addEventListener("click", closeModal)
        );
        document.addEventListener("keydown", (e) => {
          if (e.key === "Escape" && !mapaModal.hidden) closeModal();
        });

        // Modo calibración para ubicar pines con precisión
        if (CALIBRATION) {
          mapaCanvas.addEventListener("click", (e) => {
            const rect = mapaCanvas.getBoundingClientRect();
            const x = ((e.clientX - rect.left) / rect.width) * 100;
            const y = ((e.clientY - rect.top) / rect.height) * 100;
            console.log("left:" + x.toFixed(1) + "%;top:" + y.toFixed(1) + "%");
          });
        }

        window.addEventListener("resize", resetView);
        // Recalcular cuando el mapa base ya tenga sus dimensiones reales
        const mapaBaseImg = document.querySelector(".mapa__base");
        if (mapaBaseImg && !mapaBaseImg.complete) {
          mapaBaseImg.addEventListener("load", resetView);
        }
        resetView();
      }
    </script>

    <script>
      // Si la página se restaura desde la caché "atrás/adelante" del navegador
      // (por ejemplo, al volver de WhatsApp), se recarga para tener un token CSRF
      // fresco y evitar el error 419 "Page Expired" al enviar el formulario.
      window.addEventListener("pageshow", function (e) {
        if (e.persisted) {
          window.location.reload();
        }
      });
    </script>
  </body>
</html>
