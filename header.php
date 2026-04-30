<?php
$title = "Studio — Photography";
$name = "Studio";
$email = "hello@studio.example";
$instagram = "@studio.handle";
$hero_camera_img =
  "https://images.unsplash.com/photo-1502982720700-bfff7f2ea659?w=960&q=85";
$gate_earth_img =
  "https://images.unsplash.com/photo-1614730321146-b6fa6a46bcb4?w=1400&q=85";

$gallery = [
  [
    "src" => "https://images.unsplash.com/photo-1493863641943-9b68992a8d6b?w=800&q=80",
    "label" => "Portrait",
    "place" => "Tokyo",
    "nx" => 0.88,
    "ny" => 0.38,
  ],
  [
    "src" => "https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=800&q=80",
    "label" => "Landscape",
    "place" => "Reykjavík",
    "nx" => 0.46,
    "ny" => 0.22,
  ],
  [
    "src" => "https://images.unsplash.com/photo-1519741497674-611481863552?w=800&q=80",
    "label" => "Event",
    "place" => "Paris",
    "nx" => 0.5,
    "ny" => 0.32,
  ],
  [
    "src" => "https://images.unsplash.com/photo-1542037104857-ffbb0b9155fb?w=800&q=80",
    "label" => "Architecture",
    "place" => "New York",
    "nx" => 0.28,
    "ny" => 0.36,
  ],
  [
    "src" => "https://images.unsplash.com/photo-1469474968028-56623f02e42e?w=800&q=80",
    "label" => "Nature",
    "place" => "Cape Town",
    "nx" => 0.54,
    "ny" => 0.78,
  ],
  [
    "src" => "https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=800&q=80",
    "label" => "Studio",
    "place" => "Sydney",
    "nx" => 0.9,
    "ny" => 0.72,
  ],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?php echo htmlspecialchars($title); ?></title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=Syne:wght@500;600;700;800&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="style.css" />
</head>
<body>
<div id="gate" class="gate" aria-hidden="false">
    <div class="gate__shell">
      <div class="gate__panel">
        <div class="gate__inner">
          <p class="gate__eyebrow">Photography</p>
          <button type="button" class="gate__btn" id="gate-open">Enter site</button>
        </div>
      </div>
      <div class="gate__network-layer" aria-hidden="true">
        <svg class="gate__svg" id="gate-network-svg" viewBox="0 0 100 100" preserveAspectRatio="none">
          <defs>
            <linearGradient id="gate-line-grad" x1="0%" y1="0%" x2="100%" y2="100%">
              <stop offset="0%" stop-color="#fecaca"/>
              <stop offset="50%" stop-color="#f87171"/>
              <stop offset="100%" stop-color="#fca5a5"/>
            </linearGradient>
          </defs>
          <path id="gate-network-path" class="gate__path" fill="none" stroke="url(#gate-line-grad)" stroke-width="0.45" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        <div class="gate__nodes" id="gate-network-nodes"></div>
      </div>
    </div>
  </div>

  <div id="progress" class="progress" aria-hidden="true"></div>

  <header class="nav" id="nav">
    <a class="nav__brand" href="#top"><?php echo htmlspecialchars($name); ?></a>
    <nav class="nav__links">
      <a href="#work">Work</a>
      <a href="#process">Process</a>
      <a href="#contact">Contact</a>
    </nav>
  </header>