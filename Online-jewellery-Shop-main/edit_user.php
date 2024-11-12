<?php
        $con = mysqli_connect('localhost', 'root');
        mysqli_select_db($con, 'project');

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM userinfodata WHERE id='$id'";
    $result = mysqli_query($con, $query);
    $data = mysqli_fetch_assoc($result);
} else {
    echo "Invalid ID!";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['user'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $address = $_POST['address'];
    $code = $_POST['code'];
    $interestedon = $_POST['interestedon'];
    $comment = $_POST['comment'];

    $updateQuery = "UPDATE userinfodata SET user='$user', email='$email', mobile='$mobile', address='$address', code='$code', interestedon='$interestedon', comment='$comment' WHERE id='$id'";

    if (mysqli_query($con, $updateQuery)) {
        echo "User updated successfully!";
        header("Location: display.php"); // Redirect back to admin portal after update
        exit;
    } else {
        echo "Error updating user: " . mysqli_error($con);
    }
}

mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
</head>
<body>
    <h2>Edit User</h2>
    <form method="POST">
        <label>User:</label>
        <input type="text" name="user" value="<?php echo $data['user']; ?>"><br>

        <label>Email:</label>
        <input type="email" name="email" value="<?php echo $data['email']; ?>"><br>

        <label>Mobile:</label>
        <input type="text" name="mobile" value="<?php echo $data['mobile']; ?>"><br>

        <label>Address:</label>
        <input type="text" name="address" value="<?php echo $data['address']; ?>"><br>

        <label>Code:</label>
        <input type="text" name="code" value="<?php echo $data['code']; ?>"><br>

        <label>Interested On:</label>
        <input type="text" name="interestedon" value="<?php echo $data['interestedon']; ?>"><br>

        <label>Comment:</label>
        <textarea name="comment"><?php echo $data['comment']; ?></textarea><br>

        <button type="submit">Update</button>
    </form>
</body>
</html>
