(function () {
  var gate = document.getElementById("gate");
  var openBtn = document.getElementById("gate-open");
  var progress = document.getElementById("progress");
  var camera3d = document.getElementById("camera-3d");
  var reduce =
    window.matchMedia && window.matchMedia("(prefers-reduced-motion: reduce)").matches;

  function enter() {
    document.body.classList.add("is-entered");
    if (gate) {
      gate.classList.add("is-off");
      gate.setAttribute("aria-hidden", "true");
    }
    if (camera3d && !reduce) {
      camera3d.classList.add("camera-3d--snap");
      window.setTimeout(function () {
        camera3d.classList.remove("camera-3d--snap");
      }, 600);
    }
  }

  if (openBtn) openBtn.addEventListener("click", enter);

  function onScroll() {
    var doc = document.documentElement;
    var total = doc.scrollHeight - doc.clientHeight;
    var p = total > 0 ? (doc.scrollTop / total) * 100 : 0;
    if (progress) progress.style.width = p + "%";
  }

  function updateLensScroll() {
    var y = window.scrollY || document.documentElement.scrollTop;
    var v = Math.min(y / 4.2, 160);
    document.documentElement.style.setProperty("--lens-scroll", String(v));
  }

  function onScrollAll() {
    onScroll();
    updateLensScroll();
  }

  window.addEventListener("scroll", onScrollAll, { passive: true });
  onScrollAll();

  if (!reduce) {
    var blocks = document.querySelectorAll(".block, .gallery, .strip__intro, .tile");
    blocks.forEach(function (el) {
      el.classList.add("reveal");
    });

    var io = new IntersectionObserver(
      function (entries) {
        entries.forEach(function (e) {
          if (e.isIntersecting) e.target.classList.add("is-visible");
        });
      },
      { rootMargin: "-8% 0px", threshold: 0.05 }
    );

    document.querySelectorAll(".reveal").forEach(function (el) {
      io.observe(el);
    });

    var hero = document.querySelector(".hero");
    if (hero && camera3d) {
      hero.addEventListener(
        "mousemove",
        function (e) {
          var rect = hero.getBoundingClientRect();
          var x = (e.clientX - rect.left) / rect.width - 0.5;
          var y = (e.clientY - rect.top) / rect.height - 0.5;
          camera3d.style.transform =
            "rotateY(" + (-5 + x * 18) + "deg) rotateX(" + (10 - y * 12) + "deg)";
        },
        { passive: true }
      );
      hero.addEventListener(
        "mouseleave",
        function () {
          camera3d.style.transform = "";
        },
        { passive: true }
      );
    }

    document.querySelectorAll(".tile").forEach(function (tile) {
      tile.addEventListener("mousemove", function (e) {
        var r = tile.getBoundingClientRect();
        var px = (e.clientX - r.left) / r.width - 0.5;
        var py = (e.clientY - r.top) / r.height - 0.5;
        var rx = py * -9;
        var ry = px * 12;
        tile.style.transform =
          "rotateX(" + rx + "deg) rotateY(" + ry + "deg) translateZ(10px)";
      });
      tile.addEventListener("mouseleave", function () {
        tile.style.transform = "";
      });
    });
  }

  var NET_KEY = "pgraphy-network-v1";

  function loadNetwork() {
    try {
      var raw = localStorage.getItem(NET_KEY);
      if (!raw) return [];
      var arr = JSON.parse(raw);
      return Array.isArray(arr) ? arr : [];
    } catch (e) {
      return [];
    }
  }

  function saveNetwork(nodes) {
    try {
      localStorage.setItem(NET_KEY, JSON.stringify(nodes));
    } catch (e) {}
  }

  function renderGateNetwork() {
    var pathEl = document.getElementById("gate-network-path");
    var wrap = document.getElementById("gate-network-nodes");
    if (!pathEl || !wrap) return;

    var nodes = loadNetwork();
    wrap.innerHTML = "";

    if (nodes.length === 0) {
      pathEl.setAttribute("d", "");
      syncThumbStates([]);
      return;
    }

    var d = "";
    for (var i = 0; i < nodes.length; i++) {
      var n = nodes[i];
      var x = Number(n.nx) * 100;
      var y = Number(n.ny) * 100;
      d += (i === 0 ? "M " : " L ") + x.toFixed(2) + " " + y.toFixed(2);
    }

    pathEl.setAttribute("d", d);

    for (var j = 0; j < nodes.length; j++) {
      var nj = nodes[j];
      var el = document.createElement("div");
      el.className = "gate-map-node gate-map-node--pin";
      el.style.left = Number(nj.nx) * 100 + "%";
      el.style.top = Number(nj.ny) * 100 + "%";
      el.innerHTML =
        '<svg class="gate-map-pin" viewBox="0 0 24 36" width="28" height="42" aria-hidden="true" focusable="false">' +
        '<path fill="#dc2626" stroke="#fecaca" stroke-width="1.1" stroke-linejoin="round" d="M12 1.2C6.4 1.2 1.8 5.7 1.8 11.3c0 5.6 6.8 16.8 9.2 20.2l.5.7.5-.7c2.4-3.4 9.2-14.6 9.2-20.2C22.2 5.7 17.6 1.2 12 1.2z"/>' +
        '<circle cx="12" cy="11.2" r="3.2" fill="#fff"/></svg>';
      var lab = document.createElement("span");
      lab.className = "gate-map-node__label";
      lab.textContent = nj.place || "";
      el.appendChild(lab);
      wrap.appendChild(el);
    }

    syncThumbStates(nodes);
  }

  function syncThumbStates(nodes) {
    var ids = {};
    for (var i = 0; i < nodes.length; i++) ids[nodes[i].id] = true;
    document.querySelectorAll(".tile--marquee[data-network-id]").forEach(function (el) {
      var id = el.getAttribute("data-network-id");
      el.classList.toggle("is-network-stop", !!ids[id]);
    });
  }

  function appendNetworkPoint(id, place, nx, ny) {
    var nodes = loadNetwork();
    if (nodes.length && nodes[nodes.length - 1].id === id) return;
    nodes.push({ id: id, place: place, nx: nx, ny: ny });
    saveNetwork(nodes);
    renderGateNetwork();
    document.dispatchEvent(new CustomEvent("pgraphy-network-changed", { detail: nodes }));
  }

  function clearNetwork() {
    saveNetwork([]);
    renderGateNetwork();
    document.dispatchEvent(new CustomEvent("pgraphy-network-changed", { detail: [] }));
  }

  function readPointFromEl(el) {
    return {
      id: el.getAttribute("data-network-id"),
      place: el.getAttribute("data-place") || "",
      nx: parseFloat(el.getAttribute("data-nx") || "0.5"),
      ny: parseFloat(el.getAttribute("data-ny") || "0.5"),
    };
  }

  var resetBtn = document.getElementById("gate-network-reset");
  if (resetBtn) resetBtn.addEventListener("click", clearNetwork);

  renderGateNetwork();

  var mainGal = document.getElementById("main-gallery");
  if (mainGal) {
    mainGal.addEventListener("click", function (e) {
      var fig = e.target.closest(".tile[data-network-id]");
      if (!fig) return;
      var p = readPointFromEl(fig);
      if (!p.id) return;
      appendNetworkPoint(p.id, p.place, p.nx, p.ny);
    });
  }
})();
