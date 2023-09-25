<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');

$servername = "localhost";
$username = "root";
$password = "123456789";
$dbname = "students";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $en_name = $_POST["en_name"];
    $en_surname = $_POST["en_surname"];
    $th_name = $_POST["th_name"];
    $th_surname = $_POST["th_surname"];
    $major_code = $_POST["major_code"];
    $email = $_POST["email"];

    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
        die("Connection failed " . mysqli_connect_error());
    }

    $sql = "UPDATE `std_info` SET `en_name`='$en_name', `en_surname`='$en_surname', `th_name`='$th_name', `th_surname`='$th_surname', `major_code`='$major_code', `email`='$email' WHERE `id`='$id'";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "Record with ID $id has been updated successfully!<br>";
        echo '<a href="student.php">Back</a>';
    } else {
        echo "Error updating record: " . mysqli_error($conn) . "<br>";
        echo '<a href="student.php">Back</a>';
    }

    mysqli_close($conn);
} else {
    echo "Invalid request.";
}
?>
