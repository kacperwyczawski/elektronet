<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elektronet</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <a href="index.php" class="logo">Elektronet</a>
        <nav>
            <?php if (isset($_SESSION["username"])): ?>
                <a href="issues.php">Zgłoszenia</a>
                <a href="achievements.php">Osiągnięcia</a>
                <?php if ($_SESSION["role"] === "director"): ?>
                    <a href="administration.php">Administracja</a>
                <?php endif; ?>
            <?php endif; ?>
        </nav>
        <?php if (isset($_SESSION["username"])): ?>
            <div>
                <a href="account.php">
                    <?= $_SESSION["username"] ?>
                </a>
                |
                <a href="logout.php">wyloguj</a>
            </div>
        <?php else: ?>
            <a href="login.php">Logowanie</a>
        <?php endif; ?>
    </header>
    <main>