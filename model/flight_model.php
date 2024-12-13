<?php
// model/flight_model.php
include_once 'db_connection.php';

// Lấy danh sách chuyến bay theo điểm đi, điểm đến và ngày đi
function getFlights($departure, $destination, $departure_date) {
    global $conn;
    $query = "SELECT * FROM flights WHERE departure = ? AND destination = ? AND DATE(departure_time) = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sss", $departure, $destination, $departure_date);
    $stmt->execute();
    return $stmt->get_result();
}

// Thêm đặt vé mới
function addBooking($flight_id, $contact_name, $contact_email, $contact_phone, $adults, $children, $infants, $total_price) {
    global $conn;
    $query = "INSERT INTO bookings (flight_id, contact_name, contact_email, contact_phone, adults, children, infants, total_price) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("isssiiid", $flight_id, $contact_name, $contact_email, $contact_phone, $adults, $children, $infants, $total_price);
    $stmt->execute();
    return $stmt->insert_id;
}

// Thêm thông tin hành khách
function addPassenger($booking_id, $first_name, $middle_name, $last_name, $dob, $gender, $nationality) {
    global $conn;
    $query = "INSERT INTO passengers (booking_id, first_name, middle_name, last_name, dob, gender, nationality) 
              VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("issssss", $booking_id, $first_name, $middle_name, $last_name, $dob, $gender, $nationality);
    $stmt->execute();
}
?>
