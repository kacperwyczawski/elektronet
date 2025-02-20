<?php
session_start();

if (!isset($_SESSION["user_id"]) || ($_SESSION["role"] !== "kierownik" && $_SESSION["role"] !== "dyrektor")) {
    header("Location: /denied.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require "../db.php";
    if (isset($_POST["approve"])) {
        $stmt = $db->prepare("update issues set priority = ?where issue_id = ?");
        $stmt->execute([$_POST["priority"], $_POST["id"]]);
    } elseif (isset($_POST["reject"])) {
        $stmt = $db->prepare("delete from issues where issue_id = ?");
        $stmt->execute([$_POST["id"]]);
    }
}

require "../sidebar.php";
?>
<main>
    <h1>Zgłoszenia do zatwierdzenia</h1>
    <?php
    require "../db.php";
    $stmt = $db->prepare("select issue_id, room, description from issues where priority is null");
    $stmt->execute();
    $result = $stmt->fetchAll();
    if (!$result):
    ?>
        <p>
            No i fajrant, brak zgłoszeń do zatwierdzenia.
        </p>
    <?php else: ?>
        <table>
            <tr>
                <th>Sala</th>
                <th>Opis</th>
                <th>Priorytet</th>
                <th>Wykonawca</th>
                <th>Akcja</th>
            </tr>
            <?php
            foreach ($result as $row):
            ?>
                <tr>
                    <td><?= $row["room"] ?></td>
                    <td><?= $row["description"] ?></td>
                    <td colspan="3">
                        <form method="post">
                            <select name="priority" required>
                                <option value="high">Wysoki</option>
                                <option value="normal" selected>Normalny</option>
                                <option value="low">Niski</option>
                            </select>
                            <select name="user_id" required>
                                <?php
                                $stmt = $db->prepare("select user_id, first_name, last_name from users where role = 'wykonawca'");
                                $stmt->execute();
                                foreach ($stmt as $row2):
                                ?>
                                    <option value="<?= $row2["user_id"] ?>"><?= $row2["first_name"] ?> <?= $row2["last_name"] ?></option>
                                <?php
                                endforeach;
                                ?>
                            </select>
                            <input type="hidden" name="id" value="<?= $row["issue_id"] ?>">
                            <button type="submit" name="approve">Zatwierdź</button>
                        </form>
                        <form method="post">
                            <input type="hidden" name="id" value="<?= $row["issue_id"] ?>">
                            <button type="submit" name="reject">Odrzuć</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</main>