<?php
require_once '../includes/session.php';
requireLogin();
require_once '../includes/db.php';

$connection = getDbConnection();
$result = $connection->query("SELECT * FROM pegawais");
$pegawais = $result->fetch_all(MYSQLI_ASSOC);
$connection->close();
?>

<a href="create.php">Add New Pegawai</a>
<table border="1">
    <tr>
        <th>Name</th>
        <th>Address</th>
        <th>Age</th>
        <th>Gender</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($pegawais as $pegawai): ?>
    <tr>
        <td><?php echo htmlspecialchars($pegawai['name']); ?></td>
        <td><?php echo htmlspecialchars($pegawai['address']); ?></td>
        <td><?php echo htmlspecialchars($pegawai['age']); ?></td>
        <td><?php echo htmlspecialchars($pegawai['gender'] == 1 ? 'Laki' : 'Perempuan'); ?></td>
        <td>
            <a href="update.php?id=<?php echo $pegawai['id']; ?>">Edit</a>
            <a href="delete.php?id=<?php echo $pegawai['id']; ?>">Delete</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
