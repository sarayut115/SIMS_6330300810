<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');

$servername = "localhost";
$username = "root";
$password = "123456789";
$dbname = "students";

// ตรวจสอบว่ามีการส่งข้อมูลผ่าน POST หรือไม่
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = trim($_POST["id"]);
    $en_name = trim($_POST["en_name"]);
    $en_surname = trim($_POST["en_surname"]);
    $th_name = trim($_POST["th_name"]);
    $th_surname = trim($_POST["th_surname"]);
    $major_code = trim($_POST["major_code"]);
    $email = trim($_POST["email"]);

    // ตรวจสอบว่าไม่มีค่าว่างในฟิลด์ที่ห้ามว่าง
    if (!empty($id) && !empty($en_name) && !empty($en_surname) && !empty($th_name) && !empty($th_surname) && !empty($major_code) && !empty($email)) {
        // ตรวจสอบรูปแบบของอีเมล
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // ทำการเชื่อมต่อกับฐานข้อมูล
            $conn = mysqli_connect($servername, $username, $password, $dbname);
            if (!$conn) {
                die("Connection failed " . mysqli_connect_error());
            }

            // ใช้ htmlspecialchars() เพื่อป้องกัน Cross-Site Scripting (XSS)
            $id = htmlspecialchars($id);
            $en_name = htmlspecialchars($en_name);
            $en_surname = htmlspecialchars($en_surname);
            $th_name = htmlspecialchars($th_name);
            $th_surname = htmlspecialchars($th_surname);
            $major_code = htmlspecialchars($major_code);
            $email = htmlspecialchars($email);

            // สร้างคำสั่ง SQL เพื่อเพิ่มข้อมูล
            $sql = "INSERT INTO `std_info` (`id`, `en_name`, `en_surname`, `th_name`, `th_surname`, `major_code`, `email`) VALUES ('$id', '$en_name', '$en_surname', '$th_name', '$th_surname', '$major_code', '$email')";

            $result = mysqli_query($conn, $sql);

            if ($result) {
                echo "New record created successfully!<br>";
                echo '<a href="student.php">Back</a>';
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }

            mysqli_close($conn);
        } else {
            echo "Invalid email format. Please enter a valid email address.<br>";
            echo '<a href="insert_std_form.html">Back to Form</a>';
        }
    } else {
        echo "Please fill in all required fields.<br>";
        echo '<a href="insert_std_form.html">Back to Form</a>';
    }
} else {
    echo "Invalid request.";
}
?>
