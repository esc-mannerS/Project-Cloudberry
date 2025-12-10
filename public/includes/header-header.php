<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<div class="header-header">
    <a href="../pages/index.php" class="header-logo">SagaSwap</a>
    <div class="header-actions">
        <div>
            <?php if (isset($_SESSION['user_id'])): ?>
            <!-- user logged in -->
            <a class="header-actions-2" href="../pages/header-logout.php">
                <span class="action-text">Log ud</span>
                <img src="/sagaswap/public/includes/header-actions/login.png" height="27" width="27" alt="logout" />
            </a>
            <?php else: ?>
            <!-- not logged in -->
            <a class="header-actions-2" href="../pages/login.php">
                <span class="action-text">Log ind</span>
                <img src="/sagaswap/public/includes/header-actions/login.png" height="27" width="27" alt="login" />
            </a>
            <?php endif; ?>
            <a class="header-actions-2" id="menuToggle" href="../js/javascript:void(0)" aria-haspopup="true"
                aria-expanded="false">
                <span class="action-text">Menu</span>
                <img id="menuIcon" src="/sagaswap/public/includes/header-actions/menu.png"
                    data-closed-src="/sagaswap/public/includes/header-actions/menu.png"
                    data-open-src="/sagaswap/public/includes/header-actions/menu-close.png" height="27" width="27"
                    alt="menu icon" />
            </a>
        </div>
    </div>
</div>