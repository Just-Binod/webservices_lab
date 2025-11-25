<?php
include_once "../config/Database.php";

class Student
{
    private $id;
    private $name;
    private $faculty;
    private $created_date;
    private $connection;

    public function __construct()
    {
        $conn = new Database();
        $this->connection = $conn->getConnection();
    }

    // 🔹 Get all students
    public function getStudents()
    {
        $sql = $this->connection->prepare("SELECT * FROM students ORDER BY id DESC");
        $sql->execute();

        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    // 🔹 Create new student
    public function createStudent($name, $faculty)
    {
        try {
            $sql = $this->connection->prepare("
                INSERT INTO students (`name`, `faculty`) 
                VALUES (:name, :faculty)
            ");

            $sql->execute([
                ':name' => $name,
                ':faculty' => $faculty
            ]);

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    // 🔹 Get student by ID
    public function getStudentById($id)
    {
        $sql = $this->connection->prepare("SELECT * FROM students WHERE id = :id");
        $sql->execute([
            ':id' => $id
        ]);

        return $sql->fetch(PDO::FETCH_ASSOC);
    }

    // 🔹 Update student
    public function updateStudent($id, $name, $faculty)
    {
        try {
            $sql = $this->connection->prepare("
                UPDATE students 
                SET name = :name, faculty = :faculty
                WHERE id = :id
            ");

            $sql->execute([
                ':name' => $name,
                ':faculty' => $faculty,
                ':id' => $id
            ]);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    // 🔹 Delete student
    public function deleteStudent($id)
    {
        try {
            $sql = $this->connection->prepare("
                DELETE FROM students WHERE id = :id
            ");

            $sql->execute([
                ':id' => $id
            ]);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
