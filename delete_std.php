<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');

$servername = "localhost";
$username = "root";
$password = "123456789";
$dbname = "students";

// ตรวจสอบว่ามีรหัสนักเรียนที่ส่งมาในพารามิเตอร์ id
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirm'])) {
        // สร้างการเชื่อมต่อกับฐานข้อมูล
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        if (!$conn) {
            die("Connection failed " . mysqli_connect_error());
        }

        // สร้างคำสั่ง SQL สำหรับลบข้อมูล
        $sql = "DELETE FROM `std_info` WHERE `id` = $id";

        $result = mysqli_query($conn, $sql);

        if ($result) {
            echo "<div style='text-align: center;'>";
            echo "<h2>Record with ID $id has been deleted successfully!</h2>";
            echo "<a href='student.php' style='background-color: #28a745; color: #fff; padding: 10px 20px; border-radius: 5px; text-decoration: none;'>Back to Student List</a>";
            echo "</div>";
        } else {
            echo "<div style='text-align: center;'>";
            echo "<h2>Error deleting record: " . mysqli_error($conn) . "</h2>";
            echo "<a href='student.php' style='background-color: #dc3545; color: #fff; padding: 10px 20px; border-radius: 5px; text-decoration: none;'>Back to Student List</a>";
            echo "</div>";
        }

        mysqli_close($conn);
    } else {
        // แสดงกล่องข้อความยืนยัน
        echo "<div style='text-align: center;'>";
        echo "<h2>Are you sure you want to delete this record?</h2>";
        echo '<form method="post" action=""><input type="submit" name="confirm" value="Confirm Delete" style="background-color: #dc3545; color: #fff; padding: 10px 20px; border-radius: 5px; text-decoration: none;"> ';
        echo "<a href='student.php' style='background-color: #6c757d; color: #fff; padding: 10px 20px; border-radius: 5px; text-decoration: none;'>Cancel</a></form>";
        echo "</div>";
    }
} else {
    echo "Invalid request.";
}
?>
