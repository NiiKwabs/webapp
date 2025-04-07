<?php
include 'db.php';

if (isset($_POST['add'])) {
    $class_name = $conn->real_escape_string($_POST['class_name']);
    $teacher = $conn->real_escape_string($_POST['teacher']);
    $conn->query("INSERT INTO classes (class_name, teacher) VALUES ('$class_name', '$teacher')");
}

if (isset($_POST['edit'])) {
    $id = intval($_POST['id']);
    $class_name = $conn->real_escape_string($_POST['class_name']);
    $teacher = $conn->real_escape_string($_POST['teacher']);
    $conn->query("UPDATE classes SET class_name='$class_name', teacher='$teacher' WHERE id=$id");
}

if (isset($_POST['delete'])) {
    $id = intval($_POST['id']);
    $conn->query("DELETE FROM classes WHERE id=$id");
}

header("Location: index.php");
exit();
?>
