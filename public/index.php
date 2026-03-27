<?php require __DIR__ . '/../src/bootstrap.php';

$title = "Home";

ob_start();
?>

<section class="hero">
    <div class="hero__inner">
        <p class="hero__eyebrow">Your lifts. Your data. Your gains.</p>
        <h1 class="hero__headline">Track Every Rep.<br>Dominate Every PR.</h1>
        <p class="hero__sub">
            Swoley logs your workouts, tracks your sets and weight, and shows you
            exactly how far you've come — session by session.
        </p>
        <div class="hero__cta">
            <a href="/register.php" class="btn btn--primary">Get Started Free</a>
            <a href="/about.php" class="btn btn--ghost">Learn More</a>
        </div>
    </div>
    <div class="hero__glow" aria-hidden="true"></div>
</section>

<!-- Features -->
<section class="features">
    <div class="features__inner container">
        <h2 class="section__title">Built for lifters, not spreadsheets.</h2>
        <div class="features__grid">
            <div class="feature-card">
                <div class="feature-card__icon">🏋️</div>
                <h3>Log Workouts Fast</h3>
                <p>Add exercises, sets, reps, and weight in seconds. No friction, no fluff.</p>
            </div>
            <div class="feature-card">
                <div class="feature-card__icon">📈</div>
                <h3>Track Progress</h3>
                <p>Watch your lifts climb over time. Every session builds a picture of your growth.</p>
            </div>
            <div class="feature-card">
                <div class="feature-card__icon">🔥</div>
                <h3>Hit Personal Records</h3>
                <p>Know when you've hit a PR the moment it happens. Stay motivated, stay consistent.</p>
            </div>
        </div>
    </div>
</section>

<!-- How it works -->
<section class="how-it-works">
    <div class="how-it-works__inner container">
        <h2 class="section__title">Simple by design.</h2>
        <ol class="steps">
            <li class="step">
                <span class="step__num">01</span>
                <div class="step__body">
                    <h3>Create your account</h3>
                    <p>Sign up in under a minute. No credit card, no noise.</p>
                </div>
            </li>
            <li class="step">
                <span class="step__num">02</span>
                <div class="step__body">
                    <h3>Log your session</h3>
                    <p>Add your workout, then drop in each exercise with sets, reps, and weight.</p>
                </div>
            </li>
            <li class="step">
                <span class="step__num">03</span>
                <div class="step__body">
                    <h3>Watch the data build</h3>
                    <p>Come back every session. Your history grows, your progress becomes undeniable.</p>
                </div>
            </li>
        </ol>
    </div>
</section>

<!-- Final CTA -->
<section class="cta-band">
    <div class="cta-band__inner container">
        <h2>Ready to get Swoley?</h2>
        <p>Join now and start building the strongest version of yourself.</p>
        <a href="/register.php" class="btn btn--primary btn--lg">Create Your Free Account</a>
    </div>
    <div class="cta-band__glow" aria-hidden="true"></div>
</section>

<?php
$content = ob_get_clean();
include __DIR__ . '/../views/layout.php';
