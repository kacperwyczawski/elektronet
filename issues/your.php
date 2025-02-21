<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: /denied.php");
    exit();
}

require "../sidebar.php";
?>
<main>
    <h1>Twoje zgłoszenia</h1>
    <?php
    require "../db.php";
    $stmt = $db->prepare("select * from issues where raised_by_id = ?");
    $stmt->execute([$_SESSION["user_id"]]);
    $issues = $stmt->fetchAll();
    if (empty($issues)):
    ?>
        <p>
            Pusto! Wszystkie zgłoszone problemy zostały rozwiązane lub odrzucone.
        </p>
        <p>
            Możesz zgłosić nowy problem <a href="/issues/report.php">tutaj</a>.
        </p>
    <?php else: ?>
        <table>
            <tr>
                <th>Priorytet</th>
                <th>Sala</th>
                <th>Opis</th>
            </tr>
            <?php foreach ($issues as $row): ?>
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
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</main>