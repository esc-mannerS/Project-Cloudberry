<!DOCTYPE html>
<html lang="da">

<head>
    <title>Brugervilkår</title>
    <link rel="icon" href="sagaswap-icon.ico" />
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="SagaSwap Danmarks Open Source Marketplads" />
    <meta name="keywords" content="SagaSwap, Marketplace, Open Source" />
    <meta name="author" content="esc-mannerS" />
    <meta http-equiv="Content-Security-Policy" content="
      default-src 'self'; 
      style-src 'self'; 
      script-src 'self';
      font-src 'self';" />
    <link rel="stylesheet" href="styles.css" />
    <link rel="stylesheet" href="fqa.css" />
</head>

<body>
    <div id="container">
        <header>
            <?php include('includes/header-header.php');?>
        </header>
        <main>
            <div class="main-main">
                <div class="content-container">
                    <div class="main-content">
                        <div class="head-content">
                            <h1 class="main-text">Ofte stillede spørgsmål</h1>
                            <h2 class="main-text">
                                Se svar på spørgsmålende ved at klikke på dem
                            </h2>
                        </div>
                        <div class="body-content">
                            <div class="panel-panel">
                                <div class="panel-group">
                                    <div class="panel-head">
                                        <h3>Hvad er SagaSwap</h3>
                                    </div>
                                    <div class="panel-body">
                                        <p>SagaSwap er Danmarks nye markedsplads</p>
                                        <p>
                                            Vi har fokuseret på at lave en brugervenlig og enkel
                                            platform. Som understøtter køb og sælgers behov, når det
                                            gælder handel med genbrugsvare.
                                        </p>
                                        <p>
                                            Platformens kerne er bygget på open source, det vil sige at du på Github
                                            kan hente en kolon og bygge videre på platformen indenfor licensens
                                            rammer.<br />
                                            Hvis
                                            du har inpiration, feedback, fejl eller andet, er
                                            du mere end velkommen til at kontakte os, gennem en af
                                            nedenstående kanaler.
                                        </p>
                                        <div class="panel-contact">
                                            <a href="https://x.com"><img src="includes/images/x-logo.svg"
                                                    class="navigation-some" /></a>
                                            <a href="https://github.com/esc-mannerS/SagaSwap"><img
                                                    src="includes/images/github-logo.svg" class="navigation-some" /></a>
                                        </div>
                                        <div class="panel-contact">
                                            <p>
                                                <a href="mailto:info@sagaswap.dk">info@sagaswap.dk</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-group">
                                    <div class="panel-head">
                                        <h3>Hvor finder jeg alle annoncer/kategorier?</h3>
                                    </div>
                                    <div class="panel-body">
                                        <p>
                                            Under menuen som ligger oppe i højre hjørne vil du kunne
                                            finde alle tilgængelige kategorier.
                                        </p>
                                    </div>
                                </div>
                                <div class="panel-group">
                                    <div class="panel-head">
                                        <h3>Hvordan opretter jeg en bruger?</h3>
                                    </div>
                                    <div class="panel-body">
                                        <p>
                                            Oppe i højre hjørne kan du se "Log ind".<br />Klik her og du
                                            kommer ind til log ind siden.<br />Lige under "Log ind" knappen kan du
                                            klikke på "Opret Bruger" . </p>
                                        <p>
                                            Når du har udfyldt informationerne, skal du klikke på
                                            "Opret bruger" og du vil få en email med engangskode til
                                            at verificere din bruger.
                                        </p>
                                    </div>
                                </div>
                                <div class="panel-group">
                                    <div class="panel-head">
                                        <h3>Skal man have en bruger for at se annoncer?</h3>
                                    </div>
                                    <div class="panel-body">
                                        <p>
                                            Nej, du skal kun bruge en bruger når du vil købe eller
                                            sælge.
                                        </p>
                                    </div>
                                </div>
                                <div class="panel-group">
                                    <div class="panel-head">
                                        <h3>Hvordan foregår betalingen?</h3>
                                    </div>
                                    <div class="panel-body">
                                        <p>
                                            For at sikre en hurtigt og problemfri handle, vil
                                            betalingen foregår gennem SagaSwap.
                                        </p>
                                        <p>
                                            Når køber er klar til at købe produktet vil der skulle
                                            betales med MobilePay/Vipps.
                                        </p>
                                        <p>
                                            Når køber har modtaget og kontrolleret produktet fra
                                            sælger, skal man under "Mine handler" og klikke på "Modtaget
                                            og godkendt".
                                        </p>
                                        <p>
                                            Derefter vil sælger modtage beløbet (fratrukket et
                                            servicegebyr på 5%) på MobilePay/Vipps, og annonce vil
                                            blive deaktiveret og arkiveret under "Arkiveret
                                            annoncer".
                                        </p>
                                    </div>
                                </div>
                                <div class="panel-group">
                                    <div class="panel-head">
                                        <h3>Hvad skal jeg gør hvis jeg vil returnere en vare?</h3>
                                    </div>
                                    <div class="panel-body">
                                        <p>
                                            Foreløbigt vil man skulle aftale dette mellem køb og
                                            sælger, da vi endnu ikke tilbyder denne service.
                                        </p>
                                        <br />
                                        <i>
                                            Bemærk at SagaSwap udelukkende facilitere køb og salg
                                            mellem private, og kan dermed ikke garantere returret.
                                        </i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php include('includes/main-header-menu.php');?>
                </div>
            </div>
        </main>
        <footer>
            <?php include('includes/footer-footer.php');?>
        </footer>
    </div>
    <script src="script.js"></script>
</body>

</html>