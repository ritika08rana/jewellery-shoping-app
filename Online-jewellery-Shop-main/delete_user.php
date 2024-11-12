<?php
$con = mysqli_connect('localhost', 'root',);

mysqli_select_db($con, 'project');

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $deleteQuery = "DELETE FROM userinfodata WHERE id='$id'";

    if (mysqli_query($con, $deleteQuery)) {
        echo "User deleted successfully!";
        header("Location: display.php"); // Redirect back to admin portal after deletion
        exit;
    } else {
        echo "Error deleting user: " . mysqli_error($con);
    }
} else {
    echo "Invalid ID!";
}

mysqli_close($con);
?>
<?php
// Connect to the database
$con = mysqli_connect('localhost', 'root',);

mysqli_select_db($con, 'project');
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if date is set
if (isset($_GET['date'])) {
    $dateToDelete = $_GET['date'];
    
    // Delete query
    $deleteQuery = "DELETE FROM rate WHERE Date='$dateToDelete'";
    mysqli_query($con, $deleteQuery);
}

// Redirect back to the main page after deletion
header('location:addrate.php');
exit;
?>

