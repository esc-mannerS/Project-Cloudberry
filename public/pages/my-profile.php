<?php
require_once __DIR__ . '/../includes/bootstrap.php';
require_once __DIR__ . '/../actions/my-profile/my-profile-logic.php';
?>

<!DOCTYPE html>
<html lang="da">

<head>
    <title>Brugerprofil</title>
    <link rel="icon" href="/sagaswap/public/images/sagaswap-icon.ico" />
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="SagaSwap Danmarks Open Source Marketplads" />
    <meta name="keywords" content="SagaSwap, Marketplace, Open Source" />
    <meta name="author" content="esc-mannerS" />
    <meta http-equiv="Content-Security-Policy" content="
        default-src 'self';
        script-src 'self';
        style-src 'self';
        font-src 'self';
        img-src 'self' blob: data:;
    ">
    <link rel="stylesheet" href="/sagaswap/public/css/styles.css" />
    <link rel="stylesheet" href="/sagaswap/public/css/my-profile.css" />
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
                            <h1 class="main-text">Min profil</h1>
                            <h2 class="main-text"><?php echo "Velkommen til ".htmlspecialchars($username);?></h2>
                        </div>
                        <div class="body-content">
                            <div class="profile-head">
                                <h3>Ny annonce</h3>
                            </div>
                            <div class="profile-body" id="new-listing">
                                <div class="new-listing">
                                    <form action="../actions/my-profile/new-listing.php" method="post"
                                        enctype="multipart/form-data">
                                        <div class="listing-column first">
                                            <div class="listing-field">
                                                <label>Kategori</label>
                                                <div class="custom-select" id="custom-category">
                                                    <div class="selected">Kategori</div>
                                                    <div class="options">
                                                        <?php foreach ($categories as $category): ?>
                                                        <div class="option" data-value="<?= $category['id'] ?>">
                                                            <?= htmlspecialchars($category['name']) ?>
                                                        </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                    <input type="hidden" name="category_id" id="category_id" required>
                                                </div>
                                            </div>
                                            <div class="fields-after-category">
                                                <div class="listing-field">
                                                    <label>ISBN</label>
                                                    <input type="text" name="isbn" id="isbn" placeholder="Indsæt ISBN"
                                                        required></input>
                                                </div>
                                                <div class="listing-field">
                                                    <label>Title</label>
                                                    <input type="text" name="title" id="title" placeholder="Title"
                                                        readonly></input>
                                                </div>
                                                <div class="listing-field">
                                                    <label>Forfatter</label>
                                                    <input type="text" name="author" id="author" placeholder="Forfatter"
                                                        readonly></input>
                                                    <input type="hidden" name="book_id" id="book_id">
                                                </div>
                                                <div class="listing-field BottomText">
                                                    <p>Er title eller forfatter forkert? <a
                                                            href="mailto:info@sagaswap.dk">Send
                                                            os en mail.</a>
                                                    </p>
                                                </div>
                                                <div class="listing-field">
                                                    <label>Pris</label>
                                                    <input type="text" name="price" id="price"
                                                        placeholder="Skriv din pris" required></input>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="listing-column">
                                            <div class="fields-after-category">
                                                <div class="listing-field image">
                                                    <label>Billeder</label>
                                                    <input type="file" id="imageInput" accept="image/*" hidden multiple>
                                                    <input type="file" id="realImages" name="images[]" hidden multiple
                                                        required>
                                                    <div class="images-container">
                                                        <div id="customUploadBox" class="custom-upload-box">
                                                            Upload 2 billeder: forsiden og bagsiden
                                                        </div>
                                                        <div id="imagePreview" class="image-preview"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="listing-column button fields-after-category">
                                            <div class="listing-field">
                                                <button type="submit" name="list">Opret annonce</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="body-content">
                            <div class="profile-head">
                                <h3>Mine annoncer</h3>
                            </div>
                            <div class="profile-body" id="user-listings">
                                <?php if (empty($listings)): ?>
                                <p>Ingen annoncer endnu...</p>
                                <?php endif; ?>
                                <?php foreach ($listings as $id => $listing): ?>
                                <div class="listed-group">
                                    <div class="image-group">
                                        <?php foreach ($listing['images'] as $image): ?>
                                        <img class="listed-image"
                                            src="/sagaswap/public/user-uploads/listings/<?= htmlspecialchars($image) ?>">
                                        <?php endforeach; ?>
                                    </div>
                                    <div class="text-group">
                                        <div class="listed-text">
                                            <p class="listed-head">Title</p>
                                            <p class="listed-body"><?= htmlspecialchars($listing['title']) ?></p>
                                        </div>
                                        <div class="listed-text">
                                            <p class="listed-head">ISBN</p>
                                            <p class="listed-body"><?= htmlspecialchars($listing['isbn']) ?></p>
                                        </div>
                                        <div class="listed-text">
                                            <p class="listed-head">Pris</p>
                                            <p class="listed-body"><?= htmlspecialchars($listing['price']) ?>
                                                <?= htmlspecialchars($listing['currency']) ?></p>
                                        </div>
                                        <div class="listed-text">
                                            <p class="listed-head">Status</p>
                                            <p class="listed-body">
                                                <?= htmlspecialchars (t('status.' . $listing['status'])) ?></p>
                                        </div>
                                        <div class="listed-text DeleteButton">
                                            <form class="confirm-delete"
                                                action="/sagaswap/public/actions/my-profile/delete-listing.php"
                                                method="POST">
                                                <input type="hidden" name="listing_id"
                                                    value="<?php echo htmlspecialchars($id); ?>">
                                                <button type="submit" class="delete-listing">
                                                    <span>Slet annonce!</span>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="body-content">
                            <div class="profile-head">
                                <h3>Mine handler</h3>
                            </div>
                            <div class="profile-body">
                            </div>
                        </div>
                        <div class="body-content">
                            <div class="profile-head">
                                <h3>Profil indstillinger</h3>
                            </div>
                            <div class="profile-body" id="user-profile">
                                <div class="user-profile">
                                    <div class="profile-body-group">
                                        <div class="profile-body-column">
                                            <p>Brugernavn:</p>
                                            <p>E-mailadresse:</p>
                                            <p>Kommune:</P>
                                        </div>
                                        <div class="profile-body-column">
                                            <p><?php echo htmlspecialchars($username); ?></p>
                                            <p><?php echo htmlspecialchars($email); ?></p>
                                            <p><?php echo htmlspecialchars($municipality_name); ?></p>
                                        </div>
                                    </div>
                                    <div class="profile-body-group three">
                                        <div class="dead-user-info info">
                                            <div class="profile-body-column">
                                                <p>Bruger id:</p>
                                                <p>Bruger oprettet:</P>
                                            </div>
                                            <div class="profile-body-column">
                                                <p><?php echo htmlspecialchars($id); ?></p>
                                                <p><?php echo date("d m Y", strtotime(htmlspecialchars($created_at))); ?>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="dead-user-info delete">
                                            <form class="confirm-delete"
                                                action="/sagaswap/public/actions/my-profile/delete-user.php"
                                                method="POST">
                                                <input type="hidden" name="user_id"
                                                    value="<?php echo htmlspecialchars($id); ?>">
                                                <button type="submit" class="delete-user">
                                                    <span>Slet min bruger og alt data!</span>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php include('../includes/main-header-menu.php');?>
                </div>
            </div>
            <div class="delete-popup hidden" id="confirmModal" role="dialog" aria-modal="true">
                <div class="delete-popup-backdrop"></div>
                <div class="delete-popup-box">
                    <h2>Bekræft sletning</h2>
                    <p>Er du sikker på, at du vil slette? Dette kan ikke fortrydes!</p>
                    <div class="delete-popup-actions">
                        <button id="confirmCancel">
                            <span>Annuller</span>
                        </button>
                        <button id="confirmOk" class="deletion">
                            <span>Slet</span>
                        </button>
                    </div>
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