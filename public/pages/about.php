<?php
require_once __DIR__ . '/../includes/bootstrap.php';
?>

<!DOCTYPE html>
<html lang="da">

<head>
    <title>Om SagaSwap</title>
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
    <link rel="stylesheet" href="/sagaswap/public/css/about.css" />

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
                            <h1 class="main-text">Om SagaSwap</h1>
                            <h2 class="main-text">Danmarks enkle markedsplads</h2>
                        </div>
                        <div class="body-content">
                            <div class="main-body-text">
                                <p class="body-text TopBottom">
                                    SagaSwap er Danmarks nye online markedsplads for secondhand varer, bygget på en
                                    kerne af open source.
                                    Idéen opstod i november 2024 med et ønske om at skabe en platform,
                                    der giver både købere og sælgere maksimal frihed.
                                    Frihed til at handle brugt uden besvær og frihed til at bruge, forbedre og forstå
                                    den teknologi, der ligger bag.
                                </p>
                                <p class="body-text">
                                    Grunden til at vi har valgt at bygge platformens kerne som open source, er fordi
                                    genbrug og digitale fællesskaber trives bedst, når de er åbne og frie.<br />
                                    Når teknologien er tilgængelig for alle, kan brugerene og udviklere være med til at
                                    forme platformen og sikre, at den forbliver enkel, transparent og fremtidssikker.
                                    På samme måde giver genbrug mennesker frihed til at vælge smartere og mere
                                    bæredygtigt i stedet for altid at købe nyt.
                                </p>
                                <p class="body-text">
                                    Brugervenlighed og klarhed er centrum for oplevelsen. Vi automatiserer alt det, der
                                    ellers tager tid, og gør søgningen så præcis som muligt. Derfor
                                    automatiserer vi så meget som muligt, reducerer antallet af
                                    valg og gør søgningen enkel men ekstrem præcis.<br /> Når
                                    produkter samles efter specifikke data som ISBN-nummer
                                    (International Standard Book Number), modeller eller
                                    varianter, får både købere og sælgere en langt mere effektiv
                                    oplevelse.<br />Du slipper for at scrolle gennem uendelige,
                                    tilfældige annoncer: alt er samlet, sorteret og
                                    organiseret.<br />
                                    Vi tror på, at når genbrug bliver nemmere end at købe nyt,
                                    så vælger flere det.<br />Og dét er præcis visionen bag
                                    SagaSwap: at gøre bæredygtige valg til de oplagte valg.
                                </p>
                                <p class="body-text TopBottom">
                                    Vores mål er at gøre genbrug mere tilgængeligt og mere attraktivt. Derfor bygger
                                    SagaSwap på et system, hvor produkter automatisk samles og organiseres, efterhånden
                                    som brugerne opretter dem. <br />Det gør det hurtigt at lægge en vare til salg og
                                    endnu
                                    lettere for andre at finde den.<br />
                                    Hvis du for eksempel vil sælge en bog, indtaster du blot ISBN nummeret, tager to
                                    billeder og sætter en pris. Når du gør det, bliver bogen automatisk placeret sammen
                                    med andre udgaver af den samme titel. Det betyder, at købere nemt kan søge efter
                                    titel eller ISBN og få et tydeligt overblik over alle tilgængelige eksemplarer,
                                    uden at skulle finde rundt i et hav af tilfældige annoncer.
                                </p>
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