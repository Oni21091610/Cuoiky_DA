<?php
session_start();
$_SESSION['booking_time'] = time();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh Toán</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
        let timer = 1800; // 30 phút
        setInterval(() => {
            if (timer <= 0) {
                alert("Thời gian thanh toán đã hết. Đặt vé bị hủy.");
                window.location.href = "search_flights.php";
            } else {
                timer--;
                document.getElementById('countdown').innerText = `${Math.floor(timer / 60)} phút ${timer % 60} giây`;
            }
        }, 1000);
    </script>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Thanh Toán</h2>
        <p class="text-center">Bạn có 30 phút để hoàn tất thanh toán.</p>
        <p class="text-center" id="countdown"></p>
        <form action="confirm_booking.php" method="POST">
            <button type="submit" class="btn btn-success">Thanh Toán</button>
        </form>
    </div>
</body>
</html>
