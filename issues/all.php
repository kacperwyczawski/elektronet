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
                <th>Wykonawca</th>
            </tr>
        </thead>
        <tbody>
            <?php
            require "../db.php";
            $stmt = $db->prepare("select room, description, priority, first_name, last_name from issues natural join users");
            $stmt->execute();
            foreach ($stmt as $row):
            ?>
            <tr>
                <td><?= $row["room"] ?></td>
                <td><?= $row["description"] ?></td>
                <td><?= $row["priority"] ?></td>
                <td><?= $row["first_name"] ?> <?= $row["last_name"] ?></td>
            </tr>
            <?php
            endforeach;
            ?>
        </tbody>
    </table>
</main>
