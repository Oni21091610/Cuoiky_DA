<?php
// model/db_connection.php
$servername = "localhost";
$username = "root";
$password = ""; // Mặc định trong XAMPP là rỗng
$dbname = "flight_booking";

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Đảm bảo sử dụng UTF-8
$conn->set_charset("utf8");
?>
