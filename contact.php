<?php
$pageTitle = 'Contact Us | Equatorial College School';
include 'includes/header.php';
?>

<style>
    /* Page specific styles */
    .page-hero {
        background-color: var(--dark-green);
        color: var(--white);
        padding: 100px 0;
        text-align: center;
    }

    .page-hero h1 {
        font-size: 3.5rem;
        font-weight: 800;
    }

    .contact-grid {
        display: grid;
        grid-template-columns: 1fr 1.5fr;
        gap: 60px;
    }

    .contact-form {
        background: var(--white);
        padding: 40px;
        border-radius: 12px;
        box-shadow: var(--shadow);
    }

    .form-group {
        margin-bottom: 20px;
    }

    label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
    }

    input,
    textarea,
    select {
        width: 100%;
        padding: 12px;
        border: 1px solid #ddd;
        border-radius: 6px;
    }

    @media (max-width: 768px) {
        .contact-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<!-- Page Hero -->
<section class="page-hero">
    <div class="container">
        <h1>Get In Touch</h1>
        <p style="font-size: 1.2rem; opacity: 0.9; margin-top: 20px;">We're here to answer your questions and hear your suggestions.</p>
    </div>
</section>

<!-- Content Sections -->
<section class="section-padding">
    <div class="container">
        <div class="reveal contact-grid">
            <div>
                <h2 class="section-title">Contact Details</h2>
                <div style="margin-top: 30px;">
                    <p><strong>Email:</strong> info@ecosa.org</p>
                    <p style="margin-top: 15px;"><strong>Phone:</strong> +256 700 000 000</p>
                    <p style="margin-top: 15px;"><strong>Address:</strong> Equatorial College School, Main Campus</p>
                </div>
            </div>
            <div class="contact-form">
                <form id="main-contact-form">
                    <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" placeholder="John Doe" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" placeholder="john@example.com" required>
                    </div>
                    <div class="form-group">
                        <label>Message</label>
                        <textarea rows="5" placeholder="Your message here..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" style="width: 100%;">Send Message</button>
                </form>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>