<?php
    include_once '../controller/user.php';
    $p = new cUser();
    $id = isset($_GET['id']) ? $_GET['id'] : null;
    $location = $id ? $p->selectLocationID($id) : null;
    $tblLocation = $p->selectLocationALL();



    if ($tblLocation) {
        if (mysqli_num_rows($tblLocation) > 0) { 
            echo "<option value=''>Vui lòng địa điểm</option>";
            while ($row = mysqli_fetch_assoc($tblLocation)) {
                // Xác định ca trực cho từng dòng
                $cities = [
                    1 => 'Hồ Chí Minh',
                    2 => 'Hà Nội',
                    3 => 'Đà Nẵng',
                    4 => 'Hải Phòng',
                    5 => 'Nha Trang',
                    6 => 'Huế',
                    7 => 'Cần Thơ'
                ];

                $city = isset($cities[$row["location"]]) ? $cities[$row["location"]] : 'Unknown';

                // Kiểm tra chọn ca trực hiện tại
                $selected = ($row['location'] == $location) ? "selected" : "";

                // Hiển thị <option>
                echo "<option $selected value='" . $row['location'] . "'>$city</option>";
            }
        } else {
            echo "<option value=''>Không có dữ liệu</option>";
        }
    } else {
        echo "<option value=''>Lỗi truy xuất dữ liệu</option>";
    }
?>
