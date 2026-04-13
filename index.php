<?php
$routes = [
    '' => 'home.php',
    'home' => 'home.php',
    'about-us' => 'about.php',
    'membership' => 'membership.php',
    'community' => 'community.php',
    'contact-us' => 'contact.php',
];

$requestPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
$scriptName = str_replace('\\', '/', $_SERVER['SCRIPT_NAME'] ?? '/index.php');
$basePath = rtrim(str_replace('\\', '/', dirname($scriptName)), '/');

if ($basePath !== '' && $basePath !== '/' && strpos($requestPath, $basePath) === 0) {
    $requestPath = substr($requestPath, strlen($basePath));
}

$route = trim($requestPath, '/');

if ($route === 'index.php') {
    $route = '';
}

if (array_key_exists($route, $routes)) {
    require __DIR__ . DIRECTORY_SEPARATOR . $routes[$route];
    exit;
}

http_response_code(404);
$pageTitle = 'Page Not Found';
include __DIR__ . '/includes/header.php';
?>

<section class="page-hero">
    <div class="container">
        <h1>Page Not Found</h1>
        <p>The page you requested could not be found.</p>
    </div>
</section>

<section class="section-padding">
    <div class="container text-center">
        <p style="margin-bottom: 24px;">Try one of the main pages below.</p>
        <div style="display: flex; gap: 14px; justify-content: center; flex-wrap: wrap;">
            <a href="./" class="btn btn-primary">Home</a>
            <a href="about-us" class="btn btn-outline">About Us</a>
            <a href="membership" class="btn btn-outline">Membership</a>
            <a href="contact-us" class="btn btn-outline">Contact</a>
        </div>
    </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
