<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');

$servername = "localhost";
$username = "root";
$password = "123456789";
$dbname = "students";

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
        die("Connection failed " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM `std_info` WHERE `id` = $id";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $en_name = $row["en_name"];
        $en_surname = $row["en_surname"];
        $th_name = $row["th_name"];
        $th_surname = $row["th_surname"];
        $major_code = $row["major_code"];
        $email = $row["email"];
    } else {
        echo "No record found with ID $id.";
        mysqli_close($conn);
        exit;
    }

    mysqli_close($conn);
} else {
    echo "Invalid request.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>Update Student</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }

        h1 {
            text-align: center;
            padding: 20px 0;
        }

        .container {
            width: 60%;
            margin: 20px auto;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .container form {
            text-align: left;
        }

        .container form label {
            font-weight: bold;
        }

        .container form input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .container form input[type="submit"] {
            padding: 10px 20px;
            background-color: #28a745; /* เปลี่ยนสีปุ่มเป็นสีเขียว */
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h1>Update Student</h1>
    <div class="container">
        <form method="post" action="update_std.php">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            
            <label for="en_name">Name:</label>
            <input type="text" id="en_name" name="en_name" value="<?php echo $en_name; ?>"><br>

            <label for="en_surname">Surname:</label>
            <input type="text" id="en_surname" name="en_surname" value="<?php echo $en_surname; ?>"><br>

            <label for="th_name">ชื่อ:</label>
            <input type="text" id="th_name" name="th_name" value="<?php echo $th_name; ?>"><br>

            <label for="th_surname">นามสกุล:</label>
            <input type="text" id="th_surname" name="th_surname" value="<?php echo $th_surname; ?>"><br>

            <label for="major_code">Major:</label>
            <input type="text" id="major_code" name="major_code" value="<?php echo $major_code; ?>"><br>

            <label for="email">Email:</label>
            <input type="text" id="email" name="email" value="<?php echo $email; ?>"><br>

            <input type="submit" value="Update">
        </form>
    </div>
</body>
</html>
