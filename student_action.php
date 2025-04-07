<?php
include 'db.php';

if (isset($_POST['add'])) {
    $name = $conn->real_escape_string($_POST['name']);
    $grade = $conn->real_escape_string($_POST['grade']);
    $conn->query("INSERT INTO students (name, grade) VALUES ('$name', '$grade')");
}

if (isset($_POST['edit'])) {
    $id = intval($_POST['id']);
    $name = $conn->real_escape_string($_POST['name']);
    $grade = $conn->real_escape_string($_POST['grade']);
    $conn->query("UPDATE students SET name='$name', grade='$grade' WHERE id=$id");
}

if (isset($_POST['delete'])) {
    $id = intval($_POST['id']);
    $conn->query("DELETE FROM students WHERE id=$id");
}

header("Location: index.php");
exit();
?>
