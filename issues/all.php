<?php
session_start();

if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "director") {
    header("Location: /");
    exit();
}

require "../sidebar.php";
?>
<main>
    <h1>Wszystkie zgłoszenia</h1>
    <table>
        <thead>
            <tr>
                <th>Sala</th>
                <th>Opis</th>
                <th>Priorytet</th>
            </tr>
        </thead>
        <tbody>
            <?php
            require "../db.php";
            $stmt = $db->prepare("select room, description, priority from issues");
            $stmt->execute();
            foreach ($stmt as $row):
            ?>
            <tr>
                <td><?= $row["room"] ?></td>
                <td><?= $row["description"] ?></td>
                <td><?= $row["priority"] ?></td>
            </tr>
            <?php
            endforeach;
            ?>
        </tbody>
    </table>
</main>
