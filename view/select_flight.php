<?php
$from = $_GET['from'] ?? 'N/A';
$to = $_GET['to'] ?? 'N/A';
$departure_date = $_GET['departure_date'] ?? 'N/A';
$return_date = $_GET['return_date'] ?? null;
$adults = $_GET['adults'] ?? 0;
$children = $_GET['children'] ?? 0;
$infants = $_GET['infants'] ?? 0;

// Danh sách chuyến bay mẫu
$flights = [
    ['flight_code' => 'VN123', 'time' => '10:00', 'price' => 1000000],
    ['flight_code' => 'VN124', 'time' => '14:00', 'price' => 1200000],
    ['flight_code' => 'VN125', 'time' => '18:00', 'price' => 900000]
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chọn Chuyến Bay</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            background: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }
        h2 {
            color: #007bff;
            font-weight: bold;
        }
        .list-group-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            margin-bottom: 10px;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
            transition: 0.3s;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .header-bar {
            background-color: #007bff;
            color: white;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header-bar img {
            height: 40px;
        }
        .menu-btn {
            display: none;
        }
        .dropdown-menu {
            display: none;
            position: absolute;
            top: 60px;
            right: 15px;
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }
        .dropdown-menu a {
            display: block;
            padding: 10px 20px;
            text-decoration: none;
            color: #007bff;
        }
        .dropdown-menu a:hover {
            background-color: #f3f4f6;
        }
        @media (max-width: 768px) {
            .header-bar .hotline {
                display: none;
            }
            .menu-btn {
                display: block;
            }
        }
    </style>
</head>
<body>
<div class="header-bar">
        <div>
            <img src="your-logo-url.png" alt="Logo">
        </div>
        <div class="hotline">
            <span><i class="fas fa-phone-alt"></i> Hotline: <strong>123-456-7890</strong></span>
        </div>
        <button class="btn btn-light menu-btn" onclick="toggleMenu()">
            <i class="fas fa-bars"></i>
        </button>
    </div>

    <!-- Dropdown Menu -->
    <div class="dropdown-menu">
        <a href="search_flights.php"><i class="fas fa-home"></i> Trang Chủ</a>
        <a href="payment.php"><i class="fas fa-credit-card"></i> Thanh Toán</a>
    </div>
    <div class="container">
        <h2 class="text-center"><i class="fas fa-plane"></i> Chọn Chuyến Bay</h2>
        <p class="text-center">
            <strong>Từ:</strong> <?= htmlspecialchars($from) ?> - 
            <strong>Đến:</strong> <?= htmlspecialchars($to) ?> - 
            <strong>Ngày đi:</strong> <?= htmlspecialchars($departure_date) ?>
        </p>
        <p class="text-center">
            <strong>Người lớn:</strong> <?= htmlspecialchars($adults) ?>, 
            <strong>Trẻ em:</strong> <?= htmlspecialchars($children) ?>, 
            <strong>Em bé:</strong> <?= htmlspecialchars($infants) ?>
        </p>

        <div class="list-group mt-4">
            <?php foreach ($flights as $flight): ?>
                <div class="list-group-item">
                    <div>
                        <strong>Chuyến:</strong> <?= htmlspecialchars($flight['flight_code']) ?> - 
                        <strong>Thời gian:</strong> <?= htmlspecialchars($flight['time']) ?> - 
                        <strong>Giá:</strong> <?= number_format($flight['price'], 0, ',', '.') ?> VND
                    </div>
                    <form action="enter_customer_info.php" method="POST">
                        <input type="hidden" name="flight_code" value="<?= htmlspecialchars($flight['flight_code']) ?>">
                        <input type="hidden" name="from" value="<?= htmlspecialchars($from) ?>">
                        <input type="hidden" name="to" value="<?= htmlspecialchars($to) ?>">
                        <input type="hidden" name="departure_date" value="<?= htmlspecialchars($departure_date) ?>">
                        <input type="hidden" name="return_date" value="<?= htmlspecialchars($return_date) ?>">
                        <input type="hidden" name="adults" value="<?= htmlspecialchars($adults) ?>">
                        <input type="hidden" name="children" value="<?= htmlspecialchars($children) ?>">
                        <input type="hidden" name="infants" value="<?= htmlspecialchars($infants) ?>">
                        <button type="submit" class="btn btn-primary">Đặt vé</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script>
        function toggleMenu() {
            const menu = document.querySelector('.dropdown-menu');
            menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
        }
    </script>
</body>
</html>
