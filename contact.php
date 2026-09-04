<?php
require_once 'db.php';

/* ---------------------------------------------
   Handle contact form submission (POST)
   --------------------------------------------- */
$form_success = false;
$form_error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_inquiry'])) {
    $client_name = trim($_POST['client_name'] ?? '');
    $client_phone = trim($_POST['client_phone'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if ($client_name === '' || $client_phone === '' || $message === '') {
        $form_error = 'Please fill in your name, phone number, and message.';
    } else {
        $stmt = mysqli_prepare($conn, "INSERT INTO inquiries (client_name, client_phone, message) VALUES (?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "sss", $client_name, $client_phone, $message);

        if (mysqli_stmt_execute($stmt)) {
            $form_success = true;
        } else {
            $form_error = 'Something went wrong. Please try again.';
        }
        mysqli_stmt_close($stmt);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Contact — Mashaer Tayebah Paint & Showroom</title>
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
            <li><a href="gallery.php">Gallery</a></li>
            <li><a href="contact.php" class="active">Contact</a></li>
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
        <h1 style="max-width:16ch; font-size:clamp(2.2rem, 5vw, 3.4rem);">Get in touch</h1>
        <p class="hero-lead">Tell us about your space and we'll get back to you with a plan and a price.</p>
    </div>
</section>

<!-- ===== CONTACT ===== -->
<section class="contact-cta" id="contact">
    <div class="container">
        <div class="contact-top" style="border-bottom:none; padding-bottom:0;">
            <div>
                <h2>Ready when you are</h2>
                <a href="tel:0508185486" class="contact-phone">050 818 5486</a>
                <p class="contact-location">Al-Qassim, Saudi Arabia</p>
                <div class="hero-actions" style="margin-top:28px;">
                    <a href="https://wa.me/9660508185486" class="btn btn-gold">Start a Message Chat</a>
                </div>
            </div>

            <form class="contact-form" method="POST" action="contact.php#contact">
                <?php if ($form_success): ?>
                    <div class="form-msg success show">Thanks — we've received your message and will be in touch shortly.</div>
                <?php elseif ($form_error): ?>
                    <div class="form-msg error show"><?= htmlspecialchars($form_error) ?></div>
                <?php endif; ?>
                <input type="text" name="client_name" placeholder="Your name" required>
                <input type="text" name="client_phone" placeholder="Phone number" required>
                <textarea name="message" placeholder="Tell us about your space" required></textarea>
                <button type="submit" name="submit_inquiry" class="btn btn-gold">Send Message</button>
            </form>
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
