<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit();
}

require_once("../sidebar.php");
?>
<main>
    <h1>
        Zmień hasło
    </h1>
    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        if ($password !== $confirm_password) {
            echo "<p>Podane hasła nie są takie same.</p>";
        } else {
            require("../db.php");
            $stmt = $db->prepare("update users set password = ? where username = ?");
            $stmt->execute([password_hash($password, PASSWORD_DEFAULT), $_SESSION['username']]);
            echo "<p>Hasło zostało zmienione.</p>";
        }
    }
    ?>
    <form method="post">
        <label>
            Nowe hasło:
            <input type="password" name="password" required>
        </label>
        <br>
        <label>
            Powtórz nowe hasło:
            <input type="password" name="confirm_password" required>
        </label>
        <br>
        <button type="submit" name="submit">Zmień hasło</button>
    </form>
</main>