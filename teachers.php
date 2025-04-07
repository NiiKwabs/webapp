<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Teachers</title>
</head>
<body>
    <h2>Teachers</h2>
    <form method="POST" action="teacher_action.php">
        <input type="text" name="name" placeholder="Name" required>
        <input type="text" name="subject" placeholder="Subject" required>
        <button name="add">Add Teacher</button>
    </form>
    <table border="1">
        <tr><th>Name</th><th>Subject</th><th>Actions</th></tr>
        <?php
        $result = $conn->query("SELECT * FROM teachers");
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                <td>{$row['name']}</td>
                <td>{$row['subject']}</td>
                <td>
                    <form method='POST' action='teacher_action.php' style='display:inline-block'>
                        <input type='hidden' name='id' value='{$row['id']}'>
                        <input type='text' name='name' value='{$row['name']}' required>
                        <input type='text' name='subject' value='{$row['subject']}' required>
                        <button name='edit'>Edit</button>
                    </form>
                    <form method='POST' action='teacher_action.php' style='display:inline-block'>
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
