<?php
require_once __DIR__ . '/../actions/books/listings/listings-logic.php';
?>

<!DOCTYPE html>
<html lang="da">

<head>
    <title>Annoncer</title>
    <link rel="icon" href="/sagaswap/public/images/sagaswap-icon.ico" />
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="SagaSwap Danmarks Open Source Marketplads" />
    <meta name="keywords" content="SagaSwap, Marketplace, Open Source" />
    <meta name="author" content="esc-mannerS" />
    <meta http-equiv="Content-Security-Policy" content="
        default-src 'self'; 
        style-src 'self'; 
        script-src 'self';
        font-src 'self';
        img-src 'self';" />
    <link rel="stylesheet" href="/sagaswap/public/css/styles.css" />
    <link rel="stylesheet" href="/sagaswap/public/css/books-listings.css" />
</head>

<body>
    <div id="container">
        <header>
            <?php include('../includes/header-header.php');?>
        </header>
        <main>
            <div class="main-main">
                <div class="content-container">
                    <div class="main-content">
                        <div class="head-content">
                            <h1 class="main-text"><?= htmlspecialchars($book['title']) ?></h1>
                            <h2 class="main-text">
                                Annoncer for denne bog
                            </h2>
                        </div>
                        <div class="body-content">
                            <?php if (empty($listings)): ?>
                            <p>Ingen annoncer fundet.</p>
                            <?php else: ?>
                            <?php foreach ($listings as $listing): ?>
                            <div class="listed-group">
                                <div class="image-group">
                                    <?php foreach ($listing['images'] as $image): ?>
                                    <img class="listed-image"
                                        src="/sagaswap/public/user-uploads/listings/<?= htmlspecialchars($image) ?>">
                                    <?php endforeach; ?>
                                </div>
                                <div class="text-group">
                                    <div class="listed-text">
                                        <p class="listed-head">Pris</p>
                                        <p class="listed-body">
                                            <?= number_format((float)$listing['price'], 2, ',', '.') ?> kr.
                                        </p>
                                    </div>

                                    <div class="listed-text">
                                        <p class="listed-head">Oprettet</p>
                                        <p class="listed-body">
                                            <?= date('d m Y', strtotime($listing['created_at'])) ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php include('../includes/main-header-menu.php');?>
                </div>
            </div>
        </main>
        <footer>
            <?php include('../includes/footer-footer.php');?>
        </footer>
    </div>
    <script src="/sagaswap/public/js/script.js"></script>
</body>

</html>