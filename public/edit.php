<?php
include "../classes/Student.php";

$student = new Student();
$id = $_GET['id'];

$data = $student->getStudentById($id);

if (!$data) {
    die("Student not found!");
}

if ($_POST) {
    $name = $_POST['name'];
    $faculty = $_POST['faculty'];

    if ($student->updateStudent($id, $name, $faculty)) {
        header("Location: index.php");
        exit;
    } else {
        echo "Failed to update!";
    }
}
?>

<h2>Edit Student</h2>

<form method="POST">
    Name: <input type="text" name="name" value="<?= $data['name'] ?>" required><br><br>
    Faculty: <input type="text" name="faculty" value="<?= $data['faculty'] ?>" required><br><br>

    <button type="submit">Update</button>
</form>

<br>
<a href="index.php">Back</a>