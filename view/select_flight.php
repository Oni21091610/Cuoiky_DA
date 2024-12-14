<?php
    error_reporting(0);

    $idAirline = $_GET['airline'];
    $idDiemDi = $_GET['diemDi'] ?? null;
    $idDiemDen = $_GET['diemDen'] ?? null; 
    $departure_date = $_GET['departure_date'] ?? null;
    $return_date = $_GET['return_date'] ?? null;
    $adults_amount = $_GET['adults'] ?? 0;
    $children_amount = $_GET['children'] ?? 0;

    $cities = [
        1 => 'Hồ Chí Minh',
        2 => 'Hà Nội',
        3 => 'Đà Nẵng',
        4 => 'Hải Phòng',
        5 => 'Nha Trang',
        6 => 'Huế',
        7 => 'Cần Thơ'
    ];

    $idDiemDi = isset($cities[$idDiemDi]) ? $cities[$idDiemDi] : 'Unknown';
    $idDiemDen = isset($cities[$idDiemDen]) ? $cities[$idDiemDen] : 'Unknown';

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
            <strong>Từ:</strong> <?= htmlspecialchars($idDiemDi) ?> - 
            <strong>Đến:</strong> <?= htmlspecialchars($idDiemDen) ?>
        </p>
        <p class="text-center">
            <strong>Người lớn:</strong> <?= htmlspecialchars($adults_amount) ?>, 
            <strong>Trẻ em:</strong> <?= htmlspecialchars($children_amount) ?>
        </p>
        
        <div class="list-group mt-4">
            <?php

if(isset($_GET['airline']))
{
    error_reporting(0);
    include '../controller/user.php';
    $p = new cUser();
    $result = $p->selectInfomationAllByIDAirlines($_GET['airline']);
    
    
    if($result)
    {
            while ($row = mysqli_fetch_assoc($result)) {
                $total_price = $row['adult_price'] * $adults_amount + $row['child_price'] * $children_amount;
                
                $price = number_format($row['adult_price'] * $adults_amount + $row['child_price'] * $children_amount, 0, ',', '.');

                echo '<form action="" method="post" enctype="multipart/form-data">';
                echo '<table class="table table-bordered">';

                echo '<tr>';
                echo '<div class="d-flex align-items-center">';
                    echo '<span class="me-2"><strong>Mã chuyến bay:</strong> '.$row['flight_number'].'</span>';
                    echo '<span class="me-2"><strong>Thời Gian:</strong> '.$row['departure_time'].'</span>';
                    echo '<span class="me-2"><strong>Giá:</strong> '.$price.' VND</span>';
                    echo '<div class="ms-auto"><a href="enter_customer_info.php?maChuyenBay='.$row['flight_number'].'" class="btn btn-primary">Đặt vé</a></div>';
                echo '</div>';
                echo '</tr>';
                echo '</table>';
                echo '</form>';
            }
        }
    }

    else
    {
        echo "Vui lòng chọn hãng bay";
    }
?>
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


