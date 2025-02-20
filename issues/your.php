<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: /");
    exit();
}

require "../sidebar.php";
?>
<main>
    <h1>Twoje zgłoszenia</h1>
    <table>
        <tr>
            <th>Sala</th>
            <th>Opis</th>
            <th>Priorytet</th>
        </tr>
        <?php
        require "../db.php";
        $stmt = $db->prepare("select room, description, priority from issues where user_id = ?");
        $stmt->execute([$_SESSION["user_id"]]);
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
    </table>
</main>