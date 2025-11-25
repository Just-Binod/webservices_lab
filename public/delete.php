<?php
include "../classes/Student.php";

$student = new Student();
$id = $_GET['id'];

if ($student->deleteStudent($id)) {
    header("Location: index.php");
    exit;
} else {
    echo "Failed to delete!";
}
