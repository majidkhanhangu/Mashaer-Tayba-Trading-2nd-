<?php
require_once 'db.php';

/* ---------------------------------------------
   Fetch services
   --------------------------------------------- */
$services = [];
$services_result = mysqli_query($conn, "SELECT * FROM services ORDER BY id ASC");
while ($row = mysqli_fetch_assoc($services_result)) {
    $services[] = $row;
}

/* ---------------------------------------------
   Fetch gallery
   --------------------------------------------- */
$gallery = [];
$gallery_result = mysqli_query($conn, "SELECT * FROM gallery ORDER BY id ASC");
while ($row = mysqli_fetch_assoc($gallery_result)) {
    $gallery[] = $row;
}

/* ---------------------------------------------
   Fetch paints (for the price slider)
   --------------------------------------------- */
$paints = [];
$paints_result = mysqli_query($conn, "SELECT * FROM paints ORDER BY id ASC");
if ($paints_result) {
    while ($row = mysqli_fetch_assoc($paints_result)) {
        $paints[] = $row;
    }
}

// Service icons (simple inline SVGs, one per service)
$service_icons = [
    // Profile Texture — layered trowel strokes
    '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M3 17c3-4 6-4 9 0s6 4 9 0"/><path d="M3 11c3-4 6-4 9 0s6 4 9 0"/></svg>',
    // American Spray — spray can
    '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><rect x="7" y="9" width="8" height="12" rx="1.5"/><path d="M9 9V6a2 2 0 0 1 2-2h2"/><path d="M17 6h3M18 4v4M16 9h3"/></svg>',
    // Plastic & Glass Paint — pane with drop
    '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="4" width="12" height="16" rx="1"/><path d="M20 12c0 2-1.5 3.2-1.5 3.2S17 14 17 12a1.5 1.5 0 0 1 3 0Z"/></svg>',
    // Roof Thermal Insulation — house with rays
    '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M4 11 12 4l8 7"/><path d="M6 10v10h12V10"/><path d="M12 1v1.5M18 2l-.8 1.3M6 2l.8 1.3"/></svg>',
];

$gallery_textures = ['tex-1', 'tex-2', 'tex-3', 'tex-4', 'tex-5', 'tex-6'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Mashaer Tayebah Paint & Showroom — Al-Qassim, Saudi Arabia</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<!-- ===== NAVBAR ===== -->
<nav class="navbar">
    <div class="container">
        <a href="#top" class="nav-logo">
            <span class="name">MASHAER TAYEBAH</span>
            <span class="tag">Paint &amp; Showroom</span>
        </a>
        <ul class="nav-links" id="navLinks">
            <li><a href="#top">Home</a></li>
            <li><a href="services.php">Services</a></li>
            <li><a href="gallery.php">Gallery</a></li>
            <li><a href="contact.php">Contact</a></li>
        </ul>
        <div class="nav-cta">
            <a href="tel:0508185486" class="btn btn-gold">Call Now</a>
        </div>
        <button class="nav-toggle" id="navToggle" aria-label="Toggle menu">
            <span></span><span></span><span></span>
        </button>
    </div>
</nav>

<!-- ===== HERO ===== -->
<section class="hero" id="top">
    <div class="container">
        <div class="hero-content">
            <div class="hero-subtitle">AL-QASSIM • SAUDI ARABIA</div>
            <h1>Colour that lifts a room. Protection that lasts.</h1>
            <p class="hero-lead">Interior and exterior painting, textured finishes, and thermal roof coatings — done by hand, matched to your space.</p>
            <div class="hero-actions">
                <a href="https://wa.me/9660508185486" class="btn btn-gold">WhatsApp: 050 818 5486</a>
                <a href="tel:0508185486" class="btn btn-outline">Call Directly</a>
            </div>
        </div>
        <div class="swatch-stack">
            <div class="swatch-row">
                <span class="swatch"></span><span class="swatch"></span><span class="swatch"></span>
            </div>
            <div class="swatch-row">
                <span class="swatch"></span><span class="swatch"></span><span class="swatch"></span>
            </div>
            <p class="swatch-caption">Every finish is colour-matched on site before it touches a wall.</p>
        </div>
    </div>
</section>

<!-- ===== ABOUT / VALUE PROPOSITION ===== -->
<section class="about-statement">
    <div class="container">
        <div class="about-rule"></div>
        <h2>We turn a space into somewhere that suits you</h2>
    </div>
</section>

<!-- ===== SERVICES ===== -->
<section class="services" id="services">
    <div class="container">
        <div class="section-head">
            <h2>Precise finishing for every surface</h2>
            <p>From textured walls to reflective roofing — each service is applied by the same crew that mixes your colour.</p>
        </div>
        <div class="services-grid">
            <?php foreach ($services as $index => $service): ?>
            <div class="service-card">
                <div class="service-icon"><?= $service_icons[$index % count($service_icons)] ?></div>
                <h3><?= htmlspecialchars($service['title']) ?></h3>
                <p><?= htmlspecialchars($service['description']) ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ===== FEATURE SPOTLIGHT ===== -->
<section class="spotlight">
    <div class="container">
        <div class="spotlight-text">
            <h2>Every colour, mixed while you watch</h2>
            <p>Our in-showroom mixing station matches any reference — a fabric swatch, a photo, or a shade you already have on your wall — so what you approve is exactly what goes up.</p>
            <a href="#contact" class="spotlight-link">Become a free consultation</a>
        </div>
        <div class="mixing-station">
            <div class="mixing-station-label">Colour-Mixing Station</div>
            <div class="swatch-palette">
                <span class="swatch"></span><span class="swatch"></span><span class="swatch"></span><span class="swatch"></span><span class="swatch"></span>
                <span class="swatch"></span><span class="swatch"></span><span class="swatch"></span><span class="swatch"></span><span class="swatch"></span>
            </div>
        </div>
    </div>
</section>

<!-- ===== SHOWROOM & GALLERY ===== -->
<section class="gallery" id="gallery">
    <div class="container">
        <div class="section-head">
            <h2>Inside the showroom &amp; recent work</h2>
            <p>A look at the space, the materials, and finishes we've delivered around Al-Qassim.</p>
        </div>
        <div class="gallery-grid">
            <?php foreach ($gallery as $index => $item): ?>
            <?php
                $img_path = 'images/' . $item['image_url'];
                $has_real_image = file_exists(__DIR__ . '/' . $img_path);
            ?>
            <div class="gallery-item">
                <div class="gallery-img <?= $has_real_image ? '' : $gallery_textures[$index % count($gallery_textures)] ?>"
                     <?php if ($has_real_image): ?>style="background-image:url('<?= htmlspecialchars($img_path) ?>');"<?php endif; ?>></div>
                <div class="item-info">
                    <div class="item-title"><?= htmlspecialchars($item['title']) ?></div>
                    <div class="item-cat"><?= htmlspecialchars($item['category']) ?></div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ===== PAINT TYPES SLIDER ===== -->
<?php if (!empty($paints)): ?>
<section class="paint-slider-section">
    <div class="container">
        <div class="section-head">
            <h2>Paint types &amp; pricing</h2>
            <p>A starting guide to what we stock — final pricing depends on surface area and finish.</p>
        </div>
    </div>

    <div class="paint-slider">
        <button class="slider-btn slider-prev" id="paintPrev" aria-label="Previous">&larr;</button>
        <div class="paint-track" id="paintTrack">
            <?php foreach ($paints as $paint): ?>
            <?php
                $paint_img_path = 'images/paints/' . ($paint['image_url'] ?? '');
                $paint_has_image = !empty($paint['image_url']) && file_exists(__DIR__ . '/' . $paint_img_path);
            ?>
            <div class="paint-card">
                <div class="paint-swatch"
                     style="<?= $paint_has_image
                        ? "background-image:url('" . htmlspecialchars($paint_img_path) . "'); background-size:cover; background-position:center;"
                        : "background:" . htmlspecialchars($paint['color_hex']) . ";" ?>"></div>
                <div class="paint-info">
                    <div class="paint-category"><?= htmlspecialchars($paint['category']) ?></div>
                    <div class="paint-name"><?= htmlspecialchars($paint['name']) ?></div>
                    <div class="paint-price">SAR <?= number_format((float)$paint['price'], 2) ?></div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <button class="slider-btn slider-next" id="paintNext" aria-label="Next">&rarr;</button>
    </div>
</section>
<?php endif; ?>

<!-- ===== CONTACT / FOOTER CTA ===== -->
<section class="contact-cta" id="contact">
    <div class="container">
        <div class="contact-top" style="border-bottom:none; padding-bottom:0;">
            <div>
                <h2>Ready when you are</h2>
                <a href="tel:0508185486" class="contact-phone">050 818 5486</a>
                <p class="contact-location">Al-Qassim, Saudi Arabia</p>
                <div class="hero-actions" style="margin-top:28px;">
                    <a href="https://wa.me/9660508185486" class="btn btn-gold">Start a Message Chat</a>
                    <a href="contact.php" class="btn btn-outline">Send a Message</a>
                </div>
            </div>
        </div>

        <div class="footer-bottom" style="border-top:1px solid var(--border-dark); margin-top:40px; padding-top:24px;">
            <span>&copy; <?= date('Y') ?> Mashaer Tayebah Paint &amp; Showroom.</span>
            <span>Al-Qassim, Saudi Arabia</span>
        </div>
    </div>
</section>

<script>
document.getElementById('navToggle').addEventListener('click', () => {
    document.getElementById('navLinks').classList.toggle('show');
});

// Paint types slider — scrolls the track left/right by one card width
const paintTrack = document.getElementById('paintTrack');
if (paintTrack) {
    const scrollAmount = () => paintTrack.querySelector('.paint-card').offsetWidth + 20;
    document.getElementById('paintNext').addEventListener('click', () => {
        paintTrack.scrollBy({ left: scrollAmount(), behavior: 'smooth' });
    });
    document.getElementById('paintPrev').addEventListener('click', () => {
        paintTrack.scrollBy({ left: -scrollAmount(), behavior: 'smooth' });
    });
}
</script>

</body>
</html>
