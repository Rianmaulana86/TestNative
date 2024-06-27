<?php
require_once '../includes/db.php';
require_once '../includes/session.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $connection = getDbConnection();
    $stmt = $connection->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($id, $hashed_password);
    $stmt->fetch();
    $stmt->close();
    $connection->close();

    if (password_verify($password, $hashed_password)) {
        $_SESSION['user_id'] = $id;
        header('Location: /private/read.php');
        exit();
    } else {
        $error = "Invalid username or password";
    }
}
?>

<form method="POST">
    <input type="text" name="username" placeholder="Username" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <button type="submit">Login</button>
</form>
<?php if (isset($error)) { echo $error; } ?>
