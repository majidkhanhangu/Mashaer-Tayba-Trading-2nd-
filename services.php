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

// Service icons (simple inline SVGs, one per service)
$service_icons = [
    '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M3 17c3-4 6-4 9 0s6 4 9 0"/><path d="M3 11c3-4 6-4 9 0s6 4 9 0"/></svg>',
    '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><rect x="7" y="9" width="8" height="12" rx="1.5"/><path d="M9 9V6a2 2 0 0 1 2-2h2"/><path d="M17 6h3M18 4v4M16 9h3"/></svg>',
    '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="4" width="12" height="16" rx="1"/><path d="M20 12c0 2-1.5 3.2-1.5 3.2S17 14 17 12a1.5 1.5 0 0 1 3 0Z"/></svg>',
    '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M4 11 12 4l8 7"/><path d="M6 10v10h12V10"/><path d="M12 1v1.5M18 2l-.8 1.3M6 2l.8 1.3"/></svg>',
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Services — Mashaer Tayebah Paint & Showroom</title>
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
            <li><a href="services.php" class="active">Services</a></li>
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

<!-- ===== PAGE HEADER ===== -->
<section class="hero" style="padding:80px 0 70px;">
    <div class="container" style="display:block;">
        <div class="hero-subtitle">AL-QASSIM • SAUDI ARABIA</div>
        <h1 style="max-width:16ch; font-size:clamp(2.2rem, 5vw, 3.4rem);">Our Services</h1>
        <p class="hero-lead">Every finish we offer, applied by the same crew that mixes your colour in-showroom.</p>
    </div>
</section>

<!-- ===== SERVICES ===== -->
<section class="services">
    <div class="container">
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

<!-- ===== CTA ===== -->
<section class="contact-cta" id="contact">
    <div class="container">
        <div class="contact-top" style="border-bottom:none; padding-bottom:0;">
            <div>
                <h2>Have a project in mind?</h2>
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
