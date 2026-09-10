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

/* ---------------------------------------------
   Handle product order submission (POST)
   --------------------------------------------- */
$order_success = false;
$order_error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_order'])) {
    $o_name = trim($_POST['order_name'] ?? '');
    $o_phone = trim($_POST['order_phone'] ?? '');
    $o_product = trim($_POST['product_name'] ?? '');
    $o_qty = (int)($_POST['quantity'] ?? 0);
    $o_size = trim($_POST['size'] ?? '');
    $o_payment = trim($_POST['payment_method'] ?? '');

    // Only allow known values (never trust raw POST data for fixed-choice fields)
    if (!in_array($o_size, ['Small', 'Medium', 'Large'], true)) {
        $o_size = '';
    }
    if (!in_array($o_payment, ['cash', 'card'], true)) {
        $o_payment = '';
    }

    if ($o_name === '' || $o_phone === '' || $o_product === '' || $o_qty <= 0 || $o_size === '' || $o_payment === '') {
        $order_error = 'Please fill in every field to place your order.';
    } else {
        $stmt = mysqli_prepare($conn, "INSERT INTO orders (client_name, client_phone, product_name, quantity, size, payment_method) VALUES (?, ?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "sssiss", $o_name, $o_phone, $o_product, $o_qty, $o_size, $o_payment);

        if (mysqli_stmt_execute($stmt)) {
            $order_success = true;
        } else {
            $order_error = 'Something went wrong. Please try again.';
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
    </div>
</section>

<!-- ===== ORDER A PRODUCT ===== -->
<section class="section" id="order" style="padding:80px 0;">
    <div class="container">
        <div class="section-head">
            <h2>Order a Product</h2>
            <p>Buying paint directly? Tell us what you need and how you'd like to pay, and we'll confirm your order.</p>
        </div>

        <form class="order-form" method="POST" action="contact.php#order">
            <?php if ($order_success): ?>
                <div class="form-msg success show">Thanks — your order has been received. We'll contact you to confirm.</div>
            <?php elseif ($order_error): ?>
                <div class="form-msg error show"><?= htmlspecialchars($order_error) ?></div>
            <?php endif; ?>

            <div class="order-grid">
                <div class="form-group">
                    <label for="order_name">Your Name</label>
                    <input type="text" id="order_name" name="order_name" placeholder="Full name" required>
                </div>
                <div class="form-group">
                    <label for="order_phone">Phone Number</label>
                    <input type="text" id="order_phone" name="order_phone" placeholder="05XXXXXXXX" required>
                </div>
                <div class="form-group">
                    <label for="product_name">Product Name</label>
                    <input type="text" id="product_name" name="product_name" placeholder="e.g. American Spray Paint" required>
                </div>
                <div class="form-group">
                    <label for="quantity">Quantity</label>
                    <input type="number" id="quantity" name="quantity" min="1" value="1" required>
                </div>
                <div class="form-group">
                    <label for="size">Size</label>
                    <select id="size" name="size" required>
                        <option value="">Select size</option>
                        <option value="Small">Small</option>
                        <option value="Medium">Medium</option>
                        <option value="Large">Large</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Payment Method</label>
                    <div class="payment-options">
                        <label class="payment-option">
                            <input type="radio" name="payment_method" value="cash" checked>
                            <span class="payment-option-content">
                                <span class="payment-option-title">Cash</span>
                                <span class="payment-option-desc">Pay on collection or delivery</span>
                            </span>
                        </label>
                        <label class="payment-option">
                            <input type="radio" name="payment_method" value="card">
                            <span class="payment-option-content">
                                <span class="payment-option-title">Card</span>
                                <span class="payment-option-desc">Pay by credit or debit card</span>
                            </span>
                        </label>
                    </div>
                </div>
            </div>

            <button type="submit" name="submit_order" class="btn btn-gold">Place Order</button>
        </form>
    </div>
</section>

<!-- ===== FOOTER ===== -->
<footer class="footer-bottom-section">
    <div class="container">
        <div class="footer-bottom">
            <span>&copy; <?= date('Y') ?> Mashaer Tayebah Paint &amp; Showroom.</span>
            <span>Al-Qassim, Saudi Arabia</span>
        </div>
    </div>
</footer>

<script>
document.getElementById('navToggle').addEventListener('click', () => {
    document.getElementById('navLinks').classList.toggle('show');
});
</script>

</body>
</html>
