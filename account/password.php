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
        Zmień hasło do swojego konta
    </h1>
    <p>
        Hasło powinno składać się z co najmniej 12 znaków.
    </p>
    <form method="post">
        <label for="password">Nowe hasło:</label>
        <input type="password" id="password" name="password" required>
        <label for="confirm_password">Powtórz nowe hasło:</label>
        <input type="password" id="confirm_password" name="confirm_password" required>
        <button type="submit" name="submit">Zmień hasło</button>
    </form>
    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        if ($password !== $confirm_password) {
            echo "<p class='error'>Podane hasła nie są takie same.</p>";
        } elseif (strlen($password) < 12) {
            echo "<p class='error'>Podane hasło jest za krótkie.</p>";
        } else {
            require("../db.php");
            $stmt = $db->prepare("update users set password = ? where username = ?");
            $stmt->execute([password_hash($password, PASSWORD_DEFAULT), $_SESSION['username']]);
            echo "<p  class='success'>Hasło zostało zmienione.</p>";
        }
    }
    ?>
</main>