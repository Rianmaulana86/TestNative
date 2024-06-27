<?php
require_once '../includes/session.php';
requireLogin();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once '../includes/db.php';

    $name = $_POST['name'];
    $address = $_POST['address'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];

    $connection = getDbConnection();
    $stmt = $connection->prepare("INSERT INTO pegawais (name, address, age, gender) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssis", $name, $address, $age, $gender);
    $stmt->execute();
    $stmt->close();
    $connection->close();

    header('Location: read.php');
    exit();
}
?>

<form method="POST">
    <input type="text" name="name" placeholder="Name" required><br>
    <input type="text" name="address" placeholder="Address" required><br>
    <input type="number" name="age" placeholder="Age" required><br>
    <input type="radio" name="gender" value="1" required> Laki<br>
    <input type="radio" name="gender" value="2" required> Perempuan<br>
    <button type="submit">Create</button>
</form>
