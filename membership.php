<?php
$pageTitle = 'Membership';
include 'includes/header.php';
?>

<style>
    /* Page specific styles */
    .membership-benefits-list {
        list-style: disc;
        margin-left: 24px;
        font-size: 1.05rem;
    }

    .membership-benefits-list li+li {
        margin-top: 10px;
    }

    .membership-benefits-list li::marker {
        color: var(--accent-green);
    }

    .membership-eligibility {
        background: linear-gradient(180deg, var(--white) 0%, var(--background) 100%);
    }

    .membership-form {
        background: var(--white);
        padding: 50px;
        border-radius: 16px;
        box-shadow: var(--shadow);
        border-top: 6px solid var(--secondary-yellow);
        max-width: 800px;
        margin: 0 auto;
        position: relative;
    }

    .membership-form::before {
        content: '';
        position: absolute;
        top: 24px;
        right: 24px;
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: var(--accent-pink);
        box-shadow: 0 0 0 8px rgba(233, 30, 99, 0.12);
    }

    .membership-kicker {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 8px 16px;
        margin-bottom: 18px;
        border-radius: 999px;
        background: rgba(103, 188, 69, 0.14);
        color: var(--accent-green-dark);
        font-size: 0.82rem;
        font-weight: 700;
        letter-spacing: 0.05em;
        text-transform: uppercase;
    }

    .membership-kicker::before {
        content: '';
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: var(--accent-green);
    }

    .membership-fee {
        margin-bottom: 30px;
        padding: 14px 18px;
        border-radius: 12px;
        background: rgba(103, 188, 69, 0.12);
        color: var(--accent-green-dark);
        font-weight: 700;
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 24px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: var(--primary-green);
    }

    input,
    select {
        width: 100%;
        padding: 12px;
        border: 1px solid var(--border);
        border-radius: 6px;
        transition: var(--transition);
    }

    input:focus,
    select:focus {
        outline: none;
        border-color: var(--brand-blue);
        box-shadow: 0 0 0 3px rgba(23, 58, 96, 0.12);
    }

    .membership-submit {
        width: 100%;
        margin-top: 20px;
    }

    @media (max-width: 768px) {
        .membership-form {
            padding: 32px 22px;
        }

        .form-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<!-- Page Hero -->
<section class="page-hero">
    <div class="container">
        <h1>Membership Hub</h1>
        <p>Join our global network of over 500 alumni today.</p>
    </div>
</section>

<!-- Content Sections -->
<section id="benefits" class="section-padding">
    <div class="container">
        <div class="reveal">
            <h2 class="section-title">Membership Benefits</h2>
            <ul class="membership-benefits-list">
                <li>Access to a global alumni networking database.</li>
                <li>Exclusive invitations to reunions and gala events.</li>
                <li>Professional mentorship from senior alumni.</li>
                <li>Official ECOSA membership ID card.</li>
            </ul>
        </div>
    </div>
</section>

<section id="eligibility" class="section-padding membership-eligibility">
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
                <span class="membership-kicker">Membership Registration</span>
                <p class="membership-fee">Registration Fee: UGX 20,000</p>
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
                    <button type="submit" class="btn btn-primary membership-submit">Submit Application</button>
                </form>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
