<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tìm Chuyến Bay</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f3f4f6;
            font-family: 'Roboto', sans-serif;
        }
        .container {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }
        h2 {
            color: #007bff;
            font-weight: bold;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
            transition: 0.3s;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .form-check-label {
            color: #495057;
        }
        input, select {
            border-radius: 8px;
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
    <div class="container mt-5">
<h2 class="text-center mb-4"><i class="fas fa-plane-departure"></i> Tìm Chuyến Bay</h2>
        <form action="view/select_flight.php" method="GET">
            <!-- Loại vé -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Hãng bay:</label>
                    <div>
                        <select name="airline" id="airline" class="form-control">
                            
                            <?php include 'component/optionAirlines.php'; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                <label class="form-label">Loại vé:</label> <br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="trip_type" id="one_way" value="one_way" checked onchange="toggleReturnDate()">
                    <label class="form-check-label" for="one_way">Một chiều</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="trip_type" id="round_trip" value="round_trip" onchange="toggleReturnDate()">
                    <label class="form-check-label" for="round_trip">Khứ hồi</label>
                </div>

                </div>
            </div>

            <!-- Điểm đi và đến -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="from" class="form-label">Điểm đi</label>
                    <select name="diemDi" id="diemDi" class="form-control">
                        <?php
                            include 'component/optionLocation.php';
                        ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="to" class="form-label">Điểm đến</label>
                    <select name="diemDen" id="diemDen" class="form-control">
                        <?php
                            include 'component/optionLocation.php'; 
                        ?>
                    </select>
                </div>
            </div>

            <!-- Ngày đi và ngày về -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="departure_date" class="form-label">Ngày đi</label>
                    <input type="date" class="form-control" id="departure_date" name="departure_date" required>
                </div>
                <div class="col-md-6">
                    <label for="return_date" class="form-label">Ngày về</label>
                    <input type="date" class="form-control" id="return_date" name="return_date" disabled>
                </div>
            </div>

            <!-- Số lượng hành khách -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="adults" class="form-label">Người lớn (>= 12 tuổi)</label>
                    <input type="number" class="form-control" id="adults" name="adults" min="1" max="10" value="1" required>
                </div>
                <div class="col-md-6">
                    <label for="children" class="form-label">Trẻ em (0-11 tuổi)</label>
                    <input type="number" class="form-control" id="children" name="children" min="0" max="10" value="0">
                </div>
</div>

            <button type="submit" class="btn btn-primary w-100">Tìm chuyến bay</button>
        </form>
    </div>

    <script>
        function toggleReturnDate() {
            const tripType = document.querySelector('input[name="trip_type"]:checked').value;
            const returnDateField = document.getElementById('return_date');
            returnDateField.disabled = tripType === 'one_way';
            if (tripType === 'one_way') returnDateField.value = '';
        }
        toggleReturnDate();

        function toggleMenu() {
            const menu = document.querySelector('.dropdown-menu');
            menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
        }
    </script>
</body>
</html>