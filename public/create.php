<?php
include "../classes/Student.php";

$student = new Student();

if ($_POST) {
    $name = $_POST['name'];
    $faculty = $_POST['faculty'];

    if ($student->createStudent($name, $faculty)) {
        header("Location: index.php");
        exit;
    } else {
        echo "Failed to insert data!";
    }
}
?>

<h2>Add Student</h2>

<form method="POST">
    Name: <input type="text" name="name" required><br><br>
    Faculty: <input type="text" name="faculty" required><br><br>

    <button type="submit">Save</button>
</form>

<br>
<a href="index.php">Back</a>