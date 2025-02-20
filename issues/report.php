<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: /denied.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require "../db.php";
    $stmt = $db->prepare("insert into issues (room, description) values (?, ?, ?)");
    $stmt->execute([ $_POST["room"], $_POST["description"]]);
    header("Location: /issues/your.php");
    exit();
}

require "../sidebar.php";
?>
<main>
    <h1>Zgłoś problem</h1>
    <form method="post">
        <label for="room">Sala:</label>
        <input type="text" name="room" id="room" required>
        <label for="description">Opis:</label>
        <textarea name="description" id="description" rows="10" required></textarea>
        <button type="submit">Zgłoś problem</button>
    </form>
</main>