<?php
require_once '../includes/session.php';
requireLogin();
require_once '../includes/db.php';

$id = $_GET['id'];

$connection = getDbConnection();
$stmt = $connection->prepare("DELETE FROM pegawais WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->close();
$connection->close();

header('Location: read.php');
exit();
?>
