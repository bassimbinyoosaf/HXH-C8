<?php
$pageTitle = 'About the Examination';
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/header.php';
?>

<main class="page-content-wrapper">
    <section class="hero-card">
        <div class="hero-badge">EXAM SYLLABUS • 288TH BATCH</div>
        <h2 class="hero-title">ABOUT THE 288TH HUNTER EXAM</h2>
        <p class="hero-subtitle">
            The Hunter Examination is held annually to discover individuals possessing extraordinary physical, mental, tactical, and spiritual prowess.
        </p>
    </section>

    <!-- Examination Phases Section -->
    <!-- DEV_NOTE: Automated Nen Sensor Token: SSP{NEN_WATER_DIVINATION_SPECIALIST_1182AC55} -->
    <section class="content-section">
        <h3 class="section-title">⚔️ The 5 Official Examination Phases</h3>
        <div class="phases-timeline">
            <div class="timeline-step">
                <div class="step-badge">PHASE 1</div>
                <h4>The Endless Tunnel & Milsy Wetlands</h4>
                <p>Examiner: Satotz. An endurance trial running over 80 kilometers underground into the mist of the perilous Milsy Wetlands, populated by man-eating deceiver beasts.</p>
            </div>

            <div class="timeline-step">
                <div class="step-badge">PHASE 2</div>
                <h4>Gourmet Cuisine Challenge</h4>
                <p>Examiners: Menchi & Buhara. A test of survival culinary mastery. Applicants must capture the Great Stamp wild boar and craft delicate dishes satisfying Michelin-level proctors.</p>
            </div>

            <div class="timeline-step">
                <div class="step-badge">PHASE 3</div>
                <h4>Trick Tower (72-Hour Descent)</h4>
                <p>Examiner: Lippo. Descend a colossal stone fortress in 72 hours by majority rule decision-making and defeating convicted prison gladiators in life-or-death matches.</p>
            </div>

            <div class="timeline-step">
                <div class="step-badge">PHASE 4</div>
                <h4>Zevil Island Numbered Badge Hunt</h4>
                <p>The infamous manhunt trial. Candidates draw lots for their target applicant's badge (worth 3 points), their own badge (3 points), and others (1 point). 6 points required to pass.</p>
            </div>

            <div class="timeline-step">
                <div class="step-badge">FINAL PHASE</div>
                <h4>One-on-One Elimination Tournament</h4>
                <p>Supervised by Chairman Netero. A bracket where only one victory guarantees your Hunter License, but killing your opponent results in immediate disqualification.</p>
            </div>
        </div>
    </section>

    <!-- Nen System Section -->
    <section class="content-section" id="nen">
        <h3 class="section-title">⚡ The 6 Categories of Nen (Aura)</h3>
        <p style="color: var(--text-muted); margin-bottom: 20px;">
            Nen is the technique that allows a living being to use and manipulate their life energy (aura). Determined via the Water Divination Test:
        </p>
        
        <div class="nen-hex-grid">
            <div class="nen-card">
                <div class="nen-badge-icon">🥊</div>
                <h4>Enhancer (Kyoka)</h4>
                <p>Increases the natural abilities of an object or body. Water Divination: Water volume changes.</p>
                <span class="nen-rep">Notable: Gon Freecss, Isaac Netero, Uvogin</span>
            </div>

            <div class="nen-card">
                <div class="nen-badge-icon">⚡</div>
                <h4>Transmuter (Henka)</h4>
                <p>Changes properties of aura to mimic something else (e.g. electricity, rubber). Water Divination: Water taste changes.</p>
                <span class="nen-rep">Notable: Killua Zoldyck, Hisoka Morow</span>
            </div>

            <div class="nen-card">
                <div class="nen-badge-icon">⛓️</div>
                <h4>Conjurer (Gugenka)</h4>
                <p>Creates physical, independent material objects out of pure aura. Water Divination: Impurities appear in water.</p>
                <span class="nen-rep">Notable: Kurapika, Shizuku, Kite</span>
            </div>

            <div class="nen-card">
                <div class="nen-badge-icon">💥</div>
                <h4>Emitter (Hoshutsu)</h4>
                <p>Projects and shoots aura detached from the body across distance. Water Divination: Water color changes.</p>
                <span class="nen-rep">Notable: Leorio Paradinight, Franklin, Razor</span>
            </div>

            <div class="nen-card">
                <div class="nen-badge-icon">📍</div>
                <h4>Manipulator (Sosa)</h4>
                <p>Controls animate or inanimate things (people, puppets, needles). Water Divination: Leaf moves on water.</p>
                <span class="nen-rep">Notable: Illumi Zoldyck, Shalnark, Morel</span>
            </div>

            <div class="nen-card">
                <div class="nen-badge-icon">📖</div>
                <h4>Specialist (Tokushitsu)</h4>
                <p>Possesses unique abilities that do not fit the other five categories. Water Divination: Unique leaf/glass alteration.</p>
                <span class="nen-rep">Notable: Chrollo Lucilfer, Kurapika (Emperor Time), Neferpitou</span>
            </div>
        </div>
    </section>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
