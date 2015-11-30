<?php
require_once('config.php'); // database credentials

// Create connection
$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
    header('HTTP/1.1 500 Internal Server Error');
    die("Connection failed: " . $conn->connect_error);
}
echo "<html>";
echo "<body>";

//$sql = "SELECT " . $dbcolumn . " as 'message' FROM " . $dbname . "." . $dbtable;
$sql = "SELECT VARIABLE_VALUE as 'message' FROM information_schema.GLOBAL_STATUS WHERE VARIABLE_NAME = 'wsrep_cluster_size'";
if (!$result = $conn->query($sql)) {
//	echo "Error";
	printf("Errormessage: %s\n", $conn->error());
}

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "wsrep_cluster_size: " . $row["message"];
    }
} else {
    echo "0 results";
}

$conn->close();
?>
<?php include "links.php"; ?>
</body>
</html>

