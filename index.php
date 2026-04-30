<?php include('header.php') ?>

<main id="top">
  <section class="hero">
    <div class="hero__glow" aria-hidden="true"></div>
    <div class="hero__grain" aria-hidden="true"></div>
    <div class="hero__vignette" aria-hidden="true"></div>
    <div class="hero__scene" aria-hidden="true">
      <div class="hero__bokeh">
        <span class="hero__bokeh-dot hero__bokeh-dot--1"></span>
        <span class="hero__bokeh-dot hero__bokeh-dot--2"></span>
        <span class="hero__bokeh-dot hero__bokeh-dot--3"></span>
      </div>
      <div class="camera-3d" id="camera-3d">
        <div class="camera-3d__scroll" id="camera-3d-scroll">
          <div class="lens-orbit lens-orbit--outer"></div>
          <div class="lens-orbit lens-orbit--mid"></div>
          <div class="lens-orbit lens-orbit--inner"></div>
          <div class="hero-cosmic" aria-hidden="true">
            <div class="hero-bh">
              <div class="hero-bh__core"></div>
              <div class="hero-bh__accretion"></div>
              <div class="hero-bh__photon"></div>
            </div>
            <div class="hero-tele">
              <div class="hero-tele__mount"></div>
              <div class="hero-tele__tube hero-tele__tube--1"></div>
              <div class="hero-tele__tube hero-tele__tube--2"></div>
              <div class="hero-tele__tube hero-tele__tube--3"></div>
              <div class="hero-tele__tube hero-tele__tube--4"></div>
              <div class="hero-tele__tube hero-tele__tube--5"></div>
              <div class="hero-tele__tube hero-tele__tube--6"></div>
            </div>
          </div>
          <div class="aperture-blades" aria-hidden="true">
            <span class="aperture-blades__b"></span>
            <span class="aperture-blades__b"></span>
            <span class="aperture-blades__b"></span>
            <span class="aperture-blades__b"></span>
            <span class="aperture-blades__b"></span>
            <span class="aperture-blades__b"></span>
          </div>
          <div class="hero-cam-frame">
            <div class="hero-cam-mask">
              <img
                class="hero-cam-img"
                src="<?php echo htmlspecialchars($hero_camera_img); ?>"
                alt=""
                width="640"
                height="640"
                decoding="async"
              />
            </div>
            <div class="hero-cam-vignette"></div>
            <div class="hero-cam-glint"></div>
          </div>
        </div>
      </div>
    </div>
    <p class="eyebrow">Available worldwide</p>
    <h2 class="hero__head">
      <span class="hero__line">Light,</span>
      <span class="hero__line hero__line--muted">framed.</span>
    </h2>
    <p class="hero__lead">Editorial and commercial photography — calm compositions and honest color.</p>
    <p class="hero__scroll"><span>Scroll to explore</span><span class="hero__mouse" aria-hidden="true"></span></p>
  </section>

  <div class="marquee" aria-hidden="true">
    <div class="marquee__track">
      <span>Editorial · Portraits · Events · Architecture · Travel · Campaigns ·</span>
      <span>Editorial · Portraits · Events · Architecture · Travel · Campaigns ·</span>
    </div>
  </div>

  <section class="block" id="work">
    <p class="section-num">01</p>
    <p class="eyebrow eyebrow--dark">The work</p>
    <h3 class="section-title">Stories told in still frames.</h3>
    <p class="section-text">Campaigns, editorials, and commissions — composition first, then color, then the quiet details.</p>
  </section>

  <section class="gallery" aria-label="Selected work">
    <div class="gallery__head">
      <div>
        <p class="eyebrow eyebrow--dark">Selected frames</p>
        <h3 class="section-title section-title--sm">Recent work</h3>
      </div>
      <p class="section-text section-text--narrow">Horizontal scroll runs automatically — click any frame to pin it on your world map (<code>index.php</code>).</p>
    </div>
    <div class="gallery__marquee" id="main-gallery" aria-label="Scrolling gallery">
      <div class="gallery__marquee-track">
        <?php
        for ($marqueePass = 0; $marqueePass < 2; $marqueePass++) {
          foreach ($gallery as $i => $g) {
            $id = "g" . $i;
            echo '<figure class="tile tile--marquee" data-network-id="' . htmlspecialchars($id) . '" data-place="' . htmlspecialchars($g["place"]) . '" data-nx="' . htmlspecialchars((string) $g["nx"]) . '" data-ny="' . htmlspecialchars((string) $g["ny"]) . '"><div class="tile__media"><img src="' . htmlspecialchars($g["src"]) . '" alt="' . htmlspecialchars($g["label"]) . '" loading="lazy" width="800" height="1067" /></div><figcaption>' . htmlspecialchars($g["label"]) . ' · ' . htmlspecialchars($g["place"]) . '</figcaption></figure>';
          }
        }
        ?>
      </div>
    </div>
  </section>

  <section class="strip" id="process">
    <div class="strip__intro">
      <p class="eyebrow">End to end</p>
      <h3 class="section-title section-title--on-dark">From first call to final files.</h3>
    </div>
    <div class="strip__scroll">
      <article class="card"><span class="card__n">01</span><h4 class="card__t">Concept</h4><p class="card__p">Mood, locations, and a clear shot list.</p></article>
      <article class="card"><span class="card__n">02</span><h4 class="card__t">Production</h4><p class="card__p">Natural light first, steady direction on set.</p></article>
      <article class="card"><span class="card__n">03</span><h4 class="card__t">Post</h4><p class="card__p">Color and retouching that still feels real.</p></article>
      <article class="card"><span class="card__n">04</span><h4 class="card__t">Delivery</h4><p class="card__p">Web, print, and campaign sizes as needed.</p></article>
    </div>
  </section>

  <section class="block block--right">
    <p class="section-num">02</p>
    <p class="eyebrow eyebrow--dark">On set</p>
    <h3 class="section-title">Rhythm over rush.</h3>
    <p class="section-text">Fewer poses, more pauses — so people look like themselves.</p>
  </section>

  <section class="block block--contact" id="contact">
    <p class="section-num">03</p>
    <p class="eyebrow eyebrow--dark">Contact</p>
    <h3 class="section-title">Let’s make something lasting.</h3>
    <p class="section-text">Share the brief, timeline, and where the photos will be used.</p>
    <div class="contact">
      <a class="contact__row" href="mailto:<?php echo htmlspecialchars($email); ?>"><?php echo htmlspecialchars($email); ?><span>Email</span></a>
      <a class="contact__row" href="https://instagram.com" target="_blank" rel="noopener"><?php echo htmlspecialchars($instagram); ?><span>Instagram</span></a>
    </div>
  </section>
</main>

<?php include('footer.php') ?>