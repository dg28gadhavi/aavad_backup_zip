<?php



$servername = "localhost";
$username = "aavadins_aavad";
$password = "1[ixT8A(mi5E";
$dbname = "aavadins_aavaderp";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//echo "hiiii";die;
$sql = "SELECT au_id,au_fname,au_lname FROM tbl_admin_users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["au_id"]. " - Name: " . $row["au_fname"]. " " . $row["au_lname"]. "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();

?>