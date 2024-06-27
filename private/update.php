<?php
require_once '../includes/session.php';
requireLogin();
require_once '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];

    $connection = getDbConnection();
    $stmt = $connection->prepare("UPDATE pegawais SET name = ?, address = ?, age = ?, gender = ? WHERE id = ?");
    $stmt->bind_param("ssisi", $name, $address, $age, $gender, $id);
    $stmt->execute();
    $stmt->close();
    $connection->close();

    header('Location: read.php');
    exit();
} else {
    $id = $_GET['id'];

    $connection = getDbConnection();
    $stmt = $connection->prepare("SELECT * FROM pegawais WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $pegawai = $result->fetch_assoc();
    $stmt->close();
    $connection->close();
}
?>

<form method="POST">
    <input type="hidden" name="id" value="<?php echo $pegawai['id']; ?>">
    <input type="text" name="name" placeholder="Name" value="<?php echo htmlspecialchars($pegawai['name']); ?>" required><br>
    <input type="text" name="address" placeholder="Address" value="<?php echo htmlspecialchars($pegawai['address']); ?>" required><br>
    <input type="number" name="age" placeholder="Age" value="<?php echo htmlspecialchars($pegawai['age']); ?>" required><br>
    <input type="radio" name="gender" value="1" <?php echo $pegawai['gender'] == 1 ? 'checked' : ''; ?> required> Laki<br>
    <input type="radio" name="gender" value="2" <?php echo $pegawai['gender'] == 2 ? 'checked' : ''; ?> required> Perempuan<br>
    <button type="submit">Update</button>
</form>
