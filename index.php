<?php
session_start();
include 'config/Database.php';
include 'classes/Task.php';

$db = (new Database())->connect();
$task = new Task($db);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $task->add($_POST['title'], $_POST['description']);
    $_SESSION['success'] = "Task Created Succesfully!";
    header("Location: index.php");
    exit;
}

$tasks = $task->getAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager</title>

   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"  crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
</head>

<body>

<div class="container mt-4">
    <h1 class="text-center mb-4">Task Manager</h1>

   
    <form method="POST">
        <div class="mb-3">
            <label for="title" class="form-label">Task Title</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Task Title" required />
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Task Description</label>
            <textarea class="form-control" id="description" name="description" placeholder="Task Description" required></textarea>
        </div>
        <div class=" d-grid" >
        <button type="submit" class="btn btn-primary">Add Task</button>
        </div>
    </form>

    <h2 class="text-center mt-4">Tasks</h2>
    <ul class="list-group mt-3">
        <?php while($row = $tasks->fetch_assoc()): ?>
            <li class="list-group-item">
                <strong><?= htmlspecialchars($row['title']) ?></strong> <br>
                <?= htmlspecialchars($row['description']) ?> <br>
                <small class="text-muted">Created at: <?= $row['created_at'] ?></small>
                <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm float-end">[Delete]</a>
            </li>
        <?php endwhile; ?>
    </ul>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"  crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="assets/js/toastr_success.js"></script>

<script>
<?php if (isset($_GET['status']) && $_GET['status'] == 'success'): ?>
    toastr.success("<?php $_SESSION['success'] ?> ", "Success");
    <?php unset($_SESSION['success']);   ?>
<?php endif; ?>
</script>

</body>
</html>
