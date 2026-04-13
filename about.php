<?php
$pageTitle = 'About Us';

$topLeadership = [
    [
        'initials' => 'C/P',
        'title' => 'Chairperson',
        'portfolio' => 'Strategic Leadership',
        'focus' => 'Provides overall direction, represents the association, and keeps long-term priorities aligned with member and school interests.',
        'icon' => 'fa-crown',
        'tone' => 'blue',
    ],
    [
        'initials' => 'V.C/P',
        'title' => 'Vice Chairperson',
        'portfolio' => 'Deputy Leadership',
        'focus' => 'Supports committee coordination, strengthens continuity, and helps translate leadership plans into visible progress.',
        'icon' => 'fa-compass',
        'tone' => 'green',
    ],
    [
        'initials' => 'GS',
        'title' => 'General Secretary',
        'portfolio' => 'Administration & Records',
        'focus' => 'Manages documentation, records, official correspondence, and the administrative flow that keeps the association organized.',
        'icon' => 'fa-file-lines',
        'tone' => 'gold',
    ],
    [
        'initials' => 'TR',
        'title' => 'Treasurer',
        'portfolio' => 'Finance & Accountability',
        'focus' => 'Oversees budgeting, financial stewardship, reporting, and the responsible use of association resources.',
        'icon' => 'fa-wallet',
        'tone' => 'rose',
    ],
];

$otherLeaders = [
    [
        'initials' => 'PS',
        'title' => 'Publicity Secretary',
        'portfolio' => 'Communications & Outreach',
        'focus' => 'Shapes announcements, publicity, and how ECOSA stays visible and connected with members.',
        'icon' => 'fa-bullhorn',
        'tone' => 'blue',
    ],
    [
        'initials' => 'OS',
        'title' => 'Organizing Secretary',
        'portfolio' => 'Events & Mobilization',
        'focus' => 'Coordinates logistics, event planning, and practical mobilization for alumni programs and gatherings.',
        'icon' => 'fa-calendar-check',
        'tone' => 'green',
    ],
    [
        'initials' => 'WS',
        'title' => 'Welfare Secretary',
        'portfolio' => 'Member Welfare',
        'focus' => 'Keeps member support visible through care, solidarity, and responsive attention to welfare concerns.',
        'icon' => 'fa-hand-holding-heart',
        'tone' => 'gold',
    ],
    [
        'initials' => 'CM',
        'title' => 'Committee Member',
        'portfolio' => 'Programs & Partnerships',
        'focus' => 'Supports committee work, strengthens partnerships, and helps move shared projects forward.',
        'icon' => 'fa-handshake-angle',
        'tone' => 'rose',
    ],
];

$leadershipTeam = array_merge($topLeadership, $otherLeaders);

$leadershipHighlights = [
    [
        'value' => '8',
        'label' => 'Leadership Roles',
        'detail' => 'A balanced structure covering strategy, finance, communication, welfare, events, and member engagement.',
    ],
    [
        'value' => '500+',
        'label' => 'Alumni Network',
        'detail' => 'A growing community that leadership serves through coordination, representation, and consistent communication.',
    ],
    [
        'value' => '2002',
        'label' => 'Association Since',
        'detail' => 'Leadership continues a long-standing alumni legacy built on loyalty, service, and school pride.',
    ],
];

$governancePillars = [
    [
        'icon' => 'fa-scale-balanced',
        'title' => 'Transparent Governance',
        'text' => 'Committee decisions are guided by structure, records, and clear accountability in leadership practice.',
    ],
    [
        'icon' => 'fa-people-group',
        'title' => 'Collective Service',
        'text' => 'Every office contributes a distinct responsibility, but progress depends on teamwork across the executive committee.',
    ],
    [
        'icon' => 'fa-school',
        'title' => 'School Impact',
        'text' => 'Leadership exists not only for member coordination but also to strengthen the school community we all represent.',
    ],
];

include 'includes/header.php';
?>

<style>
.leadership-section {
    background: linear-gradient(180deg, var(--white) 0%, var(--background) 42%, var(--white) 100%);
}

.leadership-hero-panel {
    display: grid;
    grid-template-columns: minmax(0, 1.2fr) minmax(320px, 0.8fr);
    gap: 28px;
    margin-bottom: 44px;
}

.leadership-intro-card,
.leadership-values-card,
.leadership-highlight-card,
.leader-profile-card,
.governance-card,
.leadership-note {
    background: var(--white);
    border-radius: 20px;
    border: 1px solid rgba(23, 58, 96, 0.08);
    box-shadow: var(--shadow);
}

.leadership-intro-card,
.leadership-values-card {
    position: relative;
    overflow: hidden;
    padding: 34px 34px 32px;
}

.leadership-intro-card {
    background:
        linear-gradient(180deg, rgba(255, 255, 255, 0.97) 0%, rgba(245, 250, 242, 0.98) 100%),
        url('assets/images/school/aerialview.jpeg');
    background-size: cover;
    background-position: center;
}

.leadership-intro-card::before,
.leadership-values-card::before {
    content: '';
    position: absolute;
    inset: auto -40px -46px auto;
    width: 180px;
    height: 180px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(103, 188, 69, 0.14) 0%, rgba(103, 188, 69, 0) 72%);
    pointer-events: none;
}

.section-kicker {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 8px 15px;
    margin-bottom: 16px;
    border-radius: 999px;
    background: rgba(23, 58, 96, 0.08);
    color: var(--brand-blue);
    font-size: 0.79rem;
    font-weight: 700;
    letter-spacing: 0.05em;
    text-transform: uppercase;
}

.section-kicker::before {
    content: '';
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: var(--accent-green);
}

.leadership-intro-card .section-title {
    max-width: 700px;
    margin-bottom: 14px;
}

.leadership-intro-card p,
.leadership-values-card p,
.leadership-group-header p,
.governance-intro p,
.leadership-note p,
.leader-profile-focus,
.leadership-highlight-card p {
    color: var(--text-muted);
}

.leadership-intro-card .section-title,
.leadership-values-card h3 {
    max-width: 520px;
}

.leadership-intro-copy {
    max-width: 640px;
}

.leadership-summary-list {
    display: grid;
    gap: 14px;
    margin-top: 24px;
}

.leadership-summary-item {
    display: flex;
    align-items: center;
    gap: 12px;
    color: var(--dark-green);
    font-weight: 600;
    line-height: 1.5;
}

.leadership-summary-item i {
    width: 38px;
    height: 38px;
    border-radius: 12px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    background: rgba(103, 188, 69, 0.14);
    color: var(--accent-green-dark);
    font-size: 0.95rem;
}

.leadership-values-card {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    gap: 24px;
}

.leadership-values-card h3 {
    color: var(--dark-green);
    font-size: 1.75rem;
    line-height: 1.12;
    margin-bottom: 12px;
}

.leadership-values-list {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}

.leadership-value-pill {
    padding: 9px 14px;
    border-radius: 999px;
    background: rgba(23, 58, 96, 0.08);
    border: 1px solid rgba(23, 58, 96, 0.12);
    color: var(--brand-blue);
    font-size: 0.88rem;
    font-weight: 600;
}

.leadership-values-quote {
    padding-top: 18px;
    border-top: 1px solid rgba(23, 58, 96, 0.08);
    color: var(--accent-green-dark);
    font-size: 1.12rem;
    font-family: var(--font-accent);
}

.leadership-highlight-grid {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 22px;
    margin-bottom: 50px;
}

.leadership-highlight-card {
    padding: 24px;
}

.leadership-highlight-value {
    margin-bottom: 10px;
    color: var(--brand-blue);
    font-size: 2rem;
    font-weight: 800;
    line-height: 1;
}

.leadership-highlight-card h3 {
    margin-bottom: 10px;
    color: var(--dark-green);
    font-size: 1.08rem;
}

.leadership-group+.leadership-group {
    margin-top: 54px;
}

.leadership-group-header,
.governance-intro {
    max-width: 760px;
    margin: 0 auto 28px;
    text-align: center;
}

.leadership-group-title {
    margin: 8px 0 12px;
    color: var(--brand-blue);
    font-size: 1.8rem;
    font-weight: 800;
}

.leadership-team-grid {
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 28px;
}

.leader-profile-card {
    overflow: hidden;
    transition: var(--transition);
    min-height: 100%;
}

.leader-profile-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 18px 38px rgba(23, 58, 96, 0.14);
}

.leader-profile-visual {
    position: relative;
    min-height: 250px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    gap: 20px;
    padding: 22px;
    background-image:
        linear-gradient(180deg, rgba(8, 27, 44, 0.2) 0%, rgba(8, 27, 44, 0.52) 100%),
        url('assets/images/school/Equatorial-College-School5.jpeg');
    background-size: cover;
    background-position: center;
}

.leader-profile-card::before {
    content: '';
    position: absolute;
    inset: 0;
    pointer-events: none;
}

.leader-profile-card::after {
    content: '';
    position: absolute;
    inset: auto 0 0 0;
    height: 5px;
    background: var(--leader-accent, var(--brand-blue));
}

.leader-tone-blue {
    --leader-accent: #173a60;
    --leader-soft: rgba(23, 58, 96, 0.18);
}

.leader-tone-green {
    --leader-accent: #4f9731;
    --leader-soft: rgba(103, 188, 69, 0.18);
}

.leader-tone-gold {
    --leader-accent: #b89012;
    --leader-soft: rgba(255, 214, 0, 0.18);
}

.leader-tone-rose {
    --leader-accent: #d14b86;
    --leader-soft: rgba(233, 30, 99, 0.16);
}

.leader-profile-top {
    position: relative;
    z-index: 1;
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 12px;
}

.leader-profile-badge {
    display: inline-flex;
    align-self: flex-start;
    padding: 8px 13px;
    border-radius: 999px;
    background: rgba(255, 255, 255, 0.14);
    color: var(--white);
    font-size: 0.76rem;
    font-weight: 700;
    letter-spacing: 0.05em;
    text-transform: uppercase;
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
}

.leader-profile-icon {
    width: 42px;
    height: 42px;
    border-radius: 14px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: var(--leader-soft);
    color: var(--white);
    font-size: 1rem;
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
}

.leader-profile-center {
    position: relative;
    z-index: 1;
    display: flex;
    justify-content: center;
    align-items: center;
    flex: 1;
}

.leader-profile-initials {
    width: 104px;
    height: 104px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(255, 255, 255, 0.95);
    color: var(--leader-accent, var(--accent-green-dark));
    font-size: 1.55rem;
    font-weight: 800;
    letter-spacing: 0.04em;
    box-shadow: 0 10px 24px rgba(0, 0, 0, 0.12);
}

.leader-profile-actions {
    position: relative;
    z-index: 1;
    display: flex;
    justify-content: center;
    gap: 12px;
    padding: 12px 14px;
    margin: 0 auto;
    border-radius: 16px;
    background: var(--brand-blue);
    color: var(--white);
    width: min(210px, 100%);
}

.leader-profile-actions span {
    width: 26px;
    height: 26px;
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: rgba(255, 255, 255, 0.08);
    font-size: 0.82rem;
}

.leader-profile-body {
    padding: 24px 22px 26px;
    text-align: center;
}

.leader-profile-title {
    margin-bottom: 8px;
    color: var(--text);
    font-size: 1.04rem;
    font-weight: 800;
}

.leader-profile-role {
    margin-bottom: 14px;
    color: var(--leader-accent, var(--accent-green-dark));
    font-size: 0.9rem;
    font-weight: 700;
}

.leader-profile-focus {
    font-size: 0.93rem;
    line-height: 1.62;
}

.governance-block {
    margin-top: 60px;
}

.governance-grid {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 24px;
}

.governance-card {
    padding: 28px;
}

.governance-icon {
    width: 52px;
    height: 52px;
    margin-bottom: 16px;
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(103, 188, 69, 0.16);
    color: var(--accent-green-dark);
    font-size: 1.15rem;
}

.governance-card h4 {
    margin-bottom: 10px;
    color: var(--dark-green);
    font-size: 1.08rem;
}

.governance-card p {
    color: var(--text-muted);
    font-size: 0.94rem;
}

.leadership-note {
    max-width: 980px;
    margin: 54px auto 0;
    padding: 26px 28px;
    text-align: center;
    border-left: 4px solid var(--accent-pink);
    border-radius: 18px;
}

.leadership-note h4 {
    margin-bottom: 10px;
    color: var(--brand-blue);
    font-size: 1.12rem;
}

.leadership-note p {
    max-width: 760px;
    margin: 0 auto;
    line-height: 1.7;
}

@media (max-width: 1024px) {

    .leadership-hero-panel,
    .leadership-highlight-grid,
    .governance-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }

    .leadership-team-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }
}

@media (max-width: 768px) {

    .leadership-hero-panel,
    .leadership-highlight-grid,
    .leadership-team-grid,
    .governance-grid {
        grid-template-columns: 1fr;
    }

    .leadership-intro-card,
    .leadership-values-card,
    .leadership-highlight-card,
    .governance-card,
    .leadership-note {
        padding: 24px 20px;
    }

    .leadership-values-card h3 {
        font-size: 1.5rem;
    }

    .leadership-group+.leadership-group,
    .governance-block {
        margin-top: 42px;
    }

    .leadership-group-title {
        font-size: 1.48rem;
    }

    .leader-profile-visual {
        min-height: 245px;
    }

    .leader-profile-actions {
        width: 100%;
    }
}
</style>

<section class="page-hero">
    <div class="container">
        <h1>Leadership Team</h1>
        <p>Meet the committee guiding ECOSA with service, accountability, and a shared commitment to alumni impact.</p>
    </div>
</section>

<section id="leadership" class="section-padding leadership-section">
    <div class="container">
        <div class="leadership-note reveal">
            <h4>Serving with trust, clarity, and continuity</h4>
            <p>Our committee remains accountable through regular engagement, careful stewardship, and a shared
                commitment to strengthen both the alumni network and Equatorial College School.</p>
        </div>


        <div class="leadership-highlight-grid">
            <?php foreach ($leadershipHighlights as $highlight): ?>
            <article class="leadership-highlight-card reveal">
                <div class="leadership-highlight-value"><?php echo $highlight['value']; ?></div>
                <h3><?php echo $highlight['label']; ?></h3>
                <p><?php echo $highlight['detail']; ?></p>
            </article>
            <?php endforeach; ?>
        </div>

        <div class="leadership-group">
            <div class="leadership-group-header reveal">
                <span class="section-kicker">Leadership Team</span>
                <h3 class="leadership-group-title">Meet the Committee</h3>
                <p>All committee members serve together to guide strategy, support alumni welfare, strengthen
                    communication, and keep ECOSA active, organized, and accountable.</p>
            </div>

            <div class="leadership-team-grid">
                <?php foreach ($leadershipTeam as $leader): ?>
                <article class="leader-profile-card leader-tone-<?php echo $leader['tone']; ?> reveal">
                    <div class="leader-profile-visual">
                        <div class="leader-profile-top">
                            <span class="leader-profile-badge"><?php echo $leader['portfolio']; ?></span>
                            <span class="leader-profile-icon"><i class="fas <?php echo $leader['icon']; ?>"></i></span>
                        </div>
                        <div class="leader-profile-center">
                            <div class="leader-profile-initials"><?php echo $leader['initials']; ?></div>
                        </div>
                        <div class="leader-profile-actions" aria-hidden="true">
                            <span><i class="fas fa-envelope"></i></span>
                            <span><i class="fas fa-bullhorn"></i></span>
                            <span><i class="fas fa-calendar-check"></i></span>
                            <span><i class="fas fa-hand-holding-heart"></i></span>
                        </div>
                    </div>
                    <div class="leader-profile-body">
                        <h4 class="leader-profile-title"><?php echo $leader['title']; ?></h4>
                        <p class="leader-profile-role"><?php echo $leader['portfolio']; ?></p>
                        <p class="leader-profile-focus"><?php echo $leader['focus']; ?></p>
                    </div>
                </article>
                <?php endforeach; ?>
            </div>
        </div>

        <div id="governance" class="governance-block">
            <div class="governance-intro reveal">
                <span class="section-kicker">Governance & Accountability</span>
                <h3 class="leadership-group-title">How the team serves the association.</h3>
                <p>Strong leadership is more than titles. It is the discipline, teamwork, and structure that keep
                    members informed, resources protected, and shared goals moving forward.</p>
            </div>

            <div class="governance-grid">
                <?php foreach ($governancePillars as $pillar): ?>
                <article class="governance-card reveal">
                    <div class="governance-icon"><i class="fas <?php echo $pillar['icon']; ?>"></i></div>
                    <h4><?php echo $pillar['title']; ?></h4>
                    <p><?php echo $pillar['text']; ?></p>
                </article>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="leadership-note reveal">
            <h4>Serving with trust, clarity, and continuity</h4>
            <p>Our committee remains accountable through regular engagement, careful stewardship, and a shared
                commitment to strengthen both the alumni network and Equatorial College School.</p>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>