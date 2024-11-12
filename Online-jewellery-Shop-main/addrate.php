<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <nav>
        <img src="designs/logo.jpeg" alt="logo" width="150px">
        <ul>
            <li><a href="index.php">Home</a></li>
        </ul>
    </nav>

    <!-- Form part starts here -->
    <section class="rate">
        <h1>Today's Rate</h1>
        <div>
            <form action="#" method="post">
                <div>
                    <h2>Date</h2>
                    <input type="date" name="date" autocomplete="off">
                </div>
                <div>
                    <h2>Gold</h2>
                    <input type="number" name="gold" autocomplete="off">
                </div>
                <div>
                    <h2>Silver</h2>
                    <input type="number" name="silver" autocomplete="off">
                </div>
                <div>
                    <button type="submit" name="submit">Submit</button>
                </div>
            </form>
        </div>

        <!-- Table to display updated rates -->
        <h2>Current Rates</h2>
        <table border="1">
            <tr>
                <th>Date</th>
                <th>Gold Rate</th>
                <th>Silver Rate</th>
                <th>Action</th>
            </tr>
            <?php
            // Database connection
			$con = mysqli_connect('localhost', 'root');
			mysqli_select_db($con, 'project');
            if (!$con) {
                die("Connection failed: " . mysqli_connect_error());
            }

            // Fetch rates from the database
            $query = "SELECT * FROM rate ORDER BY Date DESC"; // Fetch rates in descending order by date
            $result = mysqli_query($con, $query);

            while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <tr>
                    <td><?php echo $row['Date']; ?></td>
                    <td><?php echo $row['Gold']; ?></td>
                    <td><?php echo $row['Silver']; ?></td>
                    <td>
                        <a href="delete_user.php?date=<?php echo $row['Date']; ?>" onclick="return confirm('Are you sure you want to delete this rate?');">Delete</a>
                    </td>
                </tr>
            <?php
            }
            mysqli_close($con); // Close the database connection
            ?>
        </table>
    </section>
    <!-- Form part ends here -->

    <!-- Footer section begins here -->
    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="footer-cols-1">
                    <h3>Download Our App</h3>
                    <p>Download App for Android and iOS mobile phone</p>
                    <div class="app-logo">
                        <img src="designs/app-store.png">
                        <img src="designs/play-store.png">
                    </div>
                </div>
                <div class="footer-cols-2">
                    <img src="designs/rj.jpeg">
                    <p>Download App for Android and iOS mobile phone</p>
                </div>
                <div class="footer-cols-3">
                    <h3>Follow Us on</h3>
                    <div class="socialmedia">
                        <img src="designs/facebook.png">
                        <img src="designs/instagram.png">
                        <img src="designs/twitter.png">
                        <img src="designs/youtube.jpg">
                    </div>
                </div>
            </div>
            <hr>
            <p class="copyright">© 2024 License Rana jewellery. All rights reserved.</p>
        </div>
    </div>
</body>

</html>

<?php

// Database connection
$con = mysqli_connect('localhost', 'root');
mysqli_select_db($con, 'project');
if (isset($_POST['submit'])) {
    $date = $_POST['date'];
    $gold = $_POST['gold'];
    $silver = $_POST['silver'];

    $query = "INSERT INTO rate(Date, Gold, Silver) VALUES('$date', '$gold', '$silver')";
    mysqli_query($con, $query);
    header('location:display.php'); // Redirect to the display page after submission
}

?>
