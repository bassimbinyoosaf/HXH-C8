<?php
$pageTitle = 'Bureau of Communications';
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/header.php';

$feedbackMsg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $feedbackMsg = '✅ Transmission received by the Hunter Association Yorknew Branch. Priority code: CLASS-G.';
}
?>

<main class="page-content-wrapper">
    <section class="hero-card">
        <div class="hero-badge">TRANSMISSIONS • CLASSIFIED DISPATCH</div>
        <h2 class="hero-title">HUNTER ASSOCIATION COMMUNICATION BUREAU</h2>
        <p class="hero-subtitle">
            Direct high-frequency communication gateway with the Hunter Association Central Headquarters.
        </p>
    </section>

    <div class="contact-grid">
        <!-- GATEWAY_DECRYPT_KEY: SSP{WEB_CHATBOT_F782D019} -->
        <!-- Communication Form -->
        <div class="portal-card">
            <h3>📡 Transmit Official Inquiry</h3>
            <p style="color: var(--text-muted); margin-bottom: 16px;">
                Submit dispatches regarding examination grievances, magical beast sightings, or blacklist bounties.
            </p>

            <?php if ($feedbackMsg): ?>
                <div style="background: rgba(46, 204, 113, 0.2); border: 1px solid var(--accent-green); color: #2ecc71; padding: 12px; border-radius: 8px; margin-bottom: 16px; font-weight: 700;">
                    <?php echo htmlspecialchars($feedbackMsg); ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="contact.php" style="display: flex; flex-direction: column; gap: 14px;">
                <div>
                    <label style="font-size: 0.85rem; color: var(--text-muted); font-weight: 700; display: block; margin-bottom: 4px;">APPLICANT / HUNTER CODENAME</label>
                    <input type="text" name="codename" required placeholder="e.g. Applicant #405 or Leorio" class="table-search-input" style="width: 100%;">
                </div>
                <div>
                    <label style="font-size: 0.85rem; color: var(--text-muted); font-weight: 700; display: block; margin-bottom: 4px;">INQUIRY CATEGORY</label>
                    <select name="category" class="table-search-input" style="width: 100%; background: #0c101d;">
                        <option value="exam">288th Examination Protocol</option>
                        <option value="nen">Nen Calibration Issue</option>
                        <option value="bounty">Blacklist Criminal Report</option>
                        <option value="ai">AI Proctor Technical Inquiry</option>
                    </select>
                </div>
                <div>
                    <label style="font-size: 0.85rem; color: var(--text-muted); font-weight: 700; display: block; margin-bottom: 4px;">ENCRYPTED TRANSMISSION BODY</label>
                    <textarea name="message" rows="4" required placeholder="Enter message text..." class="table-search-input" style="width: 100%; resize: vertical;"></textarea>
                </div>
                <button type="submit" class="btn-hero btn-primary" style="align-self: flex-start; border: none; cursor: pointer;">
                    TRANSMIT DISPATCH ⚡
                </button>
            </form>
        </div>

        <!-- Headquarters Info Card -->
        <div class="portal-card">
            <h3>🏢 Association Headquarters & Bureaus</h3>
            <div style="display: flex; flex-direction: column; gap: 16px; margin-top: 14px;">
                <div style="border-left: 3px solid var(--accent-red); padding-left: 12px;">
                    <strong>Central Headquarters</strong>
                    <p style="font-size: 0.85rem; color: var(--text-muted);">Yorknew Metropolis, 5th Avenue Hunter Tower (Floor 80)</p>
                </div>
                <div style="border-left: 3px solid var(--accent-gold); padding-left: 12px;">
                    <strong>Examination Testing Grounds</strong>
                    <p style="font-size: 0.85rem; color: var(--text-muted);">Zaban City / Milsy Wetlands Underground Sub-station</p>
                </div>
                <div style="border-left: 3px solid var(--accent-cyan); padding-left: 12px;">
                    <strong>Greed Island Liaison Office</strong>
                    <p style="font-size: 0.85rem; color: var(--text-muted);">Joystation JoyPort 102 (Special Hunter Cartridge Unit)</p>
                </div>
                <div style="border-left: 3px solid var(--accent-purple); padding-left: 12px;">
                    <strong>Kakin Empire Diplomatic Mission</strong>
                    <p style="font-size: 0.85rem; color: var(--text-muted);">
                        Kakin Royal Embassy, Yorknew Harbor Terminal (Black Whale Pier 1).
                    </p>
                </div>
            </div>
        </div>
    </div>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
