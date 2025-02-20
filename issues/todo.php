<?php
session_start();

if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "wykonawca") {
    header("Location: /denied.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    require "../db.php";
    $stmt = $db->prepare("delete from issues where issue_id = ?");
    $stmt->execute([$_POST["id"]]);
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
            <th></th>
        </tr>
        <?php
        require "../db.php";
        $stmt = $db->prepare("select * from issues where assigned_to_id = ? order by priority");
        $stmt->execute([$_SESSION["user_id"]]);
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
                <td><?= $row["room"] ?></td>
                <td><?= $row["description"] ?></td>
                <td>
                    <form method="post" class="inline">
                        <input type="hidden" name="id" value="<?= $row["issue_id"] ?>">
                        <input type="submit" name="done" value="Zakończ">
                    </form>
                </td>
            </tr>
        <?php
        endforeach;
        ?>
    </table>
</main>