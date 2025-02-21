<?php
$currentPath = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

$navSections = [
    "Zgłoszenia" => [
        "Zgłoś problem" => "/issues/report.php",
        "Twoje zgłoszenia" => "/issues/your.php",
        "Wszystkie zgłoszenia" => "/issues/all.php",
        "Do zatwierdzenia" => "/issues/toapprove.php",
        "Do wykonania" => "/issues/todo.php",
    ],
    "Administracja" => [
        "Zarządzaj kontami" => "/administration/accounts.php",
    ],
    "Konto" => [
        "Zmień hasło" => "/account/password.php",
        "Wyloguj się" => "/account/logout.php",
    ]
];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elektronet</title>
    <link rel="stylesheet" href="/style.css">
    <meta name="theme-color" content="#d4293d" />
</head>

<body>
    <aside>
        <div class="logo">
            <?php if (isset($_SESSION["username"])): ?>
                <span><?= $_SESSION["username"] ?></span>
                <span class="chip green"><?= $_SESSION["role"] ?></span>
            <?php else: ?>
                <img src="/images/logo.svg" alt="logo">
            <?php endif; ?>
        </div>
        <nav>
            <?php foreach ($navSections as $sectionName => $links): ?>
                <div>
                    <h2><?= $sectionName ?></h2>
                    <ul>
                        <?php
                        foreach ($links as $title => $url) {
                            $activeClass = ($currentPath === $url) ? " class='active'" : "";
                            echo "<li><a href=\"$url\"$activeClass>$title</a></li>";
                        }
                        ?>
                    </ul>
                </div>
            <?php endforeach; ?>
        </nav>
        <footer>
            &copy; <?= date("Y") ?> ZSE Rzeszów
            <br>
            Wykonał <a href="/wyczawski.dev">Kacper Wyczawski</a>
        </footer>
    </aside>