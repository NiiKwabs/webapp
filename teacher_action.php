<?php
include 'db.php';

if (isset($_POST['add'])) {
    $name = $conn->real_escape_string($_POST['name']);
    $subject = $conn->real_escape_string($_POST['subject']);
    $conn->query("INSERT INTO teachers (name, subject) VALUES ('$name', '$subject')");
}

if (isset($_POST['edit'])) {
    $id = intval($_POST['id']);
    $name = $conn->real_escape_string($_POST['name']);
    $subject = $conn->real_escape_string($_POST['subject']);
    $conn->query("UPDATE teachers SET name='$name', subject='$subject' WHERE id=$id");
}

if (isset($_POST['delete'])) {
    $id = intval($_POST['id']);
    $conn->query("DELETE FROM teachers WHERE id=$id");
}

header("Location: index.php");
exit();
?>
