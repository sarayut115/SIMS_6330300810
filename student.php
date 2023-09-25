<?php
error_reporting(E_ALL);
ini_set('display_errors','1');
ini_set('display_startup_errors','1');

$servername="localhost";
$username="root";
$password="123456789";
$dbname="students";
// create connection
$conn=mysqli_connect($servername,$username,$password,$dbname);
if(!$conn){
    die("Connection failed ".mysqli_connect_error());
}
$sql="SELECT * FROM `std_info`";
$result=mysqli_query($conn,$sql);
if($result){
    if(mysqli_num_rows($result)>0){
        echo "<table border='1'>";
        echo "<tr><th>id</th><th>name</th><th>surname</th>";
        echo "<th>ชื่อ</th><th>นามสกุล</th>";
        echo "<th>Major</th><th>email</th></tr>";
        while($row=mysqli_fetch_assoc($result)){
            echo "<tr><td>".$row["id"]."</td>";
            echo "<td>".$row["en_name"]."</td>";
            echo "<td>".$row["en_surname"]."</td>";
            echo "<td>".$row["th_name"]."</td>";
            echo "<td>".$row["th_surname"]."</td>";
            echo "<td>".$row["major_code"]."</td>";
            echo "<td>".$row["email"]."</td></tr>";

            echo "<td>";

            // เพิ่มลิงค์หรือปุ่มลบ
            echo "<a href='delete_std.php?id=" . $row["id"] . "'>Delete</a> | ";

            // เพิ่มลิงค์หรือปุ่มแก้ไข
            echo "<a href='update_std_form.php?id=" . $row["id"] . "'>Update</a>";
            echo "</td>";
            
            echo "</tr>";
        }
        echo "</table>";

        // เลื่อนปุ่ม "Insert New Record" ไปด้านล่างตารางและเปลี่ยนสีเป็นสีเขียว
        echo "<div style='text-align: center; margin-top: 20px;'>";
        echo "<a href='insert_std_form.html' style='background-color: #28a745; color: #fff; padding: 10px 20px; border-radius: 5px; text-decoration: none;'>Insert New Record</a>";
        echo "</div>";
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>Student List</title>
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

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table th, table td {
            padding: 10px;
            text-align: center;
        }

        table th {
            background-color: #007BFF;
            color: #fff;
        }

        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table a {
            text-decoration: none;
            color: #007BFF;
        }

        table a:hover {
            text-decoration: underline;
        }

        .container {
            text-align: center;
        }

        .container a {
            display: inline-block;
            margin: 10px;
            padding: 10px 20px;
            background-color: #007BFF;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }

        .container a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
</html>