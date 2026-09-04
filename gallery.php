<?php
require_once 'db.php';

/* ---------------------------------------------
   Fetch gallery
   --------------------------------------------- */
$gallery = [];
$gallery_result = mysqli_query($conn, "SELECT * FROM gallery ORDER BY id ASC");
while ($row = mysqli_fetch_assoc($gallery_result)) {
    $gallery[] = $row;
}

$gallery_textures = ['tex-1', 'tex-2', 'tex-3', 'tex-4', 'tex-5', 'tex-6'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Gallery — Mashaer Tayebah Paint & Showroom</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<!-- ===== NAVBAR ===== -->
<nav class="navbar">
    <div class="container">
        <a href="index.php" class="nav-logo">
            <span class="name">MASHAER TAYEBAH</span>
            <span class="tag">Paint &amp; Showroom</span>
        </a>
        <ul class="nav-links" id="navLinks">
            <li><a href="index.php">Home</a></li>
            <li><a href="services.php">Services</a></li>
            <li><a href="gallery.php" class="active">Gallery</a></li>
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

<!-- ===== PAGE HEADER ===== -->
<section class="hero" style="padding:80px 0 70px;">
    <div class="container" style="display:block;">
        <div class="hero-subtitle">AL-QASSIM • SAUDI ARABIA</div>
        <h1 style="max-width:16ch; font-size:clamp(2.2rem, 5vw, 3.4rem);">Showroom &amp; Gallery</h1>
        <p class="hero-lead">A look at the space, the materials, and finishes we've delivered around Al-Qassim.</p>
    </div>
</section>

<!-- ===== GALLERY ===== -->
<section class="gallery">
    <div class="container">
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

<!-- ===== CTA ===== -->
<section class="contact-cta" id="contact">
    <div class="container">
        <div class="contact-top" style="border-bottom:none; padding-bottom:0;">
            <div>
                <h2>Like what you see?</h2>
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
</script>

</body>
</html>
