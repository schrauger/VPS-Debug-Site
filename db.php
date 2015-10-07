<?php
require_once('config.php'); // database credentials

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    header('HTTP/1.1 500 Internal Server Error');
    die("Connection failed: " . $conn->connect_error);
}
echo "<html>";
echo "<body>";

$sql = "SELECT " . $dbcolumn . " FROM " . $dbtable;
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "message: " . $row["message"]. "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>
<a href="index.html">Check nginx</a><br />
<a href="index.php">Check PHP</a><br />
<a href="phpfpm.php">Check php5-fpm</a><br />
<a href="hhvm.php">Check hhvm</a><br />
<a href="db.php">Check mysql</a><br />
<br />
<a href="//vps1.med.ucf.edu">Switch to VPS1</a><br />
<a href="//vps2.med.ucf.edu">Switch to VPS2</a><br />
</body>
</html>
