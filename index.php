<?php
session_start();
require_once('components/top.php');
?>
<?php if (isset($_SESSION["username"])): ?>
    <h2>Witaj, <?= $_SESSION["first_name"] ?>!</h2>
<?php else: ?>
    <a href="login.php">Zaloguj się</a>. Nie masz konta? Poproś dyrekcję o rejestrację.
<?php endif; ?>
<?php require_once('components/bottom.php'); ?>