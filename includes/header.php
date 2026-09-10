<?php
if (!defined('CHALLENGE_FLAG')) {
    require_once __DIR__ . '/../config.php';
}
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? htmlspecialchars($pageTitle) . ' | ' : ''; ?>Hunter Association Portal (HXH-C8)</title>
    <meta name="description" content="Official Portal of the Hunter Association & 288th Hunter Examination.">
    <!-- Favicon & Icons -->
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>⚔️</text></svg>">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700;900&family=Rajdhani:wght@500;600;700&family=Fira+Code:wght@400;500;700&display=swap" rel="stylesheet">
    <!-- Stylesheet -->
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <!-- Semi-opaque Anime Background Layer -->
    <div class="background-wrapper" id="anime-bg"></div>
    <div class="background-overlay"></div>
    
    <!-- Animated Nen Aura Canvas -->
    <canvas id="nen-canvas"></canvas>

    <div class="app-container">
        <!-- Top Universal Navigation Header -->
        <header class="header-bar">
            <div class="brand-section">
                <a href="/index.php" style="text-decoration: none; display: flex; align-items: center; gap: 14px; color: inherit;">
                    <div class="brand-icon">⚔️</div>
                    <div class="brand-titles">
                        <h1>HUNTER <span class="cross">✕</span> HUNTER <span class="challenge-badge">HXH-C8</span></h1>
                        <p>Hunter Association Official Mainframe</p>
                    </div>
                </a>
            </div>
            
            <nav class="nav-links">
                <a href="/index.php" class="nav-item <?php echo ($currentPage == 'index.php') ? 'active' : ''; ?>">🏠 Home</a>
                <a href="/about.php" class="nav-item <?php echo ($currentPage == 'about.php') ? 'active' : ''; ?>">📖 About Exam</a>
                <a href="/candidates.php" class="nav-item <?php echo ($currentPage == 'candidates.php') ? 'active' : ''; ?>">🏆 Candidates</a>
                <a href="/guidelines.php" class="nav-item <?php echo ($currentPage == 'guidelines.php') ? 'active' : ''; ?>">📜 Bylaws</a>
                <a href="/contact.php" class="nav-item <?php echo ($currentPage == 'contact.php') ? 'active' : ''; ?>">📮 Bureau</a>
            </nav>
        </header>
