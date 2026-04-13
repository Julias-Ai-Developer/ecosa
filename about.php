<?php
$pageTitle = 'About Us';

$topLeadership = [
    [
        'initials' => 'C/P',
        'title' => 'Chairperson',
        'portfolio' => 'Strategic Leadership',
    ],
    [
        'initials' => 'V.C/P',
        'title' => 'Vice Chairperson',
        'portfolio' => 'Deputy Leadership',
    ],
    [
        'initials' => 'GS',
        'title' => 'General Secretary',
        'portfolio' => 'Administration & Records',
    ],
    [
        'initials' => 'TR',
        'title' => 'Treasurer',
        'portfolio' => 'Finance & Accountability',
    ],
];

$otherLeaders = [
    [
        'initials' => 'PS',
        'title' => 'Publicity Secretary',
        'portfolio' => 'Communications & Outreach',
    ],
    [
        'initials' => 'OS',
        'title' => 'Organizing Secretary',
        'portfolio' => 'Events & Mobilization',
    ],
    [
        'initials' => 'WS',
        'title' => 'Welfare Secretary',
        'portfolio' => 'Member Welfare',
    ],
    [
        'initials' => 'CM',
        'title' => 'Committee Member',
        'portfolio' => 'Programs & Partnerships',
    ],
];

include 'includes/header.php';
?>

<style>
.about-purpose {
    background: linear-gradient(180deg, var(--white) 0%, var(--background) 100%);
}

.leadership-section {
    background: linear-gradient(180deg, var(--background) 0%, var(--white) 100%);
}

.leadership-intro {
    max-width: 760px;
    margin: 0 auto 40px;
    text-align: center;
}

.leadership-group+.leadership-group {
    margin-top: 56px;
}

.leadership-group-title {
    margin-bottom: 24px;
    text-align: center;
    color: var(--primary-green);
    font-size: 1.7rem;
    font-weight: 800;
}

.leadership-team-grid {
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 28px;
}

.leader-profile-card {
    background: var(--white);
    border-radius: 14px;
    overflow: hidden;
    box-shadow: var(--shadow);
    border: 1px solid rgba(23, 58, 96, 0.08);
    transition: var(--transition);
}

.leader-profile-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 18px 38px rgba(23, 58, 96, 0.14);
}

.leader-profile-visual {
    position: relative;
    min-height: 230px;
    display: flex;
    align-items: flex-end;
    justify-content: center;
    padding: 24px;
    background-image:
        linear-gradient(180deg, rgba(84, 86, 90, 0.14) 0%, rgba(84, 86, 90, 0.36) 100%),
        url('assets/images/school/Equatorial-College-School5.jpeg');
    background-size: cover;
    background-position: center;
}

.leader-profile-visual::after {
    content: '';
    position: absolute;
    inset: auto 0 0 0;
    height: 5px;
    background: var(--secondary-yellow);
}

.leader-profile-initials {
    position: relative;
    z-index: 1;
    width: 86px;
    height: 86px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(255, 255, 255, 0.92);
    color: var(--accent-green-dark);
    font-size: 1.5rem;
    font-weight: 800;
    letter-spacing: 0.04em;
    box-shadow: 0 10px 24px rgba(103, 188, 69, 0.22);
}

.leader-profile-body {
    padding: 18px 16px 22px;
    text-align: center;
}

.leader-profile-title {
    margin-bottom: 6px;
    color: var(--text);
    font-size: 1.02rem;
    font-weight: 800;
}

.leader-profile-role {
    color: var(--accent-green-dark);
    font-size: 0.84rem;
    font-weight: 600;
}

.leadership-note {
    max-width: 980px;
    margin: 52px auto 0;
    padding: 24px 28px;
    border-radius: 14px;
    background: var(--white);
    border-left: 5px solid var(--accent-pink);
    box-shadow: var(--shadow);
    text-align: center;
}

.leadership-note h4 {
    margin-bottom: 10px;
    color: var(--primary-green);
    font-size: 1.15rem;
}

.leadership-note p {
    max-width: 820px;
    margin: 0 auto;
    color: var(--text-muted);
}

@media (max-width: 1024px) {
    .leadership-team-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }
}

@media (max-width: 768px) {
    .leadership-group+.leadership-group {
        margin-top: 40px;
    }

    .leadership-group-title {
        font-size: 1.45rem;
    }

    .leadership-team-grid {
        grid-template-columns: 1fr;
    }

    .leader-profile-visual {
        min-height: 250px;
    }

    .leadership-note {
        padding: 22px 18px;
    }
}
</style>

<!-- Page Hero -->
<section class="page-hero">
    <div class="container">
        <h1>Our Story & Mission</h1>
        <p>Founded in 2002, ECOSA has been uniting alumni of Equatorial College School for over two decades.</p>
    </div>
</section>

<!-- Content Sections -->
<!-- <section id="heritage" class="section-padding">
    <div class="container">
        <div class="reveal">
            <h2 class="section-title">School Heritage</h2>
            <p>Equatorial College School has a long-standing reputation for academic excellence and moral uprightness.
                ECOSA carries this legacy forward through its dedicated alumni network.</p>
        </div>
    </div>
</section>

<section id="purpose" class="section-padding about-purpose">
    <div class="container">
        <div class="reveal">
            <h2 class="section-title">Our Purpose</h2>
            <p>We exist to foster strong bonds between alumni, support the development of our alma mater, and provide
                professional networking opportunities for our members globally.</p>
        </div>
    </div>
</section> -->

<section id="leadership" class="section-padding leadership-section">
    <div class="container">
        <div class="leadership-intro reveal">
            <h2 class="section-title">Leadership</h2>
            <p>ECOSA is guided by a committed leadership structure that supports transparency, service, and long-term
                growth for the association.</p>
        </div>

        <div class="leadership-group">
            <h3 class="leadership-group-title reveal">Top Leadership</h3>
            <div class="leadership-team-grid">
                <?php foreach ($topLeadership as $leader): ?>
                <article class="leader-profile-card reveal">
                    <div class="leader-profile-visual">
                        <div class="leader-profile-initials"><?php echo $leader['initials']; ?></div>
                    </div>
                    <div class="leader-profile-body">
                        <h4 class="leader-profile-title"><?php echo $leader['title']; ?></h4>
                        <p class="leader-profile-role"><?php echo $leader['portfolio']; ?></p>
                    </div>
                </article>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="leadership-group">
            <h3 class="leadership-group-title reveal">Other Leaders</h3>
            <div class="leadership-team-grid">
                <?php foreach ($otherLeaders as $leader): ?>
                <article class="leader-profile-card reveal">
                    <div class="leader-profile-visual">
                        <div class="leader-profile-initials"><?php echo $leader['initials']; ?></div>
                    </div>
                    <div class="leader-profile-body">
                        <h4 class="leader-profile-title"><?php echo $leader['title']; ?></h4>
                        <p class="leader-profile-role"><?php echo $leader['portfolio']; ?></p>
                    </div>
                </article>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="leadership-note reveal">
            <h4>Governance & Accountability</h4>
            <p>Our leadership team serves through a clear constitution, accountable financial processes, and regular
                reporting to the membership to keep ECOSA strong, trusted, and future-focused.</p>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
