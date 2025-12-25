<!DOCTYPE html>
<html lang="da">

<head>
    <title>Bøger</title>
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
    <link rel="stylesheet" href="/sagaswap/public/css/books.css" />
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
                            <h1 class="main-text">Bøger</h1>
                            <h2 class="main-text">
                                Herunder finder du alle bøger til salg
                            </h2>
                        </div>
                        <div class="body-content">
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