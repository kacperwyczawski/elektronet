<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: /denied.php");
    exit();
}

require "../db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["delete"])) {
        $stmt = $db->prepare("DELETE FROM students WHERE student_id = ?");
        $stmt->execute([$_POST["student_id"]]);
    } elseif (isset($_POST["achievements"])) {
        header("Location: /achievements/list.php?student_id=" . $_POST["student_id"]);
        exit();
    }
}

require "../sidebar.php";
?>
<main>
    <h1>Wszyscy uczniowie</h1>
    <table>
        <thead>
            <tr>
                <th>Imię</th>
                <th>Nazwisko</th>
                <th>Numer legitymacji</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $stmt = $db->prepare("select * from students order by last_name, first_name");
            $stmt->execute();
            foreach ($stmt as $row):
            ?>
                <tr>
                    <td><?= $row["first_name"] ?></td>
                    <td><?= $row["last_name"] ?></td>
                    <td><?= $row["school_id"] ?></td>
                    <td>
                        <form method="post" action="students.php" class="inline">
                            <input type="hidden" name="student_id" value="<?= $row['student_id'] ?>">
                            <input type="submit" name="delete" value="Usuń" onclick="return confirm('Na pewno usunąć ucznia? Spowoduje to usunięcie wszystkich jego osiągnięć.')">
                            <input type="submit" name="achievements" value="Osiągnięcia">
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>