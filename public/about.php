<?php
require __DIR__ . '/../src/bootstrap.php';

$title = "About";

ob_start();
?>

<!-- Page hero -->
<section class="about-hero">
    <div class="about-hero__inner container">
        <p class="hero__eyebrow">Our Mission</p>
        <h1 class="about-hero__headline">Built by lifters.<br>Built for lifters.</h1>
        <p class="about-hero__sub">
            Swoley exists because tracking your training shouldn't be a second job.
            We wanted something fast, focused, and actually useful in the gym — so we built it.
        </p>
    </div>
    <div class="hero__glow" aria-hidden="true"></div>
</section>

<!-- The problem -->
<section class="about-section about-section--alt">
    <div class="container about-two-col">
        <div class="about-two-col__text">
            <p class="about-kicker">The Problem</p>
            <h2>Spreadsheets aren't a training plan.</h2>
            <p>
                Most lifters fall into one of two camps: they either track nothing and wonder why they're
                stalling, or they spend more time updating a Google Sheet than actually lifting. Neither works.
            </p>
            <p>
                Progress in the gym is driven by data — knowing what you lifted last week, spotting a plateau
                before it costs you months, and seeing your numbers climb over time. That data should be
                effortless to capture.
            </p>
        </div>
        <div class="about-two-col__visual">
            <div class="about-stat-block">
                <span class="about-stat-block__num">73%</span>
                <span class="about-stat-block__desc">of lifters who track their workouts report faster strength gains</span>
            </div>
            <div class="about-stat-block">
                <span class="about-stat-block__num">3×</span>
                <span class="about-stat-block__desc">more likely to hit a new PR when progress is logged consistently</span>
            </div>
        </div>
    </div>
</section>

<!-- What we believe -->
<section class="about-section">
    <div class="container">
        <p class="about-kicker">Our Principles</p>
        <h2 class="about-section__title">What we believe.</h2>
        <div class="principles-grid">
            <div class="principle-card">
                <span class="principle-card__icon">⚡</span>
                <h3>Speed over everything</h3>
                <p>Logging a set should take three seconds, not thirty. If it's slow you won't do it — so we make it fast.</p>
            </div>
            <div class="principle-card">
                <span class="principle-card__icon">🎯</span>
                <h3>Focus on signal, cut the noise</h3>
                <p>We track what matters: exercises, sets, reps, weight, and time. No social feeds, no fluff.</p>
            </div>
            <div class="principle-card">
                <span class="principle-card__icon">📊</span>
                <h3>Data that actually helps</h3>
                <p>Your history should tell you something useful — PRs, volume trends, and plateaus you didn't know you hit.</p>
            </div>
            <div class="principle-card">
                <span class="principle-card__icon">🔒</span>
                <h3>Your data, your business</h3>
                <p>We don't sell your training data, show you ads, or monetize your effort. Full stop.</p>
            </div>
        </div>
    </div>
</section>

<!-- Roadmap -->
<section class="about-section about-section--alt">
    <div class="container">
        <p class="about-kicker">Where We're Headed</p>
        <h2 class="about-section__title">The roadmap.</h2>
        <p class="about-section__intro">
            Swoley is actively in development. Here's what's coming — and what's already shipped.
        </p>
        <div class="roadmap">
            <div class="roadmap__item roadmap__item--done">
                <div class="roadmap__marker"></div>
                <div class="roadmap__body">
                    <span class="roadmap__badge roadmap__badge--done">Shipped</span>
                    <h3>Core workout logging</h3>
                    <p>Create workouts, add exercises, log sets with reps and weight. The foundation.</p>
                </div>
            </div>
            <div class="roadmap__item roadmap__item--done">
                <div class="roadmap__marker"></div>
                <div class="roadmap__body">
                    <span class="roadmap__badge roadmap__badge--done">Shipped</span>
                    <h3>User accounts & auth</h3>
                    <p>Secure sign-up, login, and personal workout history tied to your account.</p>
                </div>
            </div>
            <div class="roadmap__item roadmap__item--active">
                <div class="roadmap__marker"></div>
                <div class="roadmap__body">
                    <span class="roadmap__badge roadmap__badge--active">In Progress</span>
                    <h3>Personal records & dashboard</h3>
                    <p>Automatic PR detection, per-lift history, and a dashboard that shows your progress at a glance.</p>
                </div>
            </div>
            <div class="roadmap__item">
                <div class="roadmap__marker"></div>
                <div class="roadmap__body">
                    <span class="roadmap__badge">Planned</span>
                    <h3>Progress charts & volume analytics</h3>
                    <p>Visual trend lines by lift, weekly volume load, and plateau detection over time.</p>
                </div>
            </div>
            <div class="roadmap__item">
                <div class="roadmap__marker"></div>
                <div class="roadmap__body">
                    <span class="roadmap__badge">Planned</span>
                    <h3>Estimated 1RM & strength scores</h3>
                    <p>Calculated 1RM over time so you can track strength even on rep-based training days.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Tech stack -->
<section class="about-section">
    <div class="container">
        <p class="about-kicker">Under the Hood</p>
        <h2 class="about-section__title">How it's built.</h2>
        <p class="about-section__intro">
            Swoley is a lean, server-rendered PHP app — no JavaScript frameworks, no over-engineering.
            Fast by default, easy to run anywhere.
        </p>
        <div class="stack-grid">
            <div class="stack-card">
                <span class="stack-card__label">Backend</span>
                <span class="stack-card__value">PHP 8.3</span>
            </div>
            <div class="stack-card">
                <span class="stack-card__label">Database</span>
                <span class="stack-card__value">PostgreSQL 16</span>
            </div>
            <div class="stack-card">
                <span class="stack-card__label">Server</span>
                <span class="stack-card__value">Apache</span>
            </div>
            <div class="stack-card">
                <span class="stack-card__label">Infrastructure</span>
                <span class="stack-card__value">Docker</span>
            </div>
            <div class="stack-card">
                <span class="stack-card__label">Frontend</span>
                <span class="stack-card__value">Vanilla HTML & CSS</span>
            </div>
            <div class="stack-card">
                <span class="stack-card__label">License</span>
                <span class="stack-card__value">Apache 2.0</span>
            </div>
        </div>
    </div>
</section>

<!-- Final CTA -->
<section class="cta-band">
    <div class="cta-band__inner container">
        <h2>Start tracking. Start growing.</h2>
        <p>It's free, it's fast, and your first PR is closer than you think.</p>
        <a href="/register.php" class="btn btn--primary btn--lg">Create Your Free Account</a>
    </div>
    <div class="cta-band__glow" aria-hidden="true"></div>
</section>

<?php
$content = ob_get_clean();
include __DIR__ . '/../views/layout.php';
