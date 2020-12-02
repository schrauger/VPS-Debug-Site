<?php
include('head.php'); 

require_once('config.php'); // database credentials

try {
    // Create connection
    $conn = new mysqli($servername, $username, $password);
} catch (mysqli_sql_exception $e) {
    header('HTTP/1.1 500 Internal Server Error');
    die("Connection failed: " . $e->errorMessage());
}

// Check connection
if ($conn->connect_error) {
    header('HTTP/1.1 500 Internal Server Error');
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT VARIABLE_VALUE as 'message' FROM information_schema.GLOBAL_STATUS WHERE VARIABLE_NAME = 'wsrep_cluster_size'";
if (!$result = $conn->query($sql)) {
//	echo "Error";
	printf("<span class=\"output broken\"><i class=\"material-icons\">warning</i>Error Message: %s\n </span>", $conn->error());
}

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<span class=\"output running\"><i class=\"material-icons\">done</i>wsrep_cluster_size: " . $row["message"] .  "</span>";
    }
} else {
    echo "0 results";
}
echo "<br />" . $sql;
$conn->close();
?>

<?php include('links.php'); ?>

<?php include('footer.php'); ?>


