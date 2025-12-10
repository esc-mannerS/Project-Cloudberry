<?php
session_start();

// destroys the session for log out
session_unset();
session_destroy();

// saves the url from page logout
$redirectUrl = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/sagaswap/public/pages/index.php';

// redirect to the url or index
header('Location: ' . $redirectUrl);
exit;
?>