<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTC-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Swoley</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <header class="navbar" role="banner">
        <div class="navbar__container">
            <a href="index.php" class="navbar__brand">Swoley</a>
            <button class="navbar__toggle" id="navbbarToggle" aria-label="Toggle navigation" aria-controls="navbarMenu" aria-expanded="false">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </button>

    <nav id="navbarMenu" class="navbar__menu" role="navigation" aria-labelledby="navbarToggle">
        <ul class="navbar__list">
            <li class="navbar__item"><a href="about.php" class="navbar__link">About</a></li>
            <li class="navbar__item"><a href="contact.php" class="navbar__link">Contact</a></li>
            <li class="navbar__item navbar__item--cta">
                <a href="login.php" class="navbar__link navbar__link--cta">Login</a>
            </li>
            <li class="navbar__item navbar__item--cta">
                <a href="register.php" class="navbar__link navbar__link--cta">Register</a>
            </li>
        </ul>
    </nav>
    </header>
    <div class="container">
        <h1>Contact Page</h1>
        <h3>Creator: </h3> <p>David Martin</p>
        <h3>Email: </h3> <p>djmartindev@gmail.com</p>
    </div>
</body>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const navbarToggle = document.getElementById('navbarToggle');
        const navbarMenu = document.getElementById('navbarMenu');

        if (navbarToggle && navbarMenu) {
            navbarToggle.addEventListener('click', function () {
                navbarToggle.classList.toggle('is-active');
                navbarMenu.classList.toggle('is-active');

                const isExpanded = navbarToggle.getAttribute('aria-expanded') === 'true';
                navbarToggle.setAttribute('aria-expanded', !isExpanded);
            });
        }
    });
</script>
</html>
