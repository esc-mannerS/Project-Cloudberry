<?php

$errors = [
    'login' => $_SESSION['login_error'] ?? '',
    'register' => $_SESSION['register_error'] ?? ''
];
$activeForm = $_SESSION['active_form'] ?? 'login';

session_unset();

function showError($error) {
    return !empty($error) ? "<p class='error-message'>$error</p>" : '';
}

function isActiveForm($formName, $activeForm) {
    return $formName === $activeForm ? 'active' : '';
}

?>

<!DOCTYPE html>
<html lang="da">
  <head>
    <title>Log ind</title>
    <link rel="icon" href="sagaswap-icon.ico" />
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="SagaSwap" />
    <meta name="keywords" content="SagaSwap, The Vaduz Network" />
    <meta name="author" content="esc-mannerS" />
    <meta
      http-equiv="Content-Security-Policy"
      content="
      default-src 'self'; 
      style-src 'self' 'unsafe-inline'; 
      script-src 'self';
      font-src 'self';"
    />
    <link rel="stylesheet" href="styles.css" />
    <link rel="stylesheet" href="login.css" />
  </head>
  <body>
    <div id="container">
      <header>
        <?php include('include/header-header.php');?>
      </header>
      <main>
        <div class="main-main">
          <div class="content-container">
            <div class="main-content">
              <div class="head-content">
                <h1 class="main-text">Velkommen til SagaSwap</h1>
                <h2 class="main-text">Log ind for at komme igang</h2>
              </div>
              <div class="body-content">
                <div class="login-container <?= isActiveForm('login', $activeForm); ?>" id="login-form">
                  <form action="login-register.php" method="post">
                    <div class="login-field">
                      <h3>Log ind</h3>
                      <?= showError($errors['login']); ?>
                    </div>
                    <div class="login-field">
                      <label>E-mailadresse</label>
                      <input
                        type="email"
                        name="email"
                        placeholder="E-mailadresse"
                        required
                      />
                    </div>
                    <div class="login-field">
                      <label>Adgangskode</label>
                      <input
                        type="password"
                        name="password"
                        placeholder="Adgangskode"
                        required
                      />
                      <label><a href="">Glemt din adgangskode?</a></label>
                    </div>
                    <div class="login-field">
                      <button type="submit" name="login">Log ind</button>
                    </div>
                    <div class="login-field BottomText">
                      <p>
                        Ikke bruger endnu?
                        <a href="#" data-toggle-form="register-form"
                          >Opret bruger</a
                        >
                      </p>
                    </div>
                  </form>
                </div>
                <div class="login-container <?= isActiveForm('register', $activeForm); ?>" id="register-form">
                  <form action="login-register.php" method="post">
                    <div class="login-field">
                      <h3>Opret bruger</h3>
                      <?= showError($errors['register']); ?>
                    </div>
                    <div class="login-field">
                      <label>Brugernavn</label>
                      <input
                        type="text"
                        name="username"
                        placeholder="Brugernavn"
                        required
                      />
                    </div>
                    <div class="login-field">
                      <label>E-mailadresse</label>
                      <input
                        type="email"
                        name="email"
                        placeholder="E-mailadresse"
                        required
                      />
                    </div>
                    <div class="login-field">
                      <label>Adgangskode</label>
                      <input
                        type="password"
                        name="password"
                        placeholder="Adgangskode"
                        required
                      />
                    </div>
                    <div class="login-field RegisterButton">
                      <button type="submit" name="register">Opret bruger</button>
                    </div>
                    <div class="login-field BottomText">
                      <p>
                        Allerede bruger?
                        <a href="#" data-toggle-form="login-form">Log ind</a>
                      </p>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <?php include('include/main-header-menu.php');?>
          </div>
        </div>
      </main>
      <footer>
        <?php include('include/footer-footer.php');?>
      </footer>
    </div>
    <script src="script.js"></script>
  </body>
</html>
