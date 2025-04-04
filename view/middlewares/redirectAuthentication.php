<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['userID'])) {
    header("Location: ?page=''");// redirect to home page
    exit();
}

