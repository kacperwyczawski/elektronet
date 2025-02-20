<?php
session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'director') {
    header('Location: index.php');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $db = new PDO('sqlite:elektronet.db');
    $stmt = $db->prepare("insert into users (
        first_name,
        last_name,
        username,
        password,
        role
    ) values (?, ?, ?, ?, ?)");
    $stmt->execute([$first_name, $last_name, $username, password_hash($password, PASSWORD_DEFAULT), $role]);
}

require_once('components/top.php');
?>
<h2>Dodaj pracownika</h2>
<form method="post" action="">
    <label for="first_name">Imię:</label>
    <input type="text" id="first_name" name="first_name" required><br>
    <label for="last_name">Nazwisko:</label>
    <input type="text" id="last_name" name="last_name" required><br>
    <label for="username">Nazwa użytkownika:</label>
    <input type="text" id="username" name="username" required><br>
    <label for="password">Hasło:</label>
    <input type="password" id="password" name="password" required><br>
    <label for="role">Rola:</label>
    <select id="role" name="role" required>
        <option value="employee">Pracownik</option>
        <option value="supervisor">Kierownik</option>
        <option value="executor">Wykonawca</option>
        <option value="director">Dyrektor</option>
    </select><br>
    <button type="submit" name="submit">Dodaj pracownika</button>
</form>
<script type="module">
    const firstName = document.getElementById("first_name");
    const lastName = document.getElementById("last_name");
    const username = document.getElementById("username");

    function generateUsername() {
        let s = (firstName.value[0] ?? "") + lastName.value;
        username.value = s
            .toLowerCase()
            .replace("ą", "a")
            .replace("ć", "c")
            .replace("ę", "e")
            .replace("ł", "l")
            .replace("ń", "n")
            .replace("ó", "o")
            .replace("ś", "s")
            .replace("ż", "z")
            .replace("ź", "z")
            .replace(/[^a-z]/g, "");
    }

    firstName.addEventListener("input", generateUsername);
    lastName.addEventListener("input", generateUsername);
</script>