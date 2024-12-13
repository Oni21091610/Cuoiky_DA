<?php
// Nhận dữ liệu từ form trước đó
$flight_code = $_POST['flight_code'] ?? '';
$from = $_POST['from'] ?? '';
$to = $_POST['to'] ?? '';
$departure_date = $_POST['departure_date'] ?? '';
$return_date = $_POST['return_date'] ?? null;
$adults = $_POST['adults'] ?? 0;
$children = $_POST['children'] ?? 0;
$infants = $_POST['infants'] ?? 0;

// Chuẩn bị mảng hành khách theo thứ tự Người lớn, Trẻ em, Em bé
$passengers = array_merge(
    array_fill(0, $adults, "Người lớn"),
    array_fill(0, $children, "Trẻ em"),
    array_fill(0, $infants, "Em bé")
);

// Danh sách quốc tịch phổ biến
$countries = [
    "Vietnam" => "Việt Nam",
    "United States" => "Hoa Kỳ",
    "United Kingdom" => "Anh",
    "Australia" => "Úc",
    "Canada" => "Canada",
    "China" => "Trung Quốc",
    "France" => "Pháp",
    "Germany" => "Đức",
    "Japan" => "Nhật Bản",
    "South Korea" => "Hàn Quốc",
    "India" => "Ấn Độ",
    "Thailand" => "Thái Lan"
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông Tin Khách Hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f4f8;
        }
        .container {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-top: 50px;
        }
        h2 {
            color: #007bff;
            font-weight: bold;
        }
        h5 {
            color: #343a40;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
            transition: 0.3s;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .rounded {
            border: 1px solid #ced4da;
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
        <h2 class="text-center"><i class="fas fa-user"></i> Thông Tin Khách Hàng</h2>
        <p class="text-center">
            Chuyến bay: <strong><?= htmlspecialchars($flight_code) ?></strong> - 
            Từ: <strong><?= htmlspecialchars($from) ?></strong> - 
            Đến: <strong><?= htmlspecialchars($to) ?></strong>
        </p>

        <form action="payment.php" method="POST">
            <h4 class="mt-4">Thông Tin Hành Khách</h4>
            <?php foreach ($passengers as $index => $passenger_type): ?>
                <div class="mb-4 p-3 rounded">
                    <h5>Hành khách <?= $index + 1 ?> - <?= $passenger_type ?></h5>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="last_name_<?= $index ?>" class="form-label">Họ</label>
                            <input type="text" class="form-control" id="last_name_<?= $index ?>" name="passengers[<?= $index ?>][last_name]" required>
                        </div>
                        <div class="col-md-4">
                            <label for="middle_name_<?= $index ?>" class="form-label">Tên đệm</label>
                            <input type="text" class="form-control" id="middle_name_<?= $index ?>" name="passengers[<?= $index ?>][middle_name]">
                        </div>
                        <div class="col-md-4">
                            <label for="first_name_<?= $index ?>" class="form-label">Tên</label>
                            <input type="text" class="form-control" id="first_name_<?= $index ?>" name="passengers[<?= $index ?>][first_name]" required>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <label for="dob_<?= $index ?>" class="form-label">Ngày sinh</label>
                            <input type="date" class="form-control" id="dob_<?= $index ?>" name="passengers[<?= $index ?>][dob]" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Giới tính</label>
                            <select class="form-select" name="passengers[<?= $index ?>][gender]" required>
                                <option value="male">Nam</option>
                                <option value="female">Nữ</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="nationality_<?= $index ?>" class="form-label">Quốc tịch</label>
                            <select class="form-select" id="nationality_<?= $index ?>" name="passengers[<?= $index ?>][nationality]" required>
                                <?php foreach ($countries as $key => $value): ?>
                                    <option value="<?= htmlspecialchars($key) ?>"><?= htmlspecialchars($value) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

            <h4 class="mt-4">Thông Tin Liên Hệ</h4>
            <div class="mb-4 p-3 rounded">
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label">Xưng hô</label>
                        <select class="form-select" name="contact[title]" required>
                            <option value="mr">Ông</option>
                            <option value="mrs">Bà</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="contact_last_name" class="form-label">Họ</label>
                        <input type="text" class="form-control" id="contact_last_name" name="contact[last_name]" required>
                    </div>
                    <div class="col-md-4">
                        <label for="contact_first_name" class="form-label">Tên</label>
                        <input type="text" class="form-control" id="contact_first_name" name="contact[first_name]" required>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <label for="contact_phone" class="form-label">Số điện thoại</label>
                        <input type="text" class="form-control" id="contact_phone" name="contact[phone]" required>
                    </div>
                    <div class="col-md-6">
                        <label for="contact_email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="contact_email" name="contact[email]" required>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Tiếp tục</button>
        </form>
    </div>
    <script>
        function toggleMenu() {
            const menu = document.querySelector('.dropdown-menu');
            menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
        }
    </script>
</body>
</html>
