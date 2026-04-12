<?php
$pageTitle = 'Membership';
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

    .membership-form {
        background: var(--white);
        padding: 50px;
        border-radius: 12px;
        box-shadow: var(--shadow);
        max-width: 800px;
        margin: 0 auto;
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
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
    select {
        width: 100%;
        padding: 12px;
        border: 1px solid #ddd;
        border-radius: 6px;
    }

    @media (max-width: 768px) {
        .form-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<!-- Page Hero -->
<section class="page-hero">
    <div class="container">
        <h1>Membership Hub</h1>
        <p style="font-size: 1.2rem; opacity: 0.9; margin-top: 20px;">Join our global network of over 500 alumni today.</p>
    </div>
</section>

<!-- Content Sections -->
<section id="benefits" class="section-padding">
    <div class="container">
        <div class="reveal">
            <h2 class="section-title">Membership Benefits</h2>
            <ul style="list-style: disc; margin-left: 20px; font-size: 1.1rem;">
                <li>Access to a global alumni networking database.</li>
                <li>Exclusive invitations to reunions and gala events.</li>
                <li>Professional mentorship from senior alumni.</li>
                <li>Official ECOSA membership ID card.</li>
            </ul>
        </div>
    </div>
</section>

<section id="eligibility" class="section-padding" style="background-color: var(--white);">
    <div class="container">
        <div class="reveal">
            <h2 class="section-title">Eligibility</h2>
            <p>Membership is open to all former students of Equatorial College School who completed at least one full academic year at the institution.</p>
        </div>
    </div>
</section>

<section id="registration" class="section-padding">
    <div class="container">
        <div class="reveal">
            <h2 class="section-title text-center">Registration Form</h2>
            <div class="membership-form">
                <p style="margin-bottom: 30px; font-weight: 700; color: var(--primary-green);">Registration Fee: UGX 200,000</p>
                <form>
                    <div class="form-grid">
                        <div class="form-group">
                            <label>Full Name</label>
                            <input type="text" placeholder="John Doe" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" placeholder="john@example.com" required>
                        </div>
                        <div class="form-group">
                            <label>Year of Completion</label>
                            <input type="number" placeholder="e.g. 2015" required>
                        </div>
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input type="tel" placeholder="+256..." required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 20px;">Submit Application</button>
                </form>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>