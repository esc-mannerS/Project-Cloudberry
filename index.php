<!DOCTYPE html>
<html lang="da">

<head>
    <title>SagaSwap</title>
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
    <link rel="stylesheet" href="index.css" />
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
                            <h1 class="main-text">SagaSwap</h1>
                            <h2 class="main-text">Danmarks enkle markedsplads</h2>
                            <div class="main-category">
                                <ul>
                                    <li>
                                        <a href="">
                                            <div>
                                                <img src="main-category/main-category-lps.jpg" class="category-image" />
                                                <p class="category-text">Lp'er</p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="">
                                            <div>
                                                <img src="main-category/main-category-books.jpg"
                                                    class="category-image" />
                                                <p class="category-text">Bøger</p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="">
                                            <div>
                                                <img src="main-category/main-category-video-games.jpg"
                                                    class="category-image" />
                                                <p class="category-text">Video spil</p>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="body-content">
                            <h3 class="gallery-head">Populære annonce sider</h3>
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