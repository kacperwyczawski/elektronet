<?php
session_start();

if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "dyrektor") {
    header("Location: /denied.php");
    exit();
}

require "../sidebar.php";
?>
<main>
    <h1>Wszystkie zgłoszenia</h1>
    <table>
        <tr>
            <th>Priorytet</th>
            <th>Wykonawca</th>
            <th>Sala</th>
            <th>Opis</th>
        </tr>
        <?php
        require "../db.php";
        $stmt = $db->prepare("select * from issues join users on user_id = assigned_to_id order by priority");
        $stmt->execute();
        foreach ($stmt as $row):
        ?>
            <tr>
                <td>
                    <?php
                    if ($row["priority"] === 0) {
                        echo "Wysoki";
                    } elseif ($row["priority"] === 1) {
                        echo "Normalny";
                    } elseif ($row["priority"] === 2) {
                        echo "Niski";
                    }
                    ?>
                </td>
                <td><?= $row["first_name"] ?> <?= $row["last_name"] ?></td>
                <td><?= $row["room"] ?></td>
                <td><?= $row["description"] ?></td>
            </tr>
        <?php
        endforeach;
        ?>
    </table>
</main>