<header class="navbar" role="banner">
    <div class="navbar__container">
        <a href="/" class="navbar__brand">Swoley</a>
        <button class="navbar__toggle" id="navbarToggle" aria-label="Toggle navigation" aria-controls="navbarMenu" aria-expanded="false">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </button>
    </div>

    <nav id="navbarMenu" class="navbar__menu" role="navigation" aria-labelledby="navbarToggle">
        <ul class="navbar__list">
            <?php if (!empty($auth['logged_in'])): ?>
                <li class="navbar__item"><a href="/dashboard" class="navbar__link">Dashboard</a></li>
                <li class="navbar__item"><a href="/about" class="navbar__link">About</a></li>
                <li class="navbar__item"><a href="/contact" class="navbar__link">Contact</a></li>
                <li class="navbar__item navbar__item--cta">
                    <a href="/logout" class="navbar__link navbar__link--cta">Logout</a>
                </li>
            <?php else: ?>
                <li class="navbar__item"><a href="/about" class="navbar__link">About</a></li>
                <li class="navbar__item"><a href="/contact" class="navbar__link">Contact</a></li>
                <li class="navbar__item navbar__item--cta">
                    <a href="/login" class="navbar__link navbar__link--cta">Login</a>
                </li>
                <li class="navbar__item navbar__item--cta">
                    <a href="/register" class="navbar__link navbar__link--cta">Register</a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
