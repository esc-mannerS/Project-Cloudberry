<?php
session_start();
require_once '../actions/config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: /sagaswap/public/pages/login.php");
    exit;
}

// db connection
$mysqli = new mysqli("localhost", "root", "", "sagaswap");
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// fetch category from db
$categories = [];
$sql = "SELECT id, name FROM categories ORDER BY name ASC";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $categories[] = $row;
    }
}

// prepare and execute query for multiple columns
$user_id = $_SESSION['user_id'];
$stmt = $mysqli->prepare("
    SELECT u.username, u.email, u.created_at, u.id, m.name AS municipality_name
    FROM users u
    LEFT JOIN municipalities m ON u.municipality_id = m.id
    LEFT JOIN listings l ON u.id = l.user_id
    WHERE u.id = ?
");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($username, $email, $created_at, $id, $municipality_name);
$stmt->fetch();
$stmt->close();
$mysqli->close();

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
                            <div class="profile-body">
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
                                            <form action="/sagaswap/public/actions/my-profile/delete-user.php"
                                                method="POST"
                                                onsubmit="return confirm('Er du sikker på, at du vil slette din konto permanent? Dette kan ikke fortrydes!');">
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
        </main>
        <footer>
            <?php include('../includes/footer-footer.php');?>
        </footer>
    </div>
    <script src="../js/script.js"></script>
</body>

</html>