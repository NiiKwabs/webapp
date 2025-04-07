<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Valley View School Management</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #00274D;
            color: white;
            padding: 20px;
            text-align: center;
        }

        nav {
            background-color: #014f86;
            display: flex;
            justify-content: center;
            gap: 20px;
            padding: 15px 0;
        }

        nav a {
            color: white;
            text-decoration: none;
            font-weight: bold;
            padding: 10px 20px;
            border-radius: 5px;
        }

        nav a:hover {
            background-color: #00509e;
        }

        .container {
            max-width: 900px;
            margin: 20px auto;
            background: rgba(255, 255, 255, 0.9);
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        h2 {
            color: #00274D;
        }

        form input {
            padding: 10px;
            margin: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        form button {
            padding: 10px 20px;
            background-color: #00509e;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        form button:hover {
            background-color: #003f7f;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #014f86;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .action-form {
            display: inline-block;
        }

        ul {
            list-style: none;
            padding-left: 0;
        }

        ul li {
            padding: 8px 0;
        }

        /* Backgrounds for different sections */
        .bg-dashboard {
            background: url('assets/bg-dashboard.png') no-repeat center center fixed;
            background-size: cover;
        }

        .bg-students {
            background: url('assets/students.png') no-repeat center center fixed;
            background-size: cover;
        }

        .bg-teachers {
            background: url('assets/teachers.jpg') no-repeat center center fixed;
            background-size: cover;
        }

        .bg-classes {
            background: url('assets/classes.jpg') no-repeat center center fixed;
            background-size: cover;
        }
    </style>
</head>
<body class="
<?php
    $section = $_GET['section'] ?? 'dashboard';
    echo 'bg-' . $section;
?>
">

<header>
    <h1>Valley View University - School Management System</h1>
</header>

<nav>
    <a href="?section=dashboard">Dashboard</a>
    <a href="?section=students">Students</a>
    <a href="?section=teachers">Teachers</a>
    <a href="?section=classes">Classes</a>
</nav>

<div class="container">
<?php
if ($section == 'dashboard') {
    $students = $conn->query("SELECT COUNT(*) AS total FROM students")->fetch_assoc();
    $teachers = $conn->query("SELECT COUNT(*) AS total FROM teachers")->fetch_assoc();
    $classes = $conn->query("SELECT COUNT(*) AS total FROM classes")->fetch_assoc();
    echo "<h2>Dashboard</h2>
    <ul>
        <li><strong>Total Students:</strong> {$students['total']}</li>
        <li><strong>Total Teachers:</strong> {$teachers['total']}</li>
        <li><strong>Total Classes:</strong> {$classes['total']}</li>
    </ul>";
}

elseif ($section == 'students') {
?>
    <h2>Students</h2>
    <form method="POST" action="student_action.php">
        <input type="text" name="name" placeholder="Name" required>
        <input type="text" name="grade" placeholder="Grade" required>
        <button name="add">Add Student</button>
    </form>
    <table>
        <tr><th>Name</th><th>Grade</th><th>Actions</th></tr>
        <?php
        $result = $conn->query("SELECT * FROM students");
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                <td>{$row['name']}</td>
                <td>{$row['grade']}</td>
                <td>
                    <form method='POST' class='action-form' action='student_action.php'>
                        <input type='hidden' name='id' value='{$row['id']}'>
                        <input type='text' name='name' value='{$row['name']}' required>
                        <input type='text' name='grade' value='{$row['grade']}' required>
                        <button name='edit'>Edit</button>
                    </form>
                    <form method='POST' class='action-form' action='student_action.php'>
                        <input type='hidden' name='id' value='{$row['id']}'>
                        <button name='delete'>Delete</button>
                    </form>
                </td>
            </tr>";
        }
        ?>
    </table>

<?php
}

elseif ($section == 'teachers') {
?>
    <h2>Teachers</h2>
    <form method="POST" action="teacher_action.php">
        <input type="text" name="name" placeholder="Name" required>
        <input type="text" name="subject" placeholder="Subject" required>
        <button name="add">Add Teacher</button>
    </form>
    <table>
        <tr><th>Name</th><th>Subject</th><th>Actions</th></tr>
        <?php
        $result = $conn->query("SELECT * FROM teachers");
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                <td>{$row['name']}</td>
                <td>{$row['subject']}</td>
                <td>
                    <form method='POST' class='action-form' action='teacher_action.php'>
                        <input type='hidden' name='id' value='{$row['id']}'>
                        <input type='text' name='name' value='{$row['name']}' required>
                        <input type='text' name='subject' value='{$row['subject']}' required>
                        <button name='edit'>Edit</button>
                    </form>
                    <form method='POST' class='action-form' action='teacher_action.php'>
                        <input type='hidden' name='id' value='{$row['id']}'>
                        <button name='delete'>Delete</button>
                    </form>
                </td>
            </tr>";
        }
        ?>
    </table>

<?php
}

elseif ($section == 'classes') {
?>
    <h2>Classes</h2>
    <form method="POST" action="class_action.php">
        <input type="text" name="class_name" placeholder="Class Name" required>
        <input type="text" name="teacher" placeholder="Teacher Name" required>
        <button name="add">Add Class</button>
    </form>
    <table>
        <tr><th>Class Name</th><th>Teacher</th><th>Actions</th></tr>
        <?php
        $result = $conn->query("SELECT * FROM classes");
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                <td>{$row['class_name']}</td>
                <td>{$row['teacher']}</td>
                <td>
                    <form method='POST' class='action-form' action='class_action.php'>
                        <input type='hidden' name='id' value='{$row['id']}'>
                        <input type='text' name='class_name' value='{$row['class_name']}' required>
                        <input type='text' name='teacher' value='{$row['teacher']}' required>
                        <button name='edit'>Edit</button>
                    </form>
                    <form method='POST' class='action-form' action='class_action.php'>
                        <input type='hidden' name='id' value='{$row['id']}'>
                        <button name='delete'>Delete</button>
                    </form>
                </td>
            </tr>";
        }
        ?>
    </table>
<?php } ?>
</div>

</body>
</html>
