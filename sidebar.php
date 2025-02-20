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
            <?php if (isset($_SESSION['username'])): ?>
                <span><?= $_SESSION['username'] ?></span>
                <span class="chip green"><?= $_SESSION["role"] ?></span>
            <?php else: ?>
                <span>Elektronet</span>
            <?php endif; ?>
        </div>
        <nav>
            <div>
                <h2>Zgłoszenia</h2>
                <ul>
                    <li><a href="/issues/report.php">Zgłoś probelm</a></li>
                    <li><a href="/issues/your.php">Twoje zgłoszenia</a></li>
                    <li><a href="/issues/all.php">Wszystkie zgłoszenia</a></li>
                    <li><a href="/issues/toapprove.php">Do zatwierdzenia</a></li>
                    <li><a href="/issues/todo.php">Do wykonania</a></li>
                </ul>
            </div>
            <div>
                <h2>Administracja</h2>
                <ul>
                    <li><a href="/administration/accounts.php">Zarządzaj kontami</a></li>
                </ul>
            </div>
            <div>
                <h2>Konto</h2>
                <ul>
                    <li><a href="/account/password.php">Zmień hasło</a></li>
                    <li><a href="/account/logout.php">Wyloguj się</a></li>
                </ul>
            </div>
        </nav>
        <footer>
            &copy; <?= date('Y') ?> ZSE Rzeszów
            <br>
            Wykonał <a href="https://wyczawski.dev">Kacper Wyczawski</a>
        </footer>
    </aside>