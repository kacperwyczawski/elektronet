<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: /denied.php");
    exit();
}

require "../db.php";

if (!isset($_GET["student_id"])) {
    echo "Nie podano identyfikatora ucznia.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["add_achievement"])) {
        $stmt = $db->prepare("insert into achievements (student_id, name, result, achieved_at, created_at) values (?, ?, ?, ?, datetime('now'))");
        $stmt->execute([$_POST["student_id"], $_POST["name"], $_POST["result"], $_POST["achieved_at"]]);
    }
}

$stmt = $db->prepare("select * from students where student_id = ?");
$stmt->execute([$_GET["student_id"]]);
$student = $stmt->fetch();

$stmt = $db->prepare("select * from achievements where student_id = ? order by achieved_at desc");
$stmt->execute([$_GET["student_id"]]);
$achievements = $stmt->fetchAll();

require "../sidebar.php";
?>
<main>
    <h1>Osiągnięcia ucznia: <?= $student["first_name"] ?> <?= $student["last_name"] ?> [<?= $student["school_id"] ?>]</h1>
    <form method="post">
        <input type="hidden" name="student_id" value="<?= $student["student_id"] ?>">
        <label for="name">Nazwa osiągnięcia:</label>
        <input type="text" id="name" name="name" required>
        <label for="result">Wynik:</label>
        <input type="text" id="result" name="result" required>
        <label for="achieved_at">Data osiągnięcia:</label>
        <input type="date" id="achieved_at" name="achieved_at" required>
        <button type="submit" name="add_achievement">Dodaj osiągnięcie</button>
    </form>
    <?php if (!$achievements): ?>
        <p>Brak osiągnięć dla tego ucznia.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Nazwa</th>
                    <th>Wynik</th>
                    <th>Data osiągnięcia</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($achievements as $ach): ?>
                    <tr>
                        <td><?= $ach["name"] ?></td>
                        <td><?= $ach["result"] ?></td>
                        <td><?= $ach["achieved_at"] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</main>