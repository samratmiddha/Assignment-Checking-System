<?php
session_start();
if (isset($_COOKIE['tag'])) {
    unset($_COOKIE['tag']);
    setcookie('tag', '', time() -3600, '/'); 
}
session_unset();
session_destroy();

header('Location: ../frontend/login_page.php');

?>