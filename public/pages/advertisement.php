<?php
require_once __DIR__ . '/../includes/bootstrap.php';
?>

<!DOCTYPE html>
<html lang="da">

<head>
    <title>Erhvervs annoncering</title>
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
    <link rel="stylesheet" href="/sagaswap/public/css/advertisement.css" />
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
                            <h1 class="main-text">Erhvervs annoncering</h1>
                            <h2 class="main-text">
                                Læs om mulighederne for annoncering på platformen
                            </h2>
                        </div>
                        <div class="body-content">
                            <div class="advert-container">
                                <div class="advert-group-text first">
                                    <p class="group-text TopBottom">
                                        Annoncer og reklamer er overalt: på gaden, i postkassen og ikke mindst på
                                        internettet. Vi kender det alle og folket er begyndt at blive mætte.</br>
                                        Derfor har vi valgt at gøre tingene lidt anderledes.
                                    </P>
                                    <p class="group-text">
                                        Brugeroplevelse er i centrum for platformen. Derfor har vi gjort annoncering til
                                        en
                                        integreret del af platformen.</br>
                                        Det betyder, at vi har sagt farvel til
                                        traditionelle annonceformer som bannerannoncer og programmatiske løsninger.</br>
                                        I stedet tilbyder vi målrettede og specialiserede annonceringsmuligheder på
                                        produktsiderne. Her kommer muligheden for at fremhæve jeres produkt øverst på
                                        siden,
                                        præcis der, hvor det bliver set først og efterfulgt af de brugeroprettede
                                        annoncer.
                                    </p>
                                    <p class="group-text TopBottom">
                                        Kort sagt: Bedre kvalitet, mindre støj og en bedre oplevelse for alle.
                                    </p>
                                </div>
                                <div class="advert-group-image">
                                </div>
                            </div>
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