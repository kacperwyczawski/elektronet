<?php
session_start();
$db = new PDO("sqlite:elektronet.db");
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $stmt = $db->prepare("SELECT * FROM users WHERE username = ?");
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
        header("Location: index.php");
    }
}
require_once("components/top.php");
?>
<h2>Login</h2>
<?php if (!empty($error)): ?>
    <p style="color:red;"><?php echo htmlspecialchars($error); ?></p>
<?php endif; ?>
<form method="POST" action="">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required>
    <br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
    <br>
    <input type="submit" value="Login">
</form>
<?php require_once("components/bottom.php"); ?>