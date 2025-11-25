<?php
include "../classes/Student.php";

$student = new Student();
$data = $student->getStudents();
?>

<h2>Student List</h2>

<a href="create.php">Add Student</a>
<br><br>

<table border="1" cellpadding="8">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Faculty</th>
        <th>Action</th>
    </tr>

    <?php foreach ($data as $row): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['name'] ?></td>
            <td><?= $row['faculty'] ?></td>
            <td>
                <a href="edit.php?id=<?= $row['id'] ?>">Edit</a> |
                <a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Delete this student?')">Delete</a>
            </td>
        </tr>
    <?php endforeach ?>
</table>