<?php include "db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["name"], $_POST["age"])) {
    $name = $conn->real_escape_string($_POST["name"]);
    $age = intval($_POST["age"]);
    $conn->query("INSERT INTO users (name, age) VALUES ('$name', $age)");
}

$result = $conn->query("SELECT * FROM users");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Status Toggle</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <form method="POST">
        Name: <input type="text" name="name" required>
        Age: <input type="number" name="age" required>
        <button type="submit">Submit</button>
    </form>

    <table>
        <tr><th>ID</th><th>Name</th><th>Age</th><th>Status</th><th>Action</th></tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row["id"] ?></td>
                <td><?= htmlspecialchars($row["name"]) ?></td>
                <td><?= $row["age"] ?></td>
                <td id="status-<?= $row["id"] ?>"><?= $row["status"] ?></td>
                <td><button onclick="toggleStatus(<?= $row['id'] ?>)">Toggle</button></td>
            </tr>
        <?php endwhile; ?>
    </table>

    <script>
    function toggleStatus(id) {
        fetch("toggle.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: "id=" + id
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                document.getElementById("status-" + id).textContent = data.new_status;
            } else {
                alert("Error toggling status");
            }
        });
    }
    </script>
</body>
</html>
