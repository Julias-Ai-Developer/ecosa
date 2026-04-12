<?php
$pageTitle = 'Community';
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

    .events-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 30px;
    }

    .event-card {
        background: var(--white);
        padding: 30px;
        border-radius: 12px;
        box-shadow: var(--shadow);
    }

    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 15px;
    }

    .gallery-item {
        height: 200px;
        overflow: hidden;
        border-radius: 8px;
    }

    .gallery-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    @media (max-width: 768px) {
        .events-grid {
            grid-template-columns: 1fr;
        }

        .gallery-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
</style>

<!-- Page Hero -->
<section class="page-hero">
    <div class="container">
        <h1>Community & Events</h1>
        <p style="font-size: 1.2rem; opacity: 0.9; margin-top: 20px;">Celebrating our milestones and shared memories.</p>
    </div>
</section>

<!-- Content Sections -->
<section id="events" class="section-padding">
    <div class="container">
        <div class="reveal">
            <h2 class="section-title">Upcoming Events</h2>
            <div class="events-grid">
                <div class="event-card">
                    <h3 style="color: var(--primary-green);">Annual Grand Reunion</h3>
                    <p style="margin-top: 10px;">July 2026 at Equatorial College School Main Hall.</p>
                    <p style="font-size: 0.9rem; color: var(--gray); margin-top: 5px;">Organized by ECOSA - Equatorial College School Old Students Association</p>
                </div>
                <div class="event-card">
                    <h3 style="color: var(--primary-green);">Career Mentorship Day</h3>
                    <p style="margin-top: 10px;">September 2026. A day to inspire current students.</p>
                </div>
                <div class="event-card">
                    <h3 style="color: var(--primary-green);">Corporate Dinner</h3>
                    <p style="margin-top: 10px;">December 2026. Networking and fundraising dinner.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="news" class="section-padding" style="background-color: var(--white);">
    <div class="container">
        <div class="reveal">
            <h2 class="section-title">News & Updates</h2>
            <p>Stay informed about association developments and school projects. Follow our blog for more detailed updates.</p>
        </div>
    </div>
</section>

<section id="gallery" class="section-padding">
    <div class="container">
        <div class="reveal">
            <h2 class="section-title text-center">Gallery</h2>
            <div class="gallery-grid">
                <div class="gallery-item"><img src="https://images.unsplash.com/photo-1511632765486-a01980e01a18?auto=format&fit=crop&q=80&w=400" alt="Alumni gathering"></div>
                <div class="gallery-item"><img src="https://images.unsplash.com/photo-1523580494863-6f3031224c94?auto=format&fit=crop&q=80&w=400" alt="Graduation"></div>
                <div class="gallery-item"><img src="https://images.unsplash.com/photo-1529070538774-1843cb3265df?auto=format&fit=crop&q=80&w=400" alt="Meeting"></div>
                <div class="gallery-item"><img src="https://images.unsplash.com/photo-1517486808906-6ca8b3f04846?auto=format&fit=crop&q=80&w=400" alt="Students"></div>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>