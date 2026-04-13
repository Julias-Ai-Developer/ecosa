<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? $pageTitle . ' | ECOSA' : 'ECOSA | Equatorial College School Old Students Association'; ?></title>
    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Courgette&family=Great+Vibes&family=Merriweather:ital,opsz,wght@0,18..144,300..900;1,18..144,300..900&family=Syne:wght@400..800&display=swap" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        .navbar .logo-img {
            max-height: 50px;
            width: auto;
        }
    </style>
</head>

<body>

    <!-- Topbar -->
    <div class="topbar">
        <div class="container topbar-content">
            <div class="motto">"Together for a Bright Future"</div>
            <div class="topbar-stats">
                <a href="https://wa.me/256700000000" class="topbar-stat" target="_blank" rel="noopener noreferrer">
                    <i class="fab fa-whatsapp"></i>
                    <span>+256 700 000 000</span>
                </a>
                <span class="topbar-stat">
                    <i class="fas fa-users"></i>
                    <span>500+ Members</span>
                </span>
            </div>
        </div>
    </div>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="container navbar-content">
            <a href="index.php" class="logo-area">
                <img src="assets/images/logo.png" alt="ECOSA Logo" class="logo-img">
                <div class="logo-text">ECOSA</div>
            </a>

            <div class="nav-wrapper">
                <ul class="nav-links">
                    <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
                    <li class="nav-item">
                        <a href="about.php" class="nav-link">About <i class="fas fa-chevron-down"></i></a>
                        <div class="dropdown-menu">
                            <a href="about.php#heritage" class="dropdown-item">School Heritage</a>
                            <a href="about.php#purpose" class="dropdown-item">Our Purpose</a>
                            <a href="about.php#leadership" class="dropdown-item">Leadership</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a href="membership.php" class="nav-link">Membership <i class="fas fa-chevron-down"></i></a>
                        <div class="dropdown-menu">
                            <a href="membership.php#benefits" class="dropdown-item">Benefits</a>
                            <a href="membership.php#eligibility" class="dropdown-item">Eligibility</a>
                            <a href="membership.php#registration" class="dropdown-item">Registration</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a href="community.php" class="nav-link">Community <i class="fas fa-chevron-down"></i></a>
                        <div class="dropdown-menu">
                            <a href="community.php#events" class="dropdown-item">Events</a>
                            <a href="community.php#news" class="dropdown-item">News & Updates</a>
                            <a href="community.php#gallery" class="dropdown-item">Gallery</a>
                        </div>
                    </li>
                    <li class="nav-item"><a href="contact.php" class="nav-link">Contact</a></li>
                </ul>

                <div class="nav-ctas">
                    <a href="membership.php#registration" class="btn member-pill-btn">Become a Member</a>
                </div>
            </div>

            <div class="mobile-toggle" id="mobile-toggle">
                <i class="fas fa-bars"></i>
            </div>
        </div>
    </nav>
