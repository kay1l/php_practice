<?php

require 'config/Database.php';
require 'classes/Task.php';

$db = (new Database())->connect();

$task = new Task($db);

if(isset($_GET['id'])) {
    $task->delete($_GET['id']);
}
header("Location: index.php");

?>