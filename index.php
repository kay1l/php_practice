<?php

include 'config/Database.php';
include 'classes/Task.php';

$db = (new Database())->connect();

$task = new Task($db);

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $task->add($_POST['title'], $_POST['description']);
    header("Location: index.php");
}

$task = $tasks->getAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Task Manager</title>
</head>
<body>
    <h1>Task Manager</h1>

    <form method="POST">
        <input type="text" name="title" placeholder="Task Title" required />
        <textarea name="description" placeholder="Task Description" required></textarea>
        <button type="submit">Add Task</button>
    </form>

    <h2>Tasks</h2>
    <ul>
        <?php while($row = $tasks->fetch_assoc()): ?>
        <li>
            <strong><?= htmlspecialchars($row['title']) ?></strong> <br>
            <?= htmlspecialchars($row['description']) ?> <br>
            <small>Created at: <?= $row['created_at'] ?></small>
            <a href="delete.php?id=<?= $row['id'] ?>">[Delete]</a>
        </li>
        <?php endwhile; ?>
    </ul>
    </body>
</html>