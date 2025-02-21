<?php
session_start();
$error = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    require("db.php");
    $stmt = $db->prepare("select * from users where username = ?");
    $stmt->execute([$username]);
    $row = $stmt->fetch();
    if (!$row) {
        $error = "Niepoprawna nazwa użytkownika";
    } else if (!password_verify($password, $row["password"])) {
        $error = "Niepoprawne hasło";
    } else {
        $_SESSION["user_id"] = $row["user_id"];
        $_SESSION["first_name"] = $row["first_name"];
        $_SESSION["username"] = $username;
        $_SESSION["role"] = $row["role"];
        header("Location: /");
    }
}
require_once("sidebar.php");
?>

<main>
    <h1>
        Zaloguj się
    </h1>
    <?= $error ?>
    <form method="POST">
        <label for="username">Nazwa użytkownika:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">Hasło:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <input type="submit" value="Zaloguj się">
    </form>
</main>