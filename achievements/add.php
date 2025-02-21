<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: /denied.php");
    exit();
}

require "../db.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $first_name = $_POST["first_name"];
    $last_name  = $_POST["last_name"];
    $school_id  = $_POST["school_id"];

    $stmt = $db->prepare("select student_id from students where school_id = ?");
    $stmt->execute([$school_id]);
    $existingStudent = $stmt->fetch();

    if ($existingStudent) {
        $message = "<p class='error'>Uczeń o numerze legitymacji $school_id już istnieje.</p>";
    } else {
        $stmt = $db->prepare("insert into students (first_name, last_name, school_id, created_at) values (?, ?, ?, datetime('now'))");
        if ($stmt->execute([$first_name, $last_name, $school_id])) {
            $message = "<p class='success'>Uczeń został utworzony.</p>";
        } else {
            $message = "<p class='error'>Wystąpił błąd przy tworzeniu ucznia.</p>";
        }
    }
}

require "../sidebar.php";
?>
<main>
    <h1>dodaj ucznia</h1>
    <form method="post" action="add.php">
        <label for="first_name">imię:</label>
        <input type="text" id="first_name" name="first_name" required>
        <label for="last_name">nazwisko:</label>
        <input type="text" id="last_name" name="last_name" required>
        <label for="school_id">numer legitymacji:</label>
        <input type="text" id="school_id" name="school_id" required>
        <input type="submit" value="Dodaj ucznia">
    </form>
    <?php
    echo $message;
    ?>
</main>