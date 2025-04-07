<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Classes</title>
</head>
<body>
    <h2>Classes</h2>
    <form method="POST" action="class_action.php">
        <input type="text" name="class_name" placeholder="Class Name" required>
        <input type="text" name="teacher" placeholder="Teacher" required>
        <button name="add">Add Class</button>
    </form>
    <table border="1">
        <tr><th>Class Name</th><th>Teacher</th><th>Actions</th></tr>
        <?php
        $result = $conn->query("SELECT * FROM classes");
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                <td>{$row['class_name']}</td>
                <td>{$row['teacher']}</td>
                <td>
                    <form method='POST' action='class_action.php' style='display:inline-block'>
                        <input type='hidden' name='id' value='{$row['id']}'>
                        <input type='text' name='class_name' value='{$row['class_name']}' required>
                        <input type='text' name='teacher' value='{$row['teacher']}' required>
                        <button name='edit'>Edit</button>
                    </form>
                    <form method='POST' action='class_action.php' style='display:inline-block'>
                        <input type='hidden' name='id' value='{$row['id']}'>
                        <button name='delete'>Delete</button>
                    </form>
                </td>
            </tr>";
        }
        ?>
    </table>
</body>
</html>
