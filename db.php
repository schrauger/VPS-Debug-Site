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
        echo "message: " . $row["message"];
    }
} else {
    echo "0 results";
}
$conn->close();
?>
<?php include "links.php"; ?>
</body>
</html>
