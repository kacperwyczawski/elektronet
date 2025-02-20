<?php
session_start();
require_once('sidebar.php');
?>
<main>
    <?php if (isset($_SESSION["username"])): ?>
        <h1 class="index">Dzień dobry, <?= $_SESSION["first_name"] ?>!</h1>
    <?php else: ?>
        <h1 class="index">
            Witaj! <a href="/login.php">Zaloguj się</a>.
        </h1>
    <?php endif; ?>
</main>