<?php
session_start();

if (!isset($_SESSION["username"]) || $_SESSION["role"] !== "dyrektor") {
    header("Location: /denied.php");
    exit();
}

$error = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    require "../db.php";
    if (isset($_POST["delete"])) {
        $stmt = $db->prepare("delete from users where user_id = ?");
        $stmt->execute([$_POST["id"]]);
    } elseif (isset($_POST["submit"])) {
        $stmt = $db->prepare("select * from users where username = ?");
        $stmt->execute([$_POST["username"]]);
        if ($stmt->fetch()) {
            $error = "Nazwa użytkownika jest już zajęta.";
        } else {
            $stmt = $db->prepare("insert into users (
                first_name,
                last_name,
                username,
                password,
                role,
                created_at
            ) values (?, ?, ?, ?, ?, datetime('now'))");
            $stmt->execute([
                $_POST["first_name"],
                $_POST["last_name"],
                $_POST["username"],
                password_hash($_POST["password"], PASSWORD_DEFAULT),
                $_POST["role"],
            ]);
        }
    }
}

require_once("../sidebar.php");
?>
<main>
    <h1>Dodaj pracownika</h1>
    <?php if ($error !== ""): ?>
        <p class="error"><?= $error ?></p>
    <?php endif; ?>
    <form method="post">
        <label for="first_name">Imię:</label>
        <input type="text" id="first_name" name="first_name" required>
        <label for="last_name">Nazwisko:</label>
        <input type="text" id="last_name" name="last_name" required>
        <label for="username">Nazwa użytkownika:</label>
        <input type="text" id="username" name="username" required>
        <label for="password">Hasło:</label>
        <div class="password">
            <input type="text" id="password" name="password" required>
            <button type="button">Generuj hasło</button>
            <script type="module">
                document.querySelector(".password button").addEventListener("click", () => {
                    const password = Math.random().toString(36).slice(2, 10).toUpperCase()
                    document.getElementById("password").value = password
                })
            </script>
        </div>
        <label for="role">Rola:</label>
        <select id="role" name="role" required>
            <option value="pracownik">Pracownik</option>
            <option value="kierownik">Kierownik</option>
            <option value="wykonawca">Wykonawca</option>
            <option value="dyrektor">Dyrektor</option>
        </select>
        <button type="submit" name="submit">Dodaj pracownika</button>
    </form>
    <h1>Pracownicy</h1>
    <table>
        <thead>
            <tr>
                <th>Imię</th>
                <th>Nazwisko</th>
                <th>Nazwa użytkownika</th>
                <th>Rola</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            require("../db.php");
            $stmt = $db->query("select * from users order by last_name, first_name");
            while ($row = $stmt->fetch()):
            ?>
                <tr>
                    <td><?= $row['first_name'] ?></td>
                    <td><?= $row['last_name'] ?></td>
                    <td><?= $row['username'] ?></td>
                    <td><?= $row['role'] ?></td>
                    <td>
                        <form method="post" class="inline" onsubmit="return confirm('Czy na pewno chcesz usunąć użytkownika <?= $row['username'] ?>?')">
                            <input type="hidden" name="id" value="<?= $row['user_id'] ?>">
                            <input type="submit" name="delete" value="Usuń" />
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</main>

<script type="module">
    const firstName = document.getElementById("first_name")
    const lastName = document.getElementById("last_name")
    const username = document.getElementById("username")

    function generateUsername() {
        let s = firstName.value.slice(0, 3) + lastName.value.slice(0, 3)
        username.value = s
            .toLowerCase()
            .replace("ą", "a")
            .replace("ć", "c")
            .replace("ę", "e")
            .replace("ł", "l")
            .replace("ń", "n")
            .replace("ó", "o")
            .replace("ś", "s")
            .replace("ż", "z")
            .replace("ź", "z")
            .replace(/[^a-z]/g, "")
    }

    firstName.addEventListener("input", generateUsername)
    lastName.addEventListener("input", generateUsername)
</script>