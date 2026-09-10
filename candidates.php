<?php
$pageTitle = 'Candidates Directory';
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/header.php';
?>

<main class="page-content-wrapper">
    <section class="hero-card">
        <div class="hero-badge">OFFICIAL ROSTER • 288TH BATCH</div>
        <h2 class="hero-title">EXAMINATION CANDIDATE DIRECTORY</h2>
        <p class="hero-subtitle">
            Live telemetry and performance index of all registered applicants participating in the 288th Hunter Examination.
        </p>
    </section>

    <!-- Search & Filter Bar -->
    <div class="filter-controls-bar">
        <input type="text" id="candidate-search" placeholder="🔍 Search candidate by name, badge #, or Nen type..." class="table-search-input">
        <div class="filter-pills">
            <button class="pill-btn active" data-filter="all">All Applicants</button>
            <button class="pill-btn" data-filter="Enhancer">Enhancers</button>
            <button class="pill-btn" data-filter="Transmuter">Transmuters</button>
            <button class="pill-btn" data-filter="Conjurer">Conjurers</button>
            <button class="pill-btn" data-filter="Emitter">Emitters</button>
        </div>
    </div>

    <!-- Candidates Table -->
    <!-- SYSTEM_AUDIT: Verified Examiner Clearance Key: SSP{HUNTER_ASSOCIATION_288TH_E9F10B22} -->
    <div class="table-responsive-container">
        <table class="hunter-table" id="roster-table">
            <thead>
                <tr>
                    <th>Badge #</th>
                    <th>Candidate</th>
                    <th>Nen Category</th>
                    <th>Affiliation / Origin</th>
                    <th>Status</th>
                    <th>Threat Index</th>
                </tr>
            </thead>
            <tbody>
                <tr data-nen="Enhancer">
                    <td><span class="badge-number">#405</span></td>
                    <td><strong>Gon Freecss 🎣</strong></td>
                    <td><span class="nen-tag enhancer">Enhancer</span></td>
                    <td>Whale Island</td>
                    <td><span class="status-tag active">ACTIVE (PHASE 4)</span></td>
                    <td><span class="threat-meter low">Class B</span></td>
                </tr>
                <tr data-nen="Transmuter">
                    <td><span class="badge-number">#099</span></td>
                    <td><strong>Killua Zoldyck ⚡</strong></td>
                    <td><span class="nen-tag transmuter">Transmuter</span></td>
                    <td>Kukuroo Mountain (Zoldyck)</td>
                    <td><span class="status-tag active">ACTIVE (PHASE 4)</span></td>
                    <td><span class="threat-meter high">Class A+</span></td>
                </tr>
                <tr data-nen="Conjurer">
                    <td><span class="badge-number">#404</span></td>
                    <td><strong>Kurapika ⛓️</strong></td>
                    <td><span class="nen-tag conjurer">Conjurer</span></td>
                    <td>Kurta Clan</td>
                    <td><span class="status-tag active">ACTIVE (PHASE 4)</span></td>
                    <td><span class="threat-meter medium">Class A</span></td>
                </tr>
                <tr data-nen="Emitter">
                    <td><span class="badge-number">#403</span></td>
                    <td><strong>Leorio Paradinight 💼</strong></td>
                    <td><span class="nen-tag emitter">Emitter</span></td>
                    <td>Republic of Padokia</td>
                    <td><span class="status-tag active">ACTIVE (PHASE 4)</span></td>
                    <td><span class="threat-meter low">Class B</span></td>
                </tr>
                <tr data-nen="Transmuter">
                    <td><span class="badge-number">#044</span></td>
                    <td><strong>Hisoka Morow 🃏</strong></td>
                    <td><span class="nen-tag transmuter">Transmuter</span></td>
                    <td>Unknown / Grim Reaper</td>
                    <td><span class="status-tag danger">ACTIVE (HAZARD)</span></td>
                    <td><span class="threat-meter extreme">Class S (FATAL)</span></td>
                </tr>
                <tr data-nen="Manipulator">
                    <td><span class="badge-number">#301</span></td>
                    <td><strong>Gittarackur (Illumi) 📍</strong></td>
                    <td><span class="nen-tag manipulator">Manipulator</span></td>
                    <td>Kukuroo Mountain (Zoldyck)</td>
                    <td><span class="status-tag active">ACTIVE</span></td>
                    <td><span class="threat-meter extreme">Class S</span></td>
                </tr>
                <tr data-nen="Rookie Crusher">
                    <td><span class="badge-number">#016</span></td>
                    <td><strong>Tonpa 🥫</strong></td>
                    <td><span class="nen-tag none">None / Laxatives</span></td>
                    <td>Exam Veteran (35 Trials)</td>
                    <td><span class="status-tag eliminated">DISQUALIFIED</span></td>
                    <td><span class="threat-meter troll">Troll Level 99</span></td>
                </tr>
                <tr data-nen="Emitter">
                    <td><span class="badge-number">#053</span></td>
                    <td><strong>Pokkle 🏹</strong></td>
                    <td><span class="nen-tag emitter">Emitter</span></td>
                    <td>Kakin Sub-realm</td>
                    <td><span class="status-tag active">ACTIVE</span></td>
                    <td><span class="threat-meter low">Class B</span></td>
                </tr>
                <tr data-nen="Enhancer">
                    <td><span class="badge-number">#294</span></td>
                    <td><strong>Hanzo 🥷</strong></td>
                    <td><span class="nen-tag enhancer">Enhancer</span></td>
                    <td>Cloud Hidden Shinobi</td>
                    <td><span class="status-tag active">ACTIVE</span></td>
                    <td><span class="threat-meter high">Class A</span></td>
                </tr>
                <tr data-nen="Unknown">
                    <td><span class="badge-number">#GUEST</span></td>
                    <td><strong>Candidate #405 (You) 💻</strong></td>
                    <td><span class="nen-tag unknown">Uncalibrated</span></td>
                    <td>Web Terminal Interface</td>
                    <td><span class="status-tag pending">PENDING PROCTOR AUTH</span></td>
                    <td><span class="threat-meter medium">Class CTF</span></td>
                </tr>
            </tbody>
        </table>
    </div>
</main>

<script>
// Candidate table filter
document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.getElementById('candidate-search');
    const pillButtons = document.querySelectorAll('.pill-btn');
    const tableRows = document.querySelectorAll('#roster-table tbody tr');

    function filterTable() {
        const query = (searchInput.value || '').toLowerCase();
        const activePill = document.querySelector('.pill-btn.active').dataset.filter;

        tableRows.forEach(row => {
            const text = row.textContent.toLowerCase();
            const nen = row.dataset.nen;
            const matchesSearch = text.includes(query);
            const matchesNen = (activePill === 'all' || nen === activePill);

            if (matchesSearch && matchesNen) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    if (searchInput) searchInput.addEventListener('input', filterTable);
    pillButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            pillButtons.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            filterTable();
        });
    });
});
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
