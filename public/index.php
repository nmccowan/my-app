<?php
require __DIR__ . '/../src/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name'], $_POST['body'])) {
    $stmt = db()->prepare('INSERT INTO messages (name, body) VALUES (?, ?)');
    $stmt->execute([$_POST['name'], $_POST['body']]);
    header('Location: index.php');
    exit;
}

$rows = db()->query('SELECT * FROM messages ORDER BY id DESC')->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My App</title>
</head>
<body>
    <h1>Message Board</h1>

    <form method="POST">
        <input type="text" name="name" placeholder="Your name" required><br><br>
        <textarea name="body" placeholder="Your message" required></textarea><br><br>
        <button type="submit">Send</button>
    </form>

    <hr>

    <ul>
        <?php foreach ($rows as $row): ?>
            <li><strong><?= htmlspecialchars($row['name']) ?>:</strong> <?= htmlspecialchars($row['body']) ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>