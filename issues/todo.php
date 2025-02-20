<?php
session_start();

if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "executor") {
    header("Location: /denied.php");
    exit();
}

require "../sidebar.php";
?>
<main>
    <h1>Twoje zgłoszenia</h1>
    <table>
        <tr>
            <th>Priorytet</th>
            <th>Sala</th>
            <th>Opis</th>
        </tr>
        <?php
        require "../db.php";
        $stmt = $db->prepare("select room, description, priority from issues where user_id = ?");
        $stmt->execute([$_SESSION["user_id"]]);
        foreach ($stmt as $row):
        ?>
            <tr>
                <td><?= $row["priority"] ?></td>
                <td><?= $row["room"] ?></td>
                <td><?= $row["description"] ?></td>
            </tr>
        <?php
        endforeach;
        ?>
    </table>
</main>