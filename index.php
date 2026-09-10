<?php
// Subdomain Brute Force Support: e.g. chat.hxh.local, chatbot.hxh.ctf, ai.hxh.ctf, etc.
$host = strtolower($_SERVER['HTTP_HOST'] ?? '');
$parts = explode('.', $host);
if (count($parts) > 1) {
    $subdomain = strtolower($parts[0]);
    $chatbotSubdomains = ['chat', 'chatbot', 'ai', 'assistant', 'support', 'bot', 'terminal', 'helpdesk'];
    if (in_array($subdomain, $chatbotSubdomains)) {
        require_once __DIR__ . '/chatbot.php';
        exit;
    }
}

$pageTitle = 'Home Portal';
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/header.php';
?>

<main class="page-content-wrapper">
    <!-- Hero Banner -->
    <section class="hero-card">
        <div class="hero-badge">OFFICIAL COMMUNIQUE • 288TH SESSION</div>
        <h2 class="hero-title">HUNTER ASSOCIATION PUBLIC PORTAL</h2>
        <p class="hero-subtitle">
            Welcome to the official network of the International Hunter Association. Licensed Hunters are elite individuals dedicated to tracking secret treasures, magical beasts, uncharted realms, and dangerous criminals.
        </p>
        <div class="hero-actions">
            <a href="about.php" class="btn-hero btn-primary">📖 Explore Exam Phases</a>
            <a href="candidates.php" class="btn-hero btn-secondary">🏆 View Candidate Roster</a>
            <a href="guidelines.php" class="btn-hero btn-secondary">📜 Read Hunter Bylaws</a>
        </div>
    </section>

    <!-- Quick Stats Grid -->
    <section class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon">👥</div>
            <div class="stat-number">405</div>
            <div class="stat-label">Applicants Registered</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">⚔️</div>
            <div class="stat-number">5</div>
            <div class="stat-label">Exam Phases</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">🃏</div>
            <div class="stat-number">&lt; 1%</div>
            <div class="stat-label">Pass Rate</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">💳</div>
            <div class="stat-number">3-Star</div>
            <div class="stat-label">Max Security Clearance</div>
        </div>
    </section>

    <!-- Features 3-Column Grid -->
    <section class="content-cards-grid">
        <div class="portal-card">
            <div class="card-icon-tag">🏛️</div>
            <h3>About The Hunter License</h3>
            <p>
                A Hunter License is the most prestigious credential on the globe. Holders gain unrestricted access to 90% of forbidden territories and 95% of public amenities worldwide.
            </p>
            <a href="guidelines.php" class="card-link">View Hunter Bylaws &rarr;</a>
        </div>

        <div class="portal-card">
            <div class="card-icon-tag">⚡</div>
            <h3>Nen & Aura Diagnostics</h3>
            <p>
                All certified Hunters must master the four major principles: Ten (Enclose), Zetsu (Suppress), Ren (Enhance), and Hatsu (Release). Calibrate your Nen frequency in the examination system.
            </p>
            <a href="about.php#nen" class="card-link">Read Nen Codex &rarr;</a>
        </div>

        <div class="portal-card">
            <div class="card-icon-tag">🌟</div>
            <h3>The Zodiac 12 Council</h3>
            <p>
                The high council of 12 elite Hunters selected directly by Chairman Netero to oversee the governance, discipline, and secret global expeditions of the Hunter Association.
            </p>
            <a href="about.php" class="card-link">Learn More &rarr;</a>
        </div>
    </section>

    <!-- Announcements Bulletin Board -->
    <section class="bulletin-board">
        <h3>📢 Latest Association Bulletins</h3>
        <div class="bulletin-item">
            <div class="bulletin-date">SEPTEMBER 2026</div>
            <div class="bulletin-text">
                <strong>Phase 1 Wetland Marathon Notice:</strong> Beware of Milsy Wetlands illusionary creatures. Do not consume wild fruits or accept unsealed beverages from applicant #16 (Tonpa).
            </div>
        </div>
        <div class="bulletin-item">
            <div class="bulletin-date">AUGUST 2026</div>
            <div class="bulletin-text">
                <strong>Chairman Netero's Proclamation:</strong> All candidates must complete digital verification before proceeding to Phase 2. Ensure all transmission packets are properly authenticated.
            </div>
        </div>
    </section>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
